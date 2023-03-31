@foreach($items as $key => $item)
    <tr data-url="{{ route($route.".show",$item->id) }}" id="{{ $item->id }}">
        <td colspan="1"><input type="checkbox" name="select_row" value="{{ $item->id }}" id="select_check_{{ $item->id }}" class= "select_row"></td>
        <td>{{ ++$key }}</td>
        <td>{{ $item->documentNumber }}</td>
        <td>{{ $item->version }}</td>
        <td>{{ $item->date }}</td>
        <td>{{ $item->title }}</td>
{{--        <td>{{ $item->description }}</td>--}}
        <td>{{ $item->category }}</td>
{{--        <td>{{ $item->subCategory }}</td>--}}
        <td>
            @foreach($item->attachmentItems as $attachment)
                @if(Storage::disk('library_documents')->exists($attachment->fileName))
                    <a target="_blank" href="{{ $attachment->fileLink() }}">{{ $attachment->fileName }}</a><br>
                @else
                    <b>{{ $attachment->fileName }}</b> not exist in directory
                @endif
            @endforeach
        </td>
        <td>

            @include('components.edit_delete_button')
            <i class="fas fa-clipboard" id="" onclick="copyToClipboard(this)"></i>
        </td>
    </tr>
@endforeach

