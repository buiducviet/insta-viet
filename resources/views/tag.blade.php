@extends('layouts.app')

@section('content')
    <!-- Company Info -->
    <section class="site-content no-heading-media">
        @include('blocks.breadcrumb')
        <div class="container">
            <h1 class="site-heading">{{ '#'.$tagName.' feeds' }}</h1>
            <hr>
            <!-- Portfolio Items -->
            <!-- Add the category value for each item in its data-category attribute (for the filter functionality) -->
            <div class="row portfolio">
                @foreach($result->getItems() as $key => $item)
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
                @if($result->getMore_available())
                <div class="btn-group" role="group">
                    <a href="{{ url()->current() }}?page={{ $result->getNext_max_id() }}" class="btn btn-default">NEXT <i class="fa fa-chevron-right"></i></a>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection