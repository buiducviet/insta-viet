<div class="media-container">
    <!-- Intro -->
    <section class="site-section site-section-light site-section-top">
        <div class="container text-center">
            <h3 class="animation-slideDown">{{ MetaTag::get('title') }}</h3>
            <h4 class="teanimation-slideUp">{!! MetaTag::get('description') !!}</h4>
            <form action="{{ route('search', '') }}" method="get" class="ig-search">
                <div class="input-group input-group-lg">
                    <input type="text" name="q" class="form-control text-lelf" placeholder="Search &#64;user or #tag..">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- END Intro -->

    <!-- For best results use an image with a resolution of 2560x279 pixels -->
    <img src="{{ \App\Helper::media(MetaTag::get('banner')) }}" alt="" class="media-image animation-pulseSlow">
</div>