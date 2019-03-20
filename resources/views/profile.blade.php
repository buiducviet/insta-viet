@extends('layouts.app')

@section('content')
	<!-- Intro -->
    <section class="site-section site-section-light site-section-top themed-background-fire">
        <div class="container">
            <h1 class="text-center animation-slideDown"><i class="fa fa-heart"></i> <strong>Profile</strong></h1>
            <h2 class="h3 text-center animation-slideUp">Passionate people who love what they do!</h2>
        </div>
    </section>
    <!-- END Intro -->

    <!-- People -->
    <section class="site-content site-section">
        <div class="container">
            <div class="row row-items text-center">
                <div class="col-sm-4 col-md-3">
                    <img src="img/placeholders/avatars/avatar2@2x.jpg" alt="Photo" class="img-circle visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeIn" data-element-offset="-64">
                    <h3>
                        <strong>{{ auth()->user()->name }}<br>
                        <small>{{ auth()->user()->email }}</small>
                    </h3>
                </div>
            </div>
        </div>
    </section>
    <!-- END People -->
@endsection
