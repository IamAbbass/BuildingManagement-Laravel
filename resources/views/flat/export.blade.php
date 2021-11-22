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
                            @if(request('type') == 'full')
                                <th>Block</th>
                            @endif
                            <th>Flat</th>
                            <th>Name</th>
                            @if(request('type') == 'full')
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Mobile (2)</th>
                                <th>CNIC</th>
                                <th>Permanent Address</th>
                                <th>Status</th>
                                <th>Last Payment</th>
                            @endif                            
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 0;    
                            $total = 0;
                        @endphp
                        
                        @foreach($flats as $flat)

                            @php
                                $balance = $flat->payments->where('is_cancelled',false)->sum('amount')-
                                            $flat->payments->where('is_cancelled',false)->sum('discount')-
                                            $flat->payments->where('is_cancelled',false)->sum('payment');
                                
                                $total += $balance;
                            @endphp
                        
                            <tr>
                                <td>{{ ++$sno }}</td>
                                @if(request('type') == 'full')
                                    <td>Block {{ $flat->block->name }}</td>
                                @endif
                                <td>{{ $flat->name }}</td>
                                <td>{{ $flat->person_name }}</td>
                                @if(request('type') == 'full')                                    
                                    <td>{{ $flat->person_email }}</td>                                
                                    <td>{{ $flat->person_mobile }}</td>
                                    <td>{{ $flat->person_mobile2 }}</td>
                                    <td>{{ $flat->person_cnic }}</td>
                                    <td>{{ $flat->person_perm_address }}</td>
                                    <td>{{ $flat->status }}</td>
                                    <td>
                                        PKR {{ $flat->last_payment->amount }} ({{ $flat->last_payment->month }})                                
                                    </td>
                                @endif
                                <td>
                                    <b class="text-danger">
                                        PKR {{ number_format($balance) }}
                                    </b>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

                <p class="text-dark" style="float:right;"><b class="text-danger">Total Outstanding: PKR {{ number_format($total) }}</b></p>
            </div>
        </div>
    </div>

</div>

@endsection