<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

  <div class="slimscroll-menu">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <ul class="metismenu" id="side-menu">
      <li class="menu-title">Navigation</li>
        @if(Auth::check())
          <li>
              <a class="waves-effect waves-light" href="{{ url('/dashboard') }}">
                  <i class="mdi mdi-view-dashboard"></i><span>Dashboard</span>
              </a>
          </li>
          <li>
              <a href="{{ url('/propertyList') }}" class="waves-effect waves-light">
                  <i class="fa-solid fa-tag"></i>
                  <span>Offerings</span>
              </a>
          </li>
          {{-- <li>
              <a class="waves-effect waves-light" href="{{ url('/voting') }}">
                  <i class="fa-solid fa-check-to-slot"></i>
                  <span>Voting</span>
              </a>
          </li> --}}
          <li>
              <a href="javascript: void(0);" class="waves-effect waves-light">
                <i class="fa-solid fa-wallet"></i>
                  <span>Wallet </span>
                  <span class="menu-arrow"></span>
              </a>
              <ul class="nav-second-level" aria-expanded="false">
                <li>
                    <a class="" href="{{ url('/wallet') }}">
                        <span>Deposit</span>
                    </a>
                </li>
                <li>
                    <a class="" href="{{ url('/withdrawETH') }}">
                        <span>Withdraw</span>
                    </a>
                </li>

              </ul>
          </li>
          <li>
              <a class="waves-effect waves-light" href="{{ url('/profile') }}">
                <i class="fa-solid fa-user"></i>
                  <span>Profile</span>
              </a>
          </li>
        

          <li>
            <a href="javascript: void(0);" class="waves-effect waves-light">
              <i class="mdi mdi-google-pages"></i>
                <span>Investments </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
              <li>
                <a class="" href="{{ url('/investment') }}">
                  
                  <span>Investments</span>
              </a>
              </li>
              <li>
                <a class="" href="{{ url('/buy_requests') }}">
                      <span>Token Buy History</span>
                  </a>
              </li>

            </ul>
        </li>
          <li>
              <a class="waves-effect waves-light" href="{{ url('/security') }}">
                <i class="fa-solid fa-shield-halved"></i>
                  <span>Security</span>
              </a>
          </li>
          @if($pageVisibility->get('plaid')['value'])
          <li>
            <a class="waves-effect waves-light" href="{{ route('plaid.index') }}">
              <i class="fa-solid fa-university"></i>
                <span>Bank Accounts</span>
            </a>
        </li>
        @endif
          {{-- <li>
              <a href="javascript: void(0);" class="waves-effect waves-light">
                <i class="fa-solid fa-chart-simple"></i>
                <span>My Trades</span>
                <span class="menu-arrow"></span>
              </a>
              <ul class="nav-second-level" aria-expanded="false">
                  <li>
                      <a class="" href="{{ url('/trade') }}">
                          <span>Exchange</span>
                      </a>
                  </li>
                  <li>
                      <a class="" href="{{ url('/open_trades') }}">
                          <span>My Trades</span>
                      </a>
                  </li>


                  <li>
                    <a class="" href="{{ url('/trade_history') }}">
                        <span>Trade History</span>
                    </a>
                </li>
              </ul>
          </li> --}}
        @else
          <li>
            <a class="waves-effect waves-light" href="{{ url('/') }}">
              <i class="fa-solid fa-house"></i>
              <span>Home</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/propertyList') }}" class="waves-effect waves-light">
              <i class="fa-solid fa-tag"></i>
              <span>Offerings</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/login') }}" class="waves-effect waves-light">
              <i class="fa-solid fa-arrow-right-to-bracket"></i>
                <span>Login</span>
            </a>
          </li>
          <li>
            <a href="javascript: void(0);" class="waves-effect waves-light">
              <i class="fa-regular fa-address-card"></i>
                <span>Register </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
              <li>
                  <a class="" href="{{ url('/register') }}">
                      <span>Register as Invester</span>
                  </a>
              </li>
              <li>
                  <a href="{{ url('/issuer/register') }}" class="">
                      <span>Register as Issuer</span>
                  </a>
              </li>
            </ul>
          </li>
        @endif
      </ul>
    </div>
    <!-- End Sidebar -->
    <div class="clearfix"></div>
  </div>
  <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
