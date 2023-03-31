<?php

namespace App\Http\Controllers;

use App\Models\AssetFunction;
use App\Models\ClauseData;
use App\Models\ComplianceVersion;
use App\Models\ComplianceVersionItem;
use App\Models\Location;
use App\Models\Patch;
use App\Models\StandardClause;
use Illuminate\Http\Request;

class ComplianceChartController extends Controller
{
    //
    public function render(Request $request)
    {
        $versionId = $request->versionId ?? 4;
        $locationInput = $request->locationId ?? null;
        $parentClauseId = $request->parentClauseId ?? null;
        $oldParentClauseId = $request->oldParentClauseId ?? null;

        $totalClauses = 0;
        $version = ComplianceVersion::find($versionId);
        $clauses = StandardClause::with('descendants');
        if ($parentClauseId) {
            $clauses->where('parent_id', $parentClauseId);
        } else {
            $clauses->where('parent_id', null);
        }
        $clauses = $clauses->where('standard_id', $version->standard_id);
        $clauses = $clauses->where('is_heading', 1);
        $clauses = $clauses->get();
        $data = [];
        for ($x = 0; $x < 10; $x++) {
            $label = getGapLabelForStandard($x, $version->standard_id);
            if ($label != "Unknown")
                $data[$label] = 0;
        }
        $locationTypes = [];
        if ($locationInput) {
            $locationsModels = Location::whereIn('id', $locationInput)->get();
            foreach ($locationsModels as $locationsModel)
                $locationTypes[] = Location::getTypeToModel($locationsModel->type);
        }

        foreach ($clauses as $clause) {
            if ($clause->isApplicable() && $clause->isApplicableOnLocationType($locationTypes)) {
                $clauseNumbers = [];
                $total = 0;
                for ($x = 0; $x < 10; $x++) {
                    $label = getGapLabelForStandard($x, $version->standard_id);
                    if ($label != "Unknown")
                        $clauseNumbers[$label] = 0;
                }
                $allClauses = $clause->descendants;
                $allClauses->push($clause);
                foreach ($allClauses as $descendant) {
                    if ($descendant->applicable && $descendant->is_heading == 0 && $descendant->isApplicableOnLocationType($locationTypes)) {
                        $applicability = $descendant->location;
                        if ($applicability) {
                            $locationModel = 'App\Models\\' . $applicability;
                            $locations = $locationModel::pluck('id')->toArray();
                            if (isset($locationInput))
                                $locations = $locationInput;
                            foreach ($locations as $location) {
                                $compliance = getComplianceVersionItem($versionId, $descendant->id, $location);
                                $complianceLabel = getGapLabelForStandard($compliance, $version->standard_id);
                                if (!isset($data[$complianceLabel])) $data[$complianceLabel] = 1;
                                else $data[$complianceLabel] = $data[$complianceLabel] + 1;
                                if (!isset($clauseNumbers[$complianceLabel])) $clauseNumbers[$complianceLabel] = 1;
                                else $clauseNumbers[$complianceLabel] = $clauseNumbers[$complianceLabel] + 1;
                                $total += 1;
                            }
                        }
                    }
                }
                $clause->clauseNumbers = $clauseNumbers;
                $clause->totalNumber = $total;
                $totalClauses += 1;
                $clause->notShow = 0;
            } else
                $clause->notShow = 1;
        }

        $table = view('chart.compliance_chart.table')->with(['clauses' => $clauses,'oldParentClauseId'=>$oldParentClauseId,'parentClauseId'=>$parentClauseId, 'version' => $version, 'totalClauses' => $totalClauses])->render();

        $returnObj = [];
        foreach ($data as $label => $count) {
            array_push($returnObj, (object)['value' => $count, 'name' => $label . "($count)"]);
        }

        return response()->json([
            'status' => true,
            'data' => $returnObj,
            'table' => $table
        ]);
    }

