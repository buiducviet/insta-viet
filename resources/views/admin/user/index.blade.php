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
        <h2><strong>Thành viên</strong></h2>
        <div class="block-options pull-right">
            <a href="{{route('user_create')}}" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>
    <!-- END Responsive Full Title -->

    <!-- Responsive Full Content -->
    <p>
    @if(\Session::has('message'))
    {{\Session::get('message')}}
    @endif
    </p>
    
    <div class="table-responsive">
        <table class="table table-vcenter table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th>User name</th>
                    <th>Email</th>
                    <th>Chức vụ</th>
                    <th class="text-center">Công cụ</th>
                </tr>
            </thead>
            <tbody>
                @if($result->count() > 0)
                @foreach($result as $key => $item)
                <tr>
                    <td class="text-center">{{$item->id}}</td>
                    <td><a href="{{route('user_edit', $item->id)}}"><img src="{{$item->avatar}}" style="max-width: 150px;" class="img-responsive" alt="">{{$item->name}}</a></td>
                    <td>{{$item->email}}</td>
                    <td><a href="javascript:void(0)" >{{$item->role}}</a></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-xs">
                            <a href="{{route('user_edit', $item->id)}}" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                            @if(Auth::user()->id != $item->id)
                            <a href="{{route('user_delete', $item->id)}}" data-toggle="tooltip" title="Delete" class="btn btn-danger"><i class="fa fa-times"></i></a>
                            @endif
                        </div>
                    </td>
                </tr>
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