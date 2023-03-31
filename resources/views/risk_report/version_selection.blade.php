<div class="mb-3">
    <h4>
        Select one or multiple Compliance versions to compare
    </h4>
    <form action="" id="version_form">
        {{ csrf_field() }}
        <select onchange="versionSelected()" name="versions[]" id="versions" class="form-control select2" multiple>
            @foreach(\App\Models\ComplianceVersion::all() as $item)
                <option value="{{ $item->id }}">Compliance for  {{ $item->standard->name }} - Version : {{ $item->name }}</option>
            @endforeach
        </select>
    </form>
    <br>
    <button class="btn btn-primary" onclick="versionSelected()">Refresh</button>
</div>
