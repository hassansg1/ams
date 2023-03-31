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
                        <div class="mb-3">
                            <label for="{{ isset($item) ? $item->id:'' }}name" class="form-label required">Name</label>
                            <input type="text" value="{{ isset($item) ? $item->name:old('name') ?? ''  }}"
                                   class="form-control" id="{{ isset($item) ? $item->id:'' }}name" name="name" required>
                        </div>
                    </div>
                </div>
                @if(isset($item))
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Gap Rating (Security control rating)</h4>
                            <div class="mb-3">
                                <table class="table table-bordered table-striped">
                                    @for($index = 5;$index>0;$index--)
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="gap_rating[{{ $index }}]"
                                                       value="{{ getGapLabelForStandard($index,$item->id) }}">
                                            </td>
                                            <td>{{ $index }}</td>
                                        </tr>
                                    @endfor
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
