@extends('layouts.print')


@section('content')

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Block {{ $block->name }}</h6>
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
                            <th>Mobile (2)</th>
                            <th>CNIC</th>
                            <th>Permanent Address</th>
                            <th>Status</th>
                            <th>Last Payment</th>
                            <th>Balance</th>
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
                                <td>{{ $flat->person_mobile }}</td>
                                <td>{{ $flat->person_mobile2 }}</td>
                                <td>{{ $flat->person_cnic }}</td>
                                <td>{{ $flat->person_perm_address }}</td>
                                <td>{{ $flat->status }}</td>
                                <td>
                                    PKR {{ $flat->last_payment->amount }} ({{ $flat->last_payment->month }})                                
                                </td>
                                <td>
                                    <b class="text-danger">
                                        PKR {{ number_format($flat->payments->sum('amount')-$flat->payments->sum('discount')-$flat->payments->sum('payment')) }}
                                    </b>
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