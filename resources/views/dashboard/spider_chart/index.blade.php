<div class="row">
    <div class="col-lg-12">
        <div class="card p-2" style="height: 1045px">
            <form action="" id="spider_form">
                {{ csrf_field() }}
                <div class="card-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="select_version">Standards</label>
                            <select required class="form-control select2 required"
                                    name="standard_id" id="standard_id_spider"
                                    onchange="loadVersionsForSpider()"
                                    style="box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.1);">
                                <option value="">Search by Name</option>
                                @foreach(\App\Models\Standard::all() as $standard)
                                    <option value="{{ $standard->id }}">{{ $standard->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="select_version">Select Level</label>
                            <select required class="form-control select2"
                                    name="depth" id="depth"
                                    style="box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.1);">
                                <option value="0">Level 1</option>
                                <option value="1">Level 2</option>
                                <option value="2">Level 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="select_version">Location</label>
                            <select class="form-control select2"
                                    name="location_id[]"
                                    id="location_id" multiple>
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
                        <div class="col-md-6">
                            <label for="color">Select Criticality</label>
                            <select class="form-control select2"
                                    name="security_control_rating" id="security_control_rating"
                                    style="box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.1);">
                                <option value=""></option>
                                @foreach(getSecurityControl() as $security)
                                    <option
                                            value="{{ $security->value }}">{{ $security->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="version_list">
                    @include('dashboard.spider_chart.version_selection')
                    </div>
                    <div class="col-md-12 mt-2">
                        <button class="btn btn-primary" onclick="addComplianceRow()" type="button">Select Another Compliance run</button>
                    </div>
                    <div class="col-md-12 mt-4">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
