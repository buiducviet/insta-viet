@extends('layouts.app')

@section('content')
    <!-- Company Info -->
    <section class="site-content no-heading-media">
        @include('blocks.breadcrumb')
        <div class="container">
            <h1 class="site-heading h3"><strong>{{ $feed->getLocation()->getName() }}</strong> feeds</h1>
            <hr>
            <!-- Portfolio Items -->
            <!-- Add the category value for each item in its data-category attribute (for the filter functionality) -->
            <div class="row portfolio">
                @foreach($feed->getItems() as $key => $item)
                    @include('blocks.popular-item')
                @endforeach
            </div>
            <!-- END Portfolio Items -->
            <div class="btn-group btn-group-justified mb-1" role="group" aria-label="...">
                @if(isset($_GET['page']))
                <div class="btn-group" role="group">
                    <a href="{{ url()->current() }}" class="btn btn-default"><i class="fa fa-chevron-left"></i> FIRST</a>
                </div>
                @endif
                @if($feed->getMore_available())
                <div class="btn-group" role="group">
                    <a href="{{ url()->current() }}?page={{ $feed->getNext_max_id() }}" class="btn btn-default">NEXT <i class="fa fa-chevron-right"></i></a>
                </div>
                @endif
            </div>
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