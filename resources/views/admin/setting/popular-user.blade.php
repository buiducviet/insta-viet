@extends('admin.master')

@section('content')
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-share_alt"></i>Social Widgets<br><small>Awesome &amp; colorful social widgets!</small>
            </h1>
        </div>
    </div>
    <div id="status"></div>
    <div class="btn-group">
        <button type="button" id="refreshOld" class="btn btn-info" data-toggle="tooltip" title="Refresh data"><i class="fa fa-refresh"></i>Old user</button>
        <button type="button" id="refreshNew" class="btn btn-success" data-toggle="tooltip" title="Refresh data"><i class="fa fa-refresh"></i>New user</button>
    </div>
    <div class="row">
        @foreach($result as $key => $item)
            <div class="col-lg-4">
                <!-- Simple Widget with Post Input - Variation 1 -->
                <div class="widget">
                    <div class="widget-simple">
                        <a href="#">
                            <img src="{{ \App\Helper::media($item->avatar) }}" alt="avatar" class="widget-image img-circle pull-right">
                        </a>
                        <h4 class="widget-content">
                            <a href="page_ready_user_profile.html">
                                <span id="user-index-{{$item->id}}">{{ ($result->currentPage() - 1)*$result->perPage() + $key+1 }}</span>. <strong>{{ $item->name }}</strong>
                            </a>
                            <small><span>@</span>{{ $item->username }}</small>
                        </h4>
                    </div>
                    <div class="widget-extra themed-background-dark">
                        <div class="row text-center">
                            <div class="col-xs-4">
                                <h3 class="widget-content-light">
                                    <a href="javascript:void(0)"><strong>{{ number_format($item->media) }}</strong></a><br>
                                    <small>Posts</small>
                                </h3>
                            </div>
                            <div class="col-xs-4">
                                <h3 class="widget-content-light">
                                    <a href="javascript:void(0)"><strong>{{ number_format($item->following) }}</strong></a><br>
                                    <small>Following</small>
                                </h3>
                            </div>
                            <div class="col-xs-4">
                                <h3 class="widget-content-light">
                                    <a href="javascript:void(0)"><strong>{{ number_format($item->follower/1000, 0) }}k</strong></a><br>
                                    <small>Followers</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="widget-extra-full">
                        <form action="{{ route('update_popular_user', $item->id) }}" method="post" data-for="#user-index-{{$item->id}}" class="form-horizontal {{ is_null($item->key)? 'new-user': 'old-user' }}" onsubmit="return false;">
                            <div class="form-group remove-margin-bottom">
                                <div class="col-xs-6">
                                    <div class="btn-group ajax-btn">
                                        <button type="button" class="btn btn-danger" data-text="delete" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                                        <button type="button" class="btn btn-success" data-text="refresh" data-toggle="tooltip" title="Refresh data"><i class="fa fa-refresh"></i></button>
                                    </div>
                                </div>
                                <div class="col-xs-6 text-right">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Simple Widget with Post Input - Variation 1 -->
            </div>
        @endforeach
        <div class="col-lg-4">
            <!-- Simple Widget with Post Input - Variation 1 -->
            <div class="widget">
                <div class="widget-extra-full">
                    <form action="{{ route('edit_popular_user', 0) }}" method="post" class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <div class="col-xs-12">
                                <textarea name="users" rows="4" class="form-control" placeholder="Thêm username, nhiều username cách nhau dấu phẩy"></textarea>
                            </div>
                        </div>
                        <div class="form-group remove-margin-bottom">
                            <div class="col-xs-6">
                            </div>
                            <div class="col-xs-6 text-right">
                                <button type="submit" class="btn btn-default"><i class="fa fa-location-arrow"></i> ADD</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Simple Widget with Post Input - Variation 1 -->
        </div>
    </div>
    {!! $result->render() !!}

    <script type="text/javascript">
        var index = 0;
        var _new = {{ $result->where('key', null)->count() }};
        var old = {{ $result->where('key', '<>', null)->count() }};
        $('body').on('click', '.ajax-btn button', function(){
            var e = $(this);
            ajax(e.parents('form').attr('action')+'?'+e.attr('data-text'), 1);
        });

        $('body').on('click', '#refreshOld', function(){
            var e = $(this);
            e.find('.fa-refresh').addClass('fa-spin');
            $('.old-user:eq( '+index+' )').find('.fa-refresh').addClass('fa-spin');
            ajax($('.old-user:eq( '+index+' )').attr('action')+'?refresh', 'old');
        });

        $('body').on('click', '#refreshNew', function(){
            var e = $(this);
            e.find('.fa-refresh').addClass('fa-spin');
            $('.new-user:eq( '+index+' )').find('.fa-refresh').addClass('fa-spin');
            ajax($('.new-user:eq( '+index+' )').attr('action')+'?refresh', 'new');
        });

        function ajax(url, type){
            $('#status').text($($('.'+type+'-user:eq( '+(index)+' )').attr('data-for')).text());
            $.get(url, function(data, status){
                index++;
                if (type == 1 || (type == 'new' && index > _new) || (type == 'old' && index > old)) {
                    window.location = window.location;
                }else{
                    ajax($('.'+type+'-user:eq( '+(index)+' )').attr('action')+'?refresh', type);
                    $('.'+type+'-user:eq( '+(index - 1)+' )').find('.fa-refresh').removeClass('fa-spin');
                    $('.'+type+'-user:eq( '+(index)+' )').find('.fa-refresh').addClass('fa-spin');
                }
            });
        }
    </script>
@stop