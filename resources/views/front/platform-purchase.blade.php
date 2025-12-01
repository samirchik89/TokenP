@extends('front.layout.main')

@section('title')
    Platform Purchase - TokenEasy
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="section-py landing-hero position-relative" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-text-box">
                        <h1 class="text-white hero-title display-4 fw-bold mb-4">
                            Get Your Own Tokenization Platform
                        </h1>
                        <p class="text-white-50 h5 mb-5">
                            Launch your own tokenization platform with our white-label solution.
                            Start tokenizing real estate, assets, and more in minutes.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="#plans" class="btn btn-light btn-lg">View Plans</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Get Started</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/front-pages/landing-page/hero-dashboard-light.png') }}"
                             alt="Platform" class="img-fluid" style="max-height: 400px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section-py bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Why Choose Our Platform?</h2>
                <p class="text-muted">Everything you need to launch and scale your tokenization business</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="bx bx-shield-check text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">Regulatory Compliant</h5>
                            <p class="card-text">Built with compliance in mind, supporting multiple jurisdictions and regulatory frameworks.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="bx bx-rocket text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">Quick Setup</h5>
                            <p class="card-text">Get your platform up and running in minutes, not months. No technical expertise required.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="bx bx-customize text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">White Label Ready</h5>
                            <p class="card-text">Fully customizable with your branding, colors, and domain. Make it truly yours.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Plans Section -->
    <section id="plans" class="section-py">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Choose Your Plan</h2>
                <p class="text-muted">Start with what you need, scale as you grow</p>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($plans as $plan)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm position-relative {{ $plan['popular'] ? 'border-primary' : '' }}">
                        @if($plan['popular'])
                        <div class="position-absolute top-0 start-50 translate-middle-x">
                            <span class="badge bg-primary px-3 py-2">Most Popular</span>
                        </div>
                        @endif
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h4 class="card-title fw-bold">{{ $plan['name'] }}</h4>
                                <div class="mb-3">
                                    <span class="display-6 fw-bold text-primary">${{ $plan['price'] }}</span>
                                    <span class="text-muted">/{{ $plan['duration'] }}</span>
                                </div>
                            </div>
                            <ul class="list-unstyled mb-4">
                                @foreach($plan['features'] as $feature)
                                <li class="mb-2">
                                    <i class="bx bx-check text-success me-2"></i>
                                    {{ $feature }}
                                </li>
                                @endforeach
                            </ul>
                            <div class="text-center">
                                <a href="{{ route('register') }}?plan={{ $plan['type'] }}"
                                   class="btn {{ $plan['popular'] ? 'btn-primary' : 'btn-outline-primary' }} w-100">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section-py bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-3">Ready to Launch Your Platform?</h3>
                    <p class="mb-4">Join hundreds of companies already using our platform to tokenize their assets.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg">Start Free Trial</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section-py bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Frequently Asked Questions</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    How long does it take to set up my platform?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can have your platform up and running in as little as 24 hours. Our team will handle the initial setup and customization according to your requirements.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Can I customize the platform with my branding?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! All plans include white-label options. You can customize colors, logos, domain names, and more to match your brand identity.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    What payment methods do you accept?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We accept all major credit cards, bank transfers, and cryptocurrency payments including Bitcoin, Ethereum, and USDC.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Is there a free trial available?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! We offer a 14-day free trial for all plans. No credit card required to start your trial.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection