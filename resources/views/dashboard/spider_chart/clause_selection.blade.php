<option value="">Search by Name</option>
@foreach($items as $item)
    <option value="{{ $item->id }}">{{ $item->name }}</option>
@endforeach