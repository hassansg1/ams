<?php

namespace App\Http\Controllers;

use App\Models\ComplianceVersion;
use App\Models\Configuration;
use App\Models\ConsequenceLevel;
use App\Models\Risk;
use App\Http\Controllers\Controller;
use App\Models\RiskRating;
use App\Models\SecurityControl;
use App\Models\ThreatLevel;
use Illuminate\Http\Request;

class RiskReportController extends Controller
{
    protected $model;
    protected $route;
    protected $heading;
    protected $topHeading;

    public function __construct()
    {
        $this->model = new Configuration();
        $this->route = 'risk_report';
        $this->heading = 'Risk Report';
        \Illuminate\Support\Facades\View::share('top_heading', 'Risk Report');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->route . "/index")
            ->with(['route' => $this->route, 'heading' => $this->heading]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->route . "/create")
            ->with(['route' => $this->route, 'heading' => $this->heading]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        flashSuccess(getLang($this->heading . " Successfully Updated."));
        return redirect(route($this->route . ".index"));
    }

    /**
     * @param $item
     */
    public function show($item)
    {
    }

    public function edit(Request $request, $item)
    {
    }

    /**
     * @param Request $request
     * @param $item
     */
    public function update(Request $request, $item)
    {
    }

    /**
     * @param $item
     */
    public function destroy($item)
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateColor(Request $request)
    {
        RiskRating::where('id', $request->id)->update([
            "color" => $request->value
        ]);

        return response()->json([
            "status" => true
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadRiskTable(Request $request)
    {
        $versions = null;
        $versionIds = $request->versions ?? null;
        if ($versionIds && is_array($versionIds)) {
            $versions = ComplianceVersion::whereIn('id', $versionIds)->get();
        }
        if ($versions)
            foreach ($versions as $id => $version) {
                $score = getScoresForAVersion($version->id);
                $version->likeLiHoodScore = $score["likeLiHoodScore"];
                $version->consequenceScore = $score["consequenceScore"];
                $version->riskScore = $score["riskScore"];
                $versions[$id] = $version;
            }

        return response()->json([
            "status" => true,
            "version_html" => view('risk_report.version_table')->with(["versions" => $versions])->render(),
            "html" => view('risk_report.table')->with(["versions" => $versions])->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRiskCriteria(Request $request)
    {
        $riskArray = $request->risk ?? null;
        $highlight = null;
        if ($riskArray && is_array($riskArray)) {
            if ($riskArray[0] != 1) {
                return response()->json([
                    "status" => false,
                    "highlight" => 0,
                ]);
            }

            if ($riskArray[1] < $riskArray[0] + 1) {
                return response()->json([
                    "status" => false,
                    "highlight" => 1,
                ]);
            }

            if ($riskArray[2] != $riskArray[1]) {
                return response()->json([
                    "status" => false,
                    "highlight" => 2,
                ]);
            }

            if ($riskArray[3] < $riskArray[2] + 1) {
                return response()->json([
                    "status" => false,
                    "highlight" => 3,
                ]);
            }

            if ($riskArray[4] != $riskArray[3]) {
                return response()->json([
                    "status" => false,
                    "highlight" => 4,
                ]);
            }

            if ($riskArray[5] < $riskArray[4] + 1) {
                return response()->json([
                    "status" => false,
                    "highlight" => 5,
                ]);
            }

            if ($riskArray[6] != $riskArray[5]) {
                return response()->json([
                    "status" => false,
                    "highlight" => 6,
                ]);
            }

            if ($riskArray[7] < $riskArray[6] + 1) {
                return response()->json([
                    "status" => false,
                    "highlight" => 7,
                ]);
            }

            if ($riskArray[8] != $riskArray[7]) {
                return response()->json([
                    "status" => false,
                    "highlight" => 8,
                ]);
            }

            if ($riskArray[9] != 25) {
                return response()->json([
                    "status" => false,
                    "highlight" => 9,
                ]);
            }
        }

        $start = 0;
        $end = 1;
        $id = 1;
        for ($index = 1; $index < 6; $index++) {
            RiskRating::where('id', $id)->update(["from" => $riskArray[$start], 'to' => $riskArray[$end]]);
            $id += 1;
            $start += 2;
            $end += 2;
        }

        return response()->json([
            "status" => true,
        ]);
    }
}
