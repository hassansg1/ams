@foreach($items as $item)
    <tr id="{{ $item->id }}">
        <td>{{ $item->hardware_make }}</td>
        <td>{{ $item->hardware_model }}</td>
        <td>{{ $item->type }}</td>
        <td>
            @include('components.edit_delete_button')
        </td>
    </tr>
@endforeach
