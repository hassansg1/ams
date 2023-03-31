@extends('layouts.master')
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Global Risk Management Settings</h4>

                    @include('components.form_errors')
                    <form class="item_form" method="post" enctype="multipart/form-data"
                          action="{{ route($route.'.store') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="threat_level"
                                           class="form-label required">Threat Level</label>
                                    <select name="threat_level" id="threat_level" class="form-control select2">
                                        @foreach(getThreatLevels() as $item)
                                            <option
                                                    {{ getConfiguration("threat_level") == $item->value ? 'selected' : '' }}
                                                    value="{{ $item->value }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="consequence_level"
                                           class="form-label required">Consequence</label>
                                    <select name="consequence_level" id="consequence_level"
                                            class="form-control select2">
                                        @foreach(getConsequenceLevels() as $item)
                                            <option
                                                    {{ getConfiguration("consequence_level") == $item->value ? 'selected' : '' }}
                                                    value="{{ $item->value }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @include('risk_settings.partials.threat_level')
                            @include('risk_settings.partials.consequence_level')
                        </div>
                        <br>
                        <div class="row">
                            @include('risk_settings.partials.security_control')
                            @include('risk_settings.partials.gap_rating')
                        </div>
                        @include('components.form_submit_btns')
                    </form>
                    <br>
                    <br>
                    <hr>
                    @include('risk_report.upper_content')
                    <div class="row">
                        <div class="col-md-6">
                            @include('risk_report.risk_table')
                        </div>
                    </div>
                    <form action="" id="version_form">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .save_add_new {
            display: none !important;
        }
    </style>
@endsection

@section('script')
    @include('risk_report.script')
@endsection