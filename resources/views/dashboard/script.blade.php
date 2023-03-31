<script>
    renderComplianceChart();
    assetsCriticality();
    assetsNozomi();


    $(document).ready(function () {
        loadComplianceSpiderChart();
        loadPatchReport();
    });

    function loadPatchReport() {
        $.ajax({
            type: "POST",
            url: '{{ route('chart.patch_report') }}',
            data: {
                '_token': '{{ csrf_token() }}',
            },
            success: function (result) {
                $('#patch_table').html(result.html);

                $('.not_found_tr').each(function (index, obj) {
                    $(obj).closest('tr').hide();
                });
            },
        });
    }

    let chart;
    let chartCreated = false;

    $('#spider_form').submit(function (e) {
        e.preventDefault();
        if (chartCreated) {
            chart.destroy();
        }
        $.ajax({
            type: "POST",
            url: '{{ route('chart.compliance_spider') }}',
            data: $('#spider_form').serialize(),
            success: function (result) {
                let data = {
                    labels: result.prefixes,
                    datasets: result.datasets
                };
                let ctx = document.getElementById('myChart');
                chart = new Chart(ctx, {
                    type: 'radar',
                    data: data,
                    options: {
                        elements: {
                            line: {
                                borderWidth: 3
                            }
                        }
                    },
                });
                chartCreated = true;
            },
        });
    });

    function loadComplianceSpiderChart() {

    }

    function loadVersionsForSpider() {
        $('.version_id').html('');
        let standardId = $('#standard_id_spider').val();
        $.ajax({
            type: "POST",
            url: '{{ url('loadVersionsForSpider') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'standard_id': standardId,
            },
            success: function (result) {
                $('.version_id').html(result.html);
                loadComplianceSpiderChart();
            },
        });
    }

    function removeRow(cls){
        $('#'+cls).remove();
    }

    function addComplianceRow() {
        let standardId = $('#standard_id_spider').val();
        $.ajax({
            type: "POST",
            url: '{{ url('chart/addComplianceRow') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'standard_id': standardId,
            },
            success: function (result) {
                $('#version_list').append(result.html);
            },
        });
    }


    function renderComplianceChart(parentClauseId = null) {
        let versionId = $('#select_version').val();
        let locationId = $('#select_location').val();
        let oldParentClauseId = $('#oldParentClauseId').val();
        $.ajax({
            type: "GET",
            url: '{{ url('chart/compliance_chart') }}',
            data: {
                versionId: versionId,
                parentClauseId: parentClauseId,
                locationId: locationId,
                oldParentClauseId: oldParentClauseId,
            },
            success: function (result) {
                if (result.status) {
                    $('#compliance_table').html(result.table);
                    var chartDom = document.getElementById('compliance-pie-chart');
                    var myChart = echarts.init(chartDom);
                    var option;

                    option = {
                        title: {
                            text: '',
                            subtext: '',
                            left: 'center'
                        },
                        tooltip: {
                            trigger: 'item'
                        },
                        legend: {
                            orient: 'horizontal',
                            top: 'top'
                        },
                        series: [
                            {
                                name: 'Compliance',
                                type: 'pie',
                                radius: '60%',
                                data: result.data,
                                emphasis: {
                                    itemStyle: {
                                        shadowBlur: 10,
                                        shadowOffsetX: 0,
                                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                                    }
                                }
                            }
                        ]
                    };
                    option && myChart.setOption(option);
                }
            },
        });
    }

    function assetsCriticality() {
        let unit_id = $('#select_unit_compliance').val();
        let site_id = $('#select_site_compliance').val();
        let sub_site_id = $('#select_sub_site_compliance').val();
        $.ajax({
            type: "GET",
            url: '{{ url('chart/assets_criticality_chart') }}',
            data: {
                unit_id: unit_id,
                site_id: site_id,
                sub_site_id: sub_site_id,
            },
            success: function (result) {
                if (result.status) {
                    var chartDom = document.getElementById('asset-criticality-chart');
                    var myChart = echarts.init(chartDom);
                    var option;
                    var colorPalette = ['#EE6666', '#91CC75', '#FAC858'];

                    option = {
                        title: [
                            {
                                subtext: 'Computer Assets',
                                left: '16.67%',
                                top: '90%',
                                textAlign: 'center'
                            },
                            {
                                subtext: 'Network Assets',
                                left: '50%',
                                top: '90%',
                                textAlign: 'center'
                            },
                            {
                                subtext: 'Levele-01 Assets',
                                left: '83.33%',
                                top: '90%',
                                textAlign: 'center'
                            }
                        ],
                        series: [
                            {
                                type: 'pie',
                                radius: '60%',
                                center: ['50%', '50%'],
                                data: result.computer,
                                label: {
                                    position: 'outer',
                                    alignTo: 'edge',
                                    margin: 0,
                                },
                                color: colorPalette,
                                left: 0,
                                right: '66.6667%',
                                top: 0,
                                bottom: 0,
                            },
                            {
                                type: 'pie',
                                radius: '60%',
                                center: ['50%', '50%'],
                                data: result.network,
                                label: {
                                    position: 'outer',
                                    alignTo: 'none',
                                    bleedMargin: 5
                                },
                                color: colorPalette,
                                left: '33.3333%',
                                right: '33.3333%',
                                top: 0,
                                bottom: 0
                            },
                            {
                                type: 'pie',
                                radius: '60%',
                                center: ['50%', '50%'],
                                data: result.lone,
                                label: {
                                    position: 'outer',
                                    alignTo: 'edge',
                                    margin: 1
                                },
                                color: colorPalette,
                                left: '66.6667%',
                                right: 0,
                                top: 0,
                                bottom: 0
                            }
                        ],
                    };

                    option && myChart.setOption(option);

                }
            },
        });
    }

    function assetsNozomi() {
        let unit_id = $('#select_unit').val();
        let site_id = $('#select_site').val();
        let sub_site_id = $('#select_sub_site').val();
        $.ajax({
            type: "GET",
            url: '{{ url('chart/assets_functions_chart') }}',
            data: {
                unit_id: unit_id,
                site_id: site_id,
                sub_site_id: sub_site_id,
            },
            success: function (result) {
                if (result.status) {
                    var chartDom = document.getElementById('asset-nozomi-chart');
                    var myChart = echarts.init(chartDom);
                    var option;
                    option = {
                        tooltip: {
                            trigger: 'item'
                        },
                        series: [
                            {
                                name: 'Asset Functions',
                                type: 'pie',
                                radius: '60%',
                                center: ['50%', '50%'],
                                avoidLabelOverlap: false,
                                label: {
                                    show: false,
                                    position: 'center'
                                },
                                data: result.data
                            }
                        ]
                    };
                    option && myChart.setOption(option);
                }
            },
        });
    }

    $('#select_unit_compliance').on('change', function () {

        var unit_id = this.value;
        if (unit_id) {
            $.ajax({
                type: "get",
                url: "{{url('asset_function_dashboard_unit/type')}}/" + unit_id,
                success: function (res) {
                    if (res) {
                        $("#select_site_compliance").empty();
                        $("#select_sub_ite_compliance").empty();
                        $("#select_site_compliance").append('<option value="">--Select Site--</option>');
                        $.each(res, function (key, value) {
                            $("#select_site_compliance").append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                }

            });
        }
        assetsCriticality();
    });

    $('#select_site_compliance').on('change', function () {
        var site_id = this.value;
        if (site_id) {
            $.ajax({
                type: "get",
                url: "{{url('asset_function_dashboard_site/type')}}/" + site_id,
                success: function (res) {
                    if (res) {
                        $("#select_sub_site_compliance").empty();
                        $("#select_sub_site_compliance").append('<option value="">--Select Sub Site--</option>');
                        $.each(res, function (key, value) {
                            $("#select_sub_site_compliance").append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                }

            });
        }
        assetsCriticality();
    });

</script>
