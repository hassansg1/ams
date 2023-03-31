@include('components.form_errors')
@php
    $asset_functions = getAssetFunctions();
     $assets = getComputerAssets();
    $system = getSystems();
    $rights = getRights();
    $otcm_users = getOTCMUser();
@endphp
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ isset($clone) && $clone ? '' : (isset($item) ? $item->id : '') }}">

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ $heading }} Information</h4>
                @include('components.form_errors')
                {{ csrf_field() }}
                <input type="hidden" name="id"
                       value="{{ isset($clone) && $clone ? '' : (isset($item) ? $item->id : '') }}">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}user_type"
                                   class="form-label required">Select System/Asset</label>
                            <select class="form-control select2" name="user_type" id="user_type" required>
                                <option value="">-Select System/Asset-</option>
                                <option value="asset" {{ isset($item) && $item->parent == "asset"  ? 'selected' : ''}}>
                                    Asset
                                </option>
                                <option
                                    value="system" {{ isset($item) && $item->parent == "system"  ? 'selected' : ''}}>
                                    System
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @if(isset($item) && $item->parent == "system"  && $item->parent_id)
                        <div class="mb-3 system">
                            @else
                                <div class="mb-3 system" style="display: none">
                                    @endif
                            <label for="{{ isset($item) ? $item->id:'' }}parent_id"
                                   class="form-label required">System Name</label>
                            <select class="form-control select2" id="system_id" name="system_id">
                                <option value="">-Select System-</option>
                                @foreach($system as $value)
                                    <option
                                        value="{{$value->id}}" {{ isset($item) && $item->parent_id == $value->id  ? 'selected' : ''}}>{{$value->name}}
                                        ({{$value->name}})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                                @if(isset($item) && $item->parent == "asset"  && $item->parent_id)
                                    <div class="mb-3 asset">
                                        @else
                                            <div class="mb-3 asset" style="display: none">
                                                @endif
                            <label for="{{ isset($item) ? $item->id:'' }}asset_id" class="form-label required">Asset ID</label>
                            <select class="form-control select2" id="parent_id" name="parent_id">
                                <option value="">-Select Asset ID-</option>
                                @foreach($assets as $value)
                                    <option value="{{$value->id}}" {{ isset($item) && $item->parent_id == $value->id  ? 'selected' : ''}}>{{$value->rec_id}}</option>@endforeach
                            </select>
                        </div>
                    </div>
{{--                    @if(isset($item) && $item->parent == "system"  && $item->parent_id)--}}
{{--                        <div class="col-lg-6 system" }}>--}}
{{--                            @else--}}
{{--                                <div class="col-lg-6 system" style="display: none" }}>--}}
{{--                                    @endif--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label for="{{ isset($item) ? $item->id:'' }}parent_id"--}}
{{--                                               class="form-label required">System Name</label>--}}
{{--                                        <select class="form-control select2" id="system_id" name="system_id">--}}
{{--                                            <option value="">-Select System-</option>--}}
{{--                                            @foreach($system as $value)--}}
{{--                                                <option--}}
{{--                                                    value="{{$value->id}}" {{ isset($item) && $item->parent_id == $value->id  ? 'selected' : ''}}>{{$value->name}}--}}
{{--                                                    ({{$value->name}})--}}
{{--                                                </option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                        </div>--}}
{{--                        @if(isset($item) && $item->parent == "asset"  && $item->parent_id)--}}
{{--                            <div class="col-lg-6 asset" }}>--}}
{{--                                @else--}}
{{--                                    <div class="col-lg-6 asset" style="display: none" }}>--}}
{{--                                        @endif--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label for="{{ isset($item) ? $item->id:'' }}asset_id"--}}
{{--                                                   class="form-label required">Asset ID</label>--}}
{{--                                            <select class="form-control select2" id="parent_id"--}}
{{--                                                    name="parent_id">--}}
{{--                                                <option value="">-Select Asset ID-</option>--}}
{{--                                                @foreach($assets as $value)--}}
{{--                                                    <option--}}
{{--                                                        value="{{$value->id}}" {{ isset($item) && $item->parent_id == $value->id  ? 'selected' : ''}}>{{$value->rec_id}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                            </div>--}}
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}name"
                                   class="form-label required">User ID Right</label>
                            <input type="text"
                                   value="{{ isset($item) ? $item->name:old('name') ?? ''  }}"
                                   class="form-control"
                                   id="{{ isset($item) ? $item->id:'' }}name"
                                   name="name" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}description" class="form-label">Rights Description</label>
                            <textarea class="form-control" name="description" id="description">{{ isset($item) ? $item->description:old('description') ?? ''  }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
