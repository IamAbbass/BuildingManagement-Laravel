@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Flats</h1>
        
        <div class="btn-group" role="group" aria-label="Basic example">
            @foreach ($blocks as $block)
                <a href="/flat?block={{ $block->id }}" class="btn {{ ($selected_block == $block->id) ? 'btn-primary' : 'btn-outline-primary' }}">
                    Block {{ $block->name }}
                </a>
            @endforeach
        </div>
    </div>
    
            

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Flats</h6>
            <a href="/flat/export/{{ $selected_block }}" class="btn btn-info float-right mr-1">Export Maintenance Report</a>
            <a href="/flat/export/{{ $selected_block }}?type=full" class="btn btn-success float-right mr-1">Export Flat Info Report</a>
            
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
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>PTCL</th>
                            <th>CNIC</th>
                            {{-- <th>Permanent Address</th> --}}
                            <th>Vehicles</th>
                            <th>Status</th>
                            {{-- <th>Last Payment</th> --}}
                            <th>Balance</th>
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
                                <td>{{ $flat->person_email }}</td>                                
                                <td>{{ $flat->person_mobile }}<br/>{{ $flat->person_mobile2 }}</td>
                                <td>{{ $flat->ptcl_no }}</td>                                
                                <td>{{ $flat->person_cnic }}</td>
                                {{-- <td>{{ $flat->person_perm_address }}</td> --}}
                                <td>
                                    <ol class="p-0 ml-2">
                                        @foreach ($flat->vehicles as $vehicle)
                                            <li>{{ $vehicle->number }}</li>
                                        @endforeach
                                    </ol>
                                    <a href="/flat/{{ $flat->id }}/vehicle" class="btn btn-sm btn-secondary shadow-sm">Edit</a>
                                </td>
                                <td>{{ $flat->status }}</td>
                                {{-- <td>
                                    PKR {{ $flat->last_payment->amount }} ({{ $flat->last_payment->month }})                                
                                </td> --}}
                                <td>
                                    <b class="text-danger">
                                        PKR {{ number_format($flat->payments->sum('amount')-$flat->payments->sum('discount')-$flat->payments->sum('payment')) }}
                                    </b>
                                </td>
                                
                                <td> 
                                    <a href="/flat/{{ $flat->id }}/edit" class="btn mr-1 mb-1 btn-warning shadow-sm"><i
                                        class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
                                    
                                    <a href="/flat/{{ $flat->id }}/payment" class="btn mr-1 mb-1 btn-success shadow-sm"><i
                                        class="fas fa-edit fa-sm text-white-50"></i> Payment</a>

                                    <a href="/flat/{{ $flat->id }}" class="btn mr-1 mb-1 btn-info shadow-sm"><i
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