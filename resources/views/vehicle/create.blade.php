@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Create Vehicle</h1>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Vehicle</h6>
        </div>
        <div class="card-body">
            <form action="/flat/{{ $flat->id }}/vehicle" method="POST">
                @csrf

                <div class="row">
                    
                    <div class="col-md-3">
                        <label>Make: *</label>
                        <input required type="text" class="form-control" name="make" />
                    </div>
                    <div class="col-md-3">
                        <label>Model: *</label>
                        <input required type="text" class="form-control" name="model" />
                    </div>
                    <div class="col-md-3">
                        <label>Color: *</label>
                        <input required type="text" class="form-control" name="color" />
                    </div>
                    <div class="col-md-3">
                        <label>Number: *</label>
                        <input required type="text" class="form-control" name="number" />
                    </div>
                </div>
                <div class="row mt-3">                    
                    <div class="col-md-4">
                        <label>&nbsp;</label><br/>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>

            </form>
            

        </div>
    </div>

</div>

@endsection