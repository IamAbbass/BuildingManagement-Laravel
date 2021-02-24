@extends('layouts.print')


@section('content')

<div class="container-fluid">

    <h3 style="color:black; margin-bottom: 25px;">Flat {{ $flat->name }}</h3>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>

            <tr>
                <th>Sno</th>
                <th>Month</th>
                <th>Description</th>
                <th>Slip No</th>
                <th>Head</th>
                <th>Dues</th>
                <th>Discount</th>
                <th>Received</th>
                <th>Balance</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @php
                $sno            = 0;
                $sum_amount     = 0;
                $sum_discount   = 0;
                $sum_payment    = 0;
                $sum_balance    = 0;

                
            @endphp
            
            @foreach($payments as $payment)

                @php
                    $sno = 0; 
                    
                    $sum_amount     += $payment->amount;
                    $sum_discount   += $payment->discount;
                    $sum_payment    += $payment->payment;
                    
                    $balance_this   = $payment->amount-$payment->discount-$payment->payment;

                    $sum_balance    += $balance_this;
                @endphp
            
                <tr>
                    <td>{{ ++$sno }}</td>
                    <td>{{ $payment->month }}</td>
                    <td>
                        {!! $payment->old_slip_no ? '(Manual Slip No. '.$payment->old_slip_no.')<br/>' : '' !!}
                        {!! $payment->description ? $payment->description : '' !!}
                    </td>

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
                        {{ number_format($payment->payment) }} 
                        <span class="badge badge-secondary">{{ ucfirst($payment->type) }}</span>       
                        <span class="badge badge-secondary">{{ ucfirst($payment->method) }} {{ $payment->method == 'cheque' ? $payment->cheque_no : '' }}</span>       
                    </td>
                    <td>{{ number_format($payment->amount-$payment->discount-$payment->payment) }}</td>                              
                    <td>{{ $payment->date }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="5">Total</th>
                <th>{{ $sum_amount }}</th>
                <th>{{ $sum_discount }}</th>                                
                <th>{{ $sum_payment }}</th>
                <th>{{ $sum_balance }}</th>                              
                <th>-</th>
            </tr>
        </tfoot>
    </table>
    


</div>

@endsection