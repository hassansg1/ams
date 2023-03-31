@if(Request::url() == route($route.'.create'))
<a href="{{$cancelRoute ?? route($route.'.index')}}">
    <button type="button" class="btn btn-primary w-md">Cancel</button>
</a>
@else
    <a href="{{ url()->previous()}}">
        <button type="button" class="btn btn-primary w-md">Cancel</button>
    </a>
@endif

