<script>
    function versionSelected() {
        loadRiskTable();
    }

    $(document).ready(function () {
        $('.risk_input').attr('disabled',true);
    });
    $('#risk_form').submit(function (e) {
        e.preventDefault();
        updateRiskCriteria();
    });

    function loadRiskTable() {
        $.ajax({
            url: "{{url('loadRiskTable')}}",
            type: "POST",
            data: $('#version_form').serialize(),
            success: function (data) {
                $('#risk_table').html(data.html);
                $('#version_table').html(data.version_html);
            },
        });
    }

    function updateRiskCriteria() {
        $('.risk_input').removeClass("invalid_risk");
        $.ajax({
            url: "{{url('updateRiskCriteria')}}",
            type: "POST",
            data: $('#risk_form').serialize(),
            success: function (data) {
                if (data.status) {
                    doSuccessToast();
                    loadRiskTable();
                } else {
                    doErrorToast();
                    $('#risk_' + data.highlight).addClass("invalid_risk");
                }
            },
        });
    }

    function showMarker(id) {
        $('.marker_' + id).addClass("marker_hover");
    }

    function hideMarker(id) {
        $('.marker_' + id).removeClass("marker_hover");
    }

    function showRow(id) {
        $('.hrt_' + id).addClass("hrt_hover");
    }

    function hideRow(id) {
        $('.hrt_' + id).removeClass("hrt_hover");
    }

    function updateColor(el, id) {
        let value = $(el).val();
        $.ajax({
            url: "{{url('updateColor')}}",
            type: "POST",
            data: {
                value: value,
                id: id,
                "_token": "{{ csrf_token() }}",
            },
            success: function (data) {
                doSuccessToast();
                loadRiskTable();
            },
        });
    }
</script>