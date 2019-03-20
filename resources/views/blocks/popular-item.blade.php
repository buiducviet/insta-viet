<?php $item = is_null($item->getMedia())? $item: $item->getMedia(); ?>
<div class="col-sm-4 portfolio-item">
    <div class="widget">
        <div class="widget-simple">
            <a href="{{ route('user', $item->getUser()->getUsername()) }}">
                <img src="{{ $item->getUser()->getProfile_pic_url() }}" alt="{{ $item->getUser()->getUsername() }}" class="widget-image img-circle pull-left">
            </a>
            <h4 class="widget-content">
                <a href="{{ route('user', $item->getUser()->getUsername()) }}">
                    <small>{{ $item->getUser()->getFull_name() }}</small>
                </a>
                <small class="pull-right">{{ \App\Helper::time($item->getTaken_at()) }}</small>
                <small>
                    @<span>{{ $item->getUser()->getUsername() }}</span>
                </small>
            </h4>
        </div>
    </div>
    <div class="thumb-wrap">
        <a href="{{ \App\Helper::route_decode(is_null($item->getCaption())? '': $item->getCaption()->getText(), $item->getCode()) }}">
            <img src="{{ is_null($item->getImageVersions2())? $item->getCarousel_media()[0]->getImageVersions2()->getCandidates()[0]->getUrl(): $item->getImageVersions2()->getCandidates()[0]->getUrl() }}" alt="{{ $item->getCode() }}" class="img-responsive">
        </a>
        @if(!is_null($item->getCaption()))
        <span class="portfolio-item-info">{!! \App\Helper::caption_decode($item->getCaption()->getText()) !!}</span>
        @endif
        <span class="portfolio-item-icon">
            <?php
                switch ($item->getMedia_type()) {
                    case 8:
                        $item_icon = 'images';
                        break;
                    case 1:
                        $item_icon = '';
                        break;
                    
                    default:
                        $item_icon = 'play-circle';
                        break;
                }
            ?>
            <i class="fa fa-{{ $item_icon }} fa-2x"></i>
        </span>
    </div>
    <div class="row text-center animation-fadeIn">
        <div class="col-xs-6">
            <h3 class="h5"><i class="fa fa-heart-o text-danger"></i> <span>{{ \App\Helper::numberToString($item->getLike_count()) }}</span></h3>
        </div>
        <div class="col-xs-6">
            <h3 class="h5"><i class="fa fa-comment-o text-success"></i> <span>{{ \App\Helper::numberToString($item->getComment_count()) }}</span></h3>
        </div>
    </div>
</div>