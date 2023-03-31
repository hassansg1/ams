<div class="col-md-6">
    <h4>Gap Rating (Security control rating)</h4>
    <div class="mb-3">
        <table class="table table-bordered table-striped">
            @foreach(getGapRatings() as $item)
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
