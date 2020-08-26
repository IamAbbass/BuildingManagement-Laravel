@extends('layouts.admin')
@section('content')


<div class="container">
{{-- <a href="/block/{{$block_id}}/floor/{{$floor_id}}/flat/create">all Flats</a> --}}
    

<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
        {{-- this code is for go back to block --}}
        <a href="/block/{{$block_id}}/floor" class="btn btn-md text-muted">
            <i data-feather="arrow-left"></i>
            <span class="d-none d-sm-inline mx-1">{{$floor->name}} </span>
            </a>
           
        </div>
        <div class="flex"></div>
        <div>
            {{--this code is for show all floor of block --}}
        <a href="/block/{{$block_id}}/floor/{{$floor_id}}/flat" class="btn btn-md text-muted">
        <span class="d-none d-sm-inline mx-1">{{$floor->name}} Floor's</span>
                <i data-feather="arrow-right"></i>
            </a>
        </div>
    </div>
</div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Add Flat</strong>
                    </div>
                    <div class="card-body">
                    <form action="/block/{{$block_id}}/floor/{{$floor_id}}/flat" method="post" >
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Flat Number</label>
                                <div class="col-sm-9">
                                <input id="event-title"  name="flat_no" type="text" class="form-control" placeholder="Enter floor Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-9">
                                <input id="event-title"  name="name" type="text" class="form-control" placeholder="Enter floor Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">C-N-I-C</label>
                                <div class="col-sm-9">
                                <input id="event-title"  name="cnic" type="text" class="form-control" placeholder="Enter floor Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Phone Number</label>
                                <div class="col-sm-9">
                                <input id="event-title"  name="phone" type="text" class="form-control" placeholder="Enter floor Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-9">

                                <select class=" form-control" name="status" data-plugin="select2" data-option="{}" data-minimum-results-for-search="Infinity">
                                    <option value="owner">owner</option>
                                    <option value="rent" >rent</option>
                                    <option value="vacant">vacant</option>
                                </select>
                                </div>
                            </div>
                           
                           
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea id="event-desc" name="description"  placeholder="Enter Floor Description " class="form-control" rows="6"></textarea>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2"></label>
                                <div class="col-sm-9">
                                    <button type="submit" id="btn-save" class="btn gd-primary text-white btn-rounded">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
@endsection