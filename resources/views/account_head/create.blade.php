@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Create Account Heads</h1>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Account Heads</h6>
        </div>
        <div class="card-body">
            <form action="/accounthead" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label>Name: *</label>
                        <input type="text" class="form-control" name="name" />
                    </div>
                    <div class="col-md-4">
                        <label>Default Amount: *</label>
                        <input type="number" class="form-control" name="default_amount" />
                    </div>                    
                    <div class="col-md-4">
                        <label>&nbsp;</label><br/>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>

            </form>
            

        </div>
    </div>

</div>

@endsection