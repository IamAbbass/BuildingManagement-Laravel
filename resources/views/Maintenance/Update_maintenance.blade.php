@extends('Layouts.admin')
@section('content')


<div class="container">

    <div class="page-hero page-container " id="page-hero">
        <div class="padding d-flex">
            <div class="page-title">
         
            <a href="/block" class="btn btn-md text-muted">
                <i data-feather="arrow-left"></i>
                <span class="d-none d-sm-inline mx-1"></span>
                
            </a>
               
            </div>
            <div class="flex"></div>
            <div>
                <a href="/block" class="btn btn-md text-muted">
                <span class="d-none d-sm-inline mx-1"> block's</span>
                    <i data-feather="arrow-right"></i>
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>Add Maintainance</strong>
                </div>
                <div class="card-body">
                <form action="/maintainance/{{$update_maintainance->id}}" method="post" >
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Block Id</label>
                            <div class="col-sm-9">
                                <select class=" form-control" id="block" name="block_id" data-plugin="select2" data-option="{}" data-minimum-results-for-search="Infinity">
                                    @foreach ($block as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                 
                                </select>
                                &nbsp; current block : {{$get_block->name}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Floor Id</label>
                            <div class="col-sm-9">
                                <select class=" form-control" id="floor" name="floor_id" data-plugin="select2" data-option="{}" data-minimum-results-for-search="Infinity">
                                    <option value="owner">owner</option>
                                </select>

                                &nbsp; current floor : {{$get_floor->name}}

                            </div>
                        </div>
                       

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Flat Id</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="flat" name="flat_id" data-plugin="select2" data-option="{}" data-minimum-results-for-search="Infinity">
                                    <option value="owner">owner</option>
                                </select>
                                &nbsp; current flat : {{$get_flat->name}}
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-9">
                                
                               
                            
                            <input id="event-title" type="text" value=" {{$update_maintainance->amount}}"  name="amount"  class="form-control" placeholder="Enter Block Name">
                        
                        </div>
                        </div>
                       
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-9">
                            <textarea id="event-desc" name="description"  placeholder="Enter Block Description " class="form-control" rows="6">{{$update_maintainance->description}}</textarea>
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

<script type="text/javascript">
    $('#block').change(function(){
    var block_id = $(this).val();    
    if(block_id){
        $.ajax({
           type:"GET",
           url:"{{url('get-floor-list')}}?block_id="+block_id,
           success:function(res){ 
           console.log(res);              
            if(res){
                $("#floor").empty();
                $("#floor").append('<option>Select</option>');
                $.each(res,function(key){
                    $("#floor").append('<option value="'+res[key].id+'">'+res[key].name+'</option>');
                });
           
            }else{
               $("#floor").empty();
            }
           }
        });
    }else{
        $("#floor").empty();
        $("#flat").empty();
    }      
   });
    $('#floor').on('change',function(){
    var floorID = $(this).val();    
    if(floorID){
        $.ajax({
           type:"GET",
           url:"{{url('get-flat-list')}}?floor_id="+floorID,
           success:function(res){               
            if(res){
                $("#flat").empty();
                $("#flat").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#flat").append('<option value="'+res[key].id+'">'+res[key].name+'</option>');
                });
           
            }else{
               $("#flat").empty();
            }
           }
        });
    }else{
        $("#flat").empty();
    }
        
   });
</script>

    
@endsection