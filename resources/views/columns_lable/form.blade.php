@include('components.form_errors')
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ isset($clone) && $clone ? '' : (isset($item) ? $item->id : '') }}">

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ $heading }} Information</h4>

                <div class="mb-3">
                    <label class="form-label">Select Table Name</label>
                    <select class="form-control select2" name="column_table" id="column_table" onchange="showRow()">
                        <option value="">-Select Table Name-</option>
                        @foreach($tables as  $value)
                            <option value="{{$value->table_name}}">{{ ucfirst($value->table_name) }}</option>
                        @endforeach
                    </select>
                </div>
                @foreach($items as  $index =>$item)
                    <div class="row  main_row {{$item->table_name}}" style="display: none">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Column Name</label>
                                <input type="hidden" value="{{$item->id}}" class="form-control" id="{{ isset($item) ? $item->id:'' }}id" name="id[]" readonly>
                                <input type="text" value="{{$item->key}}" class="form-control" id="{{ isset($item) ? $item->id:'' }}key" name="key[]" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="" class="form-label">Lable</label>
                                <input type="text" value="{{ isset($item) ? $item->value:'' }}" class="form-control" id="value" name="value[]">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    function showRow(){
        $('.main_row').hide();
       $column_value =  $('#column_table').val();
        if($column_value){
            $('.'+$column_value).show();
        }else{
            $('.'+$column_value).hide();
        }
    }
</script>
