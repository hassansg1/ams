<!doctype html>
@php
    $logo = \App\Models\Settings::first();
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8"/>
    <title> @yield('title') | @if(getSetting()) {{getSetting()->title}} @else OTCM @endif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ isset($logo->logo) ? URL::asset('images/logo/'.$logo->logo_icon) :  URL::asset ('/assets/images/logo.png')}}">
    @include('layouts.head-css')
</head>

@section('body')
    <body data-sidebar="dark">
    @include('layouts.preloader')
    @show

    <!-- Begin page -->
    <div id="layout-wrapper">
    @include('layouts.topbar')
    @include('layouts.sidebar')
    <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="header_inpage">
{{--            <div class="dropdown d-inline-block">--}}
{{--                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"--}}
{{--                        aria-haspopup="true" aria-expanded="false">--}}
{{--                    <span class="align-middle bolded_header" style="font-size:16px; font-weight:700;" >Organization Structure  <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i></span>--}}
{{--                </button>--}}
{{--                <div class="dropdown-menu dropdown-menu-end" style="">--}}
{{--                    <a href="{{ route('company.index') }}" class="dropdown-item notify-item language" data-lang="eng">--}}
{{--                        <span class="align-middle">Companies</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('unit.index') }}" class="dropdown-item notify-item language" data-lang="eng">--}}
{{--                        <span class="align-middle">Units</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('site.index') }}" class="dropdown-item notify-item language" data-lang="eng">--}}
{{--                        <span class="align-middle">Sites</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('subsite.index') }}" class="dropdown-item notify-item language" data-lang="eng">--}}
{{--                        <span class="align-middle">Subsites</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('building.index') }}" class="dropdown-item notify-item language" data-lang="eng">--}}
{{--                        <span class="align-middle">Buildings</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('room.index') }}" class="dropdown-item notify-item language" data-lang="eng">--}}
{{--                        <span class="align-middle">Rooms</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('cabinet.index') }}" class="dropdown-item notify-item language" data-lang="eng">--}}
{{--                        <span class="align-middle">Cabinets</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @if(Auth::user()->hasPermissionTo('Import Export'))--}}
{{--            <div class="dropdown d-inline-block">--}}
{{--                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"--}}
{{--                        aria-haspopup="true" aria-expanded="false">--}}
{{--                    <span class="align-middle bolded_header" style="font-size:16px; font-weight:700;" >Import / Export</span>--}}
{{--                </button>--}}
{{--                <div class="dropdown-menu dropdown-menu-end" style="">--}}
{{--                    <a href="{{ route('import.index') }}" class="dropdown-item notify-item language" data-lang="eng">--}}
{{--                        <span class="align-middle">Import Data</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('clause_import.index') }}" class="dropdown-item notify-item language"--}}
{{--                       data-lang="eng">--}}
{{--                        <span class="align-middle">Import Clauses</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('library_import.index') }}" class="dropdown-item notify-item language"--}}
{{--                       data-lang="eng">--}}
{{--                        <span class="align-middle">Import Document Library</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('compliance_data_import.index') }}" class="dropdown-item notify-item language"--}}
{{--                       data-lang="eng">--}}
{{--                        <span class="align-middle">Import Compliance Data</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('software_import.index') }}" class="dropdown-item notify-item language"--}}
{{--                       data-lang="eng">--}}
{{--                        <span class="align-middle">Import Software Data</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('patch_import.index') }}" class="dropdown-item notify-item language"--}}
{{--                       data-lang="eng">--}}
{{--                        <span class="align-middle">Import Patch Data</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('firewall_import.index') }}" class="dropdown-item notify-item language"--}}
{{--                       data-lang="eng">--}}
{{--                        <span class="align-middle">Import Firewall Data</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('user_import.index') }}" class="dropdown-item notify-item language"--}}
{{--                       data-lang="eng">--}}
{{--                        <span class="align-middle">Import Users</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('user_id_import.index') }}" class="dropdown-item notify-item language"--}}
{{--                       data-lang="eng">--}}
{{--                        <span class="align-middle">Import User ID's</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('nozomi_import.index') }}" class="dropdown-item notify-item language"--}}
{{--                       data-lang="eng">--}}
{{--                        <span class="align-middle">Import Nozomi Data</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('export_templates') }}" class="dropdown-item notify-item language"--}}
{{--                       data-lang="eng">--}}
{{--                        <span class="align-middle">Export Data Templates</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endif--}}
{{--            @if(Auth::user()->hasPermissionTo('Standard Compliance'))--}}
{{--            <div class="dropdown d-inline-block">--}}
{{--                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"--}}
{{--                        aria-haspopup="true" aria-expanded="false">--}}
{{--                    <span class="align-middle bolded_header" style="font-size:16px; font-weight:700;" >Standards / Compliance</span>--}}
{{--                </button>--}}
{{--                <div class="dropdown-menu dropdown-menu-end" style="">--}}
{{--                    <a href="{{ route('standard.index') }}" class="dropdown-item notify-item language" data-lang="eng">--}}
{{--                        <span class="align-middle">Standards List</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('applicable_standard.index') }}" class="dropdown-item notify-item language"--}}
{{--                       data-lang="eng">--}}
{{--                        <span class="align-middle">Applicable Standards</span>--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('version.index') }}" class="dropdown-item notify-item language" data-lang="eng">--}}
{{--                        <span class="align-middle">Compliance Version</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endif--}}

{{--<div class="dropdown d-inline-block">--}}
{{--    @if(Auth::user()->hasAnyPermission(['Approvel Requests', 'Logs', 'Task', 'Document library']))--}}
{{--   <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"--}}
{{--           aria-haspopup="true" aria-expanded="false">--}}
{{--       <span class="align-middle bolded_header" style="font-size:16px; font-weight:700;" >More</span>--}}
{{--   </button>--}}
{{--    @endif--}}
{{--   <div class="dropdown-menu dropdown-menu-end" style="">--}}
{{--       @if(Auth::user()->hasPermissionTo('Approvel Requests'))--}}
{{--       <a href="{{ route('approval.index') }}" class="dropdown-item notify-item language" data-lang="eng">--}}
{{--           <span class="align-middle">Approval Requests</span>--}}
{{--       </a>--}}
{{--       @endif--}}
{{--           @if(Auth::user()->hasPermissionTo('Logs'))--}}
{{--       <a href="{{ route('log.index') }}" class="dropdown-item notify-item language" data-lang="eng">--}}
{{--           <span class="align-middle">Logs</span>--}}
{{--       </a>--}}
{{--           @endif--}}
{{--               @if(Auth::user()->hasPermissionTo('Task'))--}}
{{--       <a href="{{ route('task') }}" class="dropdown-item notify-item language" data-lang="eng">--}}
{{--           <span class="align-middle">Task</span>--}}
{{--       </a>--}}
{{--           @endif--}}
{{--           @if(Auth::user()->hasPermissionTo('Document library'))--}}
{{--       <a href="{{ route('attachment.index') }}" class="dropdown-item notify-item language"--}}
{{--          data-lang="eng">--}}
{{--           <span class="align-middle">Document Library</span>--}}
{{--       </a>--}}
{{--           @endif--}}
{{--                    <a href="{{ route('approver.index') }}" class="dropdown-item notify-item language" data-lang="eng">--}}
{{--                        <span class="align-middle">Approvers</span>--}}
{{--                    </a>--}}
{{--   </div>--}}
{{--</div>--}}
</div>
<!-- //end header -->
                <!-- Start content -->
                <div class="container-fluid">
                    @yield('content')
                    @include('components.help_section')
                </div> <!-- content -->
            </div>
            @include('layouts.footer')
            @include('components.modals')
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <!-- END Right Sidebar -->

    @include('layouts.vendor-scripts')
    </body>

</html>
