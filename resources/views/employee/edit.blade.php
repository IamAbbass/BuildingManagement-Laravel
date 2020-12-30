@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Edit Employee</h1>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Employee</h6>
        </div>
        <div class="card-body">
            <form action="/employee/{{ $employee->id }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row">                    
                    <div class="col-md-4">
                        <label>Name: *</label>
                        <input value="{{ $employee->name }}" required type="text" class="form-control" name="name" />
                    </div>
                    <div class="col-md-4">
                        <label>CNIC: *</label>
                        <input value="{{ $employee->cnic }}" required type="text" class="form-control" name="cnic" />
                    </div>
                    <div class="col-md-4">
                        <label>Mobile: *</label>
                        <input value="{{ $employee->mobile }}" required type="text" class="form-control" name="mobile" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label>Basic Salary: *</label>
                        <input value="{{ $employee->salary }}" required type="text" class="form-control" name="salary" />
                    </div>
                    <div class="col-md-4">
                        <label>Department:</label>
                        <input value="{{ $employee->department }}" type="text" class="form-control" name="department" />
                    </div>
                    <div class="col-md-4">
                        <label>Notes:</label>
                        <textarea class="form-control" name="notes">{{ $employee->notes }}</textarea>
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