<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssetCountNozomiBase extends Controller
{
    public function  render(Request $request)
    {
        $data = [];
        $unit_it = $request->unit_it ?? null;
        $site_id = $request->site_id ?? null;
        $sub_site_id = $request->sub_site_id ?? null;
        $assetFunctions = AssetFunction::get();
        foreach ($assetFunctions as $key => $value) {
            if ($request->unit_id != null){
                $data[$value->name]= Location::where('parent_id', $request->unit_id)->where('function', $value->id)->count();
            }
            else if ($request->site_id != null){
                $data[$value->name]= Location::whereIn('parent_id', [$request->unit_id,$request->site_id])->where('function', $value->id)->count();
            }
            else if ($request->sub_site_id != null){
                $data[$value->name]= Location::whereIn('parent_id', [$request->unit_id,$request->site_id, $request->sub_site_id])->where('function', $value->id)->count();
            } else{
                $data[$value->name]= Location::where('function', $value->id)->count();
            }
        }
        $assetFunctionChartArray = [];
        foreach ($data as $assetFunction => $count) {
            array_push($assetFunctionChartArray, (object)['value' => $count, 'name' => $assetFunction . "('Assets'$count)"]);
        }
        return response()->json([
            'status' => true,
            'data' => $assetFunctionChartArray,
        ]);
    }
}
