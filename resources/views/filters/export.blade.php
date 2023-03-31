@can('Export '.$route)
    <span class="mr-5">
      <button title="Copy"  onclick="$('.buttons-copy').click()" type="button" class="btn btn-light btn-filter btn_padding8 dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-copy"></i>
      </button>
      
      <button title="Export as PDF" onclick="$('.buttons-pdf').click()" type="button" class="btn btn-light btn-filter btn_padding8 dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <img src="{{ URL::asset ('/assets/images/pdf.svg') }}" alt="" height="18px">

      </button>
      <button title="Export as EXCEL"  onclick="$('.buttons-excel').click()"  type="button" class="btn btn-light btn-filter btn_padding8 dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <img src="{{ URL::asset ('/assets/images/excel.svg') }}" alt="" height="18px" >

      </button>
</span>
@endcan
