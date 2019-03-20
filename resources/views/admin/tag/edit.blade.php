@extends('admin.master')

@section('content')
<?php $content = 'general_form'; ?>
<!-- END Table Responsive Header -->
<div class="row">
    <!-- Table Styles Block -->
    <div class="block">
        <!-- Table Styles Title -->
        <div class="block-title">
            <h2>Thêm/sửa Tag</h2>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-warning">{!! session('message') !!}</div>
        @endif
        <div class="table-options clearfix"></div>
        <form action="{{route('tag_update')}}" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(!is_null($result))
            <input type="hidden" name="id" value="{{ $result->id }}">
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="block">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="example-chosen-multiple">Chọn nhóm</label>
                            <div class="col-md-9">
                                <select id="example-chosen-multiple" name="group_ids[]" class="select-chosen" data-placeholder="Chọn.." multiple>
                                    <?php $ids = is_null($result)? []: $result->groups->pluck('id')->toArray(); ?>
                                    @foreach($groups as $key => $item)
                                        <option value="{{ $item->id }}" {{ in_array($item->id, $ids)? 'selected': '' }}>{{ $item->name }}</option>
                                    @endforeach
                                    @if($groups->count() == 0)
                                        <option disabled>Chưa có group! Hãy thêm group</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="example-text-input">Tên</label>
                            <input class="form-control" name="name" value="{{ $result->name or null }}">
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="example-text-input">Slug (Không để trống)</label>
                            <input class="form-control" name="slug" value="{{ $result->slug or null }}">
                            <span class="help-block">{{$errors->first('slug')}}</span>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Menu cấp trên</label>
                            <div class="col-md-9">
                                <select name="parent_id" class="form-control" size="1">
                                    <option value="">Không chọn</option>
                                    @foreach($parents as $key => $item)
                                    <option {{!is_null($result) && $result->parent_id == $item->id? 'selected': null}} value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Icon (Font Awesome)</label>
                            <div class="col-md-9">
                                <input class="form-control" name="icon" value="{{ $result->icon or null }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Trạng thái</label>
                            <div class="col-md-9">
                                <select name="status" class="form-control" size="1">
                                    <option value="">Không chọn</option>
                                    <option {{!is_null($result) && $result->status == 1? 'selected': null}} value="1">Nổi bật</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="example-text-input">Từ khóa</label>
                            <input class="form-control" name="keyword" value="{{ $result->keyword or null }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="example-text-input">Seo Title</label>
                            <input class="form-control" name="seo[title]" value="{{ $result->seo['title'] or null }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="example-text-input">Seo Desc</label>
                            <input class="form-control" name="seo[description]" value="{{ $result->seo['description'] or null }}">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="text-center">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="gi gi-up_arrow"></i> Submit</button>
                    <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop