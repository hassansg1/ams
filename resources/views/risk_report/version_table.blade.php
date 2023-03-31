<div class="mb-3">
    <h5>
        Selected Versions
    </h5>
    <table style="table-layout: fixed" class="table table-bordered">
        <thead>
        <tr>
            <th>Sr. no</th>
            <th>Name</th>
            <th>Weighted Likelihood</th>
            <th>Weighted Consequence</th>
            <th>Risk Score</th>
        </tr>
        </thead>
        @if($versions)
            @foreach($versions as $item)
                <tr onmouseover="showMarker({{ $item->id }})" onmouseout="hideMarker({{ $item->id }})"
                    class="hrt  hrt_{{ $item->id }}">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->likeLiHoodScore }}</td>
                    <td>{{ $item->consequenceScore }}</td>
                    <td>{{ $item->riskScore }}</td>
                </tr>
            @endforeach
        @endif
    </table>
</div>
<style>
    .hrt:hover {
        background-color: #5897fb;
        color: white;
        cursor: pointer;
    }

    .hrt_hover {
        background-color: #5897fb;
        color: white;
        cursor: pointer;
    }

    .marker_hover {
        font-size: 25px;
    }
</style>
