<div class="col-md-6">
    <h4>Security Control Weightage Definition</h4>
    <div class="mb-3">
        <table class="table table-bordered table-striped">
            @foreach(getSecurityControl() as $item)
                <tr>
                    <td>
                        <input type="text" class="form-control" name="security_control[{{ $item->id }}]"
                               value="{{ $item->name }}">
                    </td>
                    <td>{{ $item->value }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
