<!doctype html>

<html
  lang="en"
  class="layout-wide customizer-hide"
  dir="ltr"
  data-skin="default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template"
  data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ $project_name }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../../assets/vendor/fonts/iconify-icons.css" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->
    <link rel="stylesheet" href="../../assets/vendor/libs/pickr/pickr-themes.css" />
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />
    <!-- endbuild -->

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Vendor -->
    <link rel="stylesheet" href="../../assets/vendor/libs/@form-validation/form-validation.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
  </head>

  <body>
    <div class="authentication-wrapper authentication-cover">
      <a href="{{ url('/') }}" class="app-brand auth-cover-brand gap-2">
        <span class="app-brand-logo demo">
          <span class="text-primary">
            <img src="{{ $logo }}" alt="{{ $project_name }}" width="80">
          </span>
        </span>
        <span class="app-brand-text demo text-heading fw-bold">{{ $project_name }}</span>
      </a>

      <!-- Navigation Menu -->
      <nav class="navbar navbar-expand-lg navbar-light position-absolute w-100" style="z-index: 1000; top: 0; background: transparent;">
        <div class="container">
          <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ url('/') }}">Home</a>
            <a class="nav-link" href="{{ url('/login') }}">Login</a>
            <div class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Register
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('/register') }}">Register as Investor</a></li>
                <li><a class="dropdown-item" href="{{ url('/issuer/register') }}">Register as Issuer</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <div class="authentication-inner row m-0" style="margin-top: 50px !important;">
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
          <div class="w-100 d-flex justify-content-center">
            <img
              src="../../assets/img/illustrations/boy-with-rocket-light.png"
              class="img-fluid"
              alt="Login image"
              width="700"
              data-app-dark-img="illustrations/boy-with-rocket-dark.png"
              data-app-light-img="illustrations/boy-with-rocket-light.png" />
          </div>
        </div>

        <!-- Login -->
        <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
          @yield('content')
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js  -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/@algolia/autocomplete-js.js"></script>
    <script src="../../assets/vendor/libs/pickr/pickr.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/auto-focus.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/pages-auth.js"></script>

    <script>
      $('input[type=number]').on('keypress', function(e) {
        var ev = e || window.event;
        var key = ev.keyCode || ev.which;
        key = String.fromCharCode(key);
        var regex = /^[0-9]*\.?[0-9]*$/;

        if (!regex.test(key) || this.value > 100000000000) {
          ev.returnValue = false;
          if (ev.preventDefault) ev.preventDefault();
        }
      });

      $('.passwordField').on('keyup', function(e) {
        var ev = e || window.event;
        var key = $(this).val();
        var regex = /^(?=(.*[A-Z]){1,})(?=(.*[0-9]){1,})(?=(.*[!@#$%^&*()\-__+.]){1,}).{6,}$/;

        $(this).next('span').remove();
        $('.registerButton').attr('disabled', false);
        $('.pass-match-error').remove();

        if (!regex.test(key)) {
          $('.registerButton').attr('disabled', true);
          $('.pass-match-error').remove();
          $('.registerButton').after(
            '<span class="text-danger pass-match-error">Please fill valid details!</span>'
          );
          $(this).after(
            "<span class='text-danger pb-3 d-block'>Password must be 6 digits, must contain 1 capital letter, 1 special character, 1 number </span>"
          );
        }

        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();
        $('#confirm_password').next('span').remove();
        $('.registerButton').attr('disabled', false);

        if (password != confirm_password) {
          $('.registerButton').attr('disabled', true);
          $('.pass-match-error').remove();
          $('.registerButton').after(
            '<span class="text-danger pass-match-error">Please fill valid details!</span>'
          );
          $('#confirm_password').after(
            "<span class='text-danger pb-3 d-block'>Password Confirmation does not match</span>"
          );
        }
      });

      $('input[type=file]').on('change', function(e) {
        $(this).next('span').remove();
        if (this.files[0].size > 4194304) {
          $(this).after("<span class='text-danger'>* Maximum file size 4MB! * </span>");
          this.value = "";
        }
      });
    </script>

    @yield('scripts')
  </body>
</html>
