@include('components.form_errors')
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ isset($clone) && $clone ? '' : (isset($item) ? $item->id : '') }}">
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ $heading }} Information</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}hardware_make"
                                   class="form-label required">Hardware Make</label>
                            <input type="text" value="{{ isset($item) ? $item->hardware_make:old('hardware_make') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}hardware_make"
                                   name="hardware_make">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}hardware_model"
                                   class="form-label">Hardware Model</label>
                            <input type="text" value="{{ isset($item) ? $item->hardware_model:old('hardware_model') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}hardware_model"
                                   name="hardware_model">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}type" class="form-label">Asset Type</label>
                            <select class="form-select form-select-input" name="type"
                                    id="{{ isset($item) ? $item->id:'' }}type">
                                    <option value=""></option>
                                    <option value="computer" {{ isset($item) && $item->type == 'Computer' ? 'selected' : ''}}>Computer</option>
                                    <option value="network" {{ isset($item) && $item->type == 'Network' ? 'selected' : ''}}>Network</option>
                                    <option value="lone" {{ isset($item) && $item->type == 'lone' ? 'selected' : ''}}>Level01</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}end_of_sale"
                                   class="form-label">End of sale date</label>
                            <input type="date" value="{{ isset($item) ? $item->end_of_sale:old('end_of_sale') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}end_of_sale"
                                   name="end_of_sale">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}end_of_life"
                                   class="form-label">End of life date</label>
                            <input type="date" value="{{ isset($item) ? $item->end_of_life:old('end_of_life') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}end_of_life"
                                   name="end_of_life">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
