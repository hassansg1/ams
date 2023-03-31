@php($rand = rand(100000,1000000))
<div class="row mt-2" id="com_{{ $rand }}">
    <div class="col-md-6">
        <label for="select_version">Select Compliance Run</label>
        <select required class="form-control select2 version_id"
                name="version_id[]" id="version_id"
                style="box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.1);">
            @if(isset($clauses) && $clauses)
                @include('dashboard.spider_chart.clause_selection',['items' => $clauses])
            @endif
        </select>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-10">
                <label for="color">Select Color</label>
                <input required type="color" name="color[]" class="form-control"
                       id="color" value="#33dbd0">
            </div>
            <div class="col-md-2">
                <button onclick="removeRow('com_{{ $rand }}')" title="Delete"
                        type="button" style="display: inline;margin-top: 35px"
                        class="btn btn-light btn-form btn-no-color dropdown-toggle btn_delete_row"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </div>
</div>