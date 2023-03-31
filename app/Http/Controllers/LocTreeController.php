<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Role;
use App\Models\StandardClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocTreeController extends Controller
{
    //
    public function sidebar_tree()
    {
        $locations = Role::locationsArray();
        $tree = [];
        foreach ($locations as $location) {
            $nodes = Location::descendantsAndSelf($location)->sortBy('short_name')->toFlatTree()->toArray();
            $subTree =  buildTree($nodes, $location);
            $parentNode = $nodes[0] ?? null;
            if ($parentNode){
                $parentNode['href'] = url('view/assets/'.$nodes[0]['id'].'/0');
                $parentNode['nodes'] = $subTree;
                $nodeTree[0] = (object) $parentNode;
                $tree = array_merge($tree,$nodeTree );
            }
        }

        return response()->json([
            'status' => true,
            'tree' => $tree
        ]);
    }

    public function clause_tree(Request $request)
    {
        $clauses = StandardClause::where('parent_id',null)->where('standard_id',$request->standardId)->pluck('id')->toArray();
        $tree = [];
        foreach ($clauses as $clause) {
            $nodes = StandardClause::descendantsAndSelf($clause)->toFlatTree()->toArray();
            $subTree =  buildTree($nodes, $clause);
            $parentNode = $nodes[0];
            $parentNode['href'] = "javascript:void(0)";
            $parentNode['nodes'] = $subTree;
            $nodeTree[0] = (object) $parentNode;
            $tree = array_merge($tree,$nodeTree );
        }

        return response()->json([
            'status' => true,
            'tree' => $tree
        ]);
    }
}
