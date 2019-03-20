@extends('admin.master')

@section('content')
<?php $content = 'general_form'; ?>
<!-- END Table Responsive Header -->
<div class="row">
    <!-- Table Styles Block -->
    <div class="block">
        <!-- Table Styles Title -->
        <div class="block-title">
            <h2>Thêm/sửa Tin</h2>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-warning">{!! session('message') !!}</div>
        @endif
        <div class="table-options clearfix"></div>
        <form action="{{route('article_update', $id)}}" method="post" class="form-horizontal form-bordered {{ is_null($result)? '': 'form-data-ready' }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="block">
                        <div class="form-group">
                            <label class="control-label" for="example-text-input">Tiêu đề</label>
                            <input class="form-control" id="title" name="title" value="{{ $result->title or null }}">
                            <span class="help-block">{{$errors->first('title')}}</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="example-text-input">Slug (Không để trống)</label>
                            <input class="form-control" name="slug" value="{{ $result->slug or null }}">
                            <span class="help-block">{{$errors->first('slug')}}</span>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Thumb</label>
                            <div class="col-md-9">
                                <input type="file" name="thumb_file">
                                <img style="max-width: 150px" src="{{ is_null($result)? '': \App\Helper::media($result->thumb) }}" alt="Chưa có ảnh">
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
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="example-text-input">Seo Title</label>
                            <input class="form-control" name="seo[title]" value="{{ $result->seo['title'] or null }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="example-text-input">Seo Desc</label>
                            <input class="form-control" name="seo[description]" value="{{ $result->seo['description'] or null }}">
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Chọn tags</label>
                            <div class="col-md-9">
                                <select name="tag_ids[]" class="select-chosen" data-placeholder="Chọn.." multiple>
                                    <?php $ids = is_null($result)? []: $result->tags->pluck('id')->toArray(); ?>
                                    @foreach($tags as $key => $item)
                                        <option value="{{ $item->id }}" {{ in_array($item->id, $ids)? 'selected': '' }} style="font-weight: bold;">{{ $item->name }}</option>
                                        @foreach($item->childs as $value)
                                            <option {{ in_array($item->id, $ids)? 'disabled': '' }} value="{{ $value->id }}" {{ in_array($value->id, $ids)? 'selected': '' }} style="font-weight: 300; margin-left: 20px;">{{ $value->name }}</option>
                                        @endforeach
                                    @endforeach
                                    @if($tags->count() == 0)
                                        <option disabled>Chưa có tag! Hãy thêm tag</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group ajax-upload">
                <input type="hidden" id="upload_url" value="{{ route('article_upload') }}">
                <label class="col-md-3 control-label">Công cụ upload ảnh</label>
                <div class="col-md-9">
                    <div class="checkbox">
                        <label><input id="name-file" type="checkbox" value="1">Dùng tên file</label>
                    </div>
                    <input type="file" name="file" multiple>
                    <div id="list-image"></div>
                    <div class="clearfix"></div>
                    <div id="upload-error"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Nội dung</label>
                    <textarea name="content" rows="10" class="ckeditor">{!! $result->content or null !!}</textarea>
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