@extends('layouts.app')

@section('content')
	<!-- Media Container -->
    @include('blocks.search')
    <!-- END Media Container -->

    <!-- Content -->
    <section class="site-content site-section">
        <div class="container">
            <!-- Portfolio Items -->
            <!-- Add the category value for each item in its data-category attribute (for the filter functionality) -->
            <div class="row portfolio">
                @foreach($medias as $key => $item)
                    @include('blocks.popular-item')
                @endforeach
            </div>
            <!-- END Portfolio Items -->
            <div class="more-wrap text-center">
                <a href="{{ route('popular_photos', ['page' => 2]) }}" class="btn btn-default more-item-icon">
                    MORE
                    <br>
                    <i class="fa fa-angle-double-down fa-2x"></i>
                </a>
            </div>
            <hr>
        </div>
    </section>
    @foreach(config('config.blocks') as $key => $block)
        <section class="site-content site-section">
            <div class="container">
                <h2 class="site-heading">{!! $block['name'] !!}</h2>
                <hr>
                <div class="text-center mb-1">
                    @foreach(explode(',', $block['tags']) as $item)
                        <a href="{{ route('tag', str_slug($item, '')) }}"><code>#<strong>{{ $item }}</strong></code></a>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach
    <!-- END Content -->
@endsection
