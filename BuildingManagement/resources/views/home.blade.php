@extends('layouts.admin')

@section('content')
<div id="content" class="flex ">
    <!-- ############ Main START-->
    <div>
        <div class="page-content container-fuild" id="page-content">
            <div class="padding">
              <div class="row">

                @for($i=0; $i<=9; $i++)
                  <div class="col-sm-4 col-md-3 col-lg-2">
                    <div class="card table_bg">
                        <div class="card-body text-center">
                            <h5 class="card-title text-center text-white m-0">Wiraka 1</h5>
                            <p class="card-text text-center text-white mb-1"><span class="badge badge-light text-uppercase mb-0">PKR 7.5</span></p>
                            <p class="card-text text-center text-white mb-1"><small>Match In Progress</small></p>
                            <button class="btn btn-raised btn-wave {{ $i<5 ? 'green' : 'red'}} text-white">Check In</button>
                        </div>
                    </div>
                  </div>
                @endfor

              </div>
            </div>
        </div>
    </div>
    <!-- ############ Main END-->
</div>

@endsection
