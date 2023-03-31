@php

    $departments = getDepartments();
    $designations = getDesignations();
    $associate = getAssociatIds();
    $status = getStatus();
    $system = getSystems();
    $assets = getComputerAssets();
    $units = getUnits();
    $sites = getSites();
    $sub_sites = getSubSites();

@endphp
@include('components.form_errors')
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
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}unit_id"
                                   class="form-label required">Associated With</label>
                            <select class="form-control select2" name="parent_id"
                                    id="{{ isset($item) ? $item->id:'' }}short_name" required>
                                <option value="">Search by Name</option>
                                @foreach(getLocationsForDropDown('sites',isset($item)?'edit':'create',$model ?? null) as $heading => $locations)
                                    <optgroup label={{ \App\Models\Location::getTypeToModel($heading) }}>
                                        @foreach($locations as $location)
                                            <option
                                                {{ isset($item) && $item->unit_id == $location->id ? 'selected' : '' }}
                                                value="{{ $location->id }}">{{ $location->text }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}first_name"
                                   class="form-label required">User Full Name</label>
                            <input type="text"
                                   value="{{ isset($item) ? $item->first_name:old('first_name') ?? ''  }}"
                                   class="form-control"
                                   id="{{ isset($item) ? $item->id:'' }}first_name"
                                   name="first_name" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}email"
                                   class="form-label required">Email</label>
                            <input type="email"
                                   value="{{ isset($item) ? $item->email:old('email') ?? ''  }}"
                                   class="form-control"
                                   id="{{ isset($item) ? $item->id:'' }}email" name="email">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label for="" class="form-label">Department</label>
                        <input type="text"
                               value="{{ isset($item) ? $item->department_id:old('department_id') ?? ''  }}"
                               class="form-control"
                               id="{{ isset($item) ? $item->id:'' }}department_id" name="department_id">
                    </div>
                    <div class="col-lg-4">
                        <label for="" class="form-label">Designations</label>
                        <input type="text"
                               value="{{ isset($item) ? $item->designation_id:old('designation_id') ?? ''  }}"
                               class="form-control"
                               id="{{ isset($item) ? $item->id:'' }}designation_id" name="designation_id">
                    </div>
                    <div class="col-lg-4">
                        <label for="" class="form-label">Contact No</label>
                        <input type="text"
                               value="{{ isset($item) ? $item->mobile_no:old('mobile_no') ?? ''  }}"
                               class="form-control"
                               id="{{ isset($item) ? $item->id:'' }}mobile_no" name="mobile_no">
                    </div>
                </div>
                <br>
                @if(isset($item))
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Assigned User ID's</h3>
                        </div>
                        <div class="col-md-6" style="text-align: right">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Assign ID
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>User Id</th>
                                        <th>System/Asset</th>
                                        <th>Right</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($userIds as $value)
                                        <tr id="{{ $value->id }}">
                                            {{--        <td colspan="1"><input type="checkbox" name="select_row" value="{{ $value->id }}"--}}
                                            {{--                               id="select_check_{{ $value->id }}" class="select_row"></td>--}}
                                            <td>{{ $value->user_id }}</td>
                                            <td>
                                                @if($value->parent == "asset")
                                                    <i>AST:</i> {{ $value->user_id_assets->rec_id }}
                                                @elseif($value->parent == "system")
                                                    <i>SYS:</i> {{ $value->user_id_systems->name }}
                                                @endif
                                            </td>
                                            <td>
                                                @foreach(\App\Models\UserRight::where('parent_id', $value->id)->get() as $function)
                                                    @if($function->rights_name)
                                                        {{  $function->rights_name->name }}<br>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td><button type="button" class="btn btn-default btn-sm delete_id" id="{{ $value->id }}" onclick="return confirm('Are you sure want to unassign ID?')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
{{--@section('script')--}}
{{--    <script type="text/javascript">--}}
{{--        $('#unit_id').on('change', function () {--}}
{{--            var unit_id = this.value;--}}
{{--            if (unit_id) {--}}
{{--                $.ajax({--}}
{{--                    type: "get",--}}
{{--                    url: "{{url('unit/type')}}/" + unit_id,--}}
{{--                    success: function (res) {--}}
{{--                        if (res) {--}}
{{--                            $.each(res, function (key, value) {--}}
{{--                                $("#site_id").append('<option value="' + key + '">' + value + '</option>');--}}
{{--                            });--}}
{{--                        }--}}
{{--                    }--}}

{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--        $('#site_id').on('change', function () {--}}
{{--            var site_id = this.value;--}}
{{--            if (site_id) {--}}
{{--                $.ajax({--}}
{{--                    type: "get",--}}
{{--                    url: "{{url('site/type')}}/" + site_id,--}}
{{--                    success: function (res) {--}}
{{--                        if (res) {--}}
{{--                            $.each(res, function (key, value) {--}}
{{--                                $("#sub_site_id").append('<option value="' + key + '">' + value + '</option>');--}}
{{--                            });--}}
{{--                        }--}}
{{--                    }--}}

{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
