@extends('layouts.admin')
@section('content')


<div class="container">
     <!-- ############ Content START-->
     <div id="content" class="flex ">
        <!-- ############ Main START-->
        <a href="/block/create">Add Block</a>
        <div>
            <div class="page-hero page-container " id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight">All Blocks</h2>
                       
                    </div>
                    {{-- <div class="flex"></div> --}}
                    {{-- <div>
                        <a href="https://themeforest.net/item/basik-responsive-bootstrap-web-admin-template/23365964" class="btn btn-md text-muted">
                            <span class="d-none d-sm-inline mx-1">Buy this Item</span>
                            <i data-feather="arrow-right"></i>
                        </a>
                    </div> --}}
                </div>
            </div>
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
                                <th data-field="task"><span class="d-none d-sm-block">Action</span></th>
                              
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            
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
                                
                                <td>
                                    <div class="item-action dropdown">
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