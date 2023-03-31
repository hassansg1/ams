<span onclick="collapseClause('{{ $item->id }}')" id="collapse_{{ $item->id }}"
      class="icon expand-icon fas fa-minus"></span>
<span style="display:none;" onclick="showClause('{{ $item->id }}')" id="expand_{{ $item->id }}"
      class="icon expand-icon fas fa-plus"></span>
<span class="num">{{ $item->number }}</span>