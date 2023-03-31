@extends('layouts.master')
@section('content')
    <div class="card">
       <h3>{{$heading}}</h3>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 table-responsive">
                    <button class="btn btn-primary mr-10 mb-3">
                        <a style="color: white"
                           href="{{ url('hardware/model/computer') }}">Computer</a>
                    </button>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Hardware Make</th>
                            <th>Hardware Model</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($computer_hardware as $value)
                            <tr>
                                <td>{{$value->hardware_make}}</td>
                                <td>{{$value->hardware_model}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--            {!! $computer_assets->links('vendor.pagination.bootstrap-4') !!}--}}
                </div>
                <div class="col-md-4 table-responsive">
                    <button class="btn btn-primary mr-10 mb-3">
                        <a style="color: white"
                           href="{{ url('hardware/model/lone') }}">L01</a>
                    </button>
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>Hardware Make</th>
                            <th>Hardware Model</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($network_hardware as $value)
                            <tr>
                                <td>{{$value->hardware_make}}</td>
                                <td>{{$value->hardware_model}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--            {!! $network_assets->links('vendor.pagination.bootstrap-4') !!}--}}
                </div>
                <div class="col-md-4 table-responsive">
                    <button class="btn btn-primary mr-10 mb-3">
                        <a style="color: white"
                           href="{{ url('hardware/model/network') }}">Network</a>
                    </button>
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>Hardware Make</th>
                            <th>Hardware Model</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lone_hardware as $value)
                            <tr>
                                <td>{{$value->hardware_make}}</td>
                                <td>{{$value->hardware_model}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--            {!! $network_assets->links('vendor.pagination.bootstrap-4') !!}--}}
                </div>
            </div>

        </div>
    </div>
@endsection

