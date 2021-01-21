@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Expense Heads</h1>
        <a href="/expensehead/create" class="btn btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> Create</a>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Expense Heads</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Name</th>
                            <th>Details</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 0;    
                        @endphp
                        
                        @foreach($expense_heads as $head)
                        
                            <tr>
                                <td>{{ ++$sno }}</td>
                                <td>{{ $head->name }}</br><kbd>{{ $head->head_type}}</kbd></td>
                                <td>
                                    @if($head->creator)
                                        Created By: {{ $head->creator->name }}
                                    @endif

                                    @if($head->updater)
                                        <br/>
                                        Updated By: {{ $head->updater->name }}
                                    @endif
                                    
                                </td>
                                <td> <a href="/expensehead/{{ $head->id }}/edit" class="btn btn-warning shadow-sm"><i
                                    class="fas fa-edit fa-sm text-white-50"></i> Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection