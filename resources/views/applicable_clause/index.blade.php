@extends('components.datatable')
@section('table_header')
    <th class="select_all_checkbox" style="width: 10px"><input
            onclick="toggleSelectAll()"
            type="checkbox" name=""
            id="select_all"></th>
    <th style="width: 50px">Number</th>
    <th style="max-width: 20px">Title</th>
    <th>Description</th>
    <th>Applicable</th>
    <th>Security Control Weightage</th>
    <th>Applicability</th>
    <th>Justification</th>
@endsection
@section('below_filters')
    @include('components.clause_filter')
@endsection
@section('table_rows')
    @include($route.'.form_rows')
@endsection

@section('script')
    @include('applicable_clause.script')
@endsection
