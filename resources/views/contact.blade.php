@extends('layouts.app')

@section('content')
	<!-- Media Container -->
    @include('blocks.search')
    <!-- END Media Container -->

    <!-- Company Info -->
    <section class="site-content site-section">
        <div class="container">
            @if(session()->has('alert'))
                <div class="{{ session('alert')['class'] }}">{!! session('alert')['text'] !!}</div>
            @endif
            <div class="row">
                <div class="col-sm-6 col-md-4 site-block">
                    <div class="site-block">
                        <h1 class="h4 site-heading">About us</h1>
                        {!! $result['content'] or null !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-8 site-block">
                    <h3 class="h4 site-heading"><strong>Contact</strong> Form</h3>
                    @if(session()->has('message'))
                        {!! session('message') !!}
                    @endif
                    <form action="{{ route('create_contact') }}" method="post" id="form-contact">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="contact-name">Name</label>
                            <input type="text" id="contact-name" value="{{ old('name') }}" name="name" class="form-control input-lg" placeholder="Your name..">
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="contact-email">Email</label>
                            <input type="text" id="contact-email" value="{{ old('email') }}" name="email" class="form-control input-lg" placeholder="Your email..">
                            <span class="help-block">{{$errors->first('email')}}</span>
                        </div>
                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="contact-message">Message</label>
                            <textarea id="contact-message" name="message" rows="10" class="form-control input-lg" placeholder="Let us know how we can assist..">{!! old('message') !!}</textarea>
                            <span class="help-block">{{$errors->first('message')}}</span>
                        </div>
                        <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                            <label for="contact-email">Enter security number</label>
                            <div class="row">
                                <div class="col-xs-6">
                                    <input type="number" name="captcha" class="form-control input-lg" placeholder="Your email..">
                                </div>
                                <div class="col-xs-6">
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <button id="captcha_refresh" type="button" class="btn btn-success"><i class="fa fa-refresh"></i></button>
                                        </div>
                                        <div class="media-body">
                                            <img id="captcha_src" data-refresh-config="default" src="{{ captcha_src() }}" alt="captcha" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="help-block">{{$errors->first('captcha')}}</span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
