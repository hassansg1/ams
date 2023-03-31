<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Computer;
use App\Models\HardwareLegacy;
use App\Models\LoneAsset;
use App\Models\SoftwareLegacy;
use Illuminate\Http\Request;

class LegacySystem extends BaseController
{
    protected $model;
    protected $route;
    protected $heading;
    protected $topHeading;

    public function __construct()
    {
        $this->route = 'legacy_system';
        $this->heading = 'Hardware Model';
        \Illuminate\Support\Facades\View::share('top_heading', 'Hardware Model');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $computerHardware = HardwareLegacy::where('type', 1)->get();
        $networkHardware = HardwareLegacy::where('type', 2)->get();
        $loneHardware = HardwareLegacy::where('type', 3)->get();
        return view('legacy_system/index')
            ->with(['route' => $this->route, 'heading' => $this->heading, 'computer_hardware' => $computerHardware, 'network_hardware' => $networkHardware,'lone_hardware' => $loneHardware]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
