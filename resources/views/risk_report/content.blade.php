@include('risk_report.upper_content')
<div class="row">
    <div class="col-md-6">
        @include('risk_report.version_selection')
        <div id="version_table"></div>
    </div>
    <div class="col-md-6">
        @include('risk_report.risk_table')
    </div>
</div>
<style>
    .risk_criteria_btn{
        display: none;
    }
</style>
<script>
</script>