<footer class="site-footer site-section">
    <div class="container">
        <!-- Footer Links -->
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <h4 class="footer-heading">About Us</h4>
                <ul class="footer-nav list-inline">
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-3">
                <h4 class="footer-heading">Legal</h4>
                <ul class="footer-nav list-inline">
                    <li><a href="{{ route('term') }}">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-3">
                <h4 class="footer-heading">Follow Us</h4>
                <ul class="footer-nav footer-nav-social list-inline">
                    <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-dribbble"></i></a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-rss"></i></a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-3">
                <h4 class="h3">
                    <a href="{{ route('home') }}">
                        <img src="{{ \App\Helper::media(MetaTag::get('logo')) }}" style="max-height: 34px;" alt="logo-footer" class="img-responsive">
                    </a>
                </h4>
                <ul class="footer-nav list-inline">
                    <li>{{ config('config.title') }}</li>
                </ul>
            </div>
        </div>
        <!-- END Footer Links -->
    </div>
</footer>