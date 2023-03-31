@include('components.form_errors')
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ isset($clone) && $clone ? '' : (isset($item) ? $item->id : '') }}">

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ $heading }} Information</h4>
                <div class="row">
                    <div class="col-lg-4">
                        <label for="{{ isset($item) ? $item->id:'' }}vendor_id"
                               class="form-label required">Vendor</label>
                        <select class="form-select form-select-input" name="vendor_id"
                                id="{{ isset($item) ? $item->id:'' }}vendor_id" required>
                            @foreach(\App\Models\Vendor::all() as $vendor)
                                <option value=""></option>
                                <option
                                        {{ $vendor->id == (isset($item) ? $item->vendor_id:old('vendor_id') ?? '') ? 'selected' : ''  }}
                                        value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}name"
                                   class="form-label required">Software Name</label>
                            <input type="text" value="{{ isset($item) ? $item->name:old('name') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}name"
                                   name="name">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}version"
                                   class="form-label required">Software Version</label>
                            <input type="text" value="{{ isset($item) ? $item->version:old('version') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}version"
                                   name="version">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}description"
                                   class="form-label">Software Descrption</label>
                            <input type="text" value="{{ isset($item) ? $item->description:old('description') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}description"
                                   name="description">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}function" class="form-label">Software
                                Family</label>
                            <input type="text" value="{{ isset($item) ? $item->function:old('function') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}function" name="function">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Patch/AV Approval Required</label>
                            <br>
                            <input type="checkbox" id="switch3" switch="bool" name="approval_required"
                                    {{ isset($item) && $item->approval_required == 1 ? 'checked':''  }}
                            />
                            <label for="switch3" data-on-label="Yes"
                                   data-off-label="No"></label>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}software_type" class="form-label required">Software
                                Type</label>
                            <select class="form-select form-select-input" name="software_type"
                                    id="{{ isset($item) ? $item->id:'' }}software_type">
                                <option value="">Select Software Type</option>
                                <option {{ $item->software_type == "application_software" ? 'selected' : '' }}
                                        value="application_software">Application Software
                                </option>
                                <option {{ $item->software_type == "operating_system" ? 'selected' : '' }} value="operating_system">
                                    Operating System
                                </option>
                                <option {{ $item->software_type == "antivirus" ? 'selected' : '' }} value="antivirus">
                                    Antivirus
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
