@foreach($items as $item)
    <tr id="{{ $item->id }}">
        <th class="select_all_checkbox" style="width: 10px"><input
                onclick="toggleSelectAll()"
                type="checkbox" name=""
                id="select_all"></th>
        <td>
            @if($item->user_unit)
                {{ $item->user_unit->short_name }}
            @endif
        </td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->designation_id }}</td>
        <td>
            @include('components.edit_delete_button')
        </td>
    </tr>
@endforeach
