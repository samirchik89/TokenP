<link rel="stylesheet" href="{{ asset('css/new-header.css') }}">
{{--
<header class="new-header">
  <div class="container-fluid">
    <div class="logo-wrapper">
      @if(Auth::check())
      <a class="navbar-brand p-0" href="{{ url('/dashboard') }}">
          <img src="{{ logo() }}" alt="not-found">
      </a>
      @else
      <a class="navbar-brand p-0" href="" style="margin-top:10px">
          <img src="{{ logo() }}" alt="not-found">
      </a>
      @endif
  </div>
    <div class="inner-header">
      <div class="mob-bar-icon d-lg-none">
        <i class="fa-solid fa-bars"></i>
      </div>
      <div class="bar-icon d-lg-block">
        <i class="fa-solid fa-bars"></i>
      </div>
    </div>
  </div>
</header>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
    $('.bar-icon').on('click', function(){
      $('.new-sidebar').toggleClass('active');
      $('.mainlayout').toggleClass('mainlayout-active');
    })
    $('.mob-bar-icon').on('click', function(){
      $('.new-sidebar').toggleClass('mob-menu-active');
    })
  });
</script> --}}



<!-- Topbar Start -->
<div class="navbar-custom">
  <ul class="list-unstyled topnav-menu float-right mb-0">
      <li class="dropdown notification-list">
          <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
              @if (Auth::check())
                <img src="{{ asset('issuer/assets/images/users/avatar-1.png') }}" alt="user-image" class="rounded-circle" style="border-radius: 50%">
                <span class="d-none d-sm-inline-block ml-1">{{ Auth::user()->identity ? Auth::user()->identity->first_name . ' ' . Auth::user()->identity->last_name : Auth::user()->name }}</span>
              @endif
          </a>
          <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
              <!-- item-->
              <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome !</h6>
              </div>

              <a href="{{ url('/profile') }}" class="dropdown-item notify-item" >
                  <i class="mdi mdi-account-outline"></i>
                  <span>Profile</span>
              </a>
              <a href="{{ url('/security') }}" class="dropdown-item notify-item">
                  <i class="mdi mdi-account-outline"></i>
                  <span>Security</span>
              </a>

              <div class="dropdown-divider"></div>
              <a class="dropdown-item notify-item" style="color:black"
              href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"
            >
              <i class="mdi mdi-logout-variant"></i>
              <span>Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>

          </div>
      </li>

  </ul>

  <!-- LOGO -->
  <div class="logo-box">
      <a href="{{ url('/dashboard') }}" class="logo text-center">
          <span class="logo-lg">
              <img src="{{ logo() }}" alt="" height="45">
              <!-- <span class="logo-lg-text-light">Zircos</span> -->
          </span>
          <span class="logo-sm">
              <!-- <span class="logo-sm-text-dark">Z</span> -->
              <img src="{{ favicon() }}" alt="" height="40">
          </span>
      </a>
  </div>

  <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
      <li>
          <button class="button-menu-mobile waves-effect">
              <i class="mdi mdi-menu"></i>
          </button>
      </li>
  </ul>
</div>
  <!-- end Topbar -->
