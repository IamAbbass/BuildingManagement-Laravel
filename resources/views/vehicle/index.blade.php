@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">{{ $flat->name }} Vehicles</h1>
        <a href="/flat/{{ $flat->id }}/vehicle/create" class="btn btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> Create</a>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $flat->name }} Vehicles</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Color</th>
                            <th>Number</th>
                            <th>Details</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 0;    
                        @endphp
                        
                        @foreach($vehicles as $vehicle)
                        
                            <tr>
                                <td>{{ ++$sno }}</td>
                                <td>{{ $vehicle->make }}</td>
                                <td>{{ $vehicle->model }}</td>
                                <td>{{ $vehicle->color }}</td>
                                <td>{{ $vehicle->number }}</td>
                                <td>
                                    @if($vehicle->creator)
                                        Created By: {{ $vehicle->creator->name }}
                                    @endif

                                    @if($vehicle->updater)
                                        <br/>
                                        Updated By: {{ $vehicle->updater->name }}
                                    @endif
                                    
                                </td>
                                <td> 
                                    <a href="/flat/{{ $vehicle->flat_id }}/vehicle/{{ $vehicle->id }}/edit" class="btn btn-warning shadow-sm"><i
                                        class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
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