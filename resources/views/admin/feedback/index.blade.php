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
        <h2><strong>Hỗ trợ</strong></h2>
    </div>
    <!-- END Responsive Full Title -->

    <!-- Responsive Full Content -->
    <p>
    @if(\Session::has('message'))
    {{\Session::get('message')}}
    @endif
    </p>
    <form name="search" action="{{ route('admin_feedback') }}" method="get" enctype="multipart/form-data" class="form-horizontal">
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Messenge</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($result as $key => $item)
                    <tr>
                        <td class="text-center">{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>
                            {{ str_limit(strip_tags($item->message), 50, '..') }}
                        </td>
                        <td>{{$item->status}}</td>
                        <td>{{ $item->created_at }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                @if(is_null($item->status))
                                <a href="{{route('feedback_edit', $item->id)}}?status=1" data-toggle="tooltip" title="Readed" class="btn btn-default text-success"><i class="fa fa-check"></i></a>
                                @endif
                                <a href="{{route('feedback_edit', $item->id)}}" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6" class="text-right">{!!$result->render()!!}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- END Responsive Full Content -->
</div>
<!-- END Responsive Full Block -->
@stop