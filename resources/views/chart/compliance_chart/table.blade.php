<h3>Compliance Report for {{ $version->standard->name }} - Version : {{ $version->name }}</h3>
<table class="table table-responsive table-bordered">
    <thead>
    <tr>
        <th>Clause</th>
        <th>Fully Implemented</th>
        <th>Largely Implemented</th>
        <th>Partially Implemented</th>
        <th>Not evaluated</th>
        <th>Not implemented</th>
    </tr>
    </thead>
    <tbody>
    @php
        $totals = [];
        $tClauses = 0;
    @endphp
    @foreach($clauses as $clause)
        @if(!$clause->notShow)
            @php($tClauses += $clause->totalNumber)
            <tr>
                <td><a href="javascript:void(0)"
                       onclick="renderComplianceChart('{{ $clause->id }}')">{{ $clause->number }}  {{ $clause->title }}</a>
                </td>
                @foreach($clause['clauseNumbers'] as $label => $clauseNumbers)
                    @if($label != "")
                        <td>
                            @php($yes = getPercent($clauseNumbers,$clause->totalNumber) )
                            @if(isset($totals[$label]))
                                @php($totals[$label] += $clauseNumbers)
                            @else
                                @php($totals[$label] = $clauseNumbers)
                            @endif
                            {{ $yes }}%
                        </td>
                    @endif
                @endforeach
            </tr>
        @endif
    @endforeach
    {{--    <tr>--}}
    {{--        <td>Total</td>--}}
    {{--        <td>{{ getPercent($tYes , $tClauses) }}</td>--}}
    {{--        <td>{{ getPercent($tNo , $tClauses) }}</td>--}}
    {{--        <td>{{ getPercent($tUp , $tClauses) }}</td>--}}
    {{--        <td>{{ getPercent($tNe , $tClauses) }}</td>--}}
    {{--    </tr>--}}
    </tbody>
</table>
<a href="javascript:void(0)" onclick="renderComplianceChart('{{ $oldParentClauseId }}')">Back</a>
<input type="hidden" name="oldParentClauseId" id="oldParentClauseId" value="{{ $parentClauseId ?? '' }}">
