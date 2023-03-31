<li>
    <table class="table-borderless">
        <tr>
            <td>
                <span onclick="openViewClausePopup('{{ url('clause_edit/'.$item->id) }}')"
                       class="num">{{ $item->number }}</span>
            </td>
            <td style="max-width: 100%;white-space: nowrap;">
                <a onclick="openViewClausePopup('{{ url('clause_edit/'.$item->id) }}')" href="javascript:void(0)">{{ $item->title }}
                    <i onclick="openEditClausePopup('{{ url('clause_edit/'.$item->id) }}')"
                       class="fas fa-edit add_btns add_{{ $item->id }}"></i>
                    <i onclick="openAddClausePopup('{{ url('clause/create') }}','{{ $item->id }}')"
                       class="fas fa-plus-circle add_btns add_{{ $item->id }}"></i>
                </a>
            </td>
        </tr>
    </table>



    @php($childs = $item->nodes ?? [])
    @if(count($childs) > 0)
        <ol>
            @foreach($childs as $child)
                @include('tree_files.clause_table_tree',['item' => $child])
            @endforeach
        </ol>
    @endif
</li>
