<!-- Google Translator CSS code -->
<style type="text/css">
    .goog-logo-link {
        display: none !important;
    }
    .goog-te-gadget {
        color: transparent !important;
    }
    .goog-te-banner-frame {
        display: none !important;
    }
    .goog-te-combo {
        padding: 5px 10px;
        width: 100%;
        border: 1px solid rgba(204, 163, 84, 0.45);
        cursor: pointer;
        color: #fff;
        background-color: transparent;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
        border-radius: 4px;
        -webkit-border-radius: 4px;
    }
    .goog-te-gadget .goog-te-combo {
        margin: 0px 0px !important;
    }
</style>
<!-- Google Translator CSS code end -->

<!-- <header>
	<div class="container-fluid header">
		<nav class="navbar navbar-expand-sm navbar-light bg-light ">
			<a class="navbar-brand" href="{{url('/dashboard')}}">
				<img src="/logo.png" class="logoImg"></a>
		  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
		    	<ul class="navbar-nav m-auto mt-2 mt-lg-0">
		      		<li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
		        		<a class="nav-link" href="{{url('/dashboard')}}">Dashboard <span class="sr-only">(current)</span></a>
		      		</li>
		      		<li class="nav-item {{ Request::is('invest') ? 'active' : '' }}">
                        <a class="nav-link" href="{{url('/invest')}}">Invest</a>
                    </li>
		      		<li class="nav-item {{ Request::is('wallet') ? 'active' : '' }}">
		        		<a class="nav-link" href="{{url('/wallet')}}">Wallet</a>
		      		</li>
		      		<li class="nav-item {{ Request::is('security') ? 'active' : '' }}">
		        		<a class="nav-link" href="{{url('/security')}}">Security</a>
		      		</li>
		    	</ul>

		  	</div>
		  	<ul class="navbar nav m-r-0 usermenu">
	    		<li class="nav-item dropdown userDropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<img src="/asset/img/user.png" height="32">
					</a>
				    <div class="dropdown-menu">
				      	<a class="dropdown-item" href="{{url('/support')}}">Support</a>
				      	<a class="dropdown-item" href="{{url('/privacy-policy')}}">Privacy Policy</a>
				      	<a class="dropdown-item" href="{{url('/terms-use')}}">Terms of Use</a>
				      	<a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">Logout</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
        </form>
    </div>
</li>
</ul>
</nav>
</div>
</header> -->

<style>
    .head-lang .nice-select {
        background: transparent !important;
        line-height: 30px !important;
        height: auto;
        padding-left: 0px;
        border: none !important;
        font-size: 12px;
        font-weight: 700;
    }
    /* .nice-select .list
    {
      overflow-y: scroll;
      height: 200px;
    } */
</style>


