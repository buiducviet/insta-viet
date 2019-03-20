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
        <h2><strong>Tài khoản Instagram</strong></h2>
        <div class="block-options pull-right">
            <a href="{{route('edit_account', 0)}}" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>
    <!-- END Responsive Full Title -->

    <!-- Responsive Full Content -->
    <p>
    @if(\Session::has('message'))
    {{\Session::get('message')}}
    @endif
    </p>
    <form action="{{route('setting_account')}}" method="get" class="form-horizontal form-bordered" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-md-3 control-label">Search username</label>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" value="{{ $_GET['q'] or null }}">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </span>
                </div>
            </div>
        </div>
    </form>
    <div class="clearfix"></div>
    <div class="table-responsive">
        <table class="table table-vcenter table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">ID</th>
                    <th>Username</th>
                    <th>Client</th>
                    <th>Status</th>
                    <th>Updated</th>
                    <th class="text-center">Công cụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($result as $key => $item)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td class="text-center">{{ $item->id }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->client->host }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{route('edit_account', $item->id)}}" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                            <a href="{{route('edit_account', $item->id)}}?delete=1" data-toggle="tooltip" title="Delete" class="btn btn-danger"><i class="fa fa-times"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {!! $result->render() !!}
    <!-- END Responsive Full Content -->
</div>
<!-- END Responsive Full Block -->
@stop