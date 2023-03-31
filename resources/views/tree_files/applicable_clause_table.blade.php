<tr class="{{ $class }}" id="{{ $item->id }}">
    <td colspan="1">
        <input type="checkbox" name="select_row" value="{{ $item->id }}" id="select_check_{{ $item->id }}" class= "select_row">
    </td>
    <td style="padding-left: {{ $padding }}px">
        @include('tree_files.clause_heading')
    </td>
    <td>
        {!!descriptionWrapText($item->title,50)!!}
    </td>
    <td>
        {!!descriptionWrapText($item->description,50)!!}
    </td>
    <td>
        @if(!$item->is_heading)
            <input type="checkbox" id="switch{{ $item->id }}" switch="bool" name="applicable{{ $item->id }}"
                   {{ isset($item) && $item && $item->applicable == 1 ? 'checked' : '' }}
                   onclick="applicableClauseStatusChange({{ $item->id }},'applicable',$(this).is(':checked') == false ? 0 : 1);"
            />
            <label for="switch{{ $item->id }}" data-on-label="Yes"
                   data-off-label="No"></label>
        @endif
    </td>
    <td>
        @if(!$item->is_heading)
            <select onchange="applicableClauseSecurityControlChange('{{ $item->id }}',this)" name="" id=""
                    class="select2 form-control">
                @foreach(getSecurityControl() as $security)
                    <option {{ $item->security_control_rating == $security->value ? 'selected' : '' }}
                            value="{{ $security->value }}">{{ $security->name }}
                    </option>
                @endforeach
            </select>
        @endif
    </td>
    <td>
        @if(!$item->is_heading)
            <select
                    id="select_location_{{$item->id}}"
                    {{ isset($item) && $item && $item->applicable == 1 ? '' : 'disabled' }}
                    class="form-control" name="location"
                    onchange="applicableClauseStatusChange({{ $item->id }},'location',$(this).val());">
                <option value="">Select Locations</option>
                <option
                        {{ isset($item) && $item && $item->location == shortClassName(App\Models\Company::class) ? 'selected' : '' }}
                        value="{{ shortClassName(App\Models\Company::class) }}">
                    Companies
                </option>
                <option
                        {{ isset($item) && $item && $item->location == shortClassName(App\Models\Unit::class) ? 'selected' : '' }}
                        value="{{ shortClassName(App\Models\Unit::class) }}">
                    Units
                </option>
                <option
                        {{ isset($item) && $item && $item->location == shortClassName(App\Models\Site::class) ? 'selected' : '' }}
                        value="{{ shortClassName(App\Models\Site::class) }}">
                    Sites
                </option>
                <option
                        {{ isset($item) && $item && $item->location == shortClassName(App\Models\SubSite::class) ? 'selected' : '' }}
                        value="{{ shortClassName(App\Models\SubSite::class) }}">
                    Subsites
                </option>
                <option
                        {{ isset($item) && $item && $item->location == shortClassName(App\Models\Building::class) ? 'selected' : '' }}
                        value="{{ shortClassName(App\Models\Building::class) }}">
                    Buildings
                </option>
                <option
                        {{ isset($item) && $item && $item->location == shortClassName(App\Models\Room::class) ? 'selected' : '' }}
                        value="{{ shortClassName(App\Models\Room::class) }}">
                    Rooms
                </option>
                <option
                        {{ isset($item) && $item && $item->location == shortClassName(App\Models\Cabinet::class) ? 'selected' : '' }}
                        value="{{ shortClassName(App\Models\Cabinet::class) }}">
                    Cabinets
                </option>
                <option
                        {{ isset($item) && $item && $item->location == shortClassName(App\Models\Computer::class) ? 'selected' : '' }}
                        value="{{ shortClassName(App\Models\Computer::class) }}">
                    Computer Assets
                </option>
                <option
                        {{ isset($item) && $item && $item->location == shortClassName(App\Models\NetworkAsset::class) ? 'selected' : '' }}
                        value="{{ shortClassName(App\Models\NetworkAsset::class) }}">
                    Network Assets
                </option>
                <option
                        {{ isset($item) && $item && $item->location == shortClassName(App\Models\LoneAsset::class) ? 'selected' : '' }}
                        value="{{ shortClassName(App\Models\LoneAsset::class) }}">
                    L01 Assets
                </option>
            </select>
        @endif
    </td>
    <td>
        @if(!$item->is_heading)
            <textarea class="form-control" name=""
                      id="justification" cols="30" rows="10">
            {{ $item->justification }}
        </textarea>
        @endif
    </td>
</tr>
@php($childs = $item->nodes ?? [])
@if(count($childs) > 0)
    @php($padding = $padding + 40)
    @foreach($childs as $child)
        @include('tree_files.applicable_clause_table',['item' => $child,'padding' => $padding,'class'=>$class.' '.$item->id])
    @endforeach
@endif

