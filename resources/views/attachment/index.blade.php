@extends('components.datatable')
@section('table_header')
    <th class="select_all_checkbox" style="width: 10px"><input
            onclick="toggleSelectAll()"
            type="checkbox" name=""
            id="select_all"></th>
    <th>ID</th>
    <th>Document Number</th>
    <th>Version</th>
    <th>Date</th>
    <th>Title</th>
{{--    <th>Description</th>--}}
    <th>Category</th>
{{--    <th>Sub Category</th>--}}
    <th>Attachment</th>
    <th>Actions</th>
@endsection
@section('table_rows')
    @include($route.'.form_rows')
@endsection
@section('script-bottom')
    @include($route.'.script')
@endsection
