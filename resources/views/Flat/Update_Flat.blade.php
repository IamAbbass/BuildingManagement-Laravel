@extends('layouts.admin')
@section('content')


<div class="container">
<a href="/block/{{$block_id}}/floor/{{$floor_id}}/flat">Add Flats</a>
    <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Update Flat</strong>
                    </div>
                    <div class="card-body">
                    <form action="/block/{{$block_id}}/floor/{{$floor_id}}/flat/{{$flat->id}}" method="post" >
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Flat Number</label>
                                <div class="col-sm-9">
                                <input id="event-title" value="{{$flat->flat_no}}"  name="flat_no" type="text" class="form-control" placeholder="Enter floor Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-9">
                                <input id="event-title" value="{{$flat->name}}" name="name" type="text" class="form-control" placeholder="Enter floor Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">C-N-I-C</label>
                                <div class="col-sm-9">
                                <input id="event-title" value="{{$flat->cnic}}" name="cnic" type="text" class="form-control" placeholder="Enter floor Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Phone Number</label>
                                <div class="col-sm-9">
                                <input id="event-title" value="{{$flat->phone}}" name="phone" type="text" class="form-control" placeholder="Enter floor Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <select class="form-control col-sm-9" name="status" data-plugin="select2" data-option="{}" data-minimum-results-for-search="Infinity">
                                <option value="{{$flat->status}}">{{$flat->status}}</option>
                                    <option value="owner">owner</option>
                                    <option value="rent" >rent</option>
                                    <option value="vacant">vacant</option>
                                </select>
                            </div>
                           
                           
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-9">
                                <textarea id="event-desc"  name="description"  placeholder="Enter Floor Description " class="form-control" rows="6">{{$flat->description}}</textarea>
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