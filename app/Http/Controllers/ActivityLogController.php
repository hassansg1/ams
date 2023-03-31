<?php

namespace App\Http\Controllers;

use App\Models\ColumnLables;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends BaseController
{

    public function __construct()
    {
        $this->model = new Activity();
        $this->route = 'activity_log';
        $this->heading = 'Activity Logs';
        \Illuminate\Support\Facades\View::share('top_heading', 'Activity Logs');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $app = ColumnLables::get();
        $arr = [];
        $data = $this->fetchData($this->model, $request);
        $data['no_pagination'] = true;
        $data['no_header'] = true;
        $data['items_per_page'] = "all";
        return view($this->route . "/create")
            ->with(['items' => $data['items'], 'data' => $data, 'columns'=>$app, 'route' => $this->route, 'model_name'=>'Activity', 'heading' => $this->heading]);
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
