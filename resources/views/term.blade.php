@extends('layouts.app')

@section('content')
	<!-- Media Container -->
    @include('blocks.search')
    <!-- END Media Container -->

    <!-- Company Info -->
    <section class="site-content site-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="site-block">
                        <h1 class="site-heading h4">Privacy Policy</h1>
                        <p>{!! $result['content'] or null !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
