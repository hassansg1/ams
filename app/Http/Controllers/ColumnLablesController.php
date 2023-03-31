<?php

namespace App\Http\Controllers;

use App\Models\ColumnLables;
use App\Http\Controllers\Controller;
use App\Models\Port;
use Illuminate\Http\Request;

class ColumnLablesController extends BaseController
{
    public function __construct()
    {
        $this->model = new ColumnLables();
        $this->route = 'columns_lable';
        $this->heading = 'Column Lables';
        \Illuminate\Support\Facades\View::share('top_heading', 'Column Lables');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $app = ColumnLables::get();
//        $arr = [];
        $table_name= ColumnLables::select('table_name')->groupBy('table_name')->get();
        $data['items'] = ColumnLables::get();
        $data['no_pagination'] = true;
        $data['no_header'] = true;
        $data['items_per_page'] = "all";
        return view($this->route . "/create")
            ->with(['items' => $data['items'], 'data' => $data, 'tables'=>$table_name, 'route' => $this->route, 'heading' => $this->heading]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        for ($count = 0; $count < count($request->id); $count++) {
            $lables = ColumnLables::where('id',$request['id'][$count])->update(['value'=>$request['value'][$count]]);
        }
        flashSuccess(getLang($this->heading . " Successfully Created."));

        return redirect(route($this->route . ".index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ColumnLables  $columnLables
     * @return \Illuminate\Http\Response
     */
    public function show(ColumnLables $columnLables)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ColumnLables  $columnLables
     * @return \Illuminate\Http\Response
     */
    public function edit(ColumnLables $columnLables)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ColumnLables  $columnLables
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ColumnLables $columnLables)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ColumnLables  $columnLables
     * @return \Illuminate\Http\Response
     */
    public function destroy(ColumnLables $columnLables)
    {
        //
    }
}
