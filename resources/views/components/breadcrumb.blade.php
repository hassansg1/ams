<div style="margin-left: 10px" class="row">
    <br>
    <div class="col-2 mt-3">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            @if($heading == 'dropDown')
                <h4 class="mb-sm-0 font-size-20"></h4>
            @else
                <h4 class="mb-sm-0 font-size-20">{{ $heading ?? '' }}</h4>
            @endif
        </div>
    </div>
    <div class="col-3 mt-3">
        <select onchange="changeLocation(this)" class="form-control select2" required>
            @foreach(getLocationsForDropDown(null,null,null,true) as $heading => $locations)
                <optgroup label={{ \App\Models\Location::getTypeToModel($heading) }}>
                    @foreach($locations as $location)
                        <option
                                {{ \Illuminate\Support\Facades\Session::get('asset_location_id') == $location->id ? 'selected' : '' }}
                                value="{{ $location->id }}">{{$location->name}}</option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>
    </div>
    <div class="col-12 mt-3">
        <div class="page-title-right">
{{--            <ol class="breadcrumb m-0">--}}
{{--                @foreach($items as $item)--}}
{{--                    <li class="col-md-2" style="margin-right: 10px">--}}
{{--                        <select class="form-control select2" required>--}}
{{--                            @foreach(getLocationsForDropDown($item->type,null,$model ?? null,true,$item) as $heading => $locations)--}}
{{--                                <optgroup label={{ \App\Models\Location::getTypeToModel($heading) }}>--}}
{{--                                    @foreach($locations as $location)--}}
{{--                                        <option--}}
{{--                                                {{ isset($item) && $item->parent_id == $location->id ? 'selected' : '' }}--}}
{{--                                                value="{{ $location->id }}">{{$location->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </optgroup>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </li>--}}
{{--                @endforeach--}}
{{--            </ol>--}}
            <ul class="breadcrumb m-0">
                @foreach($items as $item)
                    <li onmouseover="showList('{{ $item->id }}')" onmouseout="hideList('{{ $item->id }}')"
                        class="nav-item dropdown {{ $loop->last ? 'active' : '' }}">
                        <a href="{{ route('view/assets', [$item->id,0]) }}"
                           style="padding: 1px 4px;color: {{ $loop->last ? '#556ee6' : '#495057' }}"
                           class="nav-link  dropdown-toggle"
                           data-bs-toggle="dropdown">
                            {{ $item->text }} /
                        </a>
                        <ul class="dropdown-menu" id="ul_{{ $item->id }}">
                            @foreach(getLocationsForDropDown($item->type,null,$model ?? null,true,$item) as $heading => $locations)
                                @foreach($locations as $location)
                                    <li><a
                                                style="color: {{ $location->id == $item->id ? '#556ee6' : '#212529' }}"
                                                href="{{ route('view/assets', [$location->id,0]) }}"
                                                class="dropdown-item">{{ $location->text }}</a></li>
                                @endforeach
                            @endforeach
                        </ul>
                    </li>
                    @if($loop->last)
                        <li onmouseover="showList('0')" onmouseout="hideList('0')"
                            class="nav-item dropdown">
                            <a href="javascript:void(0)"
                               style="padding: 1px 4px;color: #495057"
                               class="nav-link  dropdown-toggle"
                               data-bs-toggle="dropdown">
                                <i class="bx bx-dots-horizontal"></i>
                            </a>
                            <ul class="dropdown-menu" id="ul_0">
                                @foreach(getLocationsForDropDown(null,null,null,true,$item,true) as $heading => $locations)
                                    @foreach($locations as $location)
                                        <li><a href="{{ route('view/assets', [$location->id,0]) }}"
                                               class="dropdown-item">{{ $location->text }}</a></li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

    </div>
</div>
@section('script')
    <script>
        function showList(id) {
            $('#ul_' + id).addClass('show');
        }

        function hideList(id) {
            $('#ul_' + id).removeClass('show');
        }
    </script>
@endsection
<style>
</style>