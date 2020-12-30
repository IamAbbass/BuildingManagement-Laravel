@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Flats</h1>
    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Flats</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Block</th>
                            <th>Flat</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Mobile (2)</th>
                            <th>CNIC</th>
                            <th>Permanent Address</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 0;    
                        @endphp
                        
                        @foreach($flats as $flat)
                        
                            <tr>
                                <td>{{ ++$sno }}</td>
                                <td>Block {{ $flat->block->name }}</td>
                                <td>{{ $flat->name }}</td>
                                <td>{{ $flat->person_name }}</td>
                                <td>{{ $flat->person_mobile }}</td>
                                <td>{{ $flat->person_mobile2 }}</td>
                                <td>{{ $flat->person_cnic }}</td>
                                <td>{{ $flat->person_perm_address }}</td>
                                <td>{{ $flat->status }}</td>
                                <td> 
                                    <a href="/flat/{{ $flat->id }}/edit" class="btn btn-warning shadow-sm"><i
                                        class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
                                    
                                    <a href="/flat/{{ $flat->id }}/payment" class="btn btn-success shadow-sm"><i
                                        class="fas fa-edit fa-sm text-white-50"></i> Payment</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection