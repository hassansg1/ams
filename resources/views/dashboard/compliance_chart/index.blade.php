<div class="row">
    <div class="col-lg-12">
        <div class="card p-2">
            <div class="card-heading">
                <div class="row" style="margin-top: 2.5rem; margin-left: 1rem" ;>
                    <h3>Compliance Chart</h3>
                    <div class="col-md-6">
                        <label for="select_version">Standards</label>
                        <select class="form-control select2" onchange="renderComplianceChart()" name="select_version"
                                id="select_version" style="box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.1);">
                            <option value="">Search by Name</option>
                            @foreach(\App\Models\ComplianceVersion::all() as $version)
                                <option selected value="{{ $version->id }}">{{ $version->name }}
                                    - {{ $version->standard->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="select_version">Location</label>
                        <select onchange="renderComplianceChart()" class="form-control select2" name="select_location[]"
                                id="select_location" multiple required>
                            <option value="">Search by Name</option>
                            @foreach(getLocationsForDropDown('assets',null,$model ?? null) as $heading => $locations)
                                <optgroup label={{ \App\Models\Location::getTypeToModel($heading) }}>
                                    @foreach($locations as $location)
                                        <option
                                                {{ isset($item) && $item->parent_id == $location->id ? 'selected' : '' }}
                                                value="{{ $location->id }}">{{ $location->text }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
                <div class="card-body">
                    <div id="compliance-pie-chart" class="e-charts"></div>
                    <div style="overflow-y: scroll;max-height: 500px" id="compliance_table"></div>
                </div>
        </div>
    </div>
</div>
