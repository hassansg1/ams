<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssetFunction;
use App\Models\ClauseData;
use App\Models\ComplianceVersion;
use App\Models\Location;
use App\Models\StandardClause;

class AssetsCriticalityChartController extends Controller
{
    public function  render(Request $request)
    {

        $assetsTypes = [
            '1'=>'high',
            '2'=>'medium',
            '3'=>'low',
        ];
        $computerCriticality = [];
        foreach ($assetsTypes as $key=>$types){
            $total_count= Location::where('type', 'computer');
            $high_critical_assets = Location::where('type', 'computer')->where('criticality', $key);
            if ($request->unit_id ) {
                $total_count->where('parent_id', $request->unit_id);
                $high_critical_assets->where('parent_id', $request->unit_id);
            }
            if ($request->site_id){
                $total_count->where('parent_id', $request->site_id);
                $high_critical_assets->where('parent_id', $request->site_id);
            }
            if ($request->sub_site_id) {
                $total_count->where('parent_id', $request->sub_site_id);
                $high_critical_assets->where('parent_id', $request->sub_site_id);
            }
                $total_count = $total_count->count();
                $high_critical_assets = $high_critical_assets->count();
                if ($total_count >0 && $high_critical_assets > 0){
                    $criticality_percentgae= $high_critical_assets / $total_count * 100;
                }else{
                    $criticality_percentgae = 0;
                }
                $computerCriticality[$types]= $criticality_percentgae;
                $computerAssetCriticalityArray = [];
                foreach ($computerCriticality as $computerAssetCriticality => $count) {
                    $count = round($count, 2);
                    array_push($computerAssetCriticalityArray, (object)['name' => $computerAssetCriticality. "($count'%')", 'value' => $count]);
                }

        }

        $networkCriticality = [];
        foreach ($assetsTypes as $key=>$types){
            $total_count= Location::where('type', 'network');
            $high_critical_assets = Location::where('type', 'network')->where('criticality', $key);
            if ($request->unit_id ) {
                $total_count->where('parent_id', $request->unit_id);
                $high_critical_assets->where('parent_id', $request->unit_id);
            }
            if ($request->site_id){
                $total_count->where('parent_id', $request->site_id);
                $high_critical_assets->where('parent_id', $request->site_id);
            }
            if ($request->sub_site_id) {
                $total_count->where('parent_id', $request->sub_site_id);
                $high_critical_assets->where('parent_id', $request->sub_site_id);
            }
            $total_count = $total_count->count();
            $high_critical_assets = $high_critical_assets->count();
            if ($total_count >0 && $high_critical_assets > 0){
                $criticality_percentgae= $high_critical_assets / $total_count * 100;
            }else{
                $criticality_percentgae = 0;
            }
                $networkCriticality[$types]= $criticality_percentgae;
                $networkAssetCriticalityArray = [];
                foreach ($networkCriticality as $networkrAssetCriticality => $count) {
                    $count = round($count, 2);
                    array_push($networkAssetCriticalityArray, (object)['name' => $networkrAssetCriticality. "($count'%')", 'value' => $count]);
                }
        }

        $loneCriticality = [];
        foreach ($assetsTypes as $key=>$types){
            $total_count= Location::where('type', 'lone');
            $high_critical_assets = Location::where('type', 'lone')->where('criticality', $key);
            if ($request->unit_id ) {
                $total_count->where('parent_id', $request->unit_id);
                $high_critical_assets->where('parent_id', $request->unit_id);
            }
            if ($request->site_id){
                $total_count->where('parent_id', $request->site_id);
                $high_critical_assets->where('parent_id', $request->site_id);
            }
            if ($request->sub_site_id) {
                $total_count->where('parent_id', $request->sub_site_id);
                $high_critical_assets->where('parent_id', $request->sub_site_id);
            }
            $total_count = $total_count->count();
            $high_critical_assets = $high_critical_assets->count();
            if ($total_count >0 && $high_critical_assets > 0){
                $criticality_percentgae= $high_critical_assets / $total_count * 100;
            }else{
                $criticality_percentgae = 0;
            }
                $loneCriticality[$types]= $criticality_percentgae;
                $loneAssetCriticalityArray = [];
                foreach ($loneCriticality as $loneAssetCriticality => $count) {
                    $count = round($count, 2);
                    array_push($loneAssetCriticalityArray, (object)['name' => $loneAssetCriticality. "($count'%')", 'value' => $count]);
                }
        }

        return response()->json([
            'status' => true,
            'computer' => $computerAssetCriticalityArray,
            'network' => $networkAssetCriticalityArray,
            'lone' => $loneAssetCriticalityArray,
        ]);
    }
}
