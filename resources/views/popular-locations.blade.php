@extends('layouts.app')

@section('content')
    <!-- Media Container -->
    @include('blocks.search-location')
    <!-- END Media Container -->
    <!-- Company Info -->
    <section class="site-content">
        @include('blocks.breadcrumb')
        <div class="container">
            <h1 class="site-heading h3"><strong>{{ $location->name }}</strong> feeds</h1>
            <hr>
            <!-- Portfolio Items -->
            <!-- Add the category value for each item in its data-category attribute (for the filter functionality) -->
            <div class="row portfolio">
                @foreach($medias as $key => $item)
                    @include('blocks.popular-item')
                @endforeach
            </div>
            <!-- END Portfolio Items -->
        </div>
    </section>
    <section class="site-content">
        <div class="container">
            <h3 class="site-heading">Nearby</h3>
            <hr>
            <!-- Portfolio Items -->
            <!-- Add the category value for each item in its data-category attribute (for the filter functionality) -->
            <div class="row portfolio">
                @foreach($places as $key => $item)
                    <div class="col-sm-6 mb-1">
                        <div class="media">
                            <div class="media-left media-middle">
                                <a href="{{ route('location_feed', str_slug($item->getLocation()->getShort_name().'-'.$item->getLocation()->getPk())) }}" class="text-danger">
                                    <i class="fa fa-map-marker fa-2x"></i>
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="{{ route('location_feed', str_slug($item->getLocation()->getShort_name().'-'.$item->getLocation()->getPk())) }}">
                                    <strong class="one-line">{{ $item->getLocation()->getName() }}</strong>
                                    @if(strlen($item->getLocation()->getAddress()) || strlen($item->getLocation()->getCity()))
                                    <div class="one-line"><span>{{ $item->getLocation()->getAddress() }}{{ strlen($item->getLocation()->getAddress())? ', ': '' }}{{ $item->getLocation()->getCity() }}</span></div>
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- END Portfolio Items -->
        </div>
    </section>
@endsection