@extends('layouts.admin')
@section('content')
    

<div class="container">
    <!-- ############ Content START-->
    <div id="content" class="flex ">
       <!-- ############ Main START-->
    {{-- <a href="/block/{{$id}}/floor/create">Add Floor</a> --}}
       <div>
           <div class="page-hero page-container " id="page-hero">
               <div class="padding d-flex">
                   <div class="page-title">
                       <h2 class="text-md text-highlight">  
                        <a href="/block" class="btn btn-md text-muted">
                            <i data-feather="arrow-left"></i>
                        <span class="d-none d-sm-inline mx-1">{{$block->name}}</span>
                            
                        </a>
                        </h2>
                      
                   </div>
                   <div class="flex"></div>
                   <div>
                   <a href="/block/{{$id}}/floor/create" class="btn btn-md text-muted">
                       <span class="d-none d-sm-inline mx-1">Add Floor</span>
                           <i data-feather="arrow-right"></i>
                       </a>
                   </div>
               </div>
           </div>

           @if (\Session::has('addfloor'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                        </button>
                        <strong>Alert</strong> {{!!  \session::get('addfloor')  !!}}
                    </div>
           @endif

           @if (\Session::has('updatefloor'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                        </button>
                        <strong>Alert</strong> {{!!  \session::get('updatefloor')  !!}}
                    </div>
           @endif

           @if (\Session::has('deletefloor'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                        </button>
                        <strong>Alert</strong> {{!!  \session::get('deletefloor')  !!}}
                    </div>
           @endif


           <div class="page-content page-container" id="page-content">
               <div class="padding">
                   <div id="toolbar">
                   </div>
                   <table id="table" class="table table-theme v-middle" data-plugin="bootstrapTable" data-toolbar="#toolbar" data-search="true" data-search-align="left" data-show-export="true" data-show-columns="true" data-detail-view="false" data-mobile-responsive="true"
                   data-pagination="true" data-page-list="[10, 25, 50, 100, ALL]">
                       <thead>
                           <tr>
                               <th data-sortable="true" data-field="id">ID</th>
                               <th data-sortable="true" data-field="owner">Name</th>
                               <th data-sortable="true" data-field="project">Description</th>
                               <th data-sortable="true" data-field="project">Building</th>
                               <th data-sortable="true" data-field="project">Block</th>
                               <th data-field="task"><span class="d-none d-sm-block">Action</span></th>
                             
                               <th></th>
                           </tr>
                       </thead>
                       <tbody>
                       
                        @if ($floor->count() > 0)
                            
                          

                           @foreach ($floor as $item)
                   
                           <tr class=" " data-id="13">
                               <td style="min-width:30px;text-align:center">
                               <span class="w-32 avatar gd-primary">{{$item->id}}</span>
                               </td>
                               <td>
                               <span class="item-amount d-none d-sm-block text-sm "><a href="/block/{{$id}}/floor/{{$item->id}}/flat" class="item-title text-color ">{{$item->name}}</a></span>
                               </td>
                               <td class="flex">
                                   {{-- <a href="#" class="item-title text-color ">Feed Reader</a> --}}
                                   <div class="item-except text-muted text-sm h-1x">
                                        {{$item->description}}
                                       {{-- <a href='#'>#big data</a> --}}
                                   </div>
                               </td>

                               <td class="flex">
                                {{-- <a href="#" class="item-title text-color ">Feed Reader</a> --}}
                                <div class="item-except text-muted text-sm h-1x">
                                    @foreach ($building as $buildings)
                                        
                                    
                                   @if ($item->building_id==$buildings->id)
                                       {{$buildings->name}}
                                   @else
                                       
                                   @endif
                                   @endforeach
                                    {{-- <a href='#'>#big data</a> --}}
                                </div>
                            </td>

                            <td class="flex">
                                {{-- <a href="#" class="item-title text-color ">Feed Reader</a> --}}
                                <div class="item-except text-muted text-sm h-1x">
                                  {{$block->name}}
                                    {{-- <a href='#'>#big data</a> --}}
                                </div>
                            </td>
                               
                               <td>
                                   <div class="item-action dropdown">
                                   <a href="/block/{{$id}}/floor/{{$item->id}}/flat" class="btn gd-warning text-white btn-rounded">Add Flat</a>

                                       <a href="#" data-toggle="dropdown" class="text-muted">
                                           <i data-feather="more-vertical"></i>
                                       </a>
                                       <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
                                       <a class="dropdown-item" href="/block/{{$id}}/floor/{{$item->id}}/edit">
                                               Edit
                                           </a>
                                           <a class="dropdown-item" href="#">
                                               show
                                           </a>
                                        <form action="/block/{{$id}}/floor/{{$item->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        {{-- <input type="text" hidden name="floor_id" value="{{$item->id}}"> --}}
                                        <button type="submit" class="dropdown-item">delete</button>
                                        </form>
                                       </div>
                                   </div>
                               </td>
                           </tr>
                           @endforeach
                           @else

                           <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">alert</span>
                            </button>
                            <strong>There is no floor must add first</strong> 
                        </div>
                           @endif
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
       <!-- ############ Main END-->
   </div>
   <!-- ############ Content END-->


</div>

@endsection