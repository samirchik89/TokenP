@extends('front.layout.main')

@section('title')
    TokenEasy - End-to-end tokenization platform for issuing, managing, and trading all kinds of digital securities.
@endsection
@section('content')
@php
$launchpad_monthly_url = 'https://buy.stripe.com/fZu3cwe9G1N27eldqe9oc00';
$launchpad_yearly_url = 'https://buy.stripe.com/28EaEYfdKgHW8ip3PE9oc03';
$business_monthly_url = 'https://buy.stripe.com/3cI3cwghO9fu7el71Q9oc02';
$business_yearly_url = 'https://buy.stripe.com/bJe9AU3v28bqgOVdqe9oc04';
$enterprise_monthly_url = config('app.tokenize_app_url').'#landingContact';
$enterprise_yearly_url = config('app.tokenize_app_url').'#landingContact';
@endphp

    <!-- Sections:Start -->

    <!-- Pricing Plans -->
    <section class=" first-section-pt">
        @include('front.tarifs', ['isMain' => false])
      </section>
      <!--/ Pricing Plans -->
      <!-- Pricing Free Trial -->
      <section class="pricing-free-trial bg-label-primary">
        <div class="container">
          <div class="position-relative">
            <div class="d-flex justify-content-between flex-column-reverse flex-lg-row align-items-center pt-12 pb-10">
              <div class="text-center text-lg-start">
                <h4 class="text-primary mb-2">Still not convinced? Mint your own test token for free!</h4>
                {{-- <p class="text-body mb-6 mb-md-11">You will get full access to with all the features for 14 days.</p> --}}
                <a href="{{config('app.demo_project_login_url')}}" class="btn btn-primary">Try demo</a>
              </div>
              <!-- image -->
              <div class="text-center">
                <img
                  src="../../assets/img/illustrations/lady-with-laptop-light.png"
                  class="img-fluid me-lg-5 pe-lg-1 mb-3 mb-lg-0"
                  alt="Api Key Image"
                  width="202"
                  data-app-light-img="illustrations/lady-with-laptop-light.png"
                  data-app-dark-img="illustrations/lady-with-laptop-dark.png" />
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--/ Pricing Free Trial -->
      <!-- Plans Comparison -->
      <section class="section-py pricing-plans-comparison">
        <div class="container">
          <div class="col-12 text-center mb-6">
            <h3 class="mb-2">Pricing & Features Comparison</h3>
            {{-- <p>Stay cool, we have a 48-hour money back guarantee!</p> --}}
          </div>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive border border-top-0 rounded">
                <table class="table table-striped text-center mb-0">
                  <thead>
                    <tr>
                      <th scope="col">
                        <p class="mb-50">Feature / Plan</p>
                        {{-- <small class="text-body fw-normal text-capitalize">Native front features</small> --}}
                      </th>
                      <th scope="col">
                        <p class="mb-50">Launchpad</p>
                        {{-- <small class="text-body fw-normal text-capitalize">Free</small> --}}
                        <small class="text-body fw-normal text-capitalize">$59/month</small>
                      </th>
                      <th scope="col">
                        <p class="mb-50 position-relative">
                            Business
                          <span class="badge badge-center rounded-pill bg-primary position-absolute mt-n2 ms-1"
                            ><i class="icon-base bx bx-star"></i
                          ></span>
                        </p>
                        <small class="text-body fw-normal text-capitalize">$299/month</small>
                      </th>
                      <th scope="col">
                        <p class="mb-50">Enterprise</p>
                        <small class="text-body fw-normal text-capitalize">Custom/month</small>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td class="text-heading">Issuer & Investor dashboards</td>
                        <td>
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="icon-base bx bx-check"></i>
                          </span>
                        </td>
                        <td>
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="icon-base bx bx-check"></i>
                          </span>
                        </td>
                        <td>
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="icon-base bx bx-check"></i>
                          </span>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-heading">Add & manage properties/projects</td>
                        <td>
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="icon-base bx bx-check"></i>
                          </span>
                        </td>
                        <td>
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="icon-base bx bx-check"></i>
                          </span>
                        </td>
                        <td>
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="icon-base bx bx-check"></i>
                          </span>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-heading">Onboard investors</td>
                        <td>
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="icon-base bx bx-check"></i>
                          </span>
                        </td>
                        <td>
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="icon-base bx bx-check"></i>
                          </span>
                        </td>
                        <td>
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="icon-base bx bx-check"></i>
                          </span>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-heading">Cap table management</td>
                        <td>
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="icon-base bx bx-check"></i>
                          </span>
                        </td>
                        <td>
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="icon-base bx bx-check"></i>
                          </span>
                          <span class="badge bg-label-primary badge-sm">Advanced</span>
                        </td>
                        <td>
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="icon-base bx bx-check"></i>
                          </span>
                          <span class="badge bg-label-primary badge-sm">Advanced + Custom</span>

                        </td>
                      </tr>
                      <tr>
                        <td class="text-heading">Blockchain support</td>
                        <td>
                            <span class="badge bg-label-primary badge-sm">Ethereum + Polygon</span>
                        </td>
                        <td>
                            <span class="badge bg-label-primary badge-sm">Ethereum + Polygon</span>
                        </td>
                        <td>
                            <span class="badge bg-label-primary badge-sm">Multichain + Custom</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-heading">Testnet token minting</td>
                        <td>
                            <span class="badge bg-label-primary badge-sm">Unlimited</span>
                        </td>
                        <td>
                            <span class="badge bg-label-primary badge-sm">Unlimited</span>
                        </td>
                        <td>
                            <span class="badge bg-label-primary badge-sm">Unlimited</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-heading">Live mainnet token deployments</td>
                        <td>
                            <span class="badge bg-label-primary badge-sm">1/month</span>
                        </td>
                        <td>
                            <span class="badge bg-label-primary badge-sm">Unlimited</span>
                        </td>
                        <td>
                            <span class="badge bg-label-primary badge-sm">Unlimited</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-heading">ERC-standard smart contracts</td>
                        <td>
                            <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                                <i class="icon-base bx bx-check"></i>
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                                <i class="icon-base bx bx-check"></i>
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                                <i class="icon-base bx bx-check"></i>
                            </span>
                            <span class="badge bg-label-primary badge-sm">Customizable</span>
                        </td>
                      </tr>
                     <tr>
                      <td class="text-heading">Secondary token trading</td>
                      <td>
                        <span class="badge bg-label-primary badge-sm">Basic</span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-check"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-check"></i>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-heading">White-label branding (domain + logo)</td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-x"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-check"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-check"></i>
                        </span>
                      </td>
                    </tr>
                    <tr>
                        <td class="text-heading">Number of issuers/projects</td>
                        <td>
                            <span class="badge bg-label-primary badge-sm">1</span>
                        </td>
                        <td>
                            <span class="badge bg-label-primary badge-sm">Unlimited</span>
                        </td>
                        <td>
                            <span class="badge bg-label-primary badge-sm">Unlimited</span>
                        </td>
                      </tr>

                    <tr>
                      <td class="text-heading">Automated dividend payments</td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-x"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-check"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-check"></i>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-heading">Automated investor onboarding</td>
                      <td>
                        <span class="badge bg-label-primary badge-sm">Basic</span>
                      </td>
                      <td>
                        <span class="badge bg-label-primary badge-sm">Advanced</span>
                      </td>
                      <td>
                        <span class="badge bg-label-primary badge-sm"> Custom</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-heading">Custom feature development</td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-x"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-x"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-check"></i>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-heading">Integration with IT systems (CRM, ERP, etc.)</td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-x"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-x"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-check"></i>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-heading">On-premise deployment option</td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-x"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-x"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-check"></i>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-heading">Dedicated Account Manager & SLA</td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-x"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-x"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-check"></i>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-heading">Source code buyout option</td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-x"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-x"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-check"></i>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-heading">Sales automation & CRM tools</td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-x"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-x"></i>
                        </span>
                      </td>
                      <td>
                        <span
                          class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0 d-inline-flex align-items-center justify-content-center">
                          <i class="icon-base bx bx-check"></i>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-heading">Support level</td>
                      <td>
                        <span class="badge bg-label-primary badge-sm">Email support</span>
                      </td>
                      <td>
                        <span class="badge bg-label-primary badge-sm">Priority support</span>
                      </td>
                      <td>
                        <span class="badge bg-label-primary badge-sm">Dedicated SLA</span>
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>
                            <!-- Monthly pricing link -->
                          <a href="{{ $launchpad_monthly_url }}" target="_blank" class="btn btn-primary flex-fill">Month</a>
                          <!-- Yearly pricing link -->
                          <a href="{{ $launchpad_yearly_url }}" target="_blank" class="btn btn-primary flex-fill">Year</a>

                      </td>
                      <td>
                        <!-- Monthly pricing link -->
                        <a href="{{ $launchpad_monthly_url }}" target="_blank" class="btn text-nowrap btn-primary">Month</a>
                        <!-- Yearly pricing link -->
                        <a href="{{ $launchpad_yearly_url }}" target="_blank" class="btn text-nowrap btn-primary">Year</a>
                      </td>
                      <td>
                        <a href="{{config('app.tokenize_app_url').'#landingContact'}}" target="_blank" class="btn btn-primary d-grid w-100">Custom pricing (contact us)</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--/ Plans Comparison -->
      <!-- FAQS -->
      <section class="section-py pricing-faqs rounded-bottom bg-body">
        <div class="container">
          <div class="text-center mb-6">
            <h4 class="mb-2">FAQs</h4>
            <p>Let us help answer the most common questions you might have.</p>
          </div>
          <div class="accordion" id="pricingFaq">
            <div class="card accordion-item">
              <h2 class="accordion-header" id="headingone">
                <button
                  type="button"
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#faq-1"
                  aria-expanded="false"
                  aria-controls="faq-1">
                  What counts towards the 100 responses limit?
                </button>
              </h2>
              <div
                id="faq-1"
                class="accordion-collapse collapse"
                aria-labelledby="headingone"
                data-bs-parent="#pricingFaq">
                <div class="accordion-body">
                  We accept Visa®, MasterCard®, American Express®, and PayPal®. So you can be confident that your
                  credit card information will be kept safe and secure.
                </div>
              </div>
            </div>
            <div class="card accordion-item active">
              <h2 class="accordion-header" id="headingTwo">
                <button
                  type="button"
                  class="accordion-button"
                  data-bs-toggle="collapse"
                  data-bs-target="#faq-2"
                  aria-expanded="false"
                  aria-controls="faq-2">
                  How do you process payments?
                </button>
              </h2>
              <div
                id="faq-2"
                class="accordion-collapse collapse show"
                aria-labelledby="headingTwo"
                data-bs-parent="#pricingFaq">
                <div class="accordion-body">
                  Donec placerat, lectus sed mattis semper, neque lectus feugiat lectus, varius pulvinar diam eros in
                  elit. Pellentesque convallis laoreet laoreet.Donec placerat, lectus sed mattis semper, neque lectus
                  feugiat lectus, varius pulvinar diam eros in elit. Pellentesque convallis laoreet laoreet.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button
                  type="button"
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#faq-3"
                  aria-expanded="false"
                  aria-controls="faq-3">
                  Do you have a money-back guarantee?
                </button>
              </h2>
              <div
                id="faq-3"
                class="accordion-collapse collapse"
                aria-labelledby="headingThree"
                data-bs-parent="#pricingFaq">
                <div class="accordion-body">
                  We count all responses submitted through all your forms in a month. If you already received 100
                  responses this month, you won’t be able to receive any more of them until next month when the counter
                  resets.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h6 class="accordion-header" id="headingFour">
                <button
                  type="button"
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#faq-4"
                  aria-expanded="false"
                  aria-controls="faq-4">
                  I have more questions. Where can I get help?
                </button>
              </h6>
              <div
                id="faq-4"
                class="accordion-collapse collapse"
                aria-labelledby="headingFour"
                data-bs-parent="#pricingFaq">
                <div class="accordion-body">2Checkout accepts all types of credit and debit cards.</div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--/ FAQS -->

      <!-- / Sections:End -->

