<?php

namespace App\Http\Controllers;

use App\Models\AssetFunction;
use App\Models\HardwareLegacy;
use App\Models\Location;
use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('import.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        set_time_limit(0);
        $file = $request->file('csv_file');
        $editMode = $request->edit_mode ?? null;
        $fileName = $file->getClientOriginalName();
        $name = rand(1000000, 10000000) . $fileName;
        try {
            $file->move(public_path('assets/files'), $name);

            $file = public_path('assets/files/' . $name);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
        $csvContent = csvToArray($file);
        $header = $csvContent['header'];
        $data = $csvContent['data'];
        $tableName = explode('.', $fileName)[0];
        $modelClass = config('models.' . $tableName);
        $tableNameRaw = tableNamesMapping($tableName, 'import');
        $logs = [];
        $items = [];
        $success = true;
        $allLocations = Location::pluck('id', 'rec_id')->toArray();
        if ($modelClass) {
            $logs[] = 'File Validated successfully';
            $logs[] = '<br>';
            $columns = Schema::getColumnListing($tableName);
            $count = 0;
            DB::beginTransaction();
            $hardwares = HardwareLegacy::all();
            $makes = [];
            $models = [];
            foreach ($hardwares as $hardware){
                $models[$hardware->hardware_model] = $hardware;
            }
            foreach ($data as $obj) {
                if ($success) {
                    $count++;
                    $logs[] = 'Precessing row no. ' . $count;
                    $model = App::make($modelClass);
                    $saveModel = App::make($modelClass);

                    $arr = [];
                    for ($i = 0; $i < count($obj); $i++) {
                        $clm = tableColumnsMapping($tableNameRaw, 'import', $header[$i]);
                        if ($clm) {
                            $arr[$clm] = utf8_encode($obj[$header[$i]]);
                        }
                    }
                    if (isset($arr['single_point_of_failure'])) {
                        $arr['single_point_of_failure'] = ($arr['single_point_of_failure'] == 'Yes') ? 1 : 2;
                        $arr['criticality'] = ($arr['criticality'] == 'High') ? 1 : (($arr['criticality'] == 'Medium') ? 2 : 3);
                    }
//                    if (isset($arr['process'])){
//                        $process = Process::where('process', $arr['process'])->first();
//                        if ($process) {
//                            $arr['process'] = $process->id;
//                        }
//                    }
//                    if (isset($arr['function'])){
//                        $asset_function = AssetFunction::where('name', $arr['function'])->first();
//                        if (!$asset_function) {
//                            $logs[] = 'Error : Asset Function not found in master list : ' . $arr['function'];
//                            $success = false;
//                            break;
//                        }else{
//                            $arr['function'] = $asset_function->id;
//                        }
//                    }


                    if (isset($arr['model'])){
                        $make = $models[$arr['model']] ?? null;
                        if ($make) {
                            $arr['model'] = $make->id;
                            $arr['make'] = $make->id;
                        }
                    }
//
//                    if (isset($arr['part_number'])){
//                        $part_number = HardwareLegacy::where('part_number', $arr['part_number'])->first();
//                        if ($part_number) {
//                            $arr['part_number'] = $part_number->id;
//                        }
//                    }
                    $parentType = $arr['parent_type'];
                    $parentId = $arr['parent_id'];

                    if (!in_array($parentType, ['Company', 'Unit', 'Site', 'SubSite', 'Unit', 'Building', 'Room', 'Cabinet'])) {
                        $logs[] = 'Error : Invalid Parent Type : ' . $parentType;
                        $success = false;
                        break;
                    }
                    if ($parentId == '' || !$parentType) {
                        $logs[] = 'Error : Parent Id cannot be empty';
                        $success = false;
                        break;
                    }


                    $parent = $allLocations[$parentId];
                    if (!$parent) {
                        $logs[] = 'Error : Parent not found : ' . $parentId;
                        $success = false;
                        break;
                    }

                    $arr['parent_id'] = $parent;
                    $request = new Request();
                    $request->replace($arr);
                    $validator = Validator::make($request->all(), $model->rules);
                    if ($validator->fails() && !$editMode) {
                        foreach ($validator->errors()->all() as $error) {
                            $logs[] = 'Error : ' . rec_id_replacer($error);
                            $logs[] = 'Data : ' . print_r($request->all(), true);
                            $success = false;
                        }
                        $logs[] = 'Rolling back the changes.';
                        $success = false;
                        break;
                    } else {
                        try {
                            $location = null;
                            if (isset($editMode)) {
                                $location = $model::where('rec_id', $request->rec_id)->first();
                                if ($location) {
                                    $model = $location;
                                }
                            }
                            $item = $model->saveFormData($model, $request, false)->toArray();

                            $item['parent_id'] = $parent;
                            unset($item['show_name']);
                            $items[] = $item;
                        } catch (\Exception $exception) {
                            $logs[] = 'Internal Error. Message  : ' . $exception->getMessage() . ' . Please contact the administer.';
                            $success = false;
                            break;
                        }
                        $logs[] = 'Saving row no. ' . $count;
                        $logs[] = 'Data saved.';
                    }
                } else
                    break;
                $logs[] = '<br>';
            }
            if ($success) {
                foreach ($items as $key => $item){
                    unset($item['text']);
                    unset($item['id']);
                    $items[$key] = $item;
                }
                $saveModel->insert($items);
                $logs[] = '<br>';
                $logs[] = 'All the Data processed successfully.';
                DB::commit();
                Location::fixtree();
            } else {
                $logs[] = '<br>';
                $logs[] = 'Changes are rolled back.';
                $success = false;
                DB::rollBack();
            }
        } else {
            $success = false;
            $logs[] = 'Invalid file name';
        }

        return view('import.index')->with(['status' => $success, 'logs' => $logs]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
