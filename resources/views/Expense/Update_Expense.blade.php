@extends('layouts.admin')
@section('content')

<div class="container">

<br>
<a href="/expensehead/{{$expensehead_id}}/expense">All Expense</a>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>Add Expense</strong>
                </div>
                <div class="card-body">
                <form action="/expensehead/{{$expensehead_id}}/expense/{{$expense_id}}" method="post" >
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Expense Name</label>
                            <div class="col-sm-9">
                            <input id="event-title" value="{{$expense->name}}" name="name" type="text" class="form-control" placeholder="Enter Expen Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Expense Amount</label>
                            <div class="col-sm-9">
                            <input id="event-title" value="{{$expense->amount}}"  name="amount" type="number" class="form-control" placeholder="Enter Expense amount">
                            </div>
                        </div>
                       
                       
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                            <textarea id="event-desc" name="description"  placeholder="Enter ExpenseHead Description " class="form-control" rows="6">{{$expense->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <button type="submit" id="btn-save" class="btn gd-primary text-white btn-rounded">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection