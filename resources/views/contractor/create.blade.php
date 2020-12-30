@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Create Contractor</h1>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Contractor</h6>
        </div>
        <div class="card-body">
            <form action="/contractor" method="POST">
                @csrf
                <div class="row">                    
                    <div class="col-md-4">
                        <label>Name: *</label>
                        <input required type="text" class="form-control" name="name" />
                    </div>
                    <div class="col-md-4">
                        <label>CNIC: *</label>
                        <input required type="text" class="form-control" name="cnic" />
                    </div>
                    <div class="col-md-4">
                        <label>Mobile: *</label>
                        <input required type="text" class="form-control" name="mobile" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label>Notes:</label>
                        <textarea class="form-control" name="notes"></textarea>
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