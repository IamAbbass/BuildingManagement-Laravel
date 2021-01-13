@extends('layouts.print')


@section('content')

<div class="container-fluid">
    
            

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Block-{{ $block->name }} {{ date('M-Y') }} Defaulter List</h6>
              
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th style="width:75px;">Block</th>
                            <th style="width:75px;">Flat</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 0;    
                        @endphp
                        
                        @foreach($flats as $flat)

                            @if($flat->isDefaulter->sum('payment') < 10000)
                                <tr>
                                    <td>{{ ++$sno }}</td>
                                    <td>Block {{ $flat->block->name }}</td>
                                    <td>{{ $flat->name }}</td>
                                    <td> PKR {{ number_format($flat->payments->sum('amount')-$flat->payments->sum('discount')-$flat->payments->sum('payment')) }}</td>
                                </tr>                            
                            @endif                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection