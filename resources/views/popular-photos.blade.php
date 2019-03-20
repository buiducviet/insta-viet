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
                @foreach($medias as $key => $item)
                    @include('blocks.popular-item')
                @endforeach
            </div>
            <!-- END Portfolio Items -->
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                @if(isset($_GET['page']) && intval($_GET['page']) > 1)
                <div class="btn-group" role="group">
                    <a href="{{ url()->current() }}?page={{ intval($_GET['page'])-1 }}" class="btn btn-default"><i class="fa fa-chevron-left"></i> PREVIOUS</a>
                </div>
                @endif
                <div class="btn-group" role="group">
                    <a href="{{ url()->current() }}?page={{ isset($_GET['page'])? intval($_GET['page'])+1: 2 }}" class="btn btn-default">NEXT <i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection