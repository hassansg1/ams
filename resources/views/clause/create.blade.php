@extends('layouts.master')

@section('title') {{ $heading }} @endsection
@section('content')
    @php($standard = \App\Models\Standard::find(\Illuminate\Support\Facades\Session::get('standard_id')))
    @include('layouts.top_heading',['heading' => $standard->name.' > Enter Clause','goBack' => route($route.'.index')])
    <div class="row">
        <div class="col-lg-12">
            <form class="item_form" method="post" enctype="multipart/form-data" action="{{ route($route.'.store') }}">
                @include($route.'.form')
                @include('components.form_submit_btns')
            </form>
        </div>
    </div>
@endsection
