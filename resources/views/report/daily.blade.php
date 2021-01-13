@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Daily Collection Report</h1>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daily Collection Report</h6>
        </div>
        <div class="card-body">

            <form method="POST" target="_blank" action="/report/daily">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label>Date: *</label>
                        <input value="{{ request('date') }}" required name="date" class="form-control" type="date" />
                    </div>
                    {{-- <div class="col-md-4">
                        <label>Date To: *</label>
                        <input value="{{ request('to') }}" required name="to" class="form-control" type="date" />
                    </div> --}}
                    <div class="col-md-4">
                        <label>&nbsp;</label><br/>
                        <button class="btn btn-primary">Generate</button>
                    </div>
                </div>
            </form>
            

            {{-- <div class="table-responsive">

                

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>

                        <tr>
                            <th>Sno</th>
                            <th>Slip No</th>
                            <th>Flat</th>
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
                        
                        @foreach($payments as $payment)
                        
                            <tr>
                                <td>{{ ++$sno }}</td>
                                <td>
                                    {{ $payment->id }}
                                </td>
                                <td>
                                    {{ $payment->flat->name }}
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
                                <td>{{ $payment->description }}</td>
                                <td>{{ $payment->date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> --}}
            
            
            

        </div>
    </div>

</div>

@endsection