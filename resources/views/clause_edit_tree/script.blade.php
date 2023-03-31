<script>
    $(document).ready(function () {
        clause_tree();
    });

    function clause_tree() {

        $.ajax({
            type: "POST",
            url: '{{ url('clause_tree') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'standardId': '{{ $standard->id }}'
            },
            success: function (result) {
                if (result.status) {
                    $searchableTree = $('#clause-tree').treeview({
                        data: result.tree,
                        levels: 0,
                        expandIcon: 'fas fa-plus',
                        collapseIcon: 'fas fa-minus',
                        emptyIcon: 'fas',
                        nodeIcon: '',
                        selectedIcon: '',
                        checkedIcon: 'fas fa-flag-checkered',
                        uncheckedIcon: 'fas fa-microscope',
                        enableLinks: true,
                        // highlights selected items
                        highlightSelected: true,
                        highlightSearchResults: true,

                    });
                }
                $('#clause-tree').on('click', 'li a', function (event, data) {
                    event.preventDefault();
                    var li = $(this).parent();
                    var nodeId = li.attr('data-nodeid');
                    const url = $(this).attr('href');
                    const newUrl = url.slice(0, url.lastIndexOf('/'));
                    const newurlLatest = newUrl + '/' + nodeId;
                    location.href = newurlLatest;
                });
            },
        });
    }
    function openEditClausePopup(url) {
        $.ajax({
            type: "get",
            url: url,
            success: function (result) {
                if (result) {
                    $('.default_modal_body').html($(result).find('.item_form').find('.row').html());
                    $('.default_modal_body').append("<button style='float: right' onclick='saveClause()' class='btn btn-primary'>Update</button>");
                    $('#default_modal').modal('show');
                }
            }

        });
    }

    function openViewClausePopup(url) {
        $.ajax({
            type: "get",
            url: url,
            success: function (result) {
                if (result) {
                    $('.default_modal_body').html($(result).find('.item_form').find('.row').html());
                    $('.default_modal_body').append("<button style='float: right' onclick='saveClause()' class='btn btn-primary'>Update</button>");
                    $('#default_modal').modal('show');
                    disableForm('#default_modal_content');
                }
            }

        });
    }

    function openAddClausePopup(url, id) {
        $.ajax({
            type: "get",
            url: url,
            data: {id: id},
            success: function (result) {
                if (result) {
                    let html = "<form id='add_clause_form'>" + $(result).find('.item_form').find('.row').html() + "</form>";
                    $('.default_modal_body').html(html);
                    $('.default_modal_body').append("<button style='float: right' onclick='saveClause()' class='btn btn-primary'>Create</button>");
                    $('#default_modal').modal('show');
                }
            }

        });
    }

    function saveClause() {
        $.ajax({
            type: "POST",
            url: "/clause",
            data: $('#add_clause_form').serialize(),
            success: function (result) {
                if (result) {
                    location.reload();
                }
            }

        });
    }
</script>