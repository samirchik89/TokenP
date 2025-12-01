<div class="container">
    <div class="text-center mb-4">
      <span class="badge bg-label-primary">Pricing Plans</span>
    </div>
    <h4 class="text-center mb-1">
      <span class="position-relative fw-extrabold z-1"
        >Pricing plans
        <img
          src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}"
          alt="laptop charging"
          class="section-title-img position-absolute object-fit-contain bottom-0 z-n1" />
      </span>
      designed for you
    </h4>
    <p class="text-center pb-2 mb-7">
        All plans go with NO SET UP FEE. <br>Money back guarantee 30 days, no questions asked

    </p>
    <div class="text-center mb-12">
      <div class="position-relative d-inline-block pt-3 pt-md-0">
        <label class="switch switch-sm switch-primary me-0">
          <span class="switch-label fs-6 text-body me-3">Pay Monthly</span>
          <input type="checkbox" class="switch-input price-duration-toggler" checked />
          <span class="switch-toggle-slider">
            <span class="switch-on"></span>
            <span class="switch-off"></span>
          </span>
          <span class="switch-label fs-6 text-body ms-3">Pay Annual</span>
        </label>
        <div class="pricing-plans-item position-absolute d-flex">
          <img
            src="{{ asset('assets/img/front-pages/icons/pricing-plans-arrow.png') }}"
            alt="pricing plans arrow"
            class="scaleX-n1-rtl" />
          <span class="fw-medium mt-2 ms-1"> Save 25%</span>
        </div>
      </div>
    </div>
    <div class="row g-6 pt-lg-5">
      <!-- Basic Plan: Start -->
      <div class="col-xl-4 col-lg-6">
        <div class="card">
          <div class="card-header">
            <div class="text-center">
              <img
                src="{{ asset('assets/img/front-pages/icons/paper-airplane.png') }}"
                alt="paper airplane icon"
                class="mb-8 pb-2" />
              <h4 class="mb-0">Launchpad</h4>
              <div class="d-flex align-items-center justify-content-center">
                <span class="price-monthly h2 text-primary fw-extrabold mb-0">$99</span>
                <span class="price-yearly h2 text-primary fw-extrabold mb-0 d-none">$74</span>
                <sub class="h6 text-body-secondary mb-n1 ms-1">/mo</sub>
              </div>
              <div class="position-relative pt-2 pb-4">
                <div class="price-yearly text-body-secondary price-yearly-toggle d-none ">$888 / year</div>
              </div>
              <p class="text-center">
                A project-based subscription to our toolkit for designing, testing, and launching a single token.
                <br> Perfect for getting your project off the ground.
              </p>
            </div>
          </div>
          <div class="card-body">
            <ul class="list-unstyled pricing-list">
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-label-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  Token Design Studio
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-label-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  Unlimited Testnet deployments
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-label-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  One live Mainnet deployment credit
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-label-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  ERC-standard smart contract
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-label-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  Email support
                </h6>
              </li>
            </ul>
            <div class="d-grid mt-8">
              <a href="{{ config('app.tokenize_app_url') }}" class="btn btn-label-primary">Get Started</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Basic Plan: End -->

      <!-- Favourite Plan: Start -->
      <div class="col-xl-4 col-lg-6">
        <div class="card border border-primary shadow-xl">
          <div class="card-header">
            <div class="text-center">
              <img src="{{ asset('assets/img/front-pages/icons/plane.png') }}" alt="plane icon" class="mb-8 pb-2" />
              <h4 class="mb-0">Business</h4>
              <div class="d-flex align-items-center justify-content-center">
                <span class="price-monthly h2 text-primary fw-extrabold mb-0">$349</span>
                <span class="price-yearly h2 text-primary fw-extrabold mb-0 d-none">$262</span>
                <sub class="h6 text-body-secondary mb-n1 ms-1">/mo</sub>
              </div>
              <div class="position-relative pt-2 pb-4">
                <div class="price-yearly text-body-secondary price-yearly-toggle d-none">$3,144 / year</div>
              </div>
              <p class="text-center">
                A complete white-label platform for serious businesses that want to manage all processes under their own brand.
              </p>
            </div>
          </div>
          <div class="card-body">
            <ul class="list-unstyled pricing-list">
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  Everything in Launchpad, plus
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  White-label platform with your branding
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  Unlimited token issuance
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  Shareholder cap table management
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  Automated dividend payments
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  Priority technical support
                </h6>
              </li>
            </ul>
            <div class="d-grid mt-8">
              <a href="{{ config('app.tokenize_app_url') }}" class="btn btn-primary">Get Started</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Favourite Plan: End -->

      <!-- Standard Plan: Start -->
      <div class="col-xl-4 col-lg-6">
        <div class="card">
          <div class="card-header">
            <div class="text-center">
              <img
                src="{{ asset('assets/img/front-pages/icons/shuttle-rocket.png') }}"
                alt="shuttle rocket icon"
                class="mb-8 pb-2" />
              <h4 class="mb-0">Enterprise</h4>
              <div class="d-flex align-items-center justify-content-center">
                <span class="price-monthly h2 text-primary fw-extrabold mb-0">Custom</span>
                <span class="price-yearly h2 text-primary fw-extrabold mb-0 d-none">Custom</span>
                <sub class="h6 text-body-secondary mb-n1 ms-1">/mo</sub>
              </div>
              {{-- <div class="position-relative pt-2 pb-4">
                <div class="price-yearly text-body-secondary price-yearly-toggle d-none">$8,988 / year</div>
              </div> --}}
              <div>
                <p class="text-center">
                    A comprehensive solution for large companies with unique requirements for features, security, and integration.
                </p>
              </div>
            </div>
          </div>
          <div class="card-body">
            <ul class="list-unstyled pricing-list">
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-label-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  Everything in Business, plus:
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-label-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  Custom feature development
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-label-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  Direct integration with your IT systems
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-label-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  On-premise deployment option
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-label-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  Dedicated Account Manager & SLA
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-label-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  Source code buyout option
                </h6>
              </li>
              <li>
                <h6 class="d-flex align-items-center mb-3">
                  <span class="badge badge-center rounded-pill bg-label-primary p-0 me-3"
                    ><i class="icon-base bx bx-check icon-12px"></i
                  ></span>
                  Sales automation tools
                </h6>
              </li>
            </ul>
            <div class="d-grid mt-8">
              <a href="{{ config('app.tokenize_app_url') }}" class="btn btn-label-primary">Get Started</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Standard Plan: End -->
    </div>
  </div>
