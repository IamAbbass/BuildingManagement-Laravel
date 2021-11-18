<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ env('APP_URL') }}/home">
        <div class="sidebar-brand-text mx-1">{{ env('APP_NAME') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ env('APP_URL') }}/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ env('APP_URL') }}/search">
            <i class="fas fa-fw fa-search"></i>
            <span>Search</span></a>
    </li>

    <hr class="sidebar-divider my-0">
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ env('APP_URL') }}/flat">
            <i class="fas fa-fw fa-building"></i>
            <span>Flats</span></a>
    </li>  --}}

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-building"></i>
            <span>Flats</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ env('APP_URL') }}/flat?block=1">Block A</a>
                <a class="collapse-item" href="{{ env('APP_URL') }}/flat?block=2">Block B</a>
                <a class="collapse-item" href="{{ env('APP_URL') }}/flat?block=3">Block C</a>
                <a class="collapse-item" href="{{ env('APP_URL') }}/flat?block=4">Block D</a>
                <a class="collapse-item" href="{{ env('APP_URL') }}/flat?block=5">Block E</a>
                <a class="collapse-item" href="{{ env('APP_URL') }}/flat?block=6">Block F</a>
                <a class="collapse-item" href="{{ env('APP_URL') }}/flat?block=7">Block G</a>
            </div>
        </div>
    </li>


    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ env('APP_URL') }}/expensehead">
            <i class="fas fa-fw fa-list"></i>
            <span>Expense Heads</span></a>
    </li>

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ env('APP_URL') }}/expense">
            <i class="fas fa-fw fa-receipt"></i>
            <span>All Expenses</span></a>
    </li>

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ env('APP_URL') }}/accounthead">
            <i class="fas fa-fw fa-list"></i>
            <span>Account Heads</span></a>
    </li>

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ env('APP_URL') }}/employee">
            <i class="fas fa-fw fa-users"></i>
            <span>Employees</span></a>
    </li>

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ env('APP_URL') }}/contractor">
            <i class="fas fa-fw fa-users"></i>
            <span>Contractors</span></a>
    </li>

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ env('APP_URL') }}/attendance">
            <i class="fas fa-fw fa-thumbs-up"></i>
            <span>Bio Metric</span></a>
    </li>

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ env('APP_URL') }}/report/daily">
            <i class="fas fa-fw fa-edit"></i>
            <span>Daily Collection Report</span></a>
    </li>

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ env('APP_URL') }}/cycle">
            <i class="fas fa-fw fa-spinner"></i>
            <span>Generate Cycle ({{ date('M-Y') }})</span></a>
    </li>




    {{-- - View All Maintenance (Block Wise Filter)
- Defaulter List
- Maintenance Report (Month Year)
- Daily Reports (Date from to)
- Users --}}




    {{-- <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> --}}

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