<header>
    <nav class="navbar navbar-custom navbar-fixed-top black-bg" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            <!-- <a class="navbar-brand p-0" href="{{url('/dashboard')}}"> -->
                @if(Auth::check())
                    <a class="navbar-brand p-0" href="{{ url('/dashboard') }}">
                        <img src="{{ logo() }}" style="width:100px">
                    </a>
                @else
                    <a class="navbar-brand p-0" href="" style="margin-top:10px">
                        <img src="{{ logo() }}" style="width:100px">
                    </a>
                @endif

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse top-menu">
                <ul class="nav navbar-nav">
                    @if(Auth::check())
                        {{-- <li class="page-scroll">
                            <a href="/#services">How It Works</a>
                        </li> --}}
                      <!--<li class="page-scroll">
                            <a href="{{url('/company')}}">Our Company</a>
                        </li> -->
                        {{-- <li class="page-scroll {{ Request::is('buytokens') ? 'active' : '' }}">
                            <a href="{{url('/buytokens')}}">Buy Tokens</a>
                        </li> --}}
                        {{-- <li class="page-scroll {{ Request::is('propertyList') ? 'active' : '' }}">
                            <a href="{{url('/propertyList')}}">Offerings</a>
                        </li> --}}
                        {{-- <li class="page-scroll">
                                <a href="{{url('/intel')}}">Intel</a>
                        </li> --}}
                        {{-- <li class="page-scroll">
                            <a href="{{ url('/flowchart') }}">Process Flow Chart</a>
                        </li> --}}
                        <li class="page-scroll">
                            <a href="{{ url('/voting') }}">Voting</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Settings
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{url('/profile')}}">Profile</a>
                                <a class="dropdown-item" href="{{url('/trade')}}">Exchange</a>
                                <a class="dropdown-item" href="{{url('/wallet')}}">Wallet</a>
                                <a class="dropdown-item" href="{{url('/withdrawETH')}}">Withdraw</a>
                                <a class="dropdown-item" href="{{url('/investment')}}">Investments</a>
                                <a class="dropdown-item" href="{{url('/trade_history')}}">History</a>
                                <a class="dropdown-item" href="{{url('/security')}}">Security</a>
                            </div>

                        </li>

                        <li class="page-scroll">
                            <a href="{{ url('/open_trades') }}">My Trades</a>
                        </li>

                        <li class="page-scroll">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        </li>
                    @else
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                        <li class="page-scroll {{ Request::is('dashboard') ? 'active' : '' }}">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        {{-- <li class="page-scroll">
                            <a href="{{ url('/#services') }}">How It Works</a>
                        </li> --}}
                       <!--  <li class="page-scroll">
                            <a href="{{url('/company')}}">Our Company</a>
                        </li> -->
                        {{-- <li class="page-scroll {{ Request::is('propertyList') ? 'active' : '' }}">
                            <a href="{{url('/propertyList')}}">Offerings</a>
                        </li> --}}
                        {{-- <li class="page-scroll">
                            @if(Auth::check())
                                <a href="{{url('/intel')}}">Intel</a>
                            @else
                                <a href="{{url('/intel')}}">Intel</a>
                            @endif
                        </li> --}}
                        <!-- <li class="page-scroll">
                            <a href="#">Offerings</a>
                        </li> -->
                        {{-- <li class="page-scroll {{ Request::is('blog') ? 'active' : '' }}">
                            <a href="{{url('/blog')}}">Blog</a>
                        </li> --}}
                    <!-- <li class="page-scroll">
                        <a href="{{url('/dashboard')}}#contact">Contact</a>
                    </li> -->

                    <!--
                    <li class="page-scroll">
                        <a href="{{url('/login')}}">Issuer Login</a>
                    </li>
                    <li class="page-scroll">
                        <a href="{{url('/login')}}">Investor Login</a>
                    </li>
                    -->
                        @if(!Auth::check())
                        <li class="page-scroll {{ Request::is('login') ? 'active' : '' }}">
                            <a href="{{url('/login')}}">Login</a>
                        </li>
                            <li class="page-scroll dropdown">
                                <a href="{{ url('/register') }}" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Register</a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="{{url('/register')}}">Register as Invester</a></li>
                                    <li><a href="{{url('/issuer/register')}}">Register as Issuer</a></li>
                                </ul>
                            </li>
                        @endif

                    <!-- <li class="page-scroll">
                            <a href="./login/login.html">Login</a>
                        </li> -->
                    <!-- <li class="page-scroll dropdown">

                        <a href="{{ url('/login') }}" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Hello, {{@$user->identity->first_name}}</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="{{url('/profile')}}">Profile</a></li>
                            <li><a href="{{url('/wallet')}}">Wallet</a></li>
                            <li><a href="{{url('/investment')}}">Investments</a></li>
                            <li><a href="{{url('/setting')}}">Settings</a></li>
                            {{-- <li><a href="{{url('/activity')}}">Activity</a></li> --}}
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                            </form>

                        </li>
                    </ul>

                </li> -->
                    @endif
                    <li class="page-scroll">
                        <!-- <div class="form-group head-lang">
                          <select name="lang" required="" aria-required="true">
                              <option value="eng">English</option>
                            <option value="fre">French</option>
                            <option value="can">Cantonese</option>
                            <option value="man">Manderin</option>
                            <option value="spa">Spanish</option>
                            <option value="hin">Hindi</option>
                            <option value="ger">German</option>
                            <option value="ita">Italian</option>
                            <option value="por">Portuguese</option>
                          </select>
                        </div> -->

                        <!-- Google Translate Start -->
                        {{-- <div id="google_translate_element"></div> --}}
                        <!-- Google Translate End -->

                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</header>

<style>
    .dropdown-item {
        display: block;
        margin: 10px;
    }
</style>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
                                                  pageLanguage: 'en'
                                              }, 'google_translate_element');
    }
</script>

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
