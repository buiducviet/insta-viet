@extends('admin.master')

@section('content')
<?php $content = 'general_form'; ?>
<ul class="breadcrumb breadcrumb-top">
    <li><a href="{{route('admin')}}">Dashboard</a></li>
</ul>
<!-- END Table Responsive Header -->
<div class="block">
    <!-- Horizontal Form Title -->
    <div class="block-title">
        <div class="block-options pull-right">
            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default toggle-bordered enable-tooltip" data-toggle="button" title="Toggles .form-bordered class">No Borders</a>
        </div>
        <h2><strong>Sửa/thêm frontent</h2>
    </div>
    <!-- END Horizontal Form Title -->

    <!-- Horizontal Form Content -->
    <form action="{{route('client_update')}}" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if(!is_null($result))
        <input type="hidden" name="id" value="{{ $result->id }}">
        @endif
        <div class="form-group">
            <label class="col-md-3 control-label">Host</label>
            <div class="col-md-9">
                <input type="text" name="host" class="form-control" value="{{ $result->host or null}}">
                <span class="help-block">{{$errors->first('host')}}</span>
            </div>
        </div>
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
            <label class="col-md-3 control-label">Popular tags</label>
            <div class="col-md-9">
                <input type="text" name="setting[popular_tags]" class="input-tags" value="{{ $result->setting['popular_tags'] or null }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Popular Locations</label>
            <div class="col-md-9">
                <input type="text" name="setting[popular_locations]" class="input-tags" value="{{ $result->setting['popular_locations'] or null }}">
            </div>
        </div>
        <div class="alert alert-info">
            <h4>Blocks Tags</h4>
        </div>
        @if(isset($result->setting['blocks']))
            @foreach($result->setting['blocks'] as $key => $block)
            <div class="tag-block">
                <div class="form-group">
                    <label class="col-md-3 control-label">Tên block</label>
                    <div class="col-md-9">
                        <input type="text" name="setting[blocks][{{ $key }}][name]" class="form-control" value="{{ $block['name'] }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Hashtags</label>
                    <div class="col-md-9">
                        <input type="text" name="setting[blocks][{{ $key }}][tags]" class="input-tags" value="{{ $block['tags'] }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Xóa</label>
                    <div class="col-md-9">
                        <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <hr>
            </div>
            @endforeach
        @endif
        <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-9">
                <a href="javascript:void(0)" id="addBlock" class="btn btn-alt btn-default enable-tooltip" title="Thêm mới block"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <?php $key = isset($result->setting['blocks'])? count($result->setting['blocks']): 0; ?>
        <div class="tag-block hidden" id="newBlock">
            <div class="form-group">
                <label class="col-md-3 control-label">Tên block nới</label>
                <div class="col-md-9">
                    <input type="text" name="setting[blocks][{{ $key }}][name]" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Hashtags</label>
                <div class="col-md-9">
                    <input type="text" name="setting[blocks][{{ $key }}][tags]" class="form-control input-tags" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Xóa</label>
                <div class="col-md-9">
                    <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
        <div class="alert alert-info">
            <h4>Cài đặt chung</h4>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="block">
                    <div class="form-group">
                        <label class="control-label" for="example-text-input">Seo Title</label>
                        <input class="form-control" name="setting[title]" value="{{$result->setting['title'] or ''}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="example-text-input">Seo Keywords</label>
                        <input class="form-control" name="setting[keywords]" value="{{$result->setting['keywords'] or ''}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="example-text-input">Seo Description</label>
                        <input class="form-control" name="setting[description]" value="{{$result->setting['description'] or ''}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="example-text-input">facebook app_id</label>
                        <input class="form-control" name="setting[fb_app_id]" value="{{$result->setting['fb_app_id'] or ''}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="example-text-input">facebook admin</label>
                        <input class="form-control" name="setting[fb_admin]" value="{{$result->setting['fb_admin'] or ''}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="example-text-input">Google Analytic ID</label>
                        <input class="form-control" name="setting[google_analytic]" value="{{$result->setting['google_analytic'] or ''}}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block" style="background-color: #eee;">
                    <div class="form-group">
                        <label class="control-label">Cusstom CSS</label>
                        <div class="">
                            <input type="file" accept=".css" class="form-control" name="css">
                        </div>
                        <code>
                            {{ !is_null($result) && isset($result->setting['css'])? \App\Helper::media($result->setting['css']): null }}
                        </code>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="example-text-input">Thẻ image (hiển thị khi chia sẻ trang)</label>
                        <div class="">
                            <input type="file" accept="image/*" class="form-control" name="image_src">
                            <img src="{{ \App\Helper::media(!is_null($result) && isset($result->setting['image_src'])? $result->setting['image_src']: null) }}" alt="Chưa có ảnh" style="max-width: 150px;" class="img-responsive">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="example-text-input">Logo</label>
                        <div class="">
                            <input type="file" accept="image/*" class="form-control" name="logo">
                            <img src="{{ \App\Helper::media(!is_null($result) && isset($result->setting['logo'])? $result->setting['logo']: null) }}" alt="Chưa có ảnh" style="max-width: 150px;" class="img-responsive">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="example-text-input">Banner</label>
                        <div class="">
                            <input type="file" accept="image/*" class="form-control" name="banner">
                            <img src="{{ \App\Helper::media(!is_null($result) && isset($result->setting['banner'])? $result->setting['banner']: null) }}" alt="Chưa có ảnh" class="img-responsive">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="example-text-input">shortcut icon</label>
                        <img width="50" class="img-responsive" src="{{ \App\Helper::media(!is_null($result) && isset($result->setting['icon'])? $result->setting['icon']: null) }}">
                        <input type="file" accept=".ico" class="form-control" name="icon">
                        <span class="help-block">File định dạng (.ico)</span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="example-text-input">Footer</label>
                        <textarea class="form-control" name="setting[footer]">{{ $result->setting['footer'] or null }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <h4>Menus</h4>
        @foreach(config('config.menu_setting') as $key => $item)
            <div class="col-md-6">
                <div class="block">
                    <div class="form-group">
                        <label class="control-label">{{ $key }}</label>
                        <input class="form-control" name="setting[menu][{{ $key }}][name]" placeholder="Tên menu" value="{{$result->setting['menu'][$key]['name'] or ''}}">
                        <input class="form-control" name="setting[menu][{{ $key }}][title]" placeholder="Seo title" value="{{$result->setting['menu'][$key]['title'] or ''}}">
                        <textarea class="form-control" name="setting[menu][{{ $key }}][description]" placeholder="Seo description">{!! $result->setting['menu'][$key]['description'] or '' !!}</textarea>
                    </div>
                </div>
            </div>
        @endforeach
        <h4>Seos</h4>
        @foreach(config('config.seo') as $key => $item)
            <div class="col-md-6">
                <div class="block">
                    <div class="form-group">
                        <label class="control-label">{{ $key }}</label>
                        <input class="form-control" name="setting[seo][{{ $key }}][title]" placeholder="Seo title" value="{{$result->setting['seo'][$key]['title'] or ''}}">
                        <textarea class="form-control" name="setting[seo][{{ $key }}][description]" placeholder="Seo description">{!! $result->setting['seo'][$key]['description'] or '' !!}</textarea>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="clearfix"></div>
        <?php $ban_quyen = $articles->where('slug', 'term')->first(); ?>
        <div class="form-group">
            <label class="col-md-3 control-label">Điều khoản</label>
            <div class="col-md-9">
                <textarea name="article[term]" class="ckeditor">{!! !is_null($ban_quyen) && isset($ban_quyen->content['content'])? $ban_quyen->content['content']: null !!}</textarea>
            </div>
        </div>
        <?php $lien_he = $articles->where('slug', 'contact')->first(); ?>
        <div class="form-group">
            <label class="col-md-3 control-label">Liên hệ</label>
            <div class="col-md-9">
                <textarea name="article[contact]" class="ckeditor">{!! !is_null($lien_he) && isset($lien_he->content['content'])? $lien_he->content['content']: null !!}</textarea>
            </div>
        </div>
        <div class="block">
            <div class="block-title">
                <h2><strong>Quảng cáo</h2>
            </div>
            @foreach(config('config.ads') as $key => $item)
            <div class="form-group">
                <label class="control-label">{{ $item }}</label>
                <textarea class="form-control" name="ads[{{ $key }}]" rows="6">{{ $ads[$key] or null }}</textarea>
            </div>
            @endforeach
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
<script type="text/javascript">
    $('body').on('click', '#addBlock', function(){
        $(this).remove();
        $('#newBlock').removeClass('hidden');
    });

    $('body').on('click', '.tag-block .btn-danger', function(){
        $(this).parents('.tag-block').remove();
    });
</script>
@stop