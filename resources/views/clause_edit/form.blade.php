@include('components.form_errors')
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ isset($clone) && $clone ? '' : (isset($item) ? $item->id : '') }}">

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ $heading }} Information</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}parent_id" class="form-label">Parent
                                Clause</label>
                            <select class="form-control select2" name="parent_id"
                                    id="{{ isset($item) ? $item->id:'' }}parent_id">
                                <option value="">Search by Name</option>
                                @foreach(getClauses(Session::get('standard_id')) as $row)
                                    <option
                                        {{ isset($item) && $item->parent_id == $row->id ? 'selected' : '' }}
                                        value="{{ $row->id }}">{{ $row->title }}  {{ $row->number }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="{{ isset($item) ? $item->id:'' }}is_heading" class="form-label">Is Heading</label>
                        <select
                                {{ isset($parent) ? 'disabled' : '' }}
                                class="form-control select2" name="is_heading"
                                id="{{ isset($item) ? $item->id:'' }}is_heading">
                            <option
                                    {{ isset($item) && $item->is_heading == 1 ? 'selected' : '' }}
                                    value="Yes">Yes
                            </option>
                            <option
                                    {{ isset($item) && $item->is_heading == 0 ? 'selected' : '' }}
                                    value="No">No
                            </option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}security_control_rating" class="form-label">Security
                                Control Rating</label>
                            <select class="form-control select2" name="security_control_rating"
                                    id="{{ isset($item) ? $item->id:'' }}security_control_rating">
                                <option value="">Search by Name</option>
                                @foreach(\App\Models\SecurityControl::all() as $row)
                                    <option
                                            {{ isset($item) && $item->security_control_rating == $row->value ? 'selected' : '' }}
                                            value="{{ $row->value }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}title" class="form-label">Title</label>
                            <input type="text" value="{{ isset($item) ? $item->title:old('title') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}title" name="title">
                            <input type="hidden" class="form-control" name="standard_id" id="standard_id" value="{{Session::get('standard_id')}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}number"
                                   class="form-label required">Number</label>
                            <input type="text" value="{{ isset($item) ? $item->number:old('number') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}number" name="number">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}description"
                                   class="form-label">Description</label>
                            <textarea class="form-control" name="description"
                                      id="{{ isset($item) ? $item->id:'' }}description" cols="30"
                                      rows="10">{{ isset($item) ? $item->description:old('description') ?? ''  }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
