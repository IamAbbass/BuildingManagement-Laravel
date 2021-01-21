<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
        <div class="sidebar-brand-text mx-1">{{ env('APP_NAME') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="/search">
            <i class="fas fa-fw fa-users"></i>
            <span>Search</span></a>
    </li>    

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="/flat">
            <i class="fas fa-fw fa-users"></i>
            <span>Flats</span></a>
    </li> 
    
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="/expensehead">
            <i class="fas fa-fw fa-users"></i>
            <span>Expense Heads</span></a>
    </li> 

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="/expense">
            <i class="fas fa-fw fa-users"></i>
            <span>All Expenses</span></a>
    </li> 

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="/accounthead">
            <i class="fas fa-fw fa-users"></i>
            <span>Account Heads</span></a>
    </li> 

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="/employee">
            <i class="fas fa-fw fa-users"></i>
            <span>Employees</span></a>
    </li> 

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="/contractor">
            <i class="fas fa-fw fa-users"></i>
            <span>Contractors</span></a>
    </li> 

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="/attendance">
            <i class="fas fa-fw fa-users"></i>
            <span>Bio Metric</span></a>
    </li> 

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="/report/daily">
            <i class="fas fa-fw fa-users"></i>
            <span>Daily Collection Report</span></a>
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