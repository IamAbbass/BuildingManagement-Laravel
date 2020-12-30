@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Employees</h1>
        <a href="/employee/create" class="btn btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> Create</a>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Employees</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Name</th>
                            <th>CNIC</th>
                            <th>Mobile</th>
                            <th>Salary</th>
                            <th>Department</th>
                            <th>Notes</th>                            
                            <th>Details</th>
                            <th>Options</th>            
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 0;    
                        @endphp
                        
                        @foreach($employees as $employee)
                        
                            <tr>
                                <td>{{ ++$sno }}</td>
                                <td>{{ $employee->name }}</td>

                                <td>{{ $employee->cnic }}</td>
                                <td>{{ $employee->mobile }}</td>
                                <td>{{ $employee->salary }}</td>
                                <td>{{ $employee->department }}</td>
                                <td>{{ $employee->notes }}</td>

                                <td>
                                    @if($employee->creator)
                                        Created By: {{ $employee->creator->name }}
                                    @endif

                                    @if($employee->updater)
                                        <br/>
                                        Updated By: {{ $employee->updater->name }}
                                    @endif
                                    
                                </td>
                                <td> <a href="/employee/{{ $employee->id }}/edit" class="btn btn-warning shadow-sm"><i
                                    class="fas fa-edit fa-sm text-white-50"></i> Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection