@extends('layouts.admin')
@section('content')

<div class="container">

<br>
{{-- <a href="/expensehead/{{$expensehead_id}}/expense">All Expense</a> --}}




<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">               
            <a href="/expensehead" class="btn btn-md text-muted">
                <i data-feather="arrow-left"></i>
                <span class="d-none d-sm-inline mx-1">{{$expensehead_name->name}} </span>
                
            </a>
        </div>
        <div class="flex"></div>
        <div>
        <a href="/expensehead/{{$expensehead_name->id}}/expense" class="btn btn-md text-muted">
                <span class="d-none d-sm-inline mx-1">{{$expensehead_name->name}} expensehead's</span>
                <i data-feather="arrow-right"></i>
            </a>
        </div>
    </div>
</div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>Add Expense</strong>
                </div>
                <div class="card-body">
                <form action="/expensehead/{{$expensehead_id}}/expense" method="post" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Expense Name</label>
                            <div class="col-sm-9">
                            <input id="event-title"  name="name" type="text" class="form-control" placeholder="Enter Expen Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Expense Amount</label>
                            <div class="col-sm-9">
                            <input id="event-title"  name="amount" type="number" class="form-control" placeholder="Enter Expense amount">
                            </div>
                        </div>
                       
                       
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea id="event-desc" name="description"  placeholder="Enter ExpenseHead Description " class="form-control" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2"></label>
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