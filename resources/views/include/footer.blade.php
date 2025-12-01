<!-- @if(Auth::check())
    <footer class="footer">
@else
    <footer class="footer loginFooter">
@endif


        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <ul class="list-inline">
                        <li><a href="#">Disclaimer</a></li>
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Consent Notice</a></li>
                    </ul>
                </div>
                <div class="col-12 text-center">
                    <p class="copy-right">Copyright &copy; Liquid Token <?php echo date('Y'); ?></p>
			</div>
		</div>
	</div>
</footer> -->

<link rel="stylesheet" type="text/css" href="{{asset('asset/login/css/chat_style.css')}}">
@if (Request::is('/'))
<div class="section footer-classic">
    <div class="innfoter-bg"></div>
    <div class="container">
        <div class="row row-30">
            <div class="col-md-3">
                <h5>About</h5>
                <ul class="nav-list">
                    <li><a href="{{ url('about_us') }}">Our platform</a></li>
                    <li><a href="{{ url('privacy') }}">Privacy Policy</a></li>
                    <li><a href="{{ url('terms') }}">Terms of use</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Get Started</h5>
                <ul class="nav-list">
                    <li><a href="{{ url('register') }}">Create profile</a></li>
                    <li><a href="{{ url('contact_us') }}">Contact us</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Resources</h5>
                <ul class="nav-list">
                    <li><a href="#">White paper</a></li>
                    <li><a href="#">{{ Setting::get('site_title') }}</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Invest</h5>
                <ul class="nav-list">
                    <li><a href="{{url('login')}}">Become a member</a></li>
                    <li><a href="{{ url('login') }}">Featured Property</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Footer content -->
{{-- <footer>
    <ul class="social">
        <li><a href="{{setting('facebook')}}"><i class="fab fa-facebook-f"></i></a></li>
        <li><a href="{{setting('twitter')}}"><i class="fab fa-twitter"></i></a></li>
        <li><a href="{{setting('instagram')}}"><i class="fab fa-instagram"></i></a></li>
    </ul>
    <p class="copy">Copyright © {{ date('Y') }} {{ Setting::get('site_title') }}.WORLD. All rights reserved.<a href="#"></a></p>
</footer> --}}

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex flex-wrap justify-content-between align-content-center">
                  <ul class="social">
                    <li><a href="{{setting('facebook')}}"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="{{setting('twitter')}}"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="{{setting('instagram')}}"><i class="fab fa-instagram"></i></a></li>
                  </ul>
                  <p class="copy {{ !Request::is('/') ? 'text-dark' : '' }}">Copyright © {{ date('Y') }} {{ Setting::get('site_title') }}.WORLD. All rights reserved.<a href="#"></a></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Chat Ui Start -->
<div id="chat-circle" class="btn btn-raised" style="display:none;">
    <div id="chat-overlay"></div>
    <i class="fa fa-comments" style="font-size:15px;"></i>
</div>

<div class="chat-box animated bounceIn" style="display:none;">
    <div class="chat-box-header">Online<span class="chat-box-toggle"><i class="fa fa-times"></i></span>
    </div>
    <div class="chat-box-body">
        <div class="chat-box-overlay">
        </div>
        <div class="chat-logs">

        </div><!--chat-log -->
    </div>
    <div class="chat-input">
        <form>
            <input type="text" id="chat-input" placeholder="Send a message..."/>
            <button type="submit" class="chat-submit" id="chat-submit"><i class="fa fa-paper-plane"></i></button>
        </form>
    </div>
</div>

<!-- Chat Ui End -->

<script type="text/javascript" src="{{asset('asset/login/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('asset/login/js/chat_script.js')}}"></script>
<!-- Footer content -->
