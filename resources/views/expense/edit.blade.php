@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Edit Expense</h1>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Expense</h6>
        </div>
        <div class="card-body">
            <form action="/expense/{{ $expense->id }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-md-4">
                        <label>Select Head: *</label>
                        <select required class="form-control" name="head_id">
                            <option value="">Select</option>
                            @foreach($expense_heads as $expense_head)
                                <option {{ $expense_head->id == $expense->head_id ? 'selected' : '' }} value="{{ $expense_head->id }}">{{ $expense_head->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Expense Title: *</label>
                        <input value="{{ $expense->name }}" required type="text" class="form-control" name="name" />
                    </div>
                    <div class="col-md-4">
                        <label>Expense Amount: *</label>
                        <input value="{{ $expense->amount }}" required type="number" class="form-control" name="amount" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label>Expense Date: *</label>
                        <input value="{{ $expense->date }}" required type="date" class="form-control" name="date" />
                    </div>
                    <div class="col-md-4">
                        <label>Description:</label>
                        <textarea class="form-control" name="description">{{ $expense->description }}</textarea>
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