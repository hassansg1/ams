<div class="mb-3">
    <table style="table-layout: fixed" class="table table-bordered">
        <thead style="text-align: center">
        <tr>
            <th style="width: 7%"></th>
            <th style="width: 5%"></th>
            @foreach(\App\Models\ConsequenceLevel::all() as $item)
                <th>{{ $item->name }}</th>
            @endforeach
        </tr>
        <tr>
            <th></th>
            <th></th>
            @foreach(\App\Models\ConsequenceLevel::all() as $item)
                <th style="text-align: right">{{ $item->value * 5 }}</th>
            @endforeach
        </tr>
        @php($count = 25)
        @php($found = [])
        @foreach(getThreatLevels() as $item)
            <tr>
                <th style="vertical-align: middle">{{ $item->name }}</th>
                <th style="vertical-align: top">{{ $count / 5 }}</th>
                @for($index = 1;$index<6;$index++)
                    <th style="padding: 0">
                        @include('risk_report.sub_table',["index"=>$index,"upperIndex"=>$count])
                    </th>
                @endfor
            </tr>
            @php($count = $count - 5)
        @endforeach
        </thead>
    </table>
</div>
<style>
    .mr-ds {
        position: relative;
    }

    .box_th {
        height: 20px;
        border: none !important;
    }
</style>