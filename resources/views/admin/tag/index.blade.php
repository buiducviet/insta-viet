@extends('admin.master')

@section('content')
<ul class="breadcrumb breadcrumb-top">
    <li><a href="{{route('admin')}}">Dashboard</a></li>
</ul>
<!-- END Table Responsive Header -->

<!-- Responsive Full Block -->
<div class="block">
    <!-- Responsive Full Title -->
    <div class="block-title">
        <h2><strong>Tag</strong></h2>
        <div class="block-options pull-right">
            <a href="{{route('tag_edit', 0)}}" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>
    <!-- END Responsive Full Title -->

    <!-- Responsive Full Content -->
    <p>
    @if(\Session::has('message'))
    {{\Session::get('message')}}
    @endif
    </p>
    <form name="search" action="{{ route('admin_tags') }}" method="get" enctype="multipart/form-data" class="form-horizontal">
        <div id="example-datatable_filter" class="dataTables_filter">
            <div class="input-group">
                <input type="search" name="q" value="<?php echo isset($_GET['q'])? $_GET['q']:''; ?>" class="form-control" placeholder="Search" aria-controls="example-datatable">
                <span class="input-group-addon btn" id="searchSubmit"><i class="fa fa-search"></i></span>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-vcenter table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th>Tên</th>
                    <th>Từ khóa</th>
                    <th>Nhóm</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Công cụ</th>
                </tr>
            </thead>
            <tbody>
                @if($result->count() > 0)
                @foreach($result as $key => $item)
                    <tr style="font-weight: bold;">
                        <td class="text-center">{{$item->id}}</td>
                        <td>
                            @if(str_contains($item->icon, 'fa-'))
                                <i class="fa {{ $item->icon }}"></i>
                            @endif
                            {{$item->name}}
                        </td>
                        <td>{{$item->keyword}}</td>
                        <td>
                            @foreach($item->groups as $group)
                                <label class="label label-success">{{ $group->name }}</label>
                            @endforeach
                        </td>
                        <td>
                            {{$item->status == 1? 'Nổi bật': ''}}
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{route('tag_edit', $item->id)}}" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                <a href="{{route('tag_edit', $item->id)}}?delete" data-toggle="tooltip" title="Delete" class="btn btn-danger"><i class="fa fa-times"></i></a>
                            </div>
                        </td>
                    </tr>
                    @foreach($item->childs as $value)
                        <tr>
                            <td class="text-center">{{$value->id}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->keyword}}</td>
                            <td>
                                @foreach($value->groups as $group)
                                    <label class="label label-success">{{ $group->name }}</label>
                                @endforeach
                            </td>
                            <td>{{$value->status}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route('tag_edit', $value->id)}}" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('tag_edit', $value->id)}}?delete" data-toggle="tooltip" title="Delete" class="btn btn-danger"><i class="fa fa-times"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                <tr>
                    <td colspan="6" class="text-right">{!!$result->render()!!}</td>
                </tr>
                @else
                <tr>
                    <td colspan="6"><h3>Empty data</h3></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <!-- END Responsive Full Content -->
</div>
<!-- END Responsive Full Block -->
@stop