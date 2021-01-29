@extends('layouts.verify')

@section('content')

<div class="container-fluid">
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Slip Verification Status</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if($verified == "YES")
                    <img style="width: 290px; display: block; margin: 6% auto;" src="{{ asset('/img/verified.jpg') }}" alt="Verified" />
                @else
                    <img style="width: 290px; display: block; margin: 6% auto;" src="{{ asset('/img/not_verified.jpg') }}" alt="Not Verified" />
                @endif
            </div>
        </div>
    </div>

</div>

@endsection