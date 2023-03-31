@foreach($items as $item)
    @php($padding = 10)
    @include('tree_files.version_compliance_table',['padding' => $padding,'class'=>''])
@endforeach
@section('script')
    @include('version_compliance.script')
@endsection
