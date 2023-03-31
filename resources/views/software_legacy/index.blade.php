@extends('components.datatable')
@section('top_content')
    <button class="btn btn-primary mr-10 mb-3">
        <a style="color: white"
           href="{{ route('hardware_legacy.index') }}">
            Hardware Legacy</a>
    </button>
    <button class="btn btn-primary mr-10 mb-3">
        <a style="color: white"
           href="{{ route('software_legacy.index') }}">
            Software Legacy</a>
    </button>
@endsection
@section('table_header')
    <th class="select_all_checkbox" style="width: 10px"><input
            onclick="toggleSelectAll()"
            type="checkbox" name=""
            id="select_all"></th>
    <th>Software Name</th>
    <th>Software Version</th>
    <th>Software Type</th>
    <th>Status</th>
    <th>Actions</th>
@endsection
@section('table_rows')
    @include($route.'.form_rows')
@endsection
