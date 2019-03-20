@extends('layouts.app')

@section('content')
    <!-- Company Info -->
    <section class="site-content no-heading-media">
        @include('blocks.breadcrumb')
        <div class="container">
            <div class="row portfolio">
                <div class="col-sm-8">
                    <div class="widget">
                        <div class="widget-simple">
                            <a href="{{ route('user', $account->getUsername()) }}">
                                <img src="{{ $account->getProfilePicUrl() }}" alt="avatar" class="widget-image img-circle pull-left">
                            </a>
                            <h4 class="widget-content">
                                <a href="{{ route('user', $account->getUsername()) }}">
                                    <strong>{{ $account->getFullName() }}</strong>
                                </a>
                                <small class="pull-right">{{ \App\Helper::time($media->getCreatedTime()) }}</small>
                                <small>
                                    @<span>{{ $account->getUsername() }}</span>
                                </small>
                            </h4>
                        </div>
                    </div>
                    <div class="row animation-fadeIn">
                        <div class="col-xs-6">
                            <i class="fa fa-heart-o text-danger"></i> <span>{{ number_format($media->getLikesCount()) }}</span>
                        </div>
                        <div class="col-xs-6 text-right">
                            <i class="fa fa-comment-o text-success"></i> <span>{{ number_format($media->getCommentsCount()) }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="thumb-wrap text-center">
                        <a>
                            @if($media->getType() == 'video')
                                <video poster="{{ $media->getImageStandardResolutionUrl() }}" controls>
                                    <source src="{{ $media->getVideoStandardResolutionUrl() }}" type="video/mp4">
                                </video>
                                <div>
                                    <a class="btn btn-primary" target="_blank" href="{{ $media->getimageStandardResolutionUrl() }}" download="{{ $account->getUsername() }}-video.mp4"><i class="fa fa-cloud-download"></i> Download video</a>
                                </div>
                            @elseif(!empty($media->getSidecarMedias()))
                                <div id="postCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        @foreach($media->getSidecarMedias() as $key => $item)
                                            <li data-target="#postCarousel" data-slide-to="{{ $key }}" class="{{$key == 0? 'active': ''}}"></li>
                                        @endforeach
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        @foreach($media->getSidecarMedias() as $key => $item)
                                            <div class="item {{$key == 0? 'active': ''}}">
                                                <img src="{{ $item->getImageStandardResolutionUrl() }}" alt="{!! $account->getFullName() !!} media {{ $key+1 }}">
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#postCarousel" data-slide="prev">
                                        <span class="fa fa-chevron-left"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#postCarousel" data-slide="next">
                                        <span class="fa fa-chevron-right"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <div>
                                    <div class="btn-group">
                                        <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Download Images <span class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-custom text-left">
                                            @foreach($media->getsidecarMedias() as $key => $item)
                                            <li>
                                                <a target="_blank" download="{{ $account->getUsername() }}-image-{{ $key+1 }}.jpg" href="{{ $item->getimageStandardResolutionUrl() }}"><i class="fa fa-cloud-download"></i> Image {{ $key+1 }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <img src="{{ $media->getImageStandardResolutionUrl() }}" alt="{{ $account->getFullName() }} post" class="img-responsive">
                                <div>
                                    <a class="btn btn-primary" target="_blank" download="{{ $account->getUsername() }}-image.jpg" href="{{ $media->getImageStandardResolutionUrl() }}"><i class="fa fa-cloud-download"></i> Download Image</a>
                                </div>
                            @endif
                        </a>
                    </div>
                    <h1 class="h5">
                        @if(strlen(trim($media->getCaption())))
                            {!! \App\Helper::content_decode($media->getCaption()) !!}
                        @else
                            {!! "{$account->getFullName()} @{$account->getUsername()} media." !!}
                        @endif
                    </h1>
                    <hr>
                    @if(isset($medias))
                    <h2 class="h3">
                        <a href="{{ route('user', $account->getUsername()) }}">{!! $account->getFullName() !!} 's other medias:</a>
                    </h2>
                    <div class="row portfolio">
                        @foreach($medias as $key => $item)
                            @include('blocks.post-item')
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="col-sm-4 comments-block">
                    <h2 class="site-heading">Comments list</h2>
                    <p>
                        @foreach($media->getComments() as $key => $comment)
                            <div class="widget">
                                <div class="widget-simple">
                                    <a href="{{ route('user', $comment->getOwner()->getUsername()) }}">
                                        <img src="{{ $comment->getOwner()->getProfilePicUrl() }}" alt="avatar" class="widget-image img-circle pull-left">
                                    </a>
                                    <div>
                                        <a href="{{ route('user', $comment->getOwner()->getUsername()) }}">
                                            <strong>{{ $comment->getOwner()->getFullName() }}</strong>
                                            @<span>{{ $comment->getOwner()->getUsername() }}</span>
                                        </a>
                                        <br>
                                        <small><i>{{ \App\Helper::time($comment->getCreatedAt()) }}</i></small>
                                        <br>
                                        <div>
                                            <small>
                                                {!! \App\Helper::content_decode($comment->getText()) !!}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
