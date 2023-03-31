@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    @include('risk_report.content')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('risk_report.script')
@endsection