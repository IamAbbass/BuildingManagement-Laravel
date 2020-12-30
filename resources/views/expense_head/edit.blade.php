@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Edit Expense Heads</h1>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Expense Heads</h6>
        </div>
        <div class="card-body">
            <form action="/expensehead/{{ $expense_head->id }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-md-8">
                        <label>Name: *</label>
                        <input type="text" class="form-control" name="name" value="{{ $expense_head->name }}" />
                    </div>
                    <div class="col-md-4">
                        <label>&nbsp;</label><br/>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>

            </form>
            

        </div>
    </div>

</div>

@endsection