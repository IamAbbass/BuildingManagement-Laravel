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
            <a href="/flat/export/{{ $selected_block }}/defaulter" class="btn btn-danger float-right mr-1">
                Defaulter List           
            </a>
            {{-- <button class="btn btn-danger float-right mr-1 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Defaulter List           
            </button> --}}
            {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach ($account_heads as $account_head)
                    <a target="_blank" class="dropdown-item" href="/flat/export/{{ $selected_block }}/defaulter?head={{ $account_head->id }}">{{ $account_head->name }}</a>
                @endforeach
                <a target="_blank" class="dropdown-item" href="/flat/export/{{ $selected_block }}/defaulter">All</a>
            </div> --}}
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th style="width:75px;">Block</th>
                            <th style="width:75px;">Flat</th>
                            <th>Contact Name</th>
                            <th>Vehicles</th>
                            {{-- <th>Status</th> --}}
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
                                <td>
                                    {{ $flat->name }}
                                    @php
                                        if($flat->isDefaulter->sum('payment') < 10000){
                                            echo "<span class='badge badge-danger'>Defaulter</span>";
                                        }
                                    @endphp

                                </td>
                                <td>
                                    {!! $flat->person_name ? "Owner: $flat->person_name </br>" : '' !!}
                                    {!! $flat->tenant_name ? "Tenant: $flat->tenant_name </br>" : '' !!}
                                    {!! $flat->person_email ? "Email: $flat->person_email </br>" : '' !!}
                                    {!! $flat->person_mobile ? "Mobile: $flat->person_mobile </br>" : '' !!}
                                    {!! $flat->person_mobile2 ? "Mobile (2): $flat->person_mobile2 </br>" : '' !!}
                                    {!! $flat->ptcl_no ? "PTCL: $flat->ptcl_no </br>" : '' !!}
                                    {!! $flat->person_cnic ? "CNIC: $flat->person_cnic </br>" : '' !!}
                                </td>
                                <td>
                                    <ol class="p-0 ml-2">
                                        @foreach ($flat->vehicles as $vehicle)
                                            <li>{{ $vehicle->number }}</li>
                                        @endforeach
                                    </ol>
                                    <a href="/flat/{{ $flat->id }}/vehicle" class="btn btn-sm btn-secondary shadow-sm">Edit</a>
                                </td>
                                {{-- <td>{{ $flat->status }}</td> --}}
                                {{-- <td>
                                    PKR {{ $flat->last_payment->amount }} ({{ $flat->last_payment->month }})                                
                                </td> --}}
                                <td>
                                    <b class="text-danger">
                                        PKR {{ number_format($flat->payments->sum('amount')-$flat->payments->sum('discount')-$flat->payments->sum('payment')) }}
                                    </b>
                                </td>
                                
                                <td> 
                                    <a href="/flat/{{ $flat->id }}/edit" class="btn btn-sm mr-1 mb-1 btn-warning shadow-sm"><i
                                        class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
                                    
                                    <a href="/flat/{{ $flat->id }}/payment" class="btn btn-sm mr-1 mb-1 btn-success shadow-sm"><i
                                        class="fas fa-edit fa-sm text-white-50"></i> Payment</a>

                                    <a href="/flat/{{ $flat->id }}" class="btn btn-sm mr-1 mb-1 btn-info shadow-sm"><i
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