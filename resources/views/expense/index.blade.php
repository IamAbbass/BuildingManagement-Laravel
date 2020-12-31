@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Expenses</h1>
        <a href="/expense/create" class="btn btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> Create</a>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Expenses</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Expense Head</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Details</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 0;    
                        @endphp
                        
                        @foreach($expenses as $expense)
                        
                            <tr>
                                <td>{{ ++$sno }}</td>
                                <td>{{ $expense->head->name }}</td>
                                <td>{{ $expense->name }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>{{ $expense->date }}</td>
                                <td>{{ $expense->amount }}</td>
                                <td>
                                    @if($expense->creator)
                                        Created By: {{ $expense->creator->name }}
                                    @endif

                                    @if($expense->updater)
                                        <br/>
                                        Updated By: {{ $expense->updater->name }}
                                    @endif
                                    
                                </td>
                                <td> 
                                    <a href="/expense/{{ $expense->id }}/slip" class="btn btn-info shadow-sm"><i
                                        class="fas fa-print fa-sm text-white-50"></i> Print</a>

                                    <a href="/expense/{{ $expense->id }}/edit" class="btn btn-warning shadow-sm"><i
                                        class="fas fa-edit fa-sm text-white-50"></i> Edit</a>

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