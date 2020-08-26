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
                            <span class="d-none d-sm-inline mx-1"></span>
                            
                        </a>
                    </div>
                    <div class="flex"></div>
                    <div>
                        <a href="maintainance/create" class="btn btn-md text-muted">
                            <span class="d-none d-sm-inline mx-1">Add maintenance</span>
                            <i data-feather="arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            
{{-- 
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
        @endif --}}

            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div id="toolbar">
                    </div>
                    <table id="table" class="table table-theme v-middle" data-plugin="bootstrapTable" data-toolbar="#toolbar" data-search="true" data-search-align="left" data-show-export="true" data-show-columns="true" data-detail-view="false" data-mobile-responsive="true"
                    data-pagination="true" data-page-list="[10, 25, 50, 100, ALL]">
                        <thead>
                            <tr>
                                <th data-sortable="true" data-field="id">ID</th>
                                <th data-sortable="true" data-field="owner">block</th>
                                <th data-sortable="true" data-field="project">floor</th>
                                <th data-sortable="true" data-field="project">flat</th>
                                <th data-sortable="true" data-field="project">building</th>
                                <th data-sortable="true" data-field="project">amount</th>
                                <th data-sortable="true" data-field="project">description</th>
                                <th data-field="task"><span class="d-none d-sm-block">Action</span></th>
                              
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            
                           @if ($maintenance->count() > 0)
                               
                           
                               
                      
                            @foreach ($maintenance as $item)
                    
                            <tr class=" " data-id="13">
                                <td style="min-width:30px;text-align:center">
                                <span class="w-32 avatar gd-primary">{{$item->id}}</span>
                                </td>
                                <td>
                                <div class="item-except text-muted text-sm h-1x">
                                    @foreach ($block as $blocks)
                                        @if ($item->block_id==$blocks->id)
                                           {{ $blocks->name}}
                                        @endif
                                    @endforeach
                                </div>
                                </td>
                                <td>
                                <div class="item-except text-muted text-sm h-1x">
                                @foreach ($floor as $floors)
                                    @if ($item->floor_id==$floors->id)
                                        {{$floors->name}}
                                    @endif
                                @endforeach
                                 </div>
                                </td>
                                
                                <td>
                                    <div class="item-except text-muted text-sm h-1x">
                                   @foreach ($flat as $flats)
                                       @if ($item->flat_id==$flats->id)
                                           {{$flats->name}}
                                       @endif
                                   @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div class="item-except text-muted text-sm h-1x">
                                        @foreach ($building as $buildings)
                                            @if ($item->building_id==$buildings->id)
                                                {{$buildings->name}}
                                            @endif
                                        @endforeach
                                    </div>
                                </td>

                                <td>
                                    <div class="item-except text-muted text-sm h-1x">
                                        {{$item->amount}}
                                    </div>
                                </td>

                                <td>
                                    <div class="item-except text-muted text-sm h-1x">
                                        {{$item->description}}
                                    </div>
                                </td>
                                

                                <td>
                                    <div class="item-action dropdown">
                                        <a href="#" data-toggle="dropdown" class="text-muted">
                                            <i data-feather="more-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
                                        <a class="dropdown-item" href="/maintainance/{{$item->id}}/edit">
                                                Edit
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                show
                                            </a>
                                        <form action="/maintainance/{{$item->id}}" method="post">
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

    {{-- {{$block->links()}} --}}
</div>

@endsection