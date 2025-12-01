    <!-- Footer: Start -->
    <footer class="landing-footer bg-body footer-text">
        <div class="footer-top position-relative overflow-hidden z-1">
          <img
            src="../../assets/img/front-pages/backgrounds/footer-bg.png"
            alt="footer bg"
            class="footer-bg banner-bg-img z-n1" />
          <div class="container">
            <div class="row gx-0 gy-6 g-lg-10">
              <div class="col-lg-5">
                <a href="landing-page.html" class="app-brand-link mb-6">
                  <span class="app-brand-logo demo">
                    <span class="text-primary">
                      <img src="{{ $logo }}" alt="{{$project_name}}" width="80">

                      {{-- <svg
                        width="25"
                        viewBox="0 0 25 42"
                        version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                          <path
                            d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                            id="path-1"></path>
                          <path
                            d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                            id="path-3"></path>
                          <path
                            d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                            id="path-4"></path>
                          <path
                            d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                            id="path-5"></path>
                        </defs>
                        <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                            <g id="Icon" transform="translate(27.000000, 15.000000)">
                              <g id="Mask" transform="translate(0.000000, 8.000000)">
                                <mask id="mask-2" fill="white">
                                  <use xlink:href="#path-1"></use>
                                </mask>
                                <use fill="currentColor" xlink:href="#path-1"></use>
                                <g id="Path-3" mask="url(#mask-2)">
                                  <use fill="currentColor" xlink:href="#path-3"></use>
                                  <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                </g>
                                <g id="Path-4" mask="url(#mask-2)">
                                  <use fill="currentColor" xlink:href="#path-4"></use>
                                  <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                </g>
                              </g>
                              <g
                                id="Triangle"
                                transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                <use fill="currentColor" xlink:href="#path-5"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                              </g>
                            </g>
                          </g>
                        </g>
                      </svg> --}}
                    </span>
                  </span>
                  <span class="app-brand-text demo text-white fw-bold ms-2 ps-1">{{$project_name}}</span>
                </a>
                <p class="footer-text footer-logo-description mb-6">
                    End to end tokenization platform for issuing, managing, and trading digital assets.
                </p>
                <p class="footer-text footer-logo-description mb-6">
                    <Address>
                      {{$address}}
                    </Address>
                    <Phone>
                      {{$phone_number}}
                    </Phone>
                </p>
                {{-- <form class="footer-form">
                  <label for="footer-email" class="small">Subscribe to newsletter</label>
                  <div class="d-flex mt-1">
                    <input
                      type="email"
                      class="form-control rounded-0 rounded-start-bottom rounded-start-top"
                      id="footer-email"
                      placeholder="Your email" />
                    <button
                      type="submit"
                      class="btn btn-primary shadow-none rounded-0 rounded-end-bottom rounded-end-top">
                      Subscribe
                    </button>
                  </div>
                </form> --}}
              </div>
              <div class="col-lg-2 col-md-4 col-sm-6">
                {{-- <h6 class="footer-title mb-6">Demos</h6> --}}
                <ul class="list-unstyled">
                  <li class="mb-4">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#privacyPolicyModal" class="footer-link">Privacy Policy</a>
                  </li>
                  <li class="mb-4">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#termsOfServiceModal" class="footer-link">Terms and Conditions</a>
                  </li>
                  <li class="mb-4">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#cookiePolicyModal" class="footer-link">Cookie Policy</a>
                  </li>
                  <li class="mb-4">
                    <a href="https://calendar.app.google/K1DUEAyzBE5rd8NB9" class="btn btn-primary" target="_blank">
                      <span class="tf-icons icon-base bx bx-calendar scaleX-n1-rtl me-md-1"></span>
                      <span class="d-none d-md-block">Book a Demo </span>
                    </a>
                  </li>
                </ul>
              </div>
              <p class="footer-text footer-logo-description mb-6">
                Disclaimer: TokenEasy does NOT provide or organize trading of financial instruments, serve as an investment intermediary, provide investment services to clients around financial instruments, issue financial instruments, or process payments
              </p>
              {{-- <div class="col-lg-2 col-md-4 col-sm-6">
                <h6 class="footer-title mb-6">Pages</h6>
                <ul class="list-unstyled">
                  <li class="mb-4">
                    <a href="pricing-page.html" class="footer-link">Pricing</a>
                  </li>
                  <li class="mb-4">
                    <a href="payment-page.html" class="footer-link"
                      >Payment<span class="badge bg-primary ms-2">New</span></a
                    >
                  </li>
                  <li class="mb-4">
                    <a href="checkout-page.html" class="footer-link">Checkout</a>
                  </li>
                  <li class="mb-4">
                    <a href="help-center-landing.html" class="footer-link">Help Center</a>
                  </li>
                  <li>
                    <a href="../vertical-menu-template/auth-login-cover.html" target="_blank" class="footer-link"
                      >Login/Register</a
                    >
                  </li>
                </ul>
              </div> --}}
            </div>
          </div>
        </div>
        {{-- <div class="footer-bottom py-3 py-md-5">
          <div
            class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
            <div class="mb-2 mb-md-0">
              <span class="footer-bottom-text"
                >©
                <script>
                  document.write(new Date().getFullYear());
                </script>
              </span>
              <a href="https://themeselection.com" target="_blank" class="text-white">ThemeSelection,</a>
              <span class="footer-bottom-text"> Made with ❤️ for a better web.</span>
            </div>
            <div>
              <a href="https://github.com/themeselection" class="me-4 text-white" target="_blank">
                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M10.7184 2.19556C6.12757 2.19556 2.40674 5.91639 2.40674 10.5072C2.40674 14.1789 4.78757 17.2947 8.0909 18.3947C8.50674 18.4697 8.65674 18.2139 8.65674 17.9939C8.65674 17.7964 8.65007 17.2731 8.64757 16.5806C6.33507 17.0822 5.84674 15.4656 5.84674 15.4656C5.47007 14.5056 4.92424 14.2497 4.92424 14.2497C4.17007 13.7339 4.98174 13.7456 4.98174 13.7456C5.81674 13.8039 6.25424 14.6022 6.25424 14.6022C6.9959 15.8722 8.2009 15.5056 8.67257 15.2931C8.7484 14.7556 8.96507 14.3889 9.20174 14.1814C7.35674 13.9722 5.41674 13.2589 5.41674 10.0731C5.41674 9.16722 5.74091 8.42389 6.27007 7.84389C6.1859 7.63306 5.89841 6.78722 6.35257 5.64389C6.35257 5.64389 7.05007 5.41972 8.63757 6.49472C9.31557 6.31028 10.0149 6.21614 10.7176 6.21472C11.4202 6.21586 12.1196 6.31001 12.7976 6.49472C14.3859 5.41889 15.0826 5.64389 15.0826 5.64389C15.5367 6.78722 15.2517 7.63306 15.1651 7.84389C15.6984 8.42389 16.0184 9.16639 16.0184 10.0731C16.0184 13.2672 14.0767 13.9689 12.2251 14.1747C12.5209 14.4314 12.7876 14.9381 12.7876 15.7131C12.7876 16.8247 12.7776 17.7214 12.7776 17.9939C12.7776 18.2164 12.9259 18.4747 13.3501 18.3931C16.6517 17.2914 19.0301 14.1781 19.0301 10.5072C19.0301 5.91639 15.3092 2.19556 10.7184 2.19556Z"
                    fill="currentColor" />
                </svg>
              </a>
              <a href="https://www.facebook.com/ThemeSelections/" class="me-4 text-white" target="_blank">
                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M11.8609 18.0262V11.1962H14.1651L14.5076 8.52204H11.8609V6.81871C11.8609 6.04704 12.0759 5.51871 13.1834 5.51871H14.5868V3.13454C13.904 3.06136 13.2176 3.02603 12.5309 3.02871C10.4943 3.02871 9.09593 4.27204 9.09593 6.55454V8.51704H6.80676V11.1912H9.10093V18.0262H11.8609Z"
                    fill="currentColor" />
                </svg>
              </a>
              <a href="https://x.com/Theme_Selection" class="me-4 text-white" target="_blank">
                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M17.0576 7.19293C17.0684 7.33876 17.0684 7.48376 17.0684 7.62876C17.0684 12.0663 13.6909 17.1796 7.5184 17.1796C5.61674 17.1796 3.85007 16.6288 2.3634 15.6721C2.6334 15.7029 2.8934 15.7138 3.17424 15.7138C4.68506 15.7174 6.15311 15.2122 7.34174 14.2796C6.64125 14.2669 5.96222 14.0358 5.39943 13.6185C4.83665 13.2013 4.41822 12.6187 4.20257 11.9521C4.41007 11.9829 4.6184 12.0038 4.83674 12.0038C5.13757 12.0038 5.44007 11.9621 5.7209 11.8896C4.9607 11.7361 4.27713 11.3241 3.78642 10.7235C3.29571 10.1229 3.02815 9.37097 3.02924 8.59543V8.55376C3.47674 8.80293 3.9959 8.95876 4.5459 8.9796C4.08514 8.67342 3.70734 8.25795 3.44619 7.77026C3.18504 7.28256 3.04866 6.73781 3.04924 6.1846C3.04924 5.56126 3.21507 4.9896 3.5059 4.49126C4.34935 5.52878 5.40132 6.37756 6.59368 6.98265C7.78604 7.58773 9.0922 7.93561 10.4276 8.00376C10.3759 7.75376 10.3442 7.4946 10.3442 7.2346C10.344 6.79373 10.4307 6.35715 10.5993 5.9498C10.7679 5.54245 11.0152 5.17233 11.3269 4.86059C11.6386 4.54885 12.0088 4.30161 12.4161 4.133C12.8235 3.96438 13.26 3.87771 13.7009 3.87793C14.6676 3.87793 15.5401 4.28293 16.1534 4.93793C16.9049 4.79261 17.6255 4.51828 18.2834 4.1271C18.0329 4.90278 17.5082 5.56052 16.8076 5.9771C17.4741 5.90108 18.1254 5.72581 18.7401 5.4571C18.281 6.12635 17.7122 6.71322 17.0576 7.19293Z"
                    fill="currentColor" />
                </svg>
              </a>
              <a href="https://www.instagram.com/themeselection/" class="text-white" target="_blank">
                <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_1833_185630)">
                    <path
                      d="M17.5869 6.33973C17.5774 5.62706 17.444 4.9215 17.1926 4.25456C16.9747 3.69202 16.6418 3.18112 16.2152 2.75453C15.7886 2.32793 15.2776 1.995 14.7151 1.77703C14.0568 1.5299 13.3613 1.39627 12.6582 1.38183C11.753 1.34137 11.466 1.33008 9.16819 1.33008C6.87039 1.33008 6.57586 1.33008 5.67725 1.38183C4.97451 1.39637 4.27932 1.53 3.62127 1.77703C3.05863 1.99485 2.54765 2.32772 2.12103 2.75434C1.69442 3.18096 1.36155 3.69193 1.14373 4.25456C0.896101 4.91242 0.76276 5.60776 0.749471 6.31056C0.70901 7.2167 0.696777 7.50368 0.696777 9.8015C0.696777 12.0993 0.696777 12.3928 0.749471 13.2924C0.763585 13.9963 0.89626 14.6907 1.14373 15.3503C1.36192 15.9128 1.69503 16.4236 2.1218 16.85C2.54855 17.2765 3.05957 17.6091 3.6222 17.8269C4.27846 18.084 4.97377 18.2272 5.67819 18.2504C6.58433 18.2908 6.87133 18.303 9.16913 18.303C11.4669 18.303 11.7615 18.303 12.6601 18.2504C13.3632 18.2365 14.0587 18.1032 14.717 17.8561C15.2794 17.6378 15.7902 17.3048 16.2167 16.8782C16.6433 16.4517 16.9763 15.941 17.1945 15.3785C17.442 14.7198 17.5746 14.0254 17.5888 13.3207C17.6293 12.4155 17.6414 12.1285 17.6414 9.82973C17.6396 7.53191 17.6396 7.24021 17.5869 6.33973ZM9.16255 14.1468C6.75935 14.1468 4.81251 12.2 4.81251 9.79679C4.81251 7.39359 6.75935 5.44676 9.16255 5.44676C10.3163 5.44676 11.4227 5.90506 12.2385 6.72085C13.0543 7.53664 13.5126 8.64309 13.5126 9.79679C13.5126 10.9505 13.0543 12.057 12.2385 12.8727C11.4227 13.6885 10.3163 14.1468 9.16255 14.1468ZM13.6857 6.3002C13.5525 6.30033 13.4206 6.27417 13.2974 6.22325C13.1743 6.17231 13.0624 6.09759 12.9682 6.00338C12.874 5.90917 12.7992 5.79729 12.7483 5.67417C12.6974 5.55105 12.6712 5.41909 12.6713 5.28585C12.6713 5.15271 12.6976 5.02087 12.7485 4.89786C12.7994 4.77485 12.8742 4.66308 12.9683 4.56893C13.0625 4.47479 13.1743 4.4001 13.2973 4.34915C13.4202 4.2982 13.5521 4.27197 13.6853 4.27197C13.8184 4.27197 13.9503 4.2982 14.0732 4.34915C14.1962 4.4001 14.3081 4.47479 14.4022 4.56893C14.4963 4.66308 14.571 4.77485 14.622 4.89786C14.6729 5.02087 14.6991 5.15271 14.6991 5.28585C14.6991 5.84666 14.2456 6.3002 13.6857 6.3002Z"
                      fill="currentColor" />
                    <path
                      d="M9.16296 12.6226C10.7236 12.6226 11.9887 11.3575 11.9887 9.79688C11.9887 8.23629 10.7236 6.97119 9.16296 6.97119C7.60238 6.97119 6.33728 8.23629 6.33728 9.79688C6.33728 11.3575 7.60238 12.6226 9.16296 12.6226Z"
                      fill="currentColor" />
                  </g>
                  <defs>
                    <clipPath id="clip0_1833_185630">
                      <rect width="16.9412" height="18" fill="currentColor" transform="translate(0.696777 0.528809)" />
                    </clipPath>
                  </defs>
                </svg>
              </a>
            </div>
          </div>
        </div> --}}
      </footer>
      <!-- Footer: End -->

      <!-- Privacy Policy Modal -->
      <div class="modal fade" id="privacyPolicyModal" tabindex="-1" aria-labelledby="privacyPolicyModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="privacyPolicyModalLabel">Privacy Policy</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="text-justify">
                          <p class="mb-3"><strong>Tokeneasy.io ("TokenEasy" "we", "us")</strong> are committed to protecting and respecting your privacy.</p>

                          <p class="mb-3"><strong>Last Update Effective Date:</strong> 18.08.2025</p>

                          <p class="mb-4">This privacy policy applies to the website tokeneasy.io owned and operated by Tokeneasy.io (acting as data controller). This privacy policy describes how TokenEasy collects and uses the personal data you provide on tokeneasy.io. It also describes the choices available to you regarding our use of your personal data and how you can access and update this information (see "Your rights" section for more details).</p>

                          <h5 class="border-bottom pb-2 mb-3">INFORMATION WE MAY COLLECT FROM YOU</h5>
                          <p class="mb-3">We may collect and process the following data about you provided at the time of requesting goods, services or information from us:</p>

                          <ul class="mb-4">
                              <li class="mb-2">Information that you provide to us by filling in forms on our site tokeneasy.io and mobile applications ("Our Site"). This includes contact information such as name, email address, mailing address, phone number, financial information such as bank or brokerage account numbers, unique identifiers such as user name, account number, password, date of birth and preferences information such as favourites lists, transaction history, marketing preferences. If you chose to list your company with us, we may ask for information about your business such as company name, company size, business type and personal data such as a professional profile.</li>
                              <li class="mb-2">Information that you provide to us when you write to us (including by email).</li>
                              <li class="mb-2">Information that you provide to us when we speak to you by telephone. We may make and keep a record of the information you share with us.</li>
                              <li class="mb-2">Information that you provide to us by completing surveys.</li>
                              <li class="mb-2">Details of transactions you carry out through Our Site and of the fulfillment of your orders.</li>
                              <li class="mb-2">Information obtained by us from third parties in accordance with this Privacy Policy.</li>
                          </ul>

                          <p class="mb-3">For example, if you chose to list your business with us, we may obtain additional information from credit reference agencies as a supplementary source.</p>

                          <p class="mb-4">As is true of most web sites, we gather certain information automatically and store it in log files. This information includes internet protocol (IP) addresses, browser type, internet service provider (ISP), referring/exit pages, operating system, date/time stamp, and clickstream data. We use this information, to analyze trends, to administer Our Site, to track users' movements around Our Site and to gather demographic information about our user base as a whole.</p>

                          <h5 class="border-bottom pb-2 mb-3">USES MADE OF THE INFORMATION</h5>
                          <p class="mb-3">We use information held about you in the following ways:</p>

                          <ul class="mb-4">
                              <li class="mb-2">To ensure that content from Our Site is presented in the most effective manner for you and for your computer. This is in our legitimate business interests.</li>
                              <li class="mb-2">To provide you with information, products or services that may be of interest to you, where you have consented to be contacted for such purposes.</li>
                              <li class="mb-2">To carry out our obligations arising from (i) legal obligations and/or (ii) any contracts entered into between you and us to provide information, products or services that you have requested and notify you about changes to our goods and services.</li>
                          </ul>

                          <p class="mb-3">If you are an existing customer/member, we may contact you by electronic means (fax, email or SMS) with information about goods and services similar to those which were the subject of a previous sale to you. We will not otherwise contact you by electronic means to provide you with information about goods and services which may be of interest to you, unless you have consented to this.</p>

                          <p class="mb-4">If you do not want us to use your data in one or more of the ways mentioned above, please let us know by contacting us at info@tokeneasy.io or refer to additional instructions in the "Your rights" portion of this policy.</p>

                          <h5 class="border-bottom pb-2 mb-3">LEGAL BASES FOR PROCESSING (for EEA users)</h5>
                          <p class="mb-3">If you are an individual in the European Area (EEA), we collect and process information about you only where we have legal bases for doing so under applicable EU laws. The legal bases depend on the services you use and how you use them. This means we collect and use information only where:</p>

                          <ul class="mb-4">
                              <li class="mb-2">We need it to provide you the services, including to provide customer support and to protect safety and security of the services;</li>
                              <li class="mb-2">It satisfies a legitimate interest (which is not overridden by your data protection interests), such as for research and development purposes, to market and promote the services and to protect our legal rights and interests;</li>
                              <li class="mb-2">You give us consent to do so for a specific purpose; or</li>
                              <li class="mb-2">We need to process your data to comply with a legal obligation.</li>
                          </ul>

                          <h5 class="border-bottom pb-2 mb-3">DISCLOSURE OF YOUR INFORMATION</h5>
                          <p class="mb-3">We will share your personal data with third parties only in the ways that are described in this privacy policy. We do not sell your personal data to third parties.</p>

                          <p class="mb-3">We may disclose your personal data to any member of our group, which means our subsidiaries, our ultimate holding company and its subsidiaries.</p>

                          <p class="mb-3">In addition to the above, we may disclose your personal data to third parties:</p>

                          <ul class="mb-4">
                              <li class="mb-2">In the event that we sell or buy any business or assets, in which case we may disclose your personal data to the prospective seller or buyer of such business or assets. You will be notified via email and/or prominent notice on Our Site of any change in ownership or uses of your personal data, as well as any choices you may have regarding your personal data.</li>
                              <li class="mb-2">If TokenEasy or substantially all of its assets are acquired by a third party, in which case personal data held by it about its customers will be one of the transferred assets.</li>
                              <li class="mb-2">If we are, or believe in good faith that we are, under a duty to disclose or share your personal data in order to comply with any legal obligation; or permitted by law in order to enforce or apply our Terms and Conditions of Website Use and other agreements; or to protect the rights, property, or safety of us, our customers, or others. This includes exchanging information with other companies and organizations for the purposes of fraud protection and credit risk reduction.</li>
                              <li class="mb-2">If you have registered in order to participate in an investment on tokeneasy.io or one of its clients running tokeneasy.io in a white-label relationship, your personal data may be disclosed to the company (or the company's professional representatives) that you have invested or applied to invest in.</li>
                          </ul>

                          <p class="mb-4">We may provide your personal data to companies that provide services to help us with our business activities such as shipping your order, processing payments, offering customer services or to improve our business operations. These companies are authorized to use your personal data only as necessary to provide these services to us.</p>

                          <h5 class="border-bottom pb-2 mb-3">YOUR RIGHTS</h5>
                          <p class="mb-3">You have the right to access information that is held about you. To protect your privacy and security, we'll take reasonable steps to verify your identity before providing copies of any relevant materials.</p>

                          <p class="mb-3">You may be entitled to ask us:</p>

                          <ul class="mb-4">
                              <li class="mb-2">for a copy of your information;</li>
                              <li class="mb-2">to correct or erase your information;</li>
                              <li class="mb-2">to restrict or stop the processing information;</li>
                              <li class="mb-2">to transfer some of this information to other organizations; and</li>
                              <li class="mb-2">where we have asked for your consent to process your data, to withdraw this consent.</li>
                          </ul>

                          <p class="mb-3">These rights may be limited in some situations – for example, where we can demonstrate that we have a legal requirement to process your data. In some instances, this may mean that we are able to retain data even if you withdraw your consent.</p>

                          <p class="mb-3">Where we require information to comply with legal or contractual obligations, then provision of such data is mandatory: if such information is not provided, then we will not be able to meet obligations placed on us or manage your transactions on Our Site. In all other cases, provision of requested information is optional.</p>

                          <p class="mb-3">We hope that we can satisfy queries you may have about the way we process your information and resolve any complaints you may have. We encourage you to come to us in the first instance but you are entitled to complain directly to the relevant data protection authority.</p>

                          <h5 class="border-bottom pb-2 mb-3">How to exercise your rights</h5>
                          <p class="mb-4">You can correct, change or delete your information in your member account setting page. You can stop receiving our newsletters or marketing emails by following the unsubscribe instructions included in these emails or accessing the email preferences in your account settings page. Alternatively, or to access any of the other above rights, you can email our Customer Support at info@tokeneasy.io or by contacting us by telephone or postal mail at the contact information listed below.</p>

                          <h5 class="border-bottom pb-2 mb-3">HOW LONG WE RETAIN YOUR INFORMATION</h5>
                          <p class="mb-4">We will retain your information for as long as your account is active or as needed to provide you services. We will retain and use your information as necessary to comply with our legal obligations, resolve disputes, and enforce our agreements, which in some cases involving the collection and processing of financial data may require a retention period of 7 years (or longer if required by law).</p>

                          <h5 class="border-bottom pb-2 mb-3">COOKIES and Tracking Technologies</h5>
                          <p class="mb-3">Technologies such as: cookies, beacons, tags and scripts are used by Tokeneasy.io and our partners, including marketing partners affiliates, or analytics service providers and business process service providers. These technologies are used in analyzing trends, administering Our Site, tracking users' movements around Our Site and to gather demographic information about our user base as a whole. We may receive reports based on the use of these technologies by these companies on an individual as well as aggregated basis.</p>

                          <p class="mb-3">We use cookies for to estimate our audience size and usage pattern; to store information about your preferences, and so allow us to customize Our Site according to your individual interests; to speed up your searches; and to recognize you when you return to Our Site. Users can control the use of cookies at the individual browser level. If you reject cookies, you may still use Our Site, but your ability to use some features or areas of Our Site may be limited.</p>

                          <p class="mb-3">Local Storage Objects (Flash/HTML5): Third parties with whom we partner to provide certain features on Our Site or to display advertising based upon your Web Browse activity use LSOs such as HTML 5 or Flash to collect and store information.</p>

                          <p class="mb-3">Various browsers may offer their own management tools for removing HTML5 LSOs. To manage Flash LSOs please click here: <a href="http://www.macromedia.com/support/documentation/en/flashplayer/help/settings_manager07.html" target="_blank">http://www.macromedia.com/support/documentation/en/flashplayer/help/settings_manager07.html</a></p>

                          <p class="mb-4">For detailed information please see the Cookies Policy on our website.</p>

                          <h5 class="border-bottom pb-2 mb-3">HOW WE STORE, PROCESS AND SECURE YOUR INFORMATION</h5>
                          <p class="mb-4">The data that we collect from you may be transferred to, and stored at, a destination inside or outside the European Economic Area ("EEA"). It may also be processed by staff operating inside or outside the EEA who work for us or for one of our suppliers. Such staff maybe engaged in, among other things, the fulfilment of your orders, the processing of your payment details and the provision of support services. Access to your information is limited to those who have a need to manage it. Where your information is transferred from the EEA to a country that is not subject to an adequacy decision by the EU Commission, we will seek to ensure that it is adequately protected by (i) ensuring that EU Commission approved standard contractual clauses, an appropriate Privacy Shield certification or a vendor's Processor Binding Corporate Rules are in place or (ii) relying on derogations (e.g. contractual necessity). A copy of the relevant mechanism can be provided for your review on request, using the contact details provided below.</p>

                          <h5 class="border-bottom pb-2 mb-3">Security</h5>
                          <p class="mb-3">All information you provide to us via email or Our Site is stored on our secure servers.</p>

                          <p class="mb-3">Where we have given you (or where you have chosen) a password which enables you to access certain parts of Our Site, you are responsible for keeping this password confidential. We ask you not to share a password with anyone.</p>

                          <p class="mb-3">The security of your personal data is important to us. When you enter sensitive information (such as bank account information) on our order forms, we encrypt the transmission of that information using secure socket layer technology (SSL).</p>

                          <p class="mb-4">We follow generally accepted standards to protect the personal data submitted to us, both during transmission and once we receive it. No method of transmission over the Internet, or method of electronic storage, is 100% secure, however. Therefore, we cannot guarantee its absolute security. If you have any questions about security on Our Site, you can contact us at info@tokeneasy.io</p>

                          <h5 class="border-bottom pb-2 mb-3">ADDITIONAL PRIVACY INFORMATION</h5>
                          <h6 class="text-primary mb-2">Blog / Discussions</h6>
                          <p class="mb-3">Our Site may offer publicly accessible community discussions. You should be aware that any information you provide in these areas may be read, collected, and used by others who access them. To request removal of your personal data from our community discussions, contact us at info@tokeneasy.io. In some cases, we may not be able to remove your personal data, in which case we will let you know if we are unable to do so and why.</p>

                          <h6 class="text-primary mb-2">Referrals</h6>
                          <p class="mb-3">If you choose to use our referral service to tell a contact about Our Site, we will ask you for your contacts' name and email address. You must have consent from your contact to provide this information to us. We will automatically send your contact a one-time email inviting him or her to visit the site. TokenEasy stores this information for the sole purpose of sending this one-time email and tracking the success of our referral program.</p>

                          <p class="mb-4">Your contact may contact us at info@tokeneasy.io to request that we remove this information from our database.</p>

                          <h5 class="border-bottom pb-2 mb-3">CHANGES TO OUR PRIVACY POLICY</h5>
                          <p class="mb-4">We may update this privacy policy to reflect changes to our information practices. If we make any material changes we will notify you by email (sent to the e-mail address specified in your account) or by means of a notice on Our Site prior to the change becoming effective. We encourage you to periodically review this page for the latest information on our privacy practices.</p>

                          <h5 class="border-bottom pb-2 mb-3">CONTACT</h5>
                          <p class="mb-0">Questions, comments and requests regarding this privacy policy are welcomed and should be addressed to the company's email <a href="mailto:info@tokeneasy.io">info@tokeneasy.io</a>.</p>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>

      <!-- Terms of Service Modal -->
      <div class="modal fade" id="termsOfServiceModal" tabindex="-1" aria-labelledby="termsOfServiceModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="termsOfServiceModalLabel">Terms and Conditions</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="text-justify">
                          <p class="mb-4">This page tells you the terms on which you may use this website (https://tokeneasy.io/) (the "Site"). By using this Site, you indicate that you accept these terms of use and that you agree to abide by them. If you do not agree to these terms of use, please refrain from using this Site.</p>

                          <h5 class="border-bottom pb-2 mb-3">INFORMATION ABOUT US</h5>
                          <p class="mb-4">https://tokeneasy.io/ is a Site operated by Tokeneasy.io ("We").</p>

                          <h5 class="border-bottom pb-2 mb-3">ACCESSING OUR SITE</h5>
                          <p class="mb-3">Access to this Site is permitted on a temporary basis, and we reserve the right to withdraw or amend the service we provide on this Site without notice. We will not be liable if for any reason our site is unavailable at any time or for any period.</p>

                          <p class="mb-3">From time to time, we may restrict your access to some or all of this Site.</p>

                          <p class="mb-4">You are responsible for making all arrangements necessary for you to have access to this Site. You are also responsible for ensuring that all persons who access this Site through your internet connection are aware of these terms, and that they comply with them.</p>

                          <h5 class="border-bottom pb-2 mb-3">INTELLECTUAL PROPERTY RIGHTS</h5>
                          <p class="mb-3">We are the owner or the licensee of all intellectual property rights in this Site, and in the material published on it. Those works are protected by copyright laws and treaties around the world. All such rights are reserved.</p>

                          <p class="mb-3">You must not print off copies or download any extracts from any part of the Site unless expressly authorised by us to do so.</p>

                          <p class="mb-3">If you print off, copy or download any part of our site in breach of these terms of use, your right to use our site will cease immediately and you must, at our option, return or destroy any copies of the materials you have made.</p>

                          <p class="mb-4">We are not responsible for content posted by third parties on our website (including content posted by investees and investors), including the content of pitches, pitch videos, images and content in the discussions. If you believe that any content on our site infringes your intellectual property rights, please send a letter to the address below for the attention of the General Counsel with the following information: (i) evidence of your ownership; (ii) the exact location of the infringing content and any copies. We will review your notice and take appropriate action, including removing such content where appropriate. The address for notices under this provision is:</p>

                          <h5 class="border-bottom pb-2 mb-3">RELIANCE ON INFORMATION POSTED</h5>
                          <p class="mb-4">Commentary and other materials posted on this Site are not intended to amount to advice. We are not liable or responsible for any reliance placed on such materials by you or anyone who you may inform of any of its contents.</p>

                          <h5 class="border-bottom pb-2 mb-3">CHANGES TO THE SITE</h5>
                          <p class="mb-4">We aim to update this Site regularly, and may change the content at any time. If the need arises, we may suspend access to the Site, or close it indefinitely. Any of the material on this Site may be out of date at any given time, and we are under no obligation to update such material.</p>

                          <h5 class="border-bottom pb-2 mb-3">OUR LIABILITY</h5>
                          <p class="mb-3">The material displayed on this Site is provided without any guarantees, conditions or warranties as to its accuracy. To the extent permitted by law, we, other members of our group of companies and third parties connected to us hereby expressly exclude:</p>

                          <ul class="mb-4">
                              <li class="mb-2">All conditions, warranties and other terms which might otherwise be implied by statute, common law or the law of equity.</li>
                              <li class="mb-2">Any liability for any direct, indirect or consequential loss or damage incurred by any user in connection with our site or in connection with the use, inability to use, or results or the use of this Site, any websites linked to it and any materials posted on it, including, without limitation any liability for:</li>
                          </ul>

                          <ul class="mb-4">
                              <li class="mb-2">Loss of income or revenue;</li>
                              <li class="mb-2">Loss of business;</li>
                              <li class="mb-2">Loss of profits or contracts;</li>
                              <li class="mb-2">Loss of anticipated savings;</li>
                              <li class="mb-2">Loss of data;</li>
                              <li class="mb-2">Loss of goodwill;</li>
                              <li class="mb-2">Wasted management or office time;</li>
                              <li class="mb-2">and for any other loss or damage of any kind, however arising and whether caused by tort (including negligence), breach of contract or otherwise, even if foreseeable.</li>
                          </ul>

                          <p class="mb-4">This does not affect our liability for death or personal injury arising from our negligence, nor our liability for fraud or fraudulent misrepresentation, nor any other liability which cannot be excluded or limited under applicable law.</p>

                          <h5 class="border-bottom pb-2 mb-3">INFORMATION ABOUT YOU AND YOUR VISITS TO OUR SITE</h5>
                          <p class="mb-4">We process information about you in accordance with our Privacy Policy. By using this Site, you consent to such processing and you warrant that all data provided by you is accurate.</p>

                          <h5 class="border-bottom pb-2 mb-3">VIRUSES, HACKING AND OTHER OFFENCES</h5>
                          <p class="mb-3">You must not misuse this Site by knowingly introducing viruses, trojans, worms, logic bombs or other material which is malicious or technologically harmful (together "Viruses"). You must not attempt to gain unauthorized access to our site, the server on which our site is stored or any server, computer or database connected to this Site. You must not attack this Site via a denial-of-service attack.</p>

                          <p class="mb-3">By breaching this provision, you may commit a criminal offence under European law. We will report any such breach to the relevant law enforcement authorities and we will co-operate with those authorities by disclosing your identity to them. In the event of such a breach, your rights to use this Site will cease immediately.</p>

                          <p class="mb-4">We will not be liable for any loss or damage caused by a denial-of-service attack or Viruses that may infect your computer equipment, computer programs, data or other proprietary material due to your use of this Site or to your downloading of any material posted on it, or on any website linked to it.</p>

                          <h5 class="border-bottom pb-2 mb-3">LINKING TO OUR SITE AND SCRAPING</h5>
                          <p class="mb-3">You may not link to this Site without our prior written permission.</p>

                          <p class="mb-3">You may not scrape content from this site and repost such content, either manually or automatically, without TokenEasy's prior written consent.</p>

                          <p class="mb-3">This site must not be framed on any other site without our prior written permission.</p>

                          <p class="mb-3">We reserve the right to withdraw linking, scraping and framing permission without notice.</p>

                          <p class="mb-4">If you wish to make any use of material on this Site other than that set out above, please address your request to <a href="mailto:info@tokeneasy.io">info@tokeneasy.io</a>.</p>

                          <h5 class="border-bottom pb-2 mb-3">LINKS FROM OUR SITE</h5>
                          <p class="mb-4">Where this Site links to other sites and resources provided by third parties, these links are provided for your information only. We have no control over the contents of those sites or resources, and accept no responsibility for them or for any loss or damage that may arise from your use of them.</p>

                          <h5 class="border-bottom pb-2 mb-3">JURISDICTION AND APPLICABLE LAW</h5>
                          <p class="mb-4">The courts will have non-exclusive jurisdiction over any claim arising from, or related to, a visit to our site although we retain the right to bring proceedings against you for breach of these conditions in your country of residence or any other relevant country. These terms of use are governed by the law.</p>

                          <h5 class="border-bottom pb-2 mb-3">VARIATIONS</h5>
                          <p class="mb-4">We may revise these terms of use at any time by amending this page. You are expected to check this page from time to time to take notice of any changes we make, as they are binding on you.</p>

                          <h5 class="border-bottom pb-2 mb-3">YOUR CONCERNS</h5>
                          <p class="mb-0">If you have any concerns about material which appears on our site, please contact <a href="mailto:info@tokeneasy.io">info@tokeneasy.io</a>.</p>

                          <p class="mb-0 mt-3">Thank you for visiting our site.</p>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>

      <!-- Cookie Policy Modal -->
      <div class="modal fade" id="cookiePolicyModal" tabindex="-1" aria-labelledby="cookiePolicyModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="cookiePolicyModalLabel">Cookie Policy</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="text-justify">
                          <p class="mb-3">This is the Cookie Policy for TokenEasy.io, accessible from https://tokeneasy.io/</p>

                          <p class="mb-4"><strong>Last updated on:</strong> 09.08.2025</p>

                          <h5 class="border-bottom pb-2 mb-3">What Are Cookies</h5>
                          <p class="mb-4">As is common practice with almost all professional websites this site uses cookies, which are tiny files that are downloaded to your computer, to improve your experience. This page describes what information they gather, how we use it and why we sometimes need to store these cookies. We will also share how you can prevent these cookies from being stored however this may downgrade or 'break' certain elements of the sites functionality.</p>

                          <h5 class="border-bottom pb-2 mb-3">How We Use Cookies</h5>
                          <p class="mb-4">We use cookies for a variety of reasons detailed below. Unfortunately in most cases there are no industry standard options for disabling cookies without completely disabling the functionality and features they add to this site. It is recommended that you leave on all cookies if you are not sure whether you need them or not in case they are used to provide a service that you use.</p>

                          <h5 class="border-bottom pb-2 mb-3">Disabling Cookies</h5>
                          <p class="mb-4">You can prevent the setting of cookies by adjusting the settings on your browser (see your browser Help for how to do this). Be aware that disabling cookies will affect the functionality of this and many other websites that you visit. Disabling cookies will usually result in also disabling certain functionality and features of this site. Therefore it is recommended that you do not disable cookies.</p>

                          <h5 class="border-bottom pb-2 mb-3">The Cookies We Set</h5>

                          <h6 class="text-primary mb-2">Account related cookies</h6>
                          <p class="mb-3">If you create an account with us then we will use cookies for the management of the signup process and general administration. These cookies will usually be deleted when you log out however in some cases they may remain afterwards to remember your site preferences when logged out.</p>

                          <h6 class="text-primary mb-2">Login related cookies</h6>
                          <p class="mb-3">We use cookies when you are logged in so that we can remember this fact. This prevents you from having to log in every single time you visit a new page. These cookies are typically removed or cleared when you log out to ensure that you can only access restricted features and areas when logged in.</p>

                          <h6 class="text-primary mb-2">Email newsletters related cookies</h6>
                          <p class="mb-3">This site offers newsletter or email subscription services and cookies may be used to remember if you are already registered and whether to show certain notifications which might only be valid to subscribed/unsubscribed users.</p>

                          <h6 class="text-primary mb-2">Forms related cookies</h6>
                          <p class="mb-3">When you submit data to through a form such as those found on contact pages or comment forms cookies may be set to remember your user details for future correspondence.</p>

                          <h6 class="text-primary mb-2">Site preferences cookies</h6>
                          <p class="mb-4">In order to provide you with a great experience on this site we provide the functionality to set your preferences for how this site runs when you use it. In order to remember your preferences we need to set cookies so that this information can be called whenever you interact with a page is affected by your preferences.</p>

                          <h5 class="border-bottom pb-2 mb-3">Third Party Cookies</h5>
                          <p class="mb-3">In some special cases we also use cookies provided by trusted third parties. The following section details which third party cookies you might encounter through this site.</p>

                          <p class="mb-3">This site uses Google Analytics which is one of the most widespread and trusted analytics solution on the web for helping us to understand how you use the site and ways that we can improve your experience. These cookies may track things such as how long you spend on the site and the pages that you visit so we can continue to produce engaging content.</p>

                          <p class="mb-3">For more information on Google Analytics cookies, see the official Google Analytics page.</p>

                          <p class="mb-3">Third party analytics are used to track and measure usage of this site so that we can continue to produce engaging content. These cookies may track things such as how long you spend on the site or pages you visit which helps us to understand how we can improve the site for you.</p>

                          <p class="mb-3">The Google AdSense service we use to serve advertising uses a DoubleClick cookie to serve more relevant ads across the web and limit the number of times that a given ad is shown to you.</p>

                          <p class="mb-3">For more information on Google AdSense see the official Google AdSense privacy FAQ.</p>

                          <p class="mb-4">We also use social media buttons and/or plugins on this site that allow you to connect with your social network in various ways. For these to work the following social media sites including; Youtube, Facebook, Twitter, Telegram and LinkedIn, will set cookies through our site which may be used to enhance your profile on their site or contribute to the data they hold for various purposes outlined in their respective privacy policies.</p>

                          <p class="mb-3">Specifically, the following third-party Cookies may be placed on your computer or device:</p>

                          <div class="table-responsive">
                              <table class="table table-bordered table-striped">
                                  <thead class="table-light">
                                      <tr>
                                          <th>Name of Cookie</th>
                                          <th>Provider</th>
                                          <th>Purpose</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>Bing.com</td>
                                          <td>Microsoft Corporation</td>
                                          <td>Advertisement</td>
                                      </tr>
                                      <tr>
                                          <td>Clarity.ms</td>
                                          <td>Microsoft Corporation</td>
                                          <td>Analytics</td>
                                      </tr>
                                      <tr>
                                          <td>Facebook.com/Facebook Pixel</td>
                                          <td>Facebook Inc</td>
                                          <td>Advertisement Analytics</td>
                                      </tr>
                                      <tr>
                                          <td>Linkedin.com/Ads.linkedin.com</td>
                                          <td>Microsoft Corporation</td>
                                          <td>Advertisement Analytics</td>
                                      </tr>
                                      <tr>
                                          <td>Youtube.com</td>
                                          <td>Google</td>
                                          <td>Advertisement Analytics</td>
                                      </tr>
                                      <tr>
                                          <td>Twitter.com/Twitter Pixel</td>
                                          <td>Twitter</td>
                                          <td>Advertisement</td>
                                      </tr>
                                      <tr>
                                          <td>Ads.google.com</td>
                                          <td>Google</td>
                                          <td>Advertisement</td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>

                          <h5 class="border-bottom pb-2 mb-3">More Information</h5>
                          <p class="mb-3">If you are still looking for more information then you can contact us through one of our preferred contact methods:</p>

                          <p class="mb-0"><strong>Email:</strong> <a href="mailto:info@tokeneasy.io">info@tokeneasy.io</a></p>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>

      <!-- Overlay for modal close effect -->
      <div class="modal-overlay" id="modalOverlay"></div>
