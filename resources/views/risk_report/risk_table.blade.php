<div class="mb-3">
    <h4>
        Risk Criteria Entry
    </h4>
    <form action="" id="risk_form">
        <table style="table-layout: fixed" class="table table-bordered">
            <thead>
            <tr>
                <th>Risk Rating From</th>
                <th>Risk Rating To</th>
                <th>Risk Level</th>
                <th>Select Color</th>
            </tr>
            </thead>
            {{ csrf_field() }}
            @php($count = 0)
            @foreach(\App\Models\RiskRating::all() as $item)
                <tr>
                    <td><input required id="risk_{{ $count }}" name="risk[]" type="number"
                               class="form-control risk_input"
                               value="{{ $item->from }}"></td>
                    @php($count++)
                    <td><input required id="risk_{{ $count }}" name="risk[]" type="number"
                               class="form-control risk_input"
                               value="{{ $item->to }}"></td>
                    @php($count++)
                    <td>{{ $item->name }}</td>
                    <td><input onchange="updateColor(this,'{{ $item->id }}')" type="color" value="{{ $item->color }}">
                    </td>
                </tr>
            @endforeach
        </table>
        <button type="submit" class="btn btn-primary risk_criteria_btn">Update Risk Criteria</button>
    </form>
</div>
<style>
    .invalid_risk {
        border: 1px solid red !important;
    }
</style>