@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Enhanced pricing toggle with smooth animations
  const priceDurationToggler = document.querySelector('.price-duration-toggler');
  const priceMonthlyList = document.querySelectorAll('.price-monthly');
  const priceYearlyList = document.querySelectorAll('.price-yearly');

  function togglePriceWithAnimation() {
    if (priceDurationToggler.checked) {
      // Switch to yearly
      priceMonthlyList.forEach(function(monthEl) {
        monthEl.style.opacity = '0';
        setTimeout(() => {
          monthEl.classList.add('d-none');
          monthEl.style.opacity = '1';
        }, 150);
      });

      setTimeout(() => {
        priceYearlyList.forEach(function(yearEl) {
          yearEl.classList.remove('d-none');
          yearEl.style.opacity = '0';
          setTimeout(() => {
            yearEl.style.opacity = '1';
          }, 50);
        });
      }, 150);
    } else {
      // Switch to monthly
      priceYearlyList.forEach(function(yearEl) {
        yearEl.style.opacity = '0';
        setTimeout(() => {
          yearEl.classList.add('d-none');
          yearEl.style.opacity = '1';
        }, 150);
      });

      setTimeout(() => {
        priceMonthlyList.forEach(function(monthEl) {
          monthEl.classList.remove('d-none');
          monthEl.style.opacity = '0';
          setTimeout(() => {
            monthEl.style.opacity = '1';
          }, 50);
        });
      }, 150);
    }
  }

  // Add click tracking for analytics
  document.querySelectorAll('a[href*="plan="]').forEach(function(link) {
    link.addEventListener('click', function(e) {
      const url = new URL(this.href);
      const plan = url.searchParams.get('plan');
      const billing = url.searchParams.get('billing');

      // You can add analytics tracking here
      console.log('Plan selected:', plan, 'Billing:', billing);

      // Optional: Add a small delay to show the click was registered
      this.style.transform = 'scale(0.95)';
      setTimeout(() => {
        this.style.transform = 'scale(1)';
      }, 100);
    });
  });

  // Initialize with smooth transitions
  priceMonthlyList.forEach(el => el.style.transition = 'opacity 0.3s ease');
  priceYearlyList.forEach(el => el.style.transition = 'opacity 0.3s ease');

  // Override the existing toggle function
  if (priceDurationToggler) {
    priceDurationToggler.addEventListener('change', togglePriceWithAnimation);
  }
});
</script>
@endpush