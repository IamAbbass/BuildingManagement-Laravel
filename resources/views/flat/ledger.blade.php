@extends('layouts.print')


@section('content')

<div class="container-fluid">
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Flat {{ $flat->name }}</h6>
            
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>

                        <tr>
                            <th>Sno</th>
                            <th>Slip No</th>
                            <th>Head</th>
                            <th>Amount</th>
                            <th>Discount</th>
                            <th>Method</th>
                            <th>Received</th>
                            <th>Month</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 0;    
                        @endphp
                        
                        @foreach($flat->payments->where('payment','>',0) as $payment)
                        
                            <tr>
                                <td>{{ ++$sno }}</td>
                                <td>
                                    {{ $payment->id }}
                                </td>
                                <td>
                                    {{ $payment->account ? $payment->account->name : '-' }}
                                </td>
                                <td>
                                    {{ number_format($payment->amount) }}
                                </td>
                                <td>{{ $payment->discount }}</td>
                                <td>
                                    {{ ucfirst($payment->method) }} {{ $payment->method == 'cheque' ? $payment->cheque_no : '' }}</td>
                                <td>
                                    {!! $payment->old_slip_no ? '(Manual Slip No. '.$payment->old_slip_no.')<br/>' : '' !!}
                                    {{ number_format($payment->payment) }} <span class="badge badge-secondary">{{ ucfirst($payment->type) }}  </span>                              
                                </td>
                                <td>{{ $payment->month }}</td>
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