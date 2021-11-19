@extends('layouts.admin')


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Payment for {{ $maintenance->flat->name }}</h1>
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Payment for {{ $maintenance->flat->name }}</h6>
        </div>
        <div class="card-body">
            <form target="_blank" action="{{ env('APP_URL') }}/slip/{{ $maintenance->id }}/edit" method="POST">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-4">
                        <label>Account: *</label>
                        @foreach($account_heads as $account_head)
                            <br/>
                            <label><input {{ $maintenance->head_id == $account_head->id ? 'checked' : '' }} data-amount={{ $account_head->default_amount }} required type="radio" name="head_id" value="{{ $account_head->id }}" /> {{ $account_head->name }} <b>(PKR {{ $account_head->default_amount }})</b></label>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        <label>Amount: *</label>
                        <input required min="0" type="number" class="form-control" name="amount" value="{{ $maintenance->amount }}" />
                    </div>
                    <div class="col-md-4">
                        <label>Month: *</label>
                        <input required type="month" class="form-control" name="month" value="{{ date('Y-m', strtotime($maintenance->month)) }}" />
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <label>Payment Method: *</label><br/>
                        <label><input {{ $maintenance->method == "cash" ? 'checked' : '' }} required type="radio" name="method" value="cash" /> Cash</label><br/>
                        <label><input {{ $maintenance->method == "cheque" ? 'checked' : '' }} required type="radio" name="method" value="cheque" /> Cheque</label>
                    </div>

                    <div class="col-md-4">
                        <label>Cheque Number (If Cheque):</label>
                        <input type="text" class="form-control" value="{{ $maintenance->cheque_no }}" name="cheque_no" />
                    </div>

                    <div class="col-md-4">
                        <label>Date: *</label>
                        <input required type="date" class="form-control" name="date" value="{{ date('Y-m-d', strtotime($maintenance->date)) }}" />
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4">
                        <label>Payment Type: *</label><br/>
                        <label><input {{ $maintenance->type == "full" ? 'checked' : '' }} required type="radio" name="type" value="full" /> Full</label><br/>
                        <label><input {{ $maintenance->type == "partial" ? 'checked' : '' }} required type="radio" name="type" value="partial" /> Partial</label>
                    </div>

                    <div class="col-md-4">
                        <label>Received Amount: *</label>
                        <input required min="1" type="text" class="form-control" name="payment" value="{{ $maintenance->payment }}" />
                    </div>
                    <div class="col-md-4">
                        <label>Discount:</label>
                        <input type="number" value="0" class="form-control" name="discount" value="{{ $maintenance->discount }}" />
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4">
                        <label>Notes: </label>
                        <input  type="text" class="form-control" name="description" value="{{ $maintenance->description }}" />
                    </div>
                    <div class="col-md-4">
                        <label>Manual Slip No:</label>
                        <input type="text" class="form-control" name="old_slip_no" value="{{ $maintenance->old_slip_no }}" />
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4">
                        <label>&nbsp;</label><br/>
                        <button type="submit" class="btn btn-primary">Update & Print</button>
                    </div>
                    
                </div>

            </form>
            

        </div>
    </div>

</div>

<script>
    $(document).ready(function(){
        // $("input[name='head_id']").change(function(){
        //     var amount = $(this).attr('data-amount');
        //     $("input[name='amount'], input[name='payment']").val(amount);
        //     $("input[name='amount'], input[name='payment'], input[name='discount']").attr('max',amount);   
           
        // });


        $("input[name='method']").change(function(){
            var value = $('input[name=method]:checked').val();
            if(value == 'cash'){
                $("input[name='cheque_no']").attr('readonly','readonly');
                $("input[name='cheque_no']").removeAttr('required');           
                $("input[name='cheque_no']").val("");        
            }else{
                $("input[name='cheque_no']").removeAttr('readonly');
                $("input[name='cheque_no']").attr('required','required');
            }
        });



    });
</script>

@endsection