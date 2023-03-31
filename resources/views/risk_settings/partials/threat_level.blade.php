<div class="col-md-6">
    <h4>Threat Levels Definition</h4>
    <div class="mb-3">
        <table class="table table-bordered table-striped">
            @foreach(getThreatLevels() as $item)
                <tr>
                    <td>
                        <input type="text" class="form-control" name="threat[{{ $item->id }}]"
                               value="{{ $item->name }}">
                    </td>
                    <td>{{ $item->value }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
