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
            {{-- <h6 class="m-0 font-weight-bold text-primary">Flat {{ $flat->name }} History</h6> --}}


            <form method="GET" target="_blank" action="/flat/{{ $flat->id }}/print">
                <div class="row">
                    <div class="col-md-4">
                        <label>From Date: *</label>
                        <input value="{{ request('from') }}" required name="from" class="form-control" type="date" />
                    </div>
                    <div class="col-md-4">
                        <label>To Date: *</label>
                        <input value="{{ request('to') }}" required name="to" class="form-control" type="date" />
                    </div>
                    <div class="col-md-4">
                        <label>&nbsp;</label><br/>
                        <button class="btn btn-primary">Export Ledger</button>
                    </div>
                </div>
            </form>
            
        </div>
        <div class="card-body">

            <div class="table-responsive">
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
                            <th>Options</th>
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
                                <td>
                                    @if($payment->is_cancelled == true)
                                        <a class="btn btn-sm mr-1 mb-1 btn-danger shadow-sm"><i
                                        class="fas fa-times fa-sm text-white-50"></i> Cancelled</a>

                                    @else
                                        <a href="javascript:;" url="/slip/{{ $payment->id }}/cancel" class="btn_cancel btn btn-sm mr-1 mb-1 btn-warning shadow-sm"><i
                                        class="fas fa-times fa-sm text-white-50"></i> Cancel</a>

                                        <a target="_blank" href="/slip/{{ $payment->id }}" class="btn btn-sm mr-1 mb-1 btn-info shadow-sm"><i
                                        class="fas fa-print fa-sm text-white-50"></i> Slip</a>
                                    @endif
                                </td>
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
            
            
            

        </div>
    </div>

</div>


<script>
    $(document).ready(function(){
        $(".btn_cancel").click(function(){
            var url = $(this).attr("url");
            var description = prompt("Write Reason:");            
            if(description){
                window.location.replace(url+"?description="+description);                
            }else{
                alert("Please Write Reason To Cancel !");
            }
        });
    });
</script>

@endsection