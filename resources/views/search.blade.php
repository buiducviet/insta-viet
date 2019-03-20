@extends('layouts.app')

@section('content')
    <!-- Media Container -->
    @include('blocks.search')
    <!-- END Media Container -->
    <!-- Company Info -->
    <section class="site-content">
        @include('blocks.breadcrumb')
        <div class="container">
            <div class="row portfolio">
                <div class="col-md-8 animation-fadeInQuick">
                    <h2 class="site-heading">Users list</h2>
                    <div class="rows user-list">
                        @foreach($result->users as $key => $item)
                            <div class="col-sm-4 col-xs-6 mb-1">
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a href="{{ route('user', $item->user->username) }}">
                                            <img src="{{ $item->user->profile_pic_url }}" alt="{{ $item->user->username }}" class="widget-image img-circle pull-left">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <a href="{{ route('user', $item->user->username) }}">
                                            <strong class="one-line">{{ $item->user->full_name }}</strong>
                                            <div class="one-line">@<span>{{ $item->user->username }}</span></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-4 comments-block">
                    <h2 class="site-heading">Tags list</h2>
                    <p>
                        <div class="rows user-list">
                            @foreach($result->hashtags as $key => $item)
                                <div class="col-md-12 col-sm-4 col-xs-6 mb-1">
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <i class="fa fa-tag fa-2x text-muted"></i>
                                        </div>
                                        <div class="media-body">
                                            <a href="{{ route('tag', str_slug($item->hashtag->name, '')) }}">
                                                <strong class="one-line">#{{ $item->hashtag->name }}</strong>
                                                <div class="one-line">{{ \App\Helper::numberToString($item->hashtag->media_count) }} posts</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
