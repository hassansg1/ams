<div class="col-md-6">
    <h4>Consequence Levels Definition</h4>
    <div class="mb-3">
        <table class="table table-bordered table-striped">
            @foreach(getConsequenceLevels() as $item)
                <tr>
                    <td>
                        <input type="text" class="form-control" name="consequence[{{ $item->id }}]"
                               value="{{ $item->name }}">
                    </td>
                    <td>{{ $item->value }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
