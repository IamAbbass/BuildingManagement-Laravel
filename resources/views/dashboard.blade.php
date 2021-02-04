@extends('layouts.admin')


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

        <form >
        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
            <i class="fa fa-calendar"></i>&nbsp;
            <span></span> <i class="fa fa-caret-down"></i>
        </div>
        </form>
    </div>

    <!-- Content Row -->
    <div class="row mb-5">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Defaulters</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">PKR {{ number_format($defaulters) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Income</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">PKR {{ number_format($income) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Expense</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">PKR {{ number_format($expense) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Balance</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">PKR {{ number_format($balance) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Headwise Income</h1>
    </div>


    <!-- Content Row -->
    <div class="row">
        <!-- Headwise Income -->
        <div class="col-xl-3 col-md-4 mb-2">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Monthly Maintainance</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">PKR {{ number_format($monthly_maintainance) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Headwise Income -->
        <div class="col-xl-3 col-md-4 mb-2">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Membership</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">PKR {{ number_format($membership) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Headwise Income -->
        <div class="col-xl-3 col-md-4 mb-2">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            RO</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">PKR {{ number_format($ro) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Headwise Income -->
        <div class="col-xl-3 col-md-4 mb-2">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Membership (Tenant)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">PKR {{ number_format($membership_tenant) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Headwise Income -->
        <div class="col-xl-3 col-md-4 mb-2">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Membership (Purchaser)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">PKR {{ number_format($membership_purchaser) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Headwise Income -->
        <div class="col-xl-3 col-md-4 mb-2">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Membership (Owner)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">PKR {{ number_format($membership_owner) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Headwise Income -->
        <div class="col-xl-3 col-md-4 mb-2">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            EVENT CHARGES</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">PKR {{ number_format($event_charges) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Headwise Income -->
        <div class="col-xl-3 col-md-4 mb-2">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            U R NET (MR. AMIR</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">PKR {{ number_format($ur_net) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
    
</div>
<!-- /.container-fluid -->


@endsection