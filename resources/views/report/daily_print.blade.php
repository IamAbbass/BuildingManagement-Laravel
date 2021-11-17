@extends('layouts.print')


@section('content')

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4  mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daily Collection Report ({{ $from }} to {{ $to }})</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>

                        <tr>
                            <th>Sno</th>
                            <th>Flat</th>
                            <th>Receipt</th>

                            <th>Head</th>
                            {{-- <th>Amount</th> --}}
                            {{-- <th>Discount</th> --}}
                            <th>Method</th>
                            <th>Received</th>
                            <th>Month</th>
                            {{-- <th>Description</th> --}}
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno            = 0;
                            $total          = 0;
                            $less_cheque    = 0;
                        @endphp

                        @foreach($payments as $payment)
                            @php
                                $total += $payment->payment;
                                if($payment->method == 'cheque'){
                                    $less_cheque += $payment->payment;
                                }
                            @endphp

                            <tr>
                                <td>{{ ++$sno }}</td>
                                <td>
                                    {{ $payment->flat ? $payment->flat->name : '' }}
                                </td>
                                <td>
                                    {{ $payment->id }}
                                </td>
                                <td>
                                    {{ $payment->account ? $payment->account->name : '-' }}
                                </td>
                                {{-- <td>
                                    {{ number_format($payment->amount) }}
                                </td> --}}
                                {{-- <td>{{ $payment->discount }}</td> --}}
                                <td>
                                    {{ ucfirst($payment->method) }} {{ $payment->method == 'cheque' ? $payment->cheque_no : '' }}</td>
                                <td>
                                    {!! $payment->old_slip_no ? '(Manual Slip No. '.$payment->old_slip_no.')<br/>' : '' !!}
                                    {{ number_format($payment->payment) }} <span class="badge badge-secondary">{{ ucfirst($payment->type) }}  </span>
                                </td>
                                <td>{{ $payment->month }}</td>
                                {{-- <td>{{ $payment->description }}</td> --}}
                                <td>{{ $payment->date }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <hr/>
                <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th>Today Collection</th>
                            <td>{{ number_format($total) }}</td>
                        </tr>
                        <tr>
                            <th>Less: Cheque</th>
                            <td>{{ number_format($less_cheque) }}</td>
                        </tr>
                        <tr>
                            <th>Today Cash Received</th>
                            <td>{{ number_format($total-$less_cheque) }}</td>
                        </tr>
                        <tr>
                            <th>Add Opening Balance</th>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th>Today Cash in Hand</th>
                            <td>{{ number_format($total-$less_cheque) }}</td>
                        </tr>
                        <tr>
                            <th>Less: Deposit in Bank</th>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th>Less: Expenses</th>
                            <td>{{ number_format($expense) }}</td>
                        </tr>
                        <tr>
                            <th>Closing Balance</th>
                            <td>{{ number_format($total-$less_cheque-$expense) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
