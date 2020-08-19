@extends('layouts.admin')
@section('content')

<div class="container">

    <div class="page-hero page-container " id="page-hero">
        <div class="padding d-flex">
            <div class="page-title">
            {{-- <h2 class="text-md text-highlight">scds</h2> --}}
            {{-- <a href="" class="btn btn-md text-muted">
                <i data-feather="arrow-left"></i>
                <span class="d-none d-sm-inline mx-1"></span>
                
            </a> --}}
               
            </div>
            <div class="flex"></div>
            <div>
                <a href="/block/create" class="btn btn-md text-muted">
                <span class="d-none d-sm-inline mx-1">Add block</span>
                    <i data-feather="arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Event form</strong>
                    </div>
                    <div class="card-body">
                    <form action="/block/{{$block->id}}" method="post" >
                           @csrf
                           @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Block Name</label>
                                <div class="col-sm-9">
                                <input id="event-title" value="{{$block->name}}" name="name" type="text" class="form-control" placeholder="Enter Block Name">
                                </div>
                            </div>
                           
                           
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-9">
                                <textarea id="event-desc"  name="description" placeholder="Enter Block Description " class="form-control" rows="6">{{$block->description}}</textarea>
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