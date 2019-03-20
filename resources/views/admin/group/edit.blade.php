@extends('admin.master')

@section('content')
<?php $content = 'general_form'; ?>
<ul class="breadcrumb breadcrumb-top">
    <li><a href="{{route('admin')}}">Dashboard</a></li>
</ul>
<!-- END Table Responsive Header -->
<div class="row">
    <div class="block">
        <!-- Horizontal Form Title -->
        <div class="block-title">
            <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default toggle-bordered enable-tooltip" data-toggle="button" title="Toggles .form-bordered class">No Borders</a>
            </div>
            <h2><strong>Sửa/thêm group</h2>
        </div>
        <!-- END Horizontal Form Title -->

        <!-- Horizontal Form Content -->
        <form action="{{route('group_update')}}" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(!is_null($result))
            <input type="hidden" name="id" value="{{ $result->id }}">
            @endif
            <div class="form-group">
                <label class="col-md-3 control-label">Tên</label>
                <div class="col-md-9">
                    <input type="text" name="name" class="form-control" value="{{ $result->name or null}}">
                    <span class="help-block">{{$errors->first('name')}}</span>
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
        <!-- END Horizontal Form Content -->
    </div>
</div>

@stop