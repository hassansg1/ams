<script>

    function applicableClauseStatusChange(clause_id, column_name, value) {
        $.ajax({
            type: "POST",
            url: '{{ route('applicableClause.storeClauseData') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'clause_id': clause_id,
                'column_name': column_name,
                'value': value,
            },
            success: function (result) {
                if (result.status) {
                    if (value == 1) {
                        $('#select_location_' + clause_id).removeAttr('disabled');
                        $('#justification_' + clause_id).prop('disabled',true);
                        $('#justification_' + clause_id).val('');
                    } else if (value == 0 && column_name == "applicable") {
                        $('#select_location_' + clause_id).prop('disabled', true);
                        $('#select_location_' + clause_id).prop('selectedIndex', 0);

                        $('#justification_' + clause_id).prop('disabled',false);
                        $('#justification_' + clause_id).val('');
                    }
                    doSuccessToast('Success ...!!!');
                } else
                    doErrorToast('Failure...!!!');
            },
        });
    }

    function applicableClauseSecurityControlChange(clause_id, ref) {
        let value = $(ref).val();
        $.ajax({
            type: "POST",
            url: '{{ route('applicableClause.storeClauseData') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'clause_id': clause_id,
                'column_name': 'security_control_rating',
                'value': value,
            },
            success: function (result) {
                if (result.status) {
                    doSuccessToast('Success ...!!!');
                } else
                    doErrorToast('Failure...!!!');
            },
        });
    }
</script>


