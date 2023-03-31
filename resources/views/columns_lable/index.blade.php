@extends('components.datatable')
@section('table_header')
    <th>Efected Model</th>
    <th>Event</th>
    <th>Changed by</th>
    <th>Description</th>
    <th>Updated At</th>
@endsection
@section('table_rows')
    @include($route.'.form_rows')
@endsection
