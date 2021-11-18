@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Edit Account Heads</h1>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Account Heads</h6>
        </div>
        <div class="card-body">
            <form action="{{ env('APP_URL') }}/accounthead/{{ $account_head->id }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-md-4">
                        <label>Name: *</label>
                        <input type="text" class="form-control" name="name" value="{{ $account_head->name }}" />
                    </div>
                    <div class="col-md-4">
                        <label>Default Amount: *</label>
                        <input type="number" class="form-control" name="default_amount" value="{{ $account_head->default_amount }}"/>
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