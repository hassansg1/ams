@extends('layouts.master')

@section('title') Dashboard @endsection
@section('content')
    @yield('top_content')
    <br>
    <div class="row">
        <div class="dashboard_stat_card">
            <div class="stat_card_left">
                <a href="{{ url('asset_lending_page') }}"></a><h4>Assets
                    ({{\App\Models\Location::whereIn('type', ['computer', 'lone', 'network'])->whereNotNull('name')->count()}}
                    )</h4>
                <a href="{{ route('computer.index') }}"><p>computer
                        ({{\App\Models\Location::where('type', 'computer')->whereNotNull('name')->count()}})</p></a>
                <a href="{{ route('network.index') }}"><p>Network
                        ({{\App\Models\Location::where('type', 'network')->whereNotNull('name')->count()}})</p></a>
                <a href="{{ route('l_one.index') }}"><p>level-01
                        ({{\App\Models\Location::where('type', 'lone')->whereNotNull('name')->count()}})</p></a>
            </div>
            <div class="stat_card_right">
                <img src="{{ URL::asset ('/assets/images/asset.svg') }}" alt="" height="28" width="20"
                     style="margin-right: 5px;">

            </div>

        </div>

        <div class="dashboard_stat_card">
            <div class="stat_card_left">
                <h4>Users ({{\App\Models\UserId::count()}})</h4>
                <a href="{{ route('user_id.index') }}"><p>permanent
                        ({{\App\Models\UserId::where('condition', 'permanent')->count()}})</p></a>
                <a href="{{ route('user_id.index') }}"><p>temporary
                        ({{\App\Models\UserId::where('condition', 'temporary')->count()}})</p></a>

            </div>
            <div class="stat_card_right">
                <img src="{{ URL::asset ('/assets/images/user.svg') }}" alt="" height="28" width="20"
                     style="margin-right: 5px;">

            </div>


        </div>

        <div class="dashboard_stat_card">
            <div class="stat_card_left">
                <h4>Patch Alert </h4>
                <a href="{{route('patch.index')}}"><p>pending ({{\App\Models\Patch::where('is_required', 1)->count()}}
                        )</p></a>
            </div>
            <div class="stat_card_right">
                <img src="{{ URL::asset ('/assets/images/patch.svg') }}" alt="" height="28" width="20"
                     style="margin-right: 5px;">

            </div>


        </div>

        <div class="dashboard_stat_card">
            <div class="stat_card_left">
                <h4>Software Update Alert</h4>
                <a href="{{route('software.index')}}"><p>Installation Pending ({{\App\Models\Software::count()}})</p>
                </a>
                {{--                <p>rejected (7)</p>--}}
            </div>
            <div class="stat_card_right">
                <img src="{{ URL::asset ('/assets/images/software.svg') }}" alt="" height="28" width="20"
                     style="margin-right: 5px;">

            </div>


        </div>

        <div class="dashboard_stat_card">
            <div class="stat_card_left">
                <h4>Nozomi Alerts</h4>
                <p>un-identified</p>
                <p>Assets</p>
            </div>
            <div class="stat_card_right">
                <img src="{{ URL::asset ('/assets/images/nazomi.svg') }}" alt="" height="28" width="20"
                     style="margin-right: 5px;">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('dashboard.spider_chart.index')
        </div>
        <div class="col-md-6">
            @include('dashboard.compliance_chart.index')
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('dashboard.asset_nozomi_chart.index')
        </div>
        <div class="col-md-6">
            @include('dashboard.asset_nozomi_chart.index')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('dashboard.assets_criticality_chart.index')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card p-2 h-100">
                <div class="card-heading">
                    <div class="row" style="margin-top: 1.25rem; margin-left: 1rem" ;>
                        <h3>User ID Satus</h3>
                    </div>
                </div>
                <div class="card-body h-100" style="height: 100%">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>User Id</th>
                            <th>Validity</th>
                            <th>User Expiry</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($userId as $value)
                            <tr @if($value->approvel_expirey_date <  Carbon\Carbon::today())  style="color: red;" @endif>
                                <td><a href="{{ route("user_id.edit",$value->id) }}">{{$value->user_id}}</a></td>
                                <td>{{$value->condition}}</td>
                                <td>{{$value->approvel_expirey_date}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-2 h-100">
                <div class="card-heading">
                    <div class="row" style="margin-top: 1.25rem; margin-left: 1rem" ;>
                        <h3>Firewall Satus</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Asset Id</th>
                            <th>Policy Status</th>
                            <th>Policy Expiry</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($firewall as $value)
                            <tr @if($value->approvel_expirey_date <  Carbon\Carbon::today())  style="color: red;" @endif>
                                <td>
                                    <a href="{{ route("firewall_managment.edit",$value->id) }}">{{$value->source_asset}}</a>
                                </td>
                                <td>{{$value->condition}}</td>
                                <td>{{$value->approvel_expirey_date}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-2 h-100">
                <div class="card-heading">
                    <div class="row" style="margin-top: 1.25rem; margin-left: 1rem" ;>
                        <h3>Firmeware Satus</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Current</th>
                            <th>Latest</th>
                            <th>Upgrade Required</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($firmware as $value)
                            <tr>
                                <td>{{$value->asset_firmware}} -
                                    ({{\App\Models\Location::where('asset_firmware', $value->asset_firmware)->count()}})
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            @include('dashboard.patch_approvals.index')
        </div>
    </div>
@endsection
@section('script')
    @include('dashboard.script')
@endsection
