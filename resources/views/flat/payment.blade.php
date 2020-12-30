@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Payment</h1>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Payment</h6>
        </div>
        <div class="card-body">
            <form action="/flat/{{ $flat->id }}/payment" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label>Account: *</label>
                        @foreach($account_heads as $account_head)
                            <br/>
                            <label><input required type="radio" name="head_id" value="{{ $account_head->id }}" /> {{ $account_head->name }} <b>(PKR {{ $account_head->default_amount }})</b></label>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        <label>Amount: *</label>
                        <input required type="number" class="form-control" name="amount" />
                    </div>
                    <div class="col-md-4">
                        <label>Month:</label>
                        <input type="month" class="form-control" name="month" />
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <label>Payment Method: *</label><br/>
                        <label><input required type="radio" name="method" value="cash" /> Cash</label><br/>
                        <label><input required type="radio" name="method" value="cheque" /> Cheque</label>
                    </div>

                    <div class="col-md-4">
                        <label>Cheque Number (If Cheque):</label>
                        <input type="text" class="form-control" name="cheque_no" />
                    </div>

                    <div class="col-md-4">
                        <label>Date: *</label>
                        <input required type="date" class="form-control" name="date" />
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4">
                        <label>Payment Type: *</label><br/>
                        <label><input required type="radio" name="type" value="full" /> Full</label><br/>
                        <label><input required type="radio" name="type" value="partial" /> Partial</label>
                    </div>

                    <div class="col-md-4">
                        <label>Received Amount: *</label>
                        <input required type="text" class="form-control" name="payment" />
                    </div>
                    <div class="col-md-4">
                        <label>Discount:</label>
                        <input type="number" class="form-control" name="discount" />
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4">
                        <label>&nbsp;</label><br/>
                        <button type="submit" class="btn btn-primary">Save & Print</button>
                    </div>
                    
                </div>

            </form>
            

        </div>
    </div>

</div>

@endsection