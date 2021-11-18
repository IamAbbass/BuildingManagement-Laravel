@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Contractors</h1>
        <a href="{{ env('APP_URL') }}/contractor/create" class="btn btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> Create</a>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Contractors</h6>
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
                            <th>Notes</th>
                            
                            <th>Details</th>
                            <th>Options</th>            
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 0;    
                        @endphp
                        
                        @foreach($contractors as $contractor)
                        
                            <tr>
                                <td>{{ ++$sno }}</td>
                                <td>{{ $contractor->name }}</td>

                                <td>{{ $contractor->cnic }}</td>
                                <td>{{ $contractor->mobile }}</td>
                                <td>{{ $contractor->notes }}</td>

                                <td>
                                    @if($contractor->creator)
                                        Created By: {{ $contractor->creator->name }}
                                    @endif

                                    @if($contractor->updater)
                                        <br/>
                                        Updated By: {{ $contractor->updater->name }}
                                    @endif
                                    
                                </td>
                                <td> 
                                    <a href="{{ env('APP_URL') }}/contractor/{{ $contractor->id }}/edit" class="btn btn-sm mr-1 mb-1 btn-warning shadow-sm"><i
                                        class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
                                    
                                    <a href="{{ env('APP_URL') }}/contractor/{{ $contractor->id }}/payment" class="btn btn-sm mr-1 mb-1 btn-success shadow-sm"><i
                                        class="fas fa-edit fa-sm text-white-50"></i> Add Payment</a>

                                    <a href="{{ env('APP_URL') }}/contractor/{{ $contractor->id }}" class="btn btn-sm mr-1 mb-1 btn-info shadow-sm"><i
                                        class="fas fa-edit fa-sm text-white-50"></i> History</a>
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