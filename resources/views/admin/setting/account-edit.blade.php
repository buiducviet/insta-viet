@extends('admin.master')

@section('content')
<?php $content = 'general_form'; ?>
<!-- END Table Responsive Header -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <!-- Horizontal Form Block -->
        <div class="block">
            <!-- Horizontal Form Title -->
            <div class="block-title">
                <div class="block-options pull-right">
                    <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default toggle-bordered enable-tooltip" data-toggle="button" title="Toggles .form-bordered class">No Borders</a>
                </div>
                <h2><strong>{{ is_null($result)? 'Thêm': 'Sửa' }} acount</h2>
            </div>
            <!-- END Horizontal Form Title -->

            <!-- Horizontal Form Content -->
            <form action="{{route('update_account', is_null($result)? 0: $result->id)}}" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="col-md-3 control-label">Username</label>
                    <div class="col-md-9">
                        <input type="text" name="username" class="form-control" value="{{ is_null($result)? null: $result->username }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Password</label>
                    <div class="col-md-9">
                        <input type="text" name="password" class="form-control" value="{{ is_null($result)? null: $result->password }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Client ID</label>
                    <div class="col-md-9">
                        <input type="text" name="data[client_id]" class="form-control" value="{{ is_null($result)? null: $result->data['client_id'] }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Client Secret</label>
                    <div class="col-md-9">
                        <input type="text" name="data[client_secret]" class="form-control" value="{{ is_null($result)? null: $result->data['client_secret'] }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Access Token</label>
                    <div class="col-md-9">
                        <input type="text" name="data[access_token]" class="form-control" value="{{ is_null($result)? null: $result->data['access_token'] }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="example-select">Status</label>
                    <div class="col-md-9">
                        <select id="example-select" name="status" class="form-control" size="1">
                            <option value="1">Active</option>
                            <option value="0">Off</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Chọn frontend</label>
                    <div class="col-md-9">
                        <select name="client_id" class="select-chosen" data-placeholder="Chọn..">
                            @foreach($clients as $key => $item)
                                <option value="{{ $item->id }}" {{ !is_null($result) && $result->client_id == $item->id? 'selected': '' }}>{{ $item->host }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="gi gi-up_arrow"></i> Submit</button>
                        <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                    </div>
                </div>
            </form>
            <!-- END Horizontal Form Content -->
        </div>
        <!-- END Horizontal Form Block -->
    </div>
</div>

@stop