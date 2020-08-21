@extends('layouts.admin')
@section('content')


<div class="container">
     <!-- ############ Content START-->
     <div id="content" class="flex ">
        <!-- ############ Main START-->
        {{-- <a href="/block/create">Add Block</a>  that code is mine --}}
        <div>
            <div class="page-hero page-container " id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        {{-- <h2 class="text-md text-highlight">All Blocks</h2> --}}
                        <a href="" class="btn btn-md text-muted">
                            <i data-feather="arrow-left"></i>
                            <span class="d-none d-sm-inline mx-1">{{$building->name}}</span>
                            
                        </a>
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

            

        @if (\Session::has('block'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Alert</strong> {{!! \Session::get('block') !!}}
        </div>
        @endif

        @if (\Session::has('Update'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Alert</strong> {{!! \Session::get('Update') !!}}
        </div>
        @endif

        @if (\Session::has('delete'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Alert</strong> {{!! \Session::get('delete') !!}}
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
                                <th data-sortable="true" data-field="project">building</th>
                                <th data-field="task"><span class="d-none d-sm-block">Action</span></th>
                              
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            
                           @if ($block->count() > 0)
                               
                           
                               
                      
                            @foreach ($block as $item)
                    
                            <tr class=" " data-id="13">
                                <td style="min-width:30px;text-align:center">
                                <span class="w-32 avatar gd-primary">{{$item->id}}</span>
                                </td>
                                <td>
                                <span class="item-amount d-none d-sm-block text-sm "><a href="/block/{{$item->id}}/floor" class="item-title text-color ">{{$item->name}}</a></span>
                                </td>
                                <td class="flex">
                                    {{-- <a href="#" class="item-title text-color ">Feed Reader</a> --}}
                                    <div class="item-except text-muted text-sm h-1x">
                               {{ $item->description}}
                                        {{-- <a href='#'>#big data</a> --}}
                                    </div>
                                </td>
                                
                                <td class="flex">
                                    {{-- <a href="#" class="item-title text-color ">Feed Reader</a> --}}
                                    <div class="item-except text-muted text-sm h-1x">
                           
                                        {{$building->name}}
                            {{-- @foreach ($building as $buildings)
                                @if ($item->building_id==$buildings->id)
                                    {{$buildings->name}}
                                @endif
                            @endforeach       --}}
                            
                                        {{-- <a href='#'>#big data</a> --}}
                                    </div>
                                </td>
                                

                                <td>
                                    <div class="item-action dropdown">

                                    <a href="/block/{{$item->id}}/floor" class="btn gd-warning text-white btn-rounded">Add floor</a>

                                        <a href="#" data-toggle="dropdown" class="text-muted">
                                            <i data-feather="more-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
                                        <a class="dropdown-item" href="/block/{{$item->id}}/edit">
                                                Edit
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                show
                                            </a>
                                        <form action="/block/{{$item->id}}" method="post">
                                                @csrf
                                                @method('DELETE')
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
                                <strong>There is no block must add first</strong> 
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

    {{$block->links()}}
</div>

@endsection