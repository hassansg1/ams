@include('components.form_errors')
{{ csrf_field() }}
@php
    $assets = getComputerAssets();
    $system = getSystems();
    $rights = getRights();
    $otcm_users = getOTCMUser();

@endphp
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
                <div class="row ">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}user_type"
                                   class="form-label required">User ID Type</label>
                            <select class="form-control select2" name="user_type" id="user_type" required>
                                <option value="">-Select User ID Type-</option>
                                <option value="asset" {{ isset($item) && $item->parent == "asset"  ? 'selected' : ''}}>
                                    Asset User ID
                                </option>
                                <option
                                    value="system" {{ isset($item) && $item->parent == "system"  ? 'selected' : ''}}>
                                    System User ID
                                </option>
                            </select>
                        </div>
                    </div>
                    @if(isset($item) && $item->parent == "system"  && $item->parent_id)
                        <div class="col-lg-6 system" }}>
                            @else
                                <div class="col-lg-6 system" style="display: none" }}>
                                    @endif
                                    <div class="mb-3">
                                        <label for="{{ isset($item) ? $item->id:'' }}parent_id"
                                               class="form-label required">System Name</label>
                                        <select class="form-control select2" id="system_id" name="system_id">
                                            <option value="">-Select System-</option>
                                            @foreach($system as $value)
{{--                                                <option--}}
{{--                                                    value="{{$value->id}}" {{ isset($item) && $item->parent_id == $value->id  ? 'selected' : ''}}>{{$value->name}}--}}
{{--                                                    ({{$value->system_type->name}})--}}
{{--                                                </option>--}}
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if(isset($item) && $item->parent == "asset"  && $item->parent_id)
                                    <div class="col-lg-6 asset" }}>
                                        @else
                                            <div class="col-lg-6 asset" style="display: none" }}>
                                                @endif
                                                <div class="mb-3">
                                                    <label for="{{ isset($item) ? $item->id:'' }}asset_id"
                                                           class="form-label required">Asset ID</label>
                                                    <select class="form-control select2" id="parent_id"
                                                            name="parent_id">
                                                        <option value="">-Select Asset ID-</option>
                                                        @foreach($assets as $value)
                                                            <option
                                                                value="{{$value->id}}" {{ isset($item) && $item->parent_id == $value->id  ? 'selected' : ''}}>{{$value->rec_id}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="{{ isset($item) ? $item->id:'' }}user_id"
                                                       class="form-label required">User ID</label>
                                                <input type="text"
                                                       value="{{ isset($item) ? $item->user_id:old('user_id') ?? ''  }}"
                                                       class="form-control"
                                                       id="{{ isset($item) ? $item->id:'' }}user_id"
                                                       name="user_id" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="{{ isset($item) ? $item->id:'' }}right"
                                                       class="form- required">User ID Rights</label><br>
                                                @if(isset($method))
                                                    @foreach($rights as $value)
                                                        @if(in_array($value->id, $selectedRights))
                                                            <h6><span class="badge bg-light">{{$value->name}}</span></h6>
                                                        @endif
                                                    @endforeach
                                                @else
                                                <select class="form-control select2" id="right_id" name="right_id[]"
                                                        required multiple>
                                                    <option value="">-Select Right-</option>
                                                    @foreach($rights as $value)
                                                        <option
                                                            value="{{$value->id}}" {{ isset($item, $item->user_rights_id->right_id) && in_array($value->id, $selectedRights)  ? 'selected' : ''}}>{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="{{ isset($item) ? $item->id:'' }}description"
                                                       class="form-label">Description</label>
                                                <textarea class="form-control" id="{{ isset($item) ? $item->id:'' }}description" name="description">{{ isset($item) ? $item->description:old('description') ?? ''  }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="{{ isset($item) ? $item->id:'' }}condition"
                                                       class="form-label required">Select User ID Status</label>
                                                <select class="form-control select2" id="condition" name="condition">
                                                    <option value="">-Select User ID Status-</option>
                                                    <option
                                                        value="temporary" {{ isset($item) && $item->condition == 'temporary'  ? 'selected' : ''}}>
                                                        Temporary
                                                    </option>
                                                    <option
                                                        value="permanent" {{ isset($item)  && $item->condition == 'permanent'  ? 'selected' : ''}}>
                                                        Permanent
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="{{ isset($item) ? $item->id:'' }}approvel_expirey_date"
                                                       class="form-label">User ID Expirey Date</label>
                                                <input type="date"
                                                       value="{{ isset($item) ? $item->approvel_expirey_date:old('approvel_expirey_date') ?? ''  }}"
                                                       {{ isset($item) && $item->condition == 'permanent'  ? 'disabled' : ''}}
                                                       class="form-control"
                                                       id="{{ isset($item) ? $item->id:'' }}approvel_expirey_date"
                                                       name="approvel_expirey_date">
                                            </div>
                                        </div>
                                    </div>
                                <br>
                                    @if(isset($item) && $users)
                                        <hr class="solid">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h3>Assigned User</h3>
                                            </div>
                                            <div class="col-md-4">
                                                <div style="text-align: right">
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        Assign User
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Unit</th>
                                                        <th>User</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($users as $value)
                                                        <tr id="{{ $value->id }}">
                                                            {{--        <td colspan="1"><input type="checkbox" name="select_row" value="{{ $value->id }}"--}}
                                                            {{--                               id="select_check_{{ $value->id }}" class="select_row"></td>--}}
                                                            @if($value->user_unit)
                                                                <td>{{ $value->user_unit->rec_id }}</td>
                                                            @else
                                                                <td></td>
                                                            @endif
                                                            <td>{{ $value->name }}</td>
                                                            <td><button type="button" class="btn btn-default btn-sm delete_user_id" id="{{ $value->id }}" onclick="return confirm('Are you sure unassign ID?')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                        </div>
                </div>
            </div>
        </div>
{{--        @section('script')--}}
{{--            <script type="text/javascript">--}}
{{--                $('#user_type').on('change', function () {--}}
{{--                    var type = this.value;--}}
{{--                    if (type == "asset") {--}}
{{--                        $('.asset').show();--}}
{{--                        $('.system').hide();--}}
{{--                    } else if (type == "system") {--}}
{{--                        $('.asset').hide();--}}
{{--                        $('.system').show();--}}
{{--                    }--}}
{{--                });--}}
{{--                $('#condition').on('change', function () {--}}
{{--                    var condition = this.value;--}}
{{--                    if (condition == 'permanent') {--}}
{{--                        $("input[type=date]").val('');--}}
{{--                        $("input[name=approvel_expirey_date]").attr('disabled', true);--}}
{{--                    }--}}
{{--                    if (condition == 'temporary') {--}}
{{--                        $("input[name=approvel_expirey_date]").attr('disabled', false);--}}
{{--                    }--}}

{{--                });--}}
{{--            </script>--}}
{{--@endsection--}}