    public function assets_chart()
    {
        $data = [];
        foreach (Location::assetTypes() as $key => $value) {
            $data[$value] = Location::where('type', $value)->count();
        }
        $assetChartArray = [];
        foreach ($data as $type => $count) {
            array_push($assetChartArray, (object)['value' => $count, 'name' => $type . "($count)"]);
        }
        return response()->json([
            'status' => true,
            'data' => $assetChartArray,
        ]);
    }

    public function assets_functions_chart()
    {
        $data = [];
        $assetFunctions = AssetFunction::get();
        foreach ($assetFunctions as $key => $value) {
            $data[$value->name] = Location::where('function', $value->id)->count();
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

    public function spiderChart(Request $request)
    {
        $prefixes = [];
        $standardId = $request->standard_id;
        $colors = $request->color;
        $depth = $request->depth;
        $versionId = $request->version_id;
        $securityControl = $request->security_control_rating;
        $locations = $request->location_id;
        $standardClause = StandardClause::where('standard_id', $standardId)->withDepth()->having('depth', '=', $depth);
        if ($securityControl && $securityControl != "") {
            $standardClause = $standardClause->where('security_control_rating', $securityControl);
        }
        $standardClause = $standardClause->get();
        $complianceVersions = ComplianceVersion::whereIn('id', $versionId)->get();
        $compliances = [];
        $index = 0;
        foreach ($complianceVersions as $complianceVersion) {
            $color = $colors[$index];
            $key = 0;
            foreach ($standardClause as $root) {
                if (!in_array($root->number, $prefixes))
                    $prefixes[] = $root->number;
                $clauses = $root->descendants;
                $total = 0;
                $compliant = 0;
                foreach ($clauses as $clause) {
                    if ($clause->is_heading == 0 && $clause->applicable == 1) {
                        $locationModel = 'App\Models\\' . $clause->location;
                        $locations = $locationModel::get();
                        foreach ($locations as $location) {
                            $complianceVersionItem = ComplianceVersionItem::where('compliance_version_id', $complianceVersion->id)
                                ->where('clause_id', $clause->id);
                            $complianceVersionItem = $complianceVersionItem->where('location_id', $location->id);
                            $complianceVersionItem = $complianceVersionItem->first();
                            $total += 1;
                            if ($complianceVersionItem) {
                                if ($complianceVersionItem->compliant == 1)
                                    $compliant += 1;
                            }
                        }
                    }
                }
                $compliances[$key] = getPercent($compliant, $total);
                $key += 1;
            }
            $index += 1;
            $obj = [
                "label" => $complianceVersion->name,
                "data" => array_values($compliances),
                "fill" => false,
                "backgroundColor" => "$color",
                "borderColor" => "$color",
                "pointBackgroundColor" => "$color",
                "pointBorderColor" => "#fff",
                "pointHoverBackgroundColor" => '#fff',
                "pointHoverBorderColor" => "$color",
            ];
            $dataSets[] = (object)$obj;
        }
        return response()->json([
            'prefixes' => $prefixes,
            'datasets' => $dataSets ?? [],
        ]);
    }

    public function loadVersionsForSpider(Request $request)
    {
        $clauses = ComplianceVersion::where('standard_id', $request->standard_id)->get();

        return response()->json([
            'status' => true,
            'html' => view('dashboard.spider_chart.clause_selection')->with(['items' => $clauses])->render()
        ]);
    }

    public function addComplianceRow(Request $request)
    {
        $clauses = null;
        if ($request->standard_id)
            $clauses = ComplianceVersion::where('standard_id', $request->standard_id)->get();

        return response()->json([
            'status' => true,
            'html' => view('dashboard.spider_chart.version_selection')->with(['clauses' => $clauses])->render()
        ]);
    }

    public function patchReport(Request $request)
    {
        $patches = Patch::all();

        return response()->json([
            'status' => true,
            'html' => view('patch_report.form_rows')->with(['items' => $patches])->render()
        ]);
    }
}
