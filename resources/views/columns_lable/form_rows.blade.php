@foreach($items as $activity)
    <tr>
        <td>{{ explode('\\',$activity->subject_type)[2] }}</td>
        <td>{{ $activity->event }}</td>
        <td>{{ $activity->causer->username }}</td>
        @if($activity->event = 'created')
            <td>{{ $activity->properties['attributes']['name'] }}</td>
        @else
            <td>{{ $activity->properties['old']['name'] }}</td>
        @endif
        <td>{{ \Carbon\Carbon::parse($activity->updated_at)->format('d-m-Y') }}</td>
    </tr>
@endforeach
