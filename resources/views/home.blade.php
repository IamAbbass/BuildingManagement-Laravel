@extends('layouts.admin')


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ env('APP_NAME') }}</h1>

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">

            <img style="width: 300px; display: block; margin: 10% auto;" src="{{ asset('/img/logo.png') }}" alt="" />

        </div>
    </div>    
    
</div>
<!-- /.container-fluid -->


@endsection