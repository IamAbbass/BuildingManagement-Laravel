@extends('layouts.print')


@section('content')

<div>
    <h3 style="color:black; margin-bottom: 25px;">{{ $title }}</h3>



    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Sno</th>
                <th style="width:75px;">Block</th>
                <th style="width:75px;">Flat</th>
                <th>Resident</th>
                <th>Balance</th>
                {{-- <th>Details</th> --}}
            </tr>
        </thead>
        <tbody>
            @php
                $sno = 0;
                $grand_total = 0;
            @endphp
            @foreach($flats as $flat)

                @if($flat->isDefaulter->sum('payment') < 10000 && ($flat->payments->where('is_cancelled',false)->sum('amount')-$flat->payments->where('is_cancelled',false)->sum('discount')-$flat->payments->where('is_cancelled',false)->sum('payment') > 0))
                    @php
                        if(request('head')){
                            $payments = $flat->payments->where('is_cancelled',false)->where('head_id',request('head'));
                        }else{
                            $payments = $flat->payments->where('is_cancelled',false);
                        }

                        $balance = $payments->sum('amount')-$payments->sum('discount')-$payments->sum('payment');
                        $grand_total += $balance;
                    @endphp

                    <tr>
                        <td>{{ ++$sno }}</td>
                        <td>Block {{ $flat->block->name }}</td>
                        <td>{{ $flat->name }}</td>
                        <td>{{ $flat->person_name }}</td>
                        <td>
                            PKR {{ number_format($balance) }}
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th class="text-center" colspan="4">Total Outstanding</th>
                <th class="text-left">PKR {{ number_format($grand_total) }}</th>
            </tr>
        </tfoot>
    </table>

</div>


@endsection
