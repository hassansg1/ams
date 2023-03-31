<tr class="{{ $class }}" id="{{ $item->id }}">
    <td colspan="1">
        <input type="checkbox" name="select_row" value="{{ $item->id }}" id="select_check_{{ $item->id }}" class= "select_row">
    </td>
    <td style="padding-left: {{ $padding }}px" data-id="{{ $item->id }}"
    >
        @if(!$item->is_heading)
            @include('tree_files.clause_heading') {{ !$item->applicable ? '(Not Applicable)' : '' }}
            @if($item->applicable)
                <span data-id="{{ $item->id }}" title="View Compliance by Locations"
                      style="cursor: pointer;color: #337ab7"
                      class="fas fa-eye icon_{{ $item->id }} {{ $item->applicable ? 'details-control' : '' }}"></span>
            @endif
        @else
            @include('tree_files.clause_heading')
        @endif


    </td>
    <td>
        {!!descriptionWrapText($item->title,50)!!}
    </td>
    <td>
        {{ getSecurityControlLabel($item->security_control_rating) }}
    </td>
    <td>
        {!!descriptionWrapText($item->description,50)!!}
    </td>
</tr>
@php($childs = $item->nodes ?? [])
@if(count($childs) > 0)
    @php($padding = $padding + 40)
    @foreach($childs as $child)
        @include('tree_files.version_compliance_table',['item' => $child,'padding' => $padding,'class'=>$class.' '.$item->id])
    @endforeach
@endif

