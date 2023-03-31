<div class="row">
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="{{ isset($item) ? $item->id:'' }}short_name" class="form-label required">Asset
                Parent</label>
            @include('hierarchy.create_drop_down',['type' => 'assets','model'=> $model])
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="{{ isset($item) ? $item->id:'' }}rec_id" class="form-label required">Asset ID</label>
            <input type="text" value="{{ isset($item) ? $item->rec_id:old('rec_id') ?? ''  }}"
                   class="form-control" id="{{ isset($item) ? $item->id:'' }}rec_id"
                   name="rec_id" required>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="{{ isset($item) ? $item->id:'' }}name" class="form-label">Asset Name</label>
            <input type="text" value="{{ isset($item) ? $item->name:old('name') ?? ''  }}"
                   class="form-control" id="{{ isset($item) ? $item->id:'' }}name"
                   name="name">
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="{{ isset($item) ? $item->id:'' }}description"
                   class="form-label">Description</label>
            <input type="text" value="{{ isset($item) ? $item->description:old('description') ?? ''  }}"
                   class="form-control" id="{{ isset($item) ? $item->id:'' }}description"
                   name="description">
        </div>
    </div>
    <div class="col-lg-4">

        <div class="mb-3">
            <label for="{{ isset($item) ? $item->id:'' }}function" class="form-label">Asset Function</label>
            <input type="text" value="{{ isset($item) ? $item->function:old('function') ?? ''  }}"
                   class="form-control" id="{{ isset($item) ? $item->id:'' }}function"
                   name="function">
        </div>
{{--        <div class="mb-3">--}}
{{--            <label for="{{ isset($item) ? $item->id:'' }}function" class="form-label required">Asset Function</label>--}}
{{--            <a style="margin-left: 5px" href="javascript:void(0)" data-bs-toggle="modal"--}}
{{--               data-bs-target="#asset_functions">--}}
{{--                <i class="fas fa-plus-circle"></i>--}}
{{--            </a>--}}
{{--            <select class="form-select form-select-input" name="function"--}}
{{--                    id="{{ isset($item) ? $item->id:'' }}function" required>--}}
{{--                @if(isset($item))--}}
{{--                    @foreach(\App\Models\AssetFunction::all() as $function)--}}
{{--                        <option {{ $function->id == $item->functions ? 'selected' : ''  }} value="{{ $function->id }}">{{ $function->name }}</option>--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            </select>--}}
{{--        </div>--}}

    </div>

    <div class="col-lg-4">
        <div class="mb-3">
            <label for="{{ isset($item) ? $item->id:'' }}serial_number" class="form-label">Serial
                Number</label>
            <input type="text"
                   value="{{ isset($item) ? $item->serial_number:old('serial_number') ?? ''  }}"
                   class="form-control" id="{{ isset($item) ? $item->id:'' }}serial_number"
                   name="serial_number">
        </div>
    </div>
</div>
@php
$hardType = ucwords($route);
if($route == "l_one") $hardType = "lone";
@endphp
<div class="row">
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="{{ isset($item) ? $item->id:'' }}model" class="form-label">Make / Model </label>
            <select class="form-control select2" id="model" name="model">
                <option value="">-Select hardware Model-</option>
                    @foreach(\App\Models\HardwareLegacy::whereNotNull('hardware_model')->where('type',$hardType)->groupBy('hardware_model')->get() as $make)
                        <option {{ isset($item) && $make->id == $item->model ? 'selected' : ''  }} value="{{ $make->id }}">{{ $make->hardware_make }} | {{ $make->hardware_model }}</option>
                    @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="{{ isset($item) ? $item->id:'' }}part_number" class="form-label">Part
                Number</label>
{{--            <a style="margin-left: 5px" href="javascript:void(0)" data-bs-toggle="modal"--}}
{{--               data-bs-target="#make_model">--}}
{{--                <i class="fas fa-plus-circle"></i>--}}
{{--            </a>--}}
{{--            <select class="form-control select2" id="part_number" name="part_number">--}}
{{--                <option value="">-Select Part Number-</option>--}}
{{--                    @foreach(\App\Models\HardwareLegacy::get() as $make)--}}
{{--                        <option {{ $make->id == (isset($item) ? $item->part_number:old('last_name') ?? '') ? 'selected' : ''  }} value="{{ $make->id }}">{{ $make->part_number }}</option>--}}
{{--                    @endforeach--}}
{{--            </select>--}}
            <input type="text"
                   value="{{ isset($item) ? $item->part_number:old('part_number') ?? ''  }}"
                   class="form-control" id="{{ isset($item) ? $item->id:'' }}part_number"
                   name="part_number">
        </div>
    </div>

    <div class="col-lg-4">
        <div class="mb-3">
            <label for="{{ isset($item) ? $item->id:'' }}comment" class="form-label">Comments</label>
            <input type="text"
                   value="{{ isset($item) ? $item->comment:old('comment') ?? ''  }}"
                   class="form-control" id="{{ isset($item) ? $item->id:'' }}comment"
                   name="comment">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="{{ isset($item) ? $item->id:'' }}security_zone" class="form-label">Security
                Zone</label>
            <input type="text"
                   value="{{ isset($item) ? $item->security_zone:old('security_zone') ?? ''  }}"
                   class="form-control" id="{{ isset($item) ? $item->id:'' }}security_zone"
                   name="security_zone">
        </div>
    </div>
