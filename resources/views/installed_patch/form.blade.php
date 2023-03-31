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
                        <label for="{{ isset($item) ? $item->id:'' }}asset_id" class="form-label required">Select Asset</label>
                        <select class="form-select form-select-input" name="asset_id"
                                id="{{ isset($item) ? $item->id:'' }}asset_id" required>
                            @foreach(\App\Models\Computer::all() as $var)
                                <option value=""></option>
                                <option
                                    {{ $var->id == (isset($item) ? $item->asset_id:old('asset_id') ?? '') ? 'selected' : ''  }}
                                    value="{{ $var->id }}">{{ $var->rec_id }} | {{ $var->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="{{ isset($item) ? $item->id:'' }}patch_id" class="form-label">Select
                            Patch</label>
                        <select class="form-select form-select-input" name="patch_id"
                                id="{{ isset($item) ? $item->id:'' }}patch_id">
                            @foreach(\App\Models\Patch::all() as $var)
                                <option value=""></option>
                                <option
                                    {{ $var->id == (isset($item) ? $item->patch_id:old('patch_id') ?? '') ? 'selected' : ''  }}
                                    value="{{ $var->id }}">{{ $var->name }} {{ $var->version }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
