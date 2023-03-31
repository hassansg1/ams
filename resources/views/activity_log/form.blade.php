@include('components.form_errors')
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ isset($clone) && $clone ? '' : (isset($item) ? $item->id : '') }}">

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ $heading }} Information</h4>
                        @foreach($columns as $column_key_lables)
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Column Name</label>
                                        <input type="text" value="{{$column_key_lables->key}}" class="form-control" id="{{ isset($item) ? $item->id:'' }}key" name="key" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Lable</label>
                                        <input type="text" value="{{ isset($column_key_lables) ? $column_key_lables->value:'' }}" class="form-control" id="value" name="value">
                                    </div>
                                </div>
                            </div>
                        @endforeach
            </div>
        </div>
    </div>
</div>
