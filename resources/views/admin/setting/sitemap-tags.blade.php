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
        <h2><strong>Tags for sitemap</strong></h2>
    </div>
    <!-- END Responsive Full Title -->

    <!-- Responsive Full Content -->
    <p>
    @if(\Session::has('message'))
    {{\Session::get('message')}}
    @endif
    </p>
    <form action="{{route('setting_sitemap_tags')}}" method="get" class="form-horizontal form-bordered" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-md-3 control-label">Search tag</label>
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
    <form action="{{route('update_sitemap_tags')}}" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label class="control-label col-md-3">Thêm tags</label>
            <div class="col-md-9">
                <textarea class="form-control" name="content" placeholder="thêm nhiều tags cách nhau bằng dấu phẩy.."></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="text-center">
                <button type="submit" class="btn btn-sm btn-primary"><i class="gi gi-up_arrow"></i> Submit</button>
                <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
            </div>
        </div>
    </form>
    <div class="clearfix"></div>
    {!! $result->render() !!}
    <div class="table-responsive">
        <table class="table table-vcenter table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">ID</th>
                    <th>Key</th>
                    <th>Status</th>
                    <th class="text-center">Công cụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($result as $key => $item)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td class="text-center">{{ $item->id }}</td>
                    <td>{{ $item->key }}</td>
                    <td>{{ $item->status }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{route('setting_sitemap_tags', ['delete' => $item->id])}}" data-toggle="tooltip" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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