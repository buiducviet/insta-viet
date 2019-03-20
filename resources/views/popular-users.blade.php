@extends('layouts.app')

@section('content')
    <!-- Company Info -->
    <section class="site-content no-heading-media">
        @include('blocks.breadcrumb')
        <div class="container">
            <h2 class="site-heading">Popular photos</h2>
            <hr>
            <!-- Portfolio Items -->
            <!-- Add the category value for each item in its data-category attribute (for the filter functionality) -->
            <div class="row portfolio">
                @foreach($result as $key => $item)
                    <div class="col-sm-4 portfolio-item animation-fadeInQuick">
                        <div class="widget">
                            <div class="widget-simple">
                                <a href="{{ route('user', $item->username) }}">
                                    <img src="{{ \App\Helper::media($item->avatar) }}" alt="{{ $item->username }}" class="widget-image img-circle pull-right">
                                </a>
                                <h4 class="widget-content">
                                    <a href="{{ route('user', $item->username) }}" class="themed-color-amethyst">
                                        <strong>{{ $item->name }}</strong>
                                    </a>
                                    <small>@<span>{{ $item->username }}</span></small>
                                </h4>
                            </div>
                            <div class="widget-extra">
                                <div class="row text-center themed-background-dark-amethyst">
                                    <div class="col-xs-4">
                                        <h3 class="widget-content-light h4">
                                            <strong>{{ \App\Helper::numberToString($item->media) }}</strong><br>
                                            <small>Photos</small>
                                        </h3>
                                    </div>
                                    <div class="col-xs-4">
                                        <h3 class="widget-content-light h4">
                                            <strong>{{ \App\Helper::numberToString($item->follower) }}</strong><br>
                                            <small>Followers</small>
                                        </h3>
                                    </div>
                                    <div class="col-xs-4">
                                        <h3 class="widget-content-light h4">
                                            <strong>{{ \App\Helper::numberToString($item->following) }}</strong><br>
                                            <small>Following</small>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- END Portfolio Items -->
        </div>
    </section>
@endsection