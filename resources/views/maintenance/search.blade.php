@extends('layouts.admin')


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Search Receipt No</h1>

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">

            <form target="_blank" method="post" action="">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input required type="number" class="form-control" placeholder="Receipt No" name="receipt_no" />
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>

            </form>

        </div>
    </div>    
    
</div>
<!-- /.container-fluid -->


@endsection