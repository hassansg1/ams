@php($rows = isset($port->rows)?$port->rows:'1')
@for($i = 0; $i < $rows ; $i ++)
    @php($rand = rand(10000,100000))
    <tr data-id="1" id="{{ $rand }}">
        <td>
            <input type="hidden" name="ports[id][]" value="{{ $port->id ?? '' }}">
            <input value="{{ isset($port) ? $port->nic : '' }}" type="text" name="ports[nic][]" class="form-control">
        </td>
        <td><input value="{{ isset($port) ? $port->number : '' }}" type="text" name="ports[number][]"
                   class="form-control"></td>
        <td><input value="{{ isset($port) ? $port->mac_address : '' }}" type="text" name="ports[mac_address][]"
                   class="form-control"></td>
        <td class="ports_selection_div">
            <select onchange="loadPorts(this,'{{ $rand }}')" name="" id="" class="form-select">
                <option value="">-Select Network Asset-</option>
                @foreach(\App\Models\NetworkAsset::all() as $entity)
                    <option
                        {{
                            isset($port->connectedPort) &&
                            $port->connectedPort->location_id == $entity->id ? 'selected' : ''
                        }}
                        value="{{ $entity->id }}">{{$entity->name}}</option>
                @endforeach
            </select>
            <select onchange="loadIpAddress(this,'{{ $rand }}','{{ $port->ip_address ?? '' }}')" name="ports[connected_port_id][]" id=""
                    class="form-control mt-3 {{ $rand }} port_auto_drop_down form-select ">
                <option value="">-Select Port-</option>
                @if($port->connectedPort)
                @foreach(\App\Models\Port::where('location_id',$port->connectedPort->location_id)->get() as $ent)
                    <option
                        {{ isset($port->connectedPort->location_id) && $port->connectedPort->id == $ent->id ? 'selected' :'' }}
                        value="{{ $ent->id }}">{{ $ent->name }}</option>
                @endforeach
                @else
                    <option value="">--No Port Available--</option>
                @endif
            </select>
        </td>
        <td>
            <select name="ports[ip_address][]" id="ip_address" class="form-select {{ $rand }} ">
                <option value="">Select IP Address</option>
            </select>
        </td>
        <td><input value="{{ isset($port) ? $port->sub_net_mask : '' }}" type="text" name="ports[sub_net_mask][]"
                   class="form-control"></td>
        <td><input value="{{ isset($port) ? $port->default_gateway : '' }}" type="text" name="ports[default_gateway][]"
                   class="form-control"></td>
        <td style="width: 100px">
            <a onclick="deletePortRow('{{ $rand }}', {{$port->id}});"
               class="btn btn-outline-secondary btn-sm edit" title="Edit">
                <i class="fas fa-trash-alt"></i>
            </a>
            <a style="display: none;"
               class="table-editable-edit-button btn btn-outline-secondary btn-sm edit" title="Edit">
                <i class="fas fa-trash-alt"></i>
            </a>
        </td>
    </tr>
@endfor
