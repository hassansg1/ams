@extends('components.datatable')
@section('table_header')
    <th>Hardware Make</th>
    <th>Hardware Model</th>
    <th>Type</th>
    <th>Actions</th>
@endsection
@section('table_rows')
    @include($route.'.form_rows')
@endsection
