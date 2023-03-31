@extends('layouts.master')
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <a href="{{ route('standard.index') }}">Standards</a> > <a
                                href="{{ route('standard.edit',$standard->id) }}">{{ $standard->name }}</a> > Clauses
                    </h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="clause-tree"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('clause_edit_tree.style')
@endsection
@section('script')
    @include($route.'.script')
@endsection