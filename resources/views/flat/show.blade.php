@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Flat {{ $flat->name }} History</h1>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Flat {{ $flat->name }} History</h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>

                        <tr>
                            <th>Sno</th>
                            <th>Head</th>
                            <th>Amount</th>
                            <th>Discount</th>
                            <th>Method</th>
                            <th>Received</th>
                            <th>Month</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 0;    
                        @endphp
                        
                        @foreach($flat->payments as $payment)
                        
                            <tr>
                                <td>{{ ++$sno }}</td>
                                <td>{{ $payment->account ? $payment->account->name : '-' }}</td>
                                <td>{{ number_format($payment->amount) }}</td>
                                <td>{{ $payment->discount }}</td>
                                <td>{{ ucfirst($payment->method) }} {{ $payment->method == 'cheque' ? $payment->cheque_no : '' }}</td>
                                <td>
                                    {!! $payment->old_slip_no ? '(Slip No. '.$payment->old_slip_no.')<br/>' : '' !!}
                                    {{ number_format($payment->payment) }}
                                    
                                </td>
                                <td>{{ $payment->month }}</td>
                                <td>{{ $payment->description }}</td>
                                <td>{{ $payment->date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            
            

        </div>
    </div>

</div>

@endsection