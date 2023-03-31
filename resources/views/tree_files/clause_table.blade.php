<tr class="{{ $class }}" id="{{ $item->id }}">
    <td colspan="1">
        <input type="checkbox" name="select_row" value="{{ $item->id }}" id="select_check_{{ $item->id }}" class= "select_row">
    </td>
    <td>
    <td style="width:50px;padding-left: {{ $padding }}px">
        @include('tree_files.clause_heading')
    </td>
    <td>
        {!!descriptionWrapText($item->title,50)!!}
    </td>
    <td>
        {!!descriptionWrapText($item->description,50)!!}
    </td>
</tr>
@php($childs = $item->nodes ?? [])
@if(count($childs) > 0)
    @php($padding = $padding + 40)
    @foreach($childs as $child)
        @include('tree_files.clause_table',['item' => $child,'padding' => $padding,'class'=>$class.' '.$item->id])
    @endforeach
@endif
