<div class="row">
    <div class="col-lg-12">
        <div class="card p-2">
            <div class="card-heading">
                <div class="row" style="margin-top: 1.25rem; margin-left: 1rem";>
                    <h3>Criticality</h3>
                </div>
                <div class="row" style="margin-top: 1.25rem; margin-left: 1rem";>
                    <div class="col-md-4">
                        <label for="select_version">Unit</label>
                        <select class="form-control select2" name="select_unit_compliance" id="select_unit_compliance">
                            <option value="">--Select Unit--</option>
                            @foreach(\App\Models\Location::where('parent_id', 1)->whereNotNull('name')->get() as $version)
                                <option  value="{{ $version->id }}">{{ $version->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="select_version">Site</label>
                        <select class="form-control select2" name="select_site_compliance" id="select_site_compliance">
                            <option value="">--Select Site--</option>

                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="select_version">Sub Site</label>
                        <select class="form-control select2" name="select_sub_site_compliance" id="select_sub_site_compliance">
                            <option value="">--Select sub Site--</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="asset-criticality-chart" class="e-charts"></div>
            </div>
        </div>
    </div>
</div>
