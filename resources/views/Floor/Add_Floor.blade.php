@extends('layouts.admin')
@section('content')


<div class="container">
<a href="/block/{{$id}}/floor">all floor</a>
    <br>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong>Add floor</strong>
                    </div>
                    <div class="card-body">
                    <form action="/block/{{$id}}/floor" method="post" >
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Floor Name</label>
                                <div class="col-sm-9">
                                <input id="event-title"  name="name" type="text" class="form-control" placeholder="Enter floor Name">
                                </div>
                            </div>
                           
                           
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea id="event-desc" name="description"  placeholder="Enter Floor Description " class="form-control" rows="6"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3"></label>
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