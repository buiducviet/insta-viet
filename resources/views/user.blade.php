@extends('layouts.app')

@section('content')
    <!-- Company Info -->
    <section class="site-content no-heading-media">
        @include('blocks.breadcrumb')
        <div class="container">
            <div class="row">
                <div class="col-sm-offset-2">
                    <div class="col-sm-3 animation-fadeInQuick text-center">
                        <img src="{{ $account->getProfilePicUrlHd() }}" alt="avatar" class="img-circle img-responsive">
                    </div>
                    <div class="col-sm-9">
                        <h1 class="h3">{{ $account->getFullName() }} profile</h1>
                        <h2 class="h4"><span>@</span>{{ $account->getUsername() }}</h2>
                        <h3 class="h5">{!! \App\Helper::content_decode($account->getBiography()) !!}</h3>
                        <h4 class="h5"><i class="fa fa-globe"></i> {{ $account->getExternalUrl() }}</h4>
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default"><strong>{{ \App\Helper::numberToString($account->getMediaCount()) }}</strong> posts</button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default"><strong>{{ \App\Helper::numberToString($account->getFollowedByCount()) }}</strong> followers</button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default"><strong>{{ \App\Helper::numberToString($account->getFollowsCount()) }}</strong> following</button>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </section>
    <section class="site-content">
        <div class="container">
            <div class="owl-carousel">
                @foreach($similar->take(30) as $key => $item)
                    <div class="text-center">
                        <a href="{{ route('user', $item->getUsername()) }}">
                            <div class="profile-image">
                                <img src="{{ $item->getProfilePicUrl() }}" alt="{{ $item->getUsername() }}" class="img-circle">
                            </div>
                            <div class="h6">
                                {{ $item->getUsername() }}<br>
                                <small>{{ $item->getFullName() }}</small>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <hr>
        </div>
    </section>
    <section class="site-content">
        <div class="container">
            <h2 class="h3">
                <a href="{{ route('user', $account->getUsername()) }}">{!! $account->getFullName() !!} <span>@</span>{{ $account->getUsername() }} 's stories:</a>
            </h2>
            <div class="row portfolio">
                @foreach($medias as $key => $item)
                    @include('blocks.post-item')
                @endforeach
            </div>
            @if($hasNextPage)
                <more :info="{{ json_encode(['url' => route('ajax', ['userId' => $account->getId(), 'data' => 'account_media_pagination']) , 'maxId' => $maxId]) }}"/>
            @endif
        </div>
    </section>
@endsection