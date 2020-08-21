@extends('layouts.admin')
@section('content')


<div class="container">
     <!-- ############ Content START-->
     <div id="content" class="flex ">
        <!-- ############ Main START-->
     {{-- <a href="/expensehead/{{$expensehead_id}}/expense/create">Add Expense</a> --}}
        <div>
            <div class="page-hero page-container " id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <a href="/expensehead" class="btn btn-md text-muted">
                            <span class="d-none d-sm-inline mx-1">@foreach ($expensehead as $item)
                                @if ($item->id==$expensehead_id)
                                    {{$item->name}}
                                @endif
                            @endforeach</span>
                            <i data-feather="arrow-right"></i>
                        </a>
                    </div>
                    <div class="flex"></div>
                    <div>
                    <a href="/expensehead/{{$expensehead_id}}/expense/create" class="btn btn-md text-muted">
                            <span class="d-none d-sm-inline mx-1">Add Expense</span>
                            <i data-feather="arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            @if (\Session::has('addexpense'))
                
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Alert</strong>{{!! \Session::get('addexpense') !!}}
            </div>

            @endif

            @if (\Session::has('updateexpense'))
                
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Alert</strong>{{!! \Session::get('updateexpense') !!}}
            </div>

            @endif

            @if (\Session::has('deleteexpense'))
                
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Alert</strong>{{!! \Session::get('deleteexpense') !!}}
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
                                <th data-sortable="true" data-field="project">Amount</th>
                                <th data-sortable="true" data-field="project">Description</th>
                                <th data-sortable="true" data-field="project">Expense Head</th>
                                <th data-sortable="true" data-field="project">Building</th>
                                <th data-field="task"><span class="d-none d-sm-block">Action</span></th>
                              
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @if ($expense->count() > 0)

                            @foreach ($expense as $item)
                    
                            <tr class=" " data-id="13">
                                <td style="min-width:30px;text-align:center">
                                <span class="w-32 avatar gd-primary">{{$item->id}}</span>
                                </td>
                                <td>
                                <span class="item-amount d-none d-sm-block text-sm ">{{$item->name}}</span>
                                </td>
                                <td>
                                <span class="item-amount d-none d-sm-block text-sm ">{{$item->amount}}</span>
                                </td>
                                <td class="flex">
                                    {{-- <a href="#" class="item-title text-color ">Feed Reader</a> --}}
                                    <div class="item-except text-muted text-sm h-1x">
                               {{ $item->description}}
                                        {{-- <a href='#'>#big data</a> --}}
                                    </div>
                                </td>
                                <td>
                                    <span class="item-amount d-none d-sm-block text-sm ">
                                        @foreach ($expensehead as $expenseheads)
                                            @if ($expenseheads->id==$item->expense_head_id)
                                    {{$expenseheads->name}}
                                            @endif
                                        @endforeach
                                    </span>
                                    </td>
                                    <td>
                                        <span class="item-amount d-none d-sm-block text-sm ">
                                            @foreach ($building as $buildings)
                                                @if ($buildings->id==$item->building_id)
                                        {{$buildings->name}}
                                                @endif
                                            @endforeach
                                        </span>
                                        </td>
                                
                                <td>
                                    <div class="item-action dropdown">
                                        <a href="#" data-toggle="dropdown" class="text-muted">
                                            <i data-feather="more-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
                                        <a class="dropdown-item" href="/expensehead/{{$expensehead_id}}/expense/{{$item->id}}/edit">
                                                Edit
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                show
                                            </a>
                                        <form action="/expensehead/{{$expensehead}}/expense/{{$item->id}}" method="post">
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
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <strong>Alert</strong> There is no expense
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