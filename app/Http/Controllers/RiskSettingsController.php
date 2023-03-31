<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\ConsequenceLevel;
use App\Models\Risk;
use App\Http\Controllers\Controller;
use App\Models\SecurityControl;
use App\Models\ThreatLevel;
use Illuminate\Http\Request;

class RiskSettingsController extends Controller
{
    protected $model;
    protected $route;
    protected $heading;
    protected $topHeading;

    public function __construct()
    {
        $this->model = new Configuration();
        $this->route = 'risk_settings';
        $this->heading = 'Risk Settings';
        \Illuminate\Support\Facades\View::share('top_heading', 'Risk Settings');
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (isset($request->threat_level) && $request->threat_level) {
            Configuration::where('name', 'threat_level')->update([
                "value" => $request->threat_level
            ]);
        }
        if (isset($request->consequence_level) && $request->consequence_level) {
            Configuration::where('name', 'consequence_level')->update([
                "value" => $request->consequence_level
            ]);
        }

        if (isset($request->threat) && is_array($request->threat)) {
            foreach ($request->threat as $id => $label) {
                ThreatLevel::where('id', $id)->update([
                    "name" => $label
                ]);
            }
        }

        if (isset($request->consequence) && is_array($request->consequence)) {
            foreach ($request->consequence as $id => $label) {
                ConsequenceLevel::where('id', $id)->update([
                    "name" => $label
                ]);
            }
        }

        if (isset($request->security_control) && is_array($request->security_control)) {
            foreach ($request->security_control as $id => $label) {
                SecurityControl::where('id', $id)->update([
                    "name" => $label
                ]);
            }
        }

        flashSuccess(getLang($this->heading . " Successfully Updated."));
        return redirect()->back();
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
}
