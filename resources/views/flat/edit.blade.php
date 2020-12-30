@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Edit Flat Info</h1>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Flat Info</h6>
        </div>
        <div class="card-body">
            <form action="/flat/{{ $flat->id }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-4">
                        <label>Name: *</label>
                        <input value="{{ $flat->person_name }}" type="text" class="form-control" name="person_name" />
                    </div>
                    <div class="col-md-4">
                        <label>Mobile: *</label>
                        <input value="{{ $flat->person_mobile }}" type="text" class="form-control" name="person_mobile" />
                    </div>
                    <div class="col-md-4">
                        <label>Mobile (2): *</label>
                        <input value="{{ $flat->person_mobile2 }}" type="text" class="form-control" name="person_mobile2" />
                    </div>
                    <div class="col-md-4">
                        <label>CNIC: *</label>
                        <input value="{{ $flat->person_cnic }}" type="text" class="form-control" name="person_cnic" />
                    </div>
                    <div class="col-md-4">
                        <label>Perminent Address: *</label>
                        <input value="{{ $flat->person_perm_address }}" type="text" class="form-control" name="person_perm_address" />
                    </div>
                    <div class="col-md-4">
                        <label>Status: *</label>
                        <select class="form-control" name="status">
                            <option value="">Select</option>
                            <option {{ $flat->status == 'Vacant' ? 'selected' : '' }} value="Vacant">Vacant</option>
                            <option {{ $flat->status == 'Owner' ? 'selected' : '' }} value="Owner">Owner</option>
                            <option {{ $flat->status == 'Tenant' ? 'selected' : '' }} value="Tenant">Tenant</option>
                        </select>
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