</div>
@section('script-bottom')
<script>
    $(document).ready(function () {
        // assetfunctions();
        // hardwareMake();
    });

    {{--function assetfunctions() {--}}
    {{--    $.ajax({--}}
    {{--        type: "get",--}}
    {{--        url: "{{url('asset/functions/name')}}",--}}
    {{--        success: function (res) {--}}
    {{--            if (res) {--}}
    {{--                $("select[name=function]").empty();--}}
    {{--                $("select[name=function]").append(--}}
    {{--                    '<option value="">--Select Asset Function--</option>'--}}
    {{--                );--}}
    {{--                $.each(res, function (key, value) {--}}
    {{--                    $("select[name=function]").append(--}}
    {{--                        '<option class="selected" value="' + key + '">' + value + '</option>'--}}
    {{--                    );--}}
    {{--                });--}}
    {{--            }--}}
    {{--        }--}}

    {{--    });--}}
    {{--}--}}

    {{--function hardwareMake() {--}}
    {{--    $.ajax({--}}
    {{--        type: "get",--}}
    {{--        url: "{{url('hardware/make/name')}}",--}}
    {{--        success: function (res) {--}}
    {{--            if (res) {--}}
    {{--                $("select[name=make]").empty();--}}
    {{--                $("select[name=make]").append(--}}
    {{--                    '<option value="">--Select Hardware Make--</option>'--}}
    {{--                );--}}
    {{--                $.each(res, function (key, value) {--}}
    {{--                    $("select[name=make]").append(--}}
    {{--                        '<option value="' + key + '">' + value + '</option>'--}}
    {{--                    );--}}
    {{--                });--}}
    {{--            }--}}
    {{--        }--}}

    {{--    });--}}
    {{--}--}}

    {{--$("select[name=make]").on('change', function () {--}}
    {{--    var make = this.value;--}}
    {{--    if (make) {--}}
    {{--        $.ajax({--}}
    {{--            type: "get",--}}
    {{--            url: "{{url('make/value')}}/" + make,--}}
    {{--            success: function (res) {--}}
    {{--                if (res) {--}}
    {{--                    $("#model").empty();--}}
    {{--                    $("#model").append(--}}
    {{--                        '<option value="">-- Select Hardware Model --</option>' +--}}
    {{--                        '<option value="0">N/A</option>'--}}
    {{--                    );--}}
    {{--                    $.each(res, function (key, value) {--}}
    {{--                        $("#model").append(--}}
    {{--                            '<option value="' + key + '">' + value + '</option>'--}}
    {{--                        );--}}
    {{--                    });--}}
    {{--                }--}}
    {{--            }--}}

    {{--        });--}}
    {{--    }--}}
    {{--});--}}
    {{--$("select[name=model]").on('change', function () {--}}
    {{--    var model_value = this.value;--}}
    {{--    var make_value = $("select[name=make]").val();--}}
    {{--    ;--}}
    {{--    if (model_value) {--}}
    {{--        $.ajax({--}}
    {{--            type: "get",--}}
    {{--            url: "{{url('model/value')}}",--}}
    {{--            data: {'model_value': model_value, 'make_value': make_value},--}}
    {{--            success: function (res) {--}}
    {{--                if (res) {--}}
    {{--                    $("#part_number").empty();--}}
    {{--                    $("#part_number").append('<option value="">-- Select Part Number --</option>');--}}
    {{--                    $.each(res, function (key, value) {--}}
    {{--                        $("#part_number").append(--}}
    {{--                            '<option value="' + key + '">' + value + '</option>'--}}
    {{--                        );--}}
    {{--                    });--}}
    {{--                }--}}
    {{--            }--}}

    {{--        });--}}
    {{--    }--}}
    {{--});--}}

    {{--$("#asset_function").on('click', function (event) {--}}
    {{--    event.preventDefault();--}}
    {{--    var name = $('#asset_function_name').val();--}}
    {{--    $.ajax({--}}
    {{--        url: "{{url('asset_function/name')}}",--}}
    {{--        type: "POST",--}}
    {{--        data: {--}}
    {{--            "name": name,--}}
    {{--            "_token": "{{ csrf_token() }}",--}}
    {{--        },--}}
    {{--        success: function (data) {--}}
    {{--            $('#asset_functions').modal('hide');--}}
    {{--            // assetfunctions();--}}
    {{--        },--}}
    {{--    });--}}
    {{--});--}}

    {{--$("#make_model_button").on('click', function (event) {--}}
    {{--    event.preventDefault();--}}
    {{--    var make = $('#hardware_make').val();--}}
    {{--    var model = $('#hardware_model').val();--}}
    {{--    var part_number = $('#hardware_part_number').val();--}}
    {{--    $.ajax({--}}
    {{--        url: "{{url('make/model')}}",--}}
    {{--        type: "POST",--}}
    {{--        data: {--}}
    {{--            "make": make,--}}
    {{--            "model": model,--}}
    {{--            "part_number": part_number,--}}
    {{--            "_token": "{{ csrf_token() }}",--}}
    {{--        },--}}
    {{--        success: function (data) {--}}
    {{--            $('#make_model').modal('hide');--}}
    {{--            $('#make_model form')[0].reset();--}}
    {{--            hardwareMake();--}}
    {{--        },--}}
    {{--    });--}}
    {{--});--}}
</script>
@endsection

