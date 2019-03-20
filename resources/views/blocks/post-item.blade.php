<div class="col-sm-4 portfolio-item">
    <div class="thumb-wrap">
        <a href="{{ \App\Helper::route_decode($item->getCaption(), $item->getShortCode()) }}">
            <img src="{{ $item->getImageThumbnailUrl() }}" alt="{{ str_limit($item->getCaption(), 50) }}" class="img-responsive">
        </a>
        <span class="portfolio-item-info">{!! \App\Helper::caption_decode($item->getCaption()) !!}</span>
        <span class="portfolio-item-icon">
            <?php
                switch ($item->getType()) {
                    case 'video':
                        $item_icon = 'play-circle';
                        break;
                    case 'image':
                        $item_icon = '';
                        break;
                    
                    default:
                        $item_icon = 'ellipsis-h';
                        break;
                }
            ?>
            <i class="fa fa-{{ $item_icon }} fa-2x"></i>
        </span>
    </div>
    <div><i>{{ \App\Helper::time($item->getCreatedTime()) }}..</i></div>
    <div class="row text-center animation-fadeIn">
        <div class="col-xs-6">
            <h3 class="h5"><i class="fa fa-heart-o text-danger"></i> <span>{{ \App\Helper::numberToString($item->getLikesCount()) }}</span></h3>
        </div>
        <div class="col-xs-6">
            <h3 class="h5"><i class="fa fa-comment-o text-success"></i> <span>{{ \App\Helper::numberToString($item->getCommentsCount()) }}</span></h3>
        </div>
    </div>
</div>