@extends('components.datatable',['id' => 'dtb'])
@section('table_header')
    <th class="select_all_checkbox" style="width: 10px"><input
            onclick="toggleSelectAll()"
            type="checkbox" name=""
            id="select_all"></th>
    <th>Number</th>
    <th>Title</th>
    <th>Security Control Weightage</th>
    <th>Description</th>
@endsection
@section('table_rows')
    @include($route.'.form_rows')
@endsection
@section('below_filters')
    @include('components.clause_filter')
@endsection
@section('script')
    @include('components.ui_formatter.hide_new_btn')
    @include('applicable_clause.script')
@endsection
