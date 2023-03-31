@can('Delete '.$route)
    <span class="mr-5">
      <button title="Delete" type="button" id="deleteMultiple" value="{{$model_name ?? ''}}" class="btn btn-light btn-filter">
         <i class="fas fa-trash-alt"></i>
      </button>
</span>
@endcan
