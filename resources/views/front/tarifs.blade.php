@php
$launchpad_monthly_url = 'https://buy.stripe.com/fZu3cwe9G1N27eldqe9oc00';
$launchpad_yearly_url = 'https://buy.stripe.com/28EaEYfdKgHW8ip3PE9oc03';
$business_monthly_url = 'https://buy.stripe.com/3cI3cwghO9fu7el71Q9oc02';
$business_yearly_url = 'https://buy.stripe.com/bJe9AU3v28bqgOVdqe9oc04';
$enterprise_monthly_url = config('app.tokenize_app_url').'#landingContact';
$enterprise_yearly_url = config('app.tokenize_app_url').'#landingContact';
@endphp

<div class="container">
    <h2 class="text-center mb-2">Pricing Plans</h2>
    <p class="text-center mb-0">
      Whether you’re just starting or already running a tokenization company, we have a budget-friendly plan for you.
  </p>
    <div class="d-flex align-items-center justify-content-center flex-wrap gap-2 pt-9 pb-3 mb-2">
      <label class="switch switch-sm ms-sm-12 ps-sm-12 me-0">
        <span class="switch-label fs-6 text-body">Monthly</span>
        <input type="checkbox" class="switch-input price-duration-toggler" checked />
        <span class="switch-toggle-slider">
          <span class="switch-on"></span>
          <span class="switch-off"></span>
        </span>
        <span class="switch-label fs-6 text-body">Annually</span>
      </label>
      <div class="mt-n5 ms-n10 ml-2 mb-10 d-none d-sm-flex align-items-center gap-1">
        <img
          src="../../assets/img/pages/pricing-arrow-light.png"
          alt="arrow img"
          class="scaleX-n1-rtl pt-1"
          data-app-dark-img="pages/pricing-arrow-dark.png"
          data-app-light-img="pages/pricing-arrow-light.png" />
        <span class="badge badge-sm bg-label-primary rounded-1 mb-3">Save up to 20%</span>
      </div>
    </div>

    <div class="row g-6">
      <!-- Basic -->
      <div class="col-lg">
        <div class="card border rounded shadow-none">
          <div class="card-body pt-12 px-5">
            <div class="mt-3 mb-5 text-center">
              <img                         src="{{ asset('assets/img/front-pages/icons/paper-airplane.png') }}"
              alt="Basic Image" width="120" />
            </div>
            <h4 class="card-title text-center text-capitalize mb-1">Launchpad</h4>
            <p class="text-center mb-5">
              Get your project off the ground with all the essentials for creating, testing, and launching a tokenized asset.
          </p>
            <div class="text-center h-px-50">
              <div class="d-flex justify-content-center">
                {{-- <sup class="h6 text-body pricing-currency mt-2 mb-0 me-1">$</sup>
                <h1 class="mb-0 text-primary">59</h1> --}}
                <span class="price-monthly h2 text-primary fw-extrabold mb-0">$59</span>
                <span class="price-yearly h2 text-primary fw-extrabold mb-0 d-none">$47</span>
                  <sub class="h6 text-body pricing-duration mt-auto mb-1 ms-1">/month</sub>
              </div>
            </div>

            <ul class="list-group my-5 pt-9">
              <li class="mb-4 d-flex align-items-center">
                <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                  ><i class="icon-base bx bx-check icon-xs"></i></span
                ><span>Issuer & Investor dashboards</span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                  ><i class="icon-base bx bx-check icon-xs"></i></span
                ><span>Add and manage properties/projects
              </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                  ><i class="icon-base bx bx-check icon-xs"></i></span
                ><span>Onboard investors seamlessly
              </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                  ><i class="icon-base bx bx-check icon-xs"></i></span
                ><span>Cap table management
              </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                  ><i class="icon-base bx bx-check icon-xs"></i></span
                ><span>Multi-chain support (Ethereum + Polygon)
              </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                  <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                    ><i class="icon-base bx bx-check icon-xs"></i></span
                  ><span>Unlimited testnet token minting
                </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                  <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                    ><i class="icon-base bx bx-check icon-xs"></i></span
                  ><span>1 live mainnet token deployment / month
                </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                  <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                    ><i class="icon-base bx bx-check icon-xs"></i></span
                  ><span>Standard ERC-compliant smart contracts
                </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                  <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                    ><i class="icon-base bx bx-check icon-xs"></i></span
                  ><span>Email support
                </span>
              </li>

            </ul>
            <div class="d-flex gap-2">
            @if($isMain)
            <a href="{{ config('app.tokenize_app_url').'/pricing' }}" target="_blank" class="btn btn-primary flex-fill w-100">Learn more</a>

            @else
              <!-- Monthly pricing link -->
              <a href="{{ $launchpad_monthly_url }}" target="_blank" class="btn btn-label-primary flex-fill">Month</a>
              <!-- Yearly pricing link -->
              <a href="{{ $launchpad_yearly_url }}" target="_blank" class="btn btn-label-primary flex-fill">Year</a>
            @endif
            </div>
          </div>
        </div>
      </div>

      <!-- Pro -->
      <div class="col-lg">
        <div class="card border-primary border shadow-none">
          <div class="card-body position-relative pt-4">
            <div class="position-absolute end-0 me-5 top-0 mt-4">
              <span class="badge bg-label-primary rounded-1">Popular</span>
            </div>
            <div class="my-5 pt-6 text-center">
              <img src="{{ asset('assets/img/front-pages/icons/plane.png') }}" alt="Pro Image" width="120" />
            </div>
            <h4 class="card-title text-center text-capitalize mb-1">Business</h4>
            <p class="text-center mb-5">
              A full-featured, white-label platform for businesses ready to scale tokenized assets under their own brand.

            </p>
            <div class="text-center h-px-50">
              <div class="d-flex justify-content-center">
                <span class="price-monthly h2 text-primary fw-extrabold mb-0">$299</span>
                <span class="price-yearly h2 text-primary fw-extrabold mb-0 d-none">$239</span>
                <sub class="h6 text-body pricing-duration mt-auto mb-1 ms-1">/month</sub>
              </div>
              {{-- <small class="price-yearly price-yearly-toggle text-body-secondary">USD 3144 / year</small> --}}
            </div>

            <ul class="list-group my-5 pt-9">
              <li class="mb-4 d-flex align-items-center">
                <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                  ><i class="icon-base bx bx-check icon-xs"></i></span
                ><span>Everything in Launchpad, plus
              </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                  ><i class="icon-base bx bx-check icon-xs"></i></span
                ><span>White-label platform on your domain + branding
              </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                  ><i class="icon-base bx bx-check icon-xs"></i></span
                ><span>Unlimited token issuance (Ethereum & Polygon)
              </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                  ><i class="icon-base bx bx-check icon-xs"></i></span
                ><span>Unlimited issuers / projects
              </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                  <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                    ><i class="icon-base bx bx-check icon-xs"></i></span
                  ><span>Integrated KYC/AML compliance workflows
                </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                  <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                    ><i class="icon-base bx bx-check icon-xs"></i></span
                  ><span>Automated investor onboarding
                </span>
                </li>
                <li class="mb-4 d-flex align-items-center">
                  <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                    ><i class="icon-base bx bx-check icon-xs"></i></span
                  ><span>Advanced shareholder cap table management
                </span>
                </li>
                <li class="mb-4 d-flex align-items-center">
                  <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                    ><i class="icon-base bx bx-check icon-xs"></i></span
                  ><span>Built-in secondary trading functionality
                </span>
                </li>
                <li class="mb-4 d-flex align-items-center">
                  <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                    ><i class="icon-base bx bx-check icon-xs"></i></span
                  ><span>Priority technical support
                </span>
                </li>
              </ul>
          <div class="d-flex gap-2">
            @if($isMain)
            <a href="{{ config('app.tokenize_app_url').'/pricing' }}" target="_blank" class="btn btn-primary flex-fill w-100">Learn more</a>

            @else
            <!-- Monthly pricing link -->
            <a href="{{ $business_monthly_url }}" target="_blank" class="btn btn-primary flex-fill">Month</a>
            <!-- Yearly pricing link -->
            <a href="{{ $business_yearly_url }}" target="_blank" class="btn btn-primary flex-fill">Year</a>
            @endif
          </div>
          </div>
        </div>
      </div>

      <!-- Enterprise -->
      <div class="col-lg">
        <div class="card border rounded shadow-none">
          <div class="card-body pt-12">
            <div class="mt-3 mb-5 text-center">
              <img src="{{ asset('assets/img/front-pages/icons/shuttle-rocket.png') }}" alt="Pro Image" width="120" />
            </div>
            <h4 class="card-title text-center text-capitalize mb-1">Enterprise</h4>
            <p class="text-center mb-5">
              A comprehensive solution for institutions with advanced needs around compliance, integrations, and ownership.
            </p>

            <div class="text-center h-px-50">
              <div class="d-flex justify-content-center">
                {{-- <sup class="h6 text-body pricing-currency mt-2 mb-0 me-1">$</sup> --}}
                <h1 class="price-toggle price-yearly text-primary mb-0">Custom</h1>
                <h1 class="price-toggle price-monthly text-primary mb-0 d-none">Custom</h1>
                {{-- <sub class="h6 text-body pricing-duration mt-auto mb-1 ms-1">/month</sub> --}}
              </div>
              <small class="price-yearly price-yearly-toggle text-body-secondary">Custom</small>
            </div>
            <ul class="list-group my-5 pt-9">
              <li class="mb-4 d-flex align-items-center">
                <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                  ><i class="icon-base bx bx-check icon-xs"></i></span
                ><span>Everything in Business, plus:
              </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                  ><i class="icon-base bx bx-check icon-xs"></i></span
                ><span>Custom feature development
              </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                  ><i class="icon-base bx bx-check icon-xs"></i></span
                ><span>Direct integration with your IT systems (CRM, ERP, etc.)
              </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                  ><i class="icon-base bx bx-check icon-xs"></i></span
                ><span>On-premise deployment option
              </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                  ><i class="icon-base bx bx-check icon-xs"></i></span
                ><span>Dedicated Account Manager & SLA
              </span>
              </li>
              <li class="mb-4 d-flex align-items-center">
                  <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                    ><i class="icon-base bx bx-check icon-xs"></i></span
                  ><span>Source code buyout option

                </span>
                </li>
                <li class="mb-4 d-flex align-items-center">
                  <span class="badge p-50 w-px-20 h-px-20 rounded-pill bg-label-primary me-2"
                    ><i class="icon-base bx bx-check icon-xs"></i></span
                  ><span>Sales automation tools

                </span>
                </li>
              </ul>
              @if($isMain)
              <a href="{{config('app.tokenize_app_url').'/pricing'}}" target="_blank" class="btn btn-primary d-grid w-100">Learn more</a>
              @else
              <a href="{{config('app.tokenize_app_url').'#landingContact'}}" target="_blank" class="btn btn-primary d-grid w-100">Custom pricing (contact us)</a>
              @endif
          </div>
        </div>
      </div>
    </div>
  </div>