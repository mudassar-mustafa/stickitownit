@extends('frontend.layouts.app')
@push('css')
@endpush
@section('content')
    <main>
        <!-- banner area start  -->
        <section class="cp-banner-area cp-bg-1 cp-banner-area1 p-relative cp-banner-height fix">
            <div class="cp-banner-full-video d-none d-xl-block">
                <div class="wrapper add-z-index-1000">
                    <div class="video-info">
                        <div class="video-intro">
                            <input id="video_check" type="checkbox">
                            <div class="intro-title">
                                <h4 class="video-title">play reel</h4>
                                <h4 class="video-title close-video-title">Close play reel</h4>
                            </div>
                            <div class="video">
                                <video autoplay>
                                    <source src="https://www.dropbox.com/s/jgeo7aa43ellilc/video.mp4?raw=1"
                                            type="video/mp4">
                                </video>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="zi-500 p-relative">
                <div class="cp-banner-shape1 p-absolute"></div>
                <div class="cp-banner-shape2 p-absolute"></div>
                <div class="cp-banner-shape6 p-absolute cp-rotation">
                    <img src="{{ asset('assets/img/shape/banner-shape-6.png') }}" alt="shape">
                </div>
                <div class="container">
                    <div class="cp-banner-content-space">
                        <div class="row align-items-center">
                            <div class="col-xl-5 col-lg-6 order-md-2">
                                <div class="cp-banner-img-wrap d-flex justify-content-xl-end mb-85">
                                    <div class="cp-banner-img p-relative">
                                        <div class="cp-banner-3 p-absolute d-none d-xxl-block wow fadeInUp animated"
                                             data-wow-duration="3s" data-wow-delay="2.3s">
                                            <img class="cp-bg-move-x" src="{{ asset('assets/img/shape/banner-shape-3.png') }}"
                                                 alt="img not found">
                                        </div>
                                        <div class="cp-banner-4 p-absolute cp-rotation zi--1">
                                            <img src="{{ asset('assets/img/shape/banner-shape-4.png') }}" alt="img not found">
                                        </div>
                                        <div class="cp-banner-5 p-absolute cp-rotation">
                                            <img src="{{ asset('assets/img/shape/banner-shape-5.png') }}" alt="img not found">
                                        </div>
                                        <div class="wow fadeInUp animated" data-wow-duration="3s">
                                            <div class="js-tilt w-img cp-banner-main-img">
                                                <img src="{{ asset('assets/img/banner/banner-1.jpg') }}" alt="banner">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-6 order-md-1">
                                <div class="cp-banner-content mb-85">
                                    <p class="cp-banner-subtitle mb-45 wow fadeInUp animated" data-wow-duration="1.5s"
                                       data-wow-delay="0.8s">Free shipping on all U.S. <span>min orders
                                 $50+</span></p>
                                    <h2 class="cp-banner-title mb-50 wow fadeInUp animated" data-wow-duration="1.5s"
                                        data-wow-delay="1.1s"> Digital <br> Printing Services</h2>
                                    <p class="cp-banner-text mb-60 wow fadeInUp animated" data-wow-duration="1.5s"
                                       data-wow-delay="1.4s">ABC Printing Co, a solutions-driven graphic communications
                                        company with a history of <br> success connecting brands with consumers.</p>
                                    <div class="cp-banner-btn cp-two-btn wow fadeInUp animated" data-wow-duration="1.5s"
                                         data-wow-delay="1.7s">
                                        <a href="#" class="cp-border-btn">
                                            Our Services
                                            <span class="cp-border-btn__inner">
                                    <span class="cp-border-btn__blobs">
                                       <span class="cp-border-btn__blob"></span>
                                       <span class="cp-border-btn__blob"></span>
                                       <span class="cp-border-btn__blob"></span>
                                       <span class="cp-border-btn__blob"></span>
                                    </span>
                                 </span>
                                        </a>
                                        <a href="contact.html" class="cp-border-btn black">
                                            Discover More
                                            <span class="cp-border-btn__inner">
                                    <span class="cp-border-btn__blobs">
                                       <span class="cp-border-btn__blob"></span>
                                       <span class="cp-border-btn__blob"></span>
                                       <span class="cp-border-btn__blob"></span>
                                       <span class="cp-border-btn__blob"></span>
                                    </span>
                                 </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner area end  -->

        <!-- services area start here  -->
        <section class="cp-services-area pb-85 p-relative z-index-1 mt--140">
            <div class="cp-services-bottom-img p-absolute m-img cp-bg-move-x d-none d-xl-block">
                <img src="{{ asset('assets/img/service/services-7.png') }}" alt="img not found">
            </div>
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-xl-6 col-lg-10 d-xl-none">
                        <div class="cp-services-title-wrap space cp-section-title mb-30 ml-30">
                            <span class="cp-subtitle mb-15">Our Main Services</span>
                            <h2 class="cp-title mb-25">Premier One-stop Custom <span>Print Solutions</span></h2>
                            <p class="mb-50">ABC Printing Co, a solutions-driven graphic communications company with a
                                history
                                of success connecting brands with consumers.</p>
                            <div class="cp-services-btn lh-1">
                                <a class="cp-btn" href="services.html">
                                    View All Services
                                    <span class="cp-btn__inner">
                              <span class="cp-btn__blobs">
                                 <span class="cp-btn__blob"></span>
                                 <span class="cp-btn__blob"></span>
                                 <span class="cp-btn__blob"></span>
                                 <span class="cp-btn__blob"></span>
                              </span>
                           </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="cp-services-item t-center mb-30 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay=".3s">
                            <span class="cp-services-num">01</span>
                            <div class="cp-services-img w-img">
                                <img src="{{ asset('assets/img/service/services-1.jpg') }}" alt="img not found">
                            </div>
                            <h4 class="cp-services-title"><a href="service-details.html">Greeting Cards</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="cp-services-item t-center mb-30 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay=".4s">
                            <span class="cp-services-num">02</span>
                            <div class="cp-services-img w-img">
                                <img src="{{ asset('assets/img/service/services-2.jpg') }}" alt="img not found">
                            </div>
                            <h4 class="cp-services-title"><a href="service-details.html">t-shirt printing</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="cp-services-item t-center mb-30 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay=".5s">
                            <span class="cp-services-num">03</span>
                            <div class="cp-services-img w-img">
                                <img src="{{ asset('assets/img/service/services-3.jpg') }}" alt="img not found">
                            </div>
                            <h4 class="cp-services-title"><a href="service-details.html">Stickers and Labels</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="cp-services-item t-center mb-30 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay=".6s">
                            <span class="cp-services-num">04</span>
                            <div class="cp-services-img w-img">
                                <img src="{{ asset('assets/img/service/services-4.jpg') }}" alt="img not found">
                            </div>
                            <h4 class="cp-services-title"><a href="service-details.html">Business Card Design</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="cp-services-item t-center mb-30 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay="0.7">
                            <span class="cp-services-num">05</span>
                            <div class="cp-services-img w-img">
                                <img src="{{ asset('assets/img/service/services-5.jpg') }}" alt="img not found">
                            </div>
                            <h4 class="cp-services-title"><a href="service-details.html">Stationary design</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="cp-services-item t-center mb-30 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay="0.8s">
                            <span class="cp-services-num">06</span>
                            <div class="cp-services-img w-img">
                                <img src="{{ asset('assets/img/service/services-6.jpg') }}" alt="img not found">
                            </div>
                            <h4 class="cp-services-title"><a href="service-details.html">banner card design</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-10 d-none d-xl-block">
                        <div class="cp-services-title-wrap space cp-section-title mb-30 ml-30 wow fadeInUp animated"
                             data-wow-duration="1.5s" data-wow-delay="0.9s">
                            <span class="cp-subtitle mb-15">Our Main Services</span>
                            <h2 class="cp-title mb-25">Premier One-stop Custom <span>Print Solutions</span></h2>
                            <p class="mb-50">ABC Printing Co, a solutions-driven graphic communications company with a
                                history
                                of success connecting brands with consumers.</p>
                            <div class="cp-services-btn lh-1">
                                <a class="cp-btn" href="services.html">
                                    View All Services
                                    <span class="cp-btn__inner">
                              <span class="cp-btn__blobs">
                                 <span class="cp-btn__blob"></span>
                                 <span class="cp-btn__blob"></span>
                                 <span class="cp-btn__blob"></span>
                                 <span class="cp-btn__blob"></span>
                              </span>
                           </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- services area end here  -->

        <!-- about area start here  -->
        <section class="cp-about-area p-relative pb-115 fix">
            <div class="cp-about-shape-img five m-img cp-bg-move-y">
                <img src="{{ asset('assets/img/about/about-squre.png') }}" alt="img not found">
            </div>
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-8">
                        <div class="cp-about-wrap fade-jr p-relative">
                            <div class="cp-about-shape one p-absolute d-none d-xl-block cp-round-rotation2"></div>
                            <div class="cp-about-shape two p-absolute d-none d-xl-block cp-round-rotation1"></div>
                            <div class="cp-about-shape three p-absolute cp-round-rotation1"></div>
                            <div class="cp-about-shape-img four p-absolute m-img cp-bg-move-y">
                                <img src="{{ asset('assets/img/about/about-2.png') }}" alt="img not found">
                            </div>
                            <div
                                class="js-tilt cp-about-inner ml-5 mr-5 t-center d-flex align-items-center justify-content-center"
                                data-background="assets/img/about/about-round.jpg">
                                <div class="cp-about-content">
                                    <span class="cp-about-subtitle mb-15">About Our Company</span>
                                    <h2 class="cp-about-title mb-70">We are just <br> <span>better Quality</span> <br>
                                        for
                                        over
                                        35 <br> <span>years</span> -</h2>
                                    <div class="cp-about-btn">
                                        <a class="cp-btn-2" href="contact.html">
                                            Contact us
                                            <span class="cp-btn-2__inner">
                                    <span class="cp-btn-2__blobs">
                                       <span class="cp-btn-2__blob"></span>
                                       <span class="cp-btn-2__blob"></span>
                                       <span class="cp-btn-2__blob"></span>
                                       <span class="cp-btn-2__blob"></span>
                                    </span>
                                 </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about area end here  -->

        <!-- feature area start here  -->
        <section class="cp-feature-area p-relative cp-bg-2 zi-1 pt-145 pb-105">
            <div class="cp-feature-img m-img p-absolute zi--1 d-none d-xl-block cp-bg-move-x">
                <img src="{{ asset('assets/img/feature/feature-img.png') }}" alt="feature">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="cp-feature-title-wrap mb-65">
                            <div class="cp-section-title">
                        <span class="cp-subtitle mb-15 wow fadeInUp animated" data-wow-duration="1.5s"
                              data-wow-delay="0.3s">Awesome Features</span>
                                <h2 class="cp-title wow fadeInUp animated" data-wow-duration="1.5s"
                                    data-wow-delay="0.4s">
                                    Top
                                    higher quality <br> <span>features</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="cp-feature-item mb-40 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay="0.5s">
                            <div class="cp-feature-icon mb-30">
                                <img src="{{ asset('assets/img/feature/feature-icon-1.png') }}" alt="feature">
                            </div>
                            <h4 class="cp-feature-title mb-20">Top quality prints</h4>
                            <p class="cp-feature-text">communications det, consec tetur adipiscing elit duis nec fringi
                                communications company</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="cp-feature-item mb-40 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay="0.6s">
                            <div class="cp-feature-icon mb-30">
                                <img src="{{ asset('assets/img/feature/feature-icon-2.png') }}" alt="feature">
                            </div>
                            <h4 class="cp-feature-title mb-20">Mix and match colors</h4>
                            <p class="cp-feature-text">communications det, consec tetur adipiscing elit duis nec fringi
                                communications company</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="cp-feature-item mb-40 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay="0.7s">
                            <div class="cp-feature-icon mb-30">
                                <img src="{{ asset('assets/img/feature/feature-icon-3.png') }}" alt="feature">
                            </div>
                            <h4 class="cp-feature-title mb-20">Shipping worldwide</h4>
                            <p class="cp-feature-text">communications det, consec tetur adipiscing elit duis nec fringi
                                communications company</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="cp-feature-item mb-40 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay="0.8s">
                            <div class="cp-feature-icon mb-30">
                                <img src="{{ asset('assets/img/feature/feature-icon-4.png') }}" alt="feature">
                            </div>
                            <h4 class="cp-feature-title mb-20">Offset Printing</h4>
                            <p class="cp-feature-text">communications det, consec tetur adipiscing elit duis nec fringi
                                communications company</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="cp-feature-item mb-40 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay="0.9s">
                            <div class="cp-feature-icon mb-30">
                                <img src="{{ asset('assets/img/feature/feature-icon-5.png') }}" alt="feature">
                            </div>
                            <h4 class="cp-feature-title mb-20">Made-to-measure</h4>
                            <p class="cp-feature-text">communications det, consec tetur adipiscing elit duis nec fringi
                                communications company</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="cp-feature-item mb-40 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay="1s">
                            <div class="cp-feature-icon mb-30">
                                <img src="{{ asset('assets/img/feature/feature-icon-6.png') }}" alt="feature">
                            </div>
                            <h4 class="cp-feature-title mb-20">Reorder quickly and easily</h4>
                            <p class="cp-feature-text">communications det, consec tetur adipiscing elit duis nec fringi
                                communications company</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="cp-feature-item mb-40 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay="1.1s">
                            <div class="cp-feature-icon mb-30">
                                <img src="{{ asset('assets/img/feature/feature-icon-7.png') }}" alt="feature">
                            </div>
                            <h4 class="cp-feature-title mb-20">Quality Guarantee</h4>
                            <p class="cp-feature-text">communications det, consec tetur adipiscing elit duis nec fringi
                                communications company</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="cp-feature-item mb-40 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay="1.2s">
                            <div class="cp-feature-icon mb-30">
                                <img src="{{ asset('assets/img/feature/feature-icon-8.png') }}" alt="feature">
                            </div>
                            <h4 class="cp-feature-title mb-20">Friendly production processes</h4>
                            <p class="cp-feature-text">communications det, consec tetur adipiscing elit duis nec fringi
                                communications company</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- feature area start end  -->

        <!-- faq area start here  -->
        <section class="cp-faq-area p-relative pt-150 pb-100 fix">
            <div class="cp-faq-shape-area">
                <div class="cp-faq-shape-img cp-faq-shape1 m-img p-absolute zi--1 cp-bg-move-x">
                    <img src="{{ asset('assets/img/faq/faq-shape-1.png') }}" alt="shape">
                </div>
                <div class="cp-faq-shape2 br-50 p-absolute cp-round-rotation1"></div>
                <div class="cp-faq-shape3 br-50 p-absolute cp-round-rotation2"></div>
                <div class="cp-faq-shape4 br-50 p-absolute cp-round-rotation1"></div>
                <div class="cp-faq-shape5 p-absolute d-none d-md-block cp-rotation">
                    <svg width="77" height="91" viewBox="0 0 77 91" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M55.1403 75.1239C66.7298 66.6461 72.5829 54.9314 68.2136 48.9584C63.8442 42.9854 50.9071 45.0159 39.3176 53.4937C27.7281 61.9714 21.875 73.6862 26.2444 79.6592C30.6137 85.6322 43.5508 83.6017 55.1403 75.1239Z"
                            stroke="#FBD017" stroke-width="2.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round"/>
                        <path
                            d="M24.8245 75.4001C24.8245 76.0001 24.9245 76.5001 25.0245 77.0001L1.72447 3.1001C1.52447 2.5001 2.22447 2.0001 2.72447 2.4001L66.1245 47.0001"
                            stroke="#FBD017" stroke-width="2.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="cp-faq-shape6 br-50 p-absolute cp-round-rotation2"></div>
                <div class="cp-faq-shape7 br-50 p-absolute"></div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-10">
                        <div class="cp-faq-img-wrap mb-20 wow fadeInLeft animated" data-wow-delay="0.3s">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="cp-faq-img-item p-relative w-img mb-30">
                                        <div class="cp-img-overlay wow"></div>
                                        <div class="cp-img-blur">
                                            <img src="{{ asset('assets/img/faq/faq-1.jpg') }}" alt="faq">
                                            <img src="{{ asset('assets/img/faq/faq-1.jpg') }}" alt="faq">
                                        </div>
                                    </div>
                                    <div class="cp-faq-img-item p-relative w-img mb-30 js-tilt">
                                        <div class="cp-img-overlay wow"></div>
                                        <div class="cp-img-blur">
                                            <img src="{{ asset('assets/img/faq/faq-3.jpg') }}" alt="faq">
                                            <img src="{{ asset('assets/img/faq/faq-3.jpg') }}" alt="faq">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="cp-faq-img-item p-relative w-img mb-30 js-tilt">
                                        <div class="cp-img-overlay wow"></div>
                                        <div class="cp-img-blur cp-min-height-445">
                                            <img src="{{ asset('assets/img/faq/faq-2.jpg') }}" alt="faq">
                                            <img src="{{ asset('assets/img/faq/faq-2.jpg') }}" alt="faq">
                                        </div>
                                    </div>
                                    <div class="cp-faq-img-item mb-30">
                                        <div class="cp-faq-img-content">
                                            <div class="cp-faq-img-icon m-img">
                                                <img src="{{ asset('assets/img/faq/faq-phone-icon.png') }}" alt="faq">
                                            </div>
                                            <h4>Call us now</h4>
                                            <a href="tel:+910265362003">+91 0265 362 003</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="cp-faq-wrap cp-faq-space pl-60 pr-60 mb-50">
                            <div class="cp-faq-title-wrap mt--5">
                                <div class="cp-section-title mb-35">
                           <span class="cp-subtitle mb-15 wow fadeInUp animated" data-wow-delay="0.3s">First &
                              Quality Service</span>
                                    <h2 class="cp-title wow fadeInUp animated" data-wow-delay="0.4s">how <span>your
                                 products</span> come to life</h2>
                                </div>
                                <p class="cp-faq-text mb-40 wow fadeInUp animated" data-wow-delay="0.5s">ABC Printing
                                    Co, a
                                    solutions-driven graphic communications company
                                    with a history of success connecting brands with consumers. What’s more, we do it
                                    right!
                                    A
                                    full administration printing background.</p>
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item wow fadeInUp animated" data-wow-delay="0.6s">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">Find
                                                the perfect product
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                             aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">Communications det, consec tetur adipiscing elit
                                                duis nec
                                                fringi communications company We build and activate brands through
                                                cultural
                                                insight,
                                                str vision, and.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item wow fadeInUp animated" data-wow-delay="0.7s">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseTwo" aria-expanded="false"
                                                    aria-controls="collapseTwo">We
                                                provide fast on-demand printing
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                             aria-labelledby="headingTwo"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">Communications det, consec tetur adipiscing elit
                                                duis nec
                                                fringi communications company We build and activate brands through
                                                cultural
                                                insight,
                                                str vision, and.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item wow fadeInUp animated" data-wow-delay="0.8s">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseThree" aria-expanded="false"
                                                    aria-controls="collapseThree">Activate brands through cultural
                                                insight
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                             aria-labelledby="headingThree"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">Communications det, consec tetur adipiscing elit
                                                duis nec
                                                fringi communications company We build and activate brands through
                                                cultural
                                                insight,
                                                str vision, and.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- faq area end here  -->

        <!-- team area start here  -->
        <section class="cp-team-area p-relative fix cp-bg-5 pt-145 pb-150">
            <div class="container">
                <div class="cp-team-title-wrap mb-65">
                    <div class="cp-section-title">
                        <span class="cp-subtitle mb-15 wow fadeInUp animated"
                              data-wow-delay=".3s">Our Awesome Team</span>
                        <h2 class="cp-title mb-25 wow fadeInUp animated" data-wow-delay=".4s">Meet the
                            <span>Chapa</span>
                            team
                        </h2>
                        <p class="mb-0 wow fadeInUp animated" data-wow-delay=".5s">Printing for what’s to come. What’s
                            more,
                            we do it right! A <br> full administration
                            printing background.</p>
                    </div>
                    <div class="cp-team-btn line-height1 wow fadeInUp animated" data-wow-delay=".6s">
                        <a class="cp-btn" href="team.html">
                            Join Our Team
                            <span class="cp-btn__inner">
                        <span class="cp-btn__blobs">
                           <span class="cp-btn__blob"></span>
                           <span class="cp-btn__blob"></span>
                           <span class="cp-btn__blob"></span>
                           <span class="cp-btn__blob"></span>
                        </span>
                     </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="cp-team-wrap">
                    <div class="cp-team-inner">
                        <div class="swiper-container cp-team-active">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="cp-team-item wow fadeInUp animated" data-wow-duration="1.5s">
                                        <div class="cp-team-social p-absolute">
                                            <a target="_blank" href="#"><i class="fab fa-facebook"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-youtube"></i></a>
                                        </div>
                                        <div class="cp-team-img w-img mb-20">
                                            <a href="team-details.html"><img src="{{ asset('assets/img/team/team-11.png') }}"
                                                                             alt="team"></a>
                                        </div>
                                        <div class="cp-team-content">
                                            <h4 class="cp-team-name"><a href="team-details.html">Billy Murphy</a></h4>
                                            <span class="cp-team-position">Founder & CEO</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cp-team-item wow fadeInUp animated" data-wow-duration="1.5s">
                                        <div class="cp-team-social p-absolute">
                                            <a target="_blank" href="#"><i class="fab fa-facebook"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-youtube"></i></a>
                                        </div>
                                        <div class="cp-team-img w-img mb-20">
                                            <a href="team-details.html"><img src="{{ asset('assets/img/team/team-12.png') }}"
                                                                             alt="team"></a>
                                        </div>
                                        <div class="cp-team-content">
                                            <h4 class="cp-team-name"><a href="team-details.html">Mr Eli Bell</a></h4>
                                            <span class="cp-team-position">Designer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cp-team-item wow fadeInUp animated" data-wow-duration="1.5s">
                                        <div class="cp-team-social p-absolute">
                                            <a target="_blank" href="#"><i class="fab fa-facebook"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-youtube"></i></a>
                                        </div>
                                        <div class="cp-team-img w-img mb-20">
                                            <a href="team-details.html"><img src="{{ asset('assets/img/team/team-13.png') }}"
                                                                             alt="team"></a>
                                        </div>
                                        <div class="cp-team-content">
                                            <h4 class="cp-team-name"><a href="team-details.html">Harrison Walker</a>
                                            </h4>
                                            <span class="cp-team-position">Marketer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cp-team-item wow fadeInUp animated" data-wow-duration="1.5s">
                                        <div class="cp-team-social p-absolute">
                                            <a target="_blank" href="#"><i class="fab fa-facebook"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-youtube"></i></a>
                                        </div>
                                        <div class="cp-team-img w-img mb-20">
                                            <a href="team-details.html"><img src="{{ asset('assets/img/team/team-14.png') }}"
                                                                             alt="team"></a>
                                        </div>
                                        <div class="cp-team-content">
                                            <h4 class="cp-team-name"><a href="team-details.html">Billy Murphy</a></h4>
                                            <span class="cp-team-position">Founder & CEO</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cp-team-item wow fadeInUp animated" data-wow-duration="1.5s">
                                        <div class="cp-team-social p-absolute">
                                            <a target="_blank" href="#"><i class="fab fa-facebook"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-youtube"></i></a>
                                        </div>
                                        <div class="cp-team-img w-img mb-20">
                                            <a href="team-details.html"><img src="{{ asset('assets/img/team/team-15.png') }}"
                                                                             alt="team"></a>
                                        </div>
                                        <div class="cp-team-content">
                                            <h4 class="cp-team-name"><a href="team-details.html">Mr Eli Bell</a></h4>
                                            <span class="cp-team-position">Designer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cp-team-item wow fadeInUp animated" data-wow-duration="1.5s">
                                        <div class="cp-team-social p-absolute">
                                            <a target="_blank" href="#"><i class="fab fa-facebook"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-youtube"></i></a>
                                        </div>
                                        <div class="cp-team-img w-img mb-20">
                                            <a href="team-details.html"><img src="{{ asset('assets/img/team/team-16.png') }}"
                                                                             alt="team"></a>
                                        </div>
                                        <div class="cp-team-content">
                                            <h4 class="cp-team-name"><a href="team-details.html">Harrison Walker</a>
                                            </h4>
                                            <span class="cp-team-position">Marketer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cp-team-item wow fadeInUp animated" data-wow-duration="1.5s">
                                        <div class="cp-team-social p-absolute">
                                            <a target="_blank" href="#"><i class="fab fa-facebook"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-youtube"></i></a>
                                        </div>
                                        <div class="cp-team-img w-img mb-20">
                                            <a href="team-details.html"><img src="{{ asset('assets/img/team/team-17.png') }}"
                                                                             alt="team"></a>
                                        </div>
                                        <div class="cp-team-content">
                                            <h4 class="cp-team-name"><a href="team-details.html">Billy Murphy</a></h4>
                                            <span class="cp-team-position">Founder & CEO</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cp-team-item wow fadeInUp animated" data-wow-duration="1.5s">
                                        <div class="cp-team-social p-absolute">
                                            <a target="_blank" href="#"><i class="fab fa-facebook"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a>
                                            <a target="_blank" href="#"><i class="fab fa-youtube"></i></a>
                                        </div>
                                        <div class="cp-team-img w-img mb-20">
                                            <a href="team-details.html"><img src="{{ asset('assets/img/team/team-18.png') }}"
                                                                             alt="team"></a>
                                        </div>
                                        <div class="cp-team-content">
                                            <h4 class="cp-team-name"><a href="team-details.html">Billy Murphy</a></h4>
                                            <span class="cp-team-position">Founder & CEO</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cp-team-shape-img p-absolute m-img cp-bg-move-x">
                <img src="{{ asset('assets/img/team/team-shape-1.png') }}" alt="team">
            </div>
        </section>
        <!-- team area end here  -->

        <!-- case study area end here  -->
        <section class="cp-case-study-area pt-145 pb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-7">
                        <div class="cp-case-study-title mb-60 t-center">
                            <div class="cp-section-title">
                        <span class="cp-subtitle mb-15 wow fadeInUp animated" data-wow-delay="0.3s">Our Case
                           Study</span>
                                <h2 class="cp-title wow fadeInUp animated" data-wow-delay="0.4s">Create <span>stunning
                              print</span> <br> for your business</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="cp-case-study-img-wrap">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="cp-case-study-item p-relative tp-img-reveal-item mb-30"
                                         data-subtitle="Design"
                                         data-title="Architect Design" data-fx="1">
                                        <div class="cp-img-overlay wow"></div>
                                        <div class="cp-case-study-img w-img fix">
                                            <a href="project-details.html"><img src="{{ asset('assets/img/case/case-study-1.jpg') }}"
                                                                                alt="study"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="cp-case-study-item p-relative tp-img-reveal-item mb-30"
                                         data-subtitle="Print"
                                         data-title="Custom Greeting Card Printed" data-fx="1">
                                        <div class="cp-img-overlay wow"></div>
                                        <div class="cp-case-study-img w-img fix">
                                            <a href="project-details.html"><img src="{{ asset('assets/img/case/case-study-2.jpg') }}"
                                                                                alt="case-study"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="cp-case-study-item p-relative tp-img-reveal-item mb-30"
                                         data-subtitle="Design"
                                         data-title="Printed Paper Coffee Cup" data-fx="1">
                                        <div class="cp-img-overlay wow"></div>
                                        <div class="cp-case-study-img w-img fix">
                                            <a href="project-details.html"><img src="{{ asset('assets/img/case/case-study-4.jpg') }}"
                                                                                alt="case-study"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="cp-case-study-img-wrap">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="cp-case-study-item p-relative tp-img-reveal-item mb-30"
                                         data-subtitle="Design"
                                         data-title="Printed Plastic Coffee Cup" data-fx="1">
                                        <div class="cp-img-overlay wow"></div>
                                        <div class="cp-case-study-img w-img fix">
                                            <a href="project-details.html"><img src="{{ asset('assets/img/case/case-study-3.jpg') }}"
                                                                                alt="case-study"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="cp-case-study-item p-relative tp-img-reveal-item mb-30"
                                         data-subtitle="Design"
                                         data-title="Custom Greeting Card Printed" data-fx="1">
                                        <div class="cp-img-overlay wow"></div>
                                        <div class="cp-case-study-img w-img fix">
                                            <a href="project-details.html"><img src="{{ asset('assets/img/case/case-study-5.jpg') }}"
                                                                                alt="case-study"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="cp-case-study-item p-relative tp-img-reveal-item mb-30"
                                         data-subtitle="Design"
                                         data-title="Custom Greeting Card Printed" data-fx="1">
                                        <div class="cp-img-overlay wow"></div>
                                        <div class="cp-case-study-img w-img fix">
                                            <a href="project-details.html"><img src="{{ asset('assets/img/case/case-study-6.jpg') }}"
                                                                                alt="case-study"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- case study area end here  -->

        <!-- testimonial area end here  -->
        <div class="cp-testimonial-area p-relative mt-20 mb-150 fadeInUp animated" data-wow-delay="0.4s">
            <div class="cp-testimonial-img-postion">
                <div class="cp-testimonial-img1 br-img-50 m-img p-absolute d-none d-lg-block">
                    <img src="{{ asset('assets/img/testimonial/testimonial-img-2.jpg')  }}" alt="testimonial">
                </div>
                <div class="cp-testimonial-img2 br-img-50 m-img p-absolute d-none d-xxl-block">
                    <img src="{{ asset('assets/img/testimonial/testimonial-img-3.jpg')  }}" alt="testimonial">
                </div>
                <div class="cp-testimonial-img3 br-img-50 m-img p-absolute d-none d-xxl-block">
                    <img src="{{ asset('assets/img/testimonial/testimonial-img-4.jpg')  }}" alt="testimonial">
                </div>
                <div class="cp-testimonial-img4 br-img-50 m-img p-absolute d-none d-lg-block">
                    <img src="{{ asset('assets/img/testimonial/testimonial-img-5.jpg')  }}" alt="testimonial">
                </div>
                <div class="cp-testimonial-img5 br-img-50 m-img p-absolute d-none d-xxl-block">
                    <img src="{{ asset('assets/img/testimonial/testimonial-img-6.jpg')  }}" alt="testimonial">
                </div>
                <div class="cp-testimonial-img6 br-img-50 m-img p-absolute d-none d-xxl-block">
                    <img src="{{ asset('assets/img/testimonial/testimonial-img-7.jpg')  }}" alt="testimonial">
                </div>

            </div>
            <div class="container">
                <div class="cp-testimonial-main-wrap p-relative pt-75">
                    <div class="cp-testimonial-button cp-testimonial-button-prev d-none d-sm-block zi-100"><i
                            class="fas fa-chevron-left"></i>
                    </div>
                    <div class="cp-testimonial-button cp-testimonial-button-next d-none d-sm-block zi-100"><i
                            class="fas fa-chevron-right"></i>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-8">
                            <div class="cp-testimonial-wrap t-center">
                                <div class="swiper-container cp-testimonial-active">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="cp-testimonial-item">
                                                <div class="cp-testimonial-img m-img p-relative mb-50">
                                                    <img src="{{ asset('assets/img/testimonial/testimonial-1.jpg') }}"
                                                         alt="testimonial">
                                                    <div class="cp-testimonial-quotation p-absolute">
                                                        <img src="{{ asset('assets/img/testimonial/testimonial-quotation.png') }}"
                                                             alt="testimonial">
                                                    </div>
                                                </div>
                                                <div class="cp-testimonial-content">
                                                    <p class="cp-testimonial-text mb-25">It is a sequence of Latin words
                                                        that, as
                                                        they are positioned, do not form sentences with a complete
                                                        sense,
                                                        but give
                                                        life to a test text useful to fill spaces that will subsequently
                                                        be
                                                        occupied
                                                        from ad hoc texts composed by communication professionals.</p>
                                                    <div class="cp-testimonial-name-wrap">
                                                        <span class="cp-testimonial-name">Dio Caprio</span>
                                                        <span class="cp-testimonial-bar"></span>
                                                        <span
                                                            class="cp-testimonial-position">CEO - XYZ Innovation</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="cp-testimonial-item">
                                                <div class="cp-testimonial-img m-img p-relative mb-50">
                                                    <img src="{{ asset('assets/img/testimonial/testimonial-2.jpg') }}"
                                                         alt="testimonial">
                                                    <div class="cp-testimonial-quotation p-absolute">
                                                        <img src="{{ asset('assets/img/testimonial/testimonial-quotation.png') }}"
                                                             alt="testimonial">
                                                    </div>
                                                </div>
                                                <div class="cp-testimonial-content">
                                                    <p class="cp-testimonial-text mb-25">People tend to be highly
                                                        influenced
                                                        by
                                                        others, particularly when shopping online. This is why peer
                                                        review
                                                        sites such
                                                        as Yelp, TripAdvisor, FourSquare, GoodReads, and many other
                                                        independent review
                                                        sites are so popular. </p>
                                                    <div class="cp-testimonial-name-wrap">
                                                        <span class="cp-testimonial-name">Mrs Luca</span>
                                                        <span class="cp-testimonial-bar"></span>
                                                        <span class="cp-testimonial-position">Printing Manager</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="cp-testimonial-item">
                                                <div class="cp-testimonial-img m-img p-relative mb-50">
                                                    <img src="{{ asset('assets/img/testimonial/testimonial-3.jpg') }}"
                                                         alt="testimonial">
                                                    <div class="cp-testimonial-quotation p-absolute">
                                                        <img src="{{ asset('assets/img/testimonial/testimonial-quotation.png') }}"
                                                             alt="testimonial">
                                                    </div>
                                                </div>
                                                <div class="cp-testimonial-content">
                                                    <p class="cp-testimonial-text mb-25">This allows your client to get
                                                        their story
                                                        across from their own perspective and lets readers know that
                                                        nobody
                                                        puts
                                                        words in their mouth. It can also get more readers across to
                                                        your
                                                        clients’
                                                        website by linking the post back to their
                                                        blog or landing page.</p>
                                                    <div class="cp-testimonial-name-wrap">
                                                        <span class="cp-testimonial-name">Levi</span>
                                                        <span class="cp-testimonial-bar"></span>
                                                        <span class="cp-testimonial-position">Product Manager</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="cp-testimonial-item">
                                                <div class="cp-testimonial-img m-img p-relative mb-50">
                                                    <img src="{{ asset('assets/img/testimonial/testimonial-4.jpg') }}"
                                                         alt="testimonial">
                                                    <div class="cp-testimonial-quotation p-absolute">
                                                        <img src="{{ asset('assets/img/testimonial/testimonial-quotation.png') }}"
                                                             alt="testimonial">
                                                    </div>
                                                </div>
                                                <div class="cp-testimonial-content">
                                                    <p class="cp-testimonial-text mb-25">You could even ask influencers
                                                        to
                                                        write a
                                                        blog post for their own website that reviews your product or
                                                        services, plus
                                                        the tips they learned through working with you. This gets your
                                                        business in
                                                        front of even more readers and prospective
                                                        target clients.</p>
                                                    <div class="cp-testimonial-name-wrap">
                                                        <span class="cp-testimonial-name">Mr Jon</span>
                                                        <span class="cp-testimonial-bar"></span>
                                                        <span
                                                            class="cp-testimonial-position">Officer - XYZ Innovation</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- testimonial area end here  -->

        <!-- news area end here  -->
        <section class="cp-news3-area p-relative pt-150 pb-150 mb-150 fix">
            <div class="cp-news3-bg2 p-absolute"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-10">
                        <div class="cp-news3-left">
                            <div class="cp-news3-title-wrap mb-40">
                                <div class="cp-section-title">
                           <span class="cp-subtitle mb-15 wow fadeInUp animated" data-wow-delay="0.3s">latest
                              news</span>
                                    <h2 class="cp-title mb-40 wow fadeInUp animated" data-wow-delay="0.4s">read our
                                        <span>latest
                                 news</span></h2>
                                    <p class="wow fadeInUp animated" data-wow-delay="0.5s">It’s safe to say that when it
                                        comes to
                                        custom. we know what we’re doing at Printed.com. Ad
                                        mei modus quodsi.</p>
                                </div>
                            </div>
                            <div class="cp-news3-nav cp-slider-round-button-wrap d-flex zi-5 p-relative mb-60">
                                <div class="cp-slider-round-button cp cp-news3-button-prev"><i
                                        class="fas fa-chevron-left"></i>
                                </div>
                                <div class="cp-slider-round-button cp cp-news3-button-next"><i
                                        class="fas fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="cp-news3-right wow fadeInRight animated" data-wow-delay="0.4s">
                            <div class="swiper-container cp-news3-active">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="cp-news3-item">
                                            <div class="cp-news3-img w-img">
                                                <a href="news-details.html"><img src="{{ asset('assets/img/news/news-1.jpg') }}"
                                                                                 alt="news"></a>
                                            </div>
                                            <div class="cp-news3-content">
                                                <span class="cp-news3-data">January 02, 2023</span>
                                                <h3 class="cp-news-title"><a href="news-details.html">How to Edit a Film
                                                        Score to
                                                        Best
                                                        Serve
                                                        Your Story..</a></h3>
                                                <h5 class="cp-news-post-by">Author : <a href="#">Johann Doe</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="cp-news3-item">
                                            <div class="cp-news3-img w-img">
                                                <a href="news-details.html"><img src="{{ asset('assets/img/news/news-2.jpg') }}"
                                                                                 alt="news"></a>
                                            </div>
                                            <div class="cp-news3-content">
                                                <span class="cp-news3-data">January 03, 2023</span>
                                                <h3 class="cp-news-title"><a href="news-details.html">Can you Scan my
                                                        Hard
                                                        copies
                                                        into Electronic</a></h3>
                                                <h5 class="cp-news-post-by">Author : <a href="#">Mr Don</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="cp-news3-item">
                                            <div class="cp-news3-img w-img">
                                                <a href="news-details.html"><img src="{{ asset('assets/img/news/news-3.jpg') }}"
                                                                                 alt="news"></a>
                                            </div>
                                            <div class="cp-news3-content">
                                                <span class="cp-news3-data">January 02, 2023</span>
                                                <h3 class="cp-news-title"><a href="news-details.html">How to Edit a Film
                                                        Score to
                                                        Best
                                                        Serve
                                                        Your Story..</a></h3>
                                                <h5 class="cp-news-post-by">Author : <a href="#">Johann Doe</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="cp-news3-item">
                                            <div class="cp-news3-img w-img">
                                                <a href="news-details.html"><img src="{{ asset('assets/img/news/news-1.jpg') }}"
                                                                                 alt="news"></a>
                                            </div>
                                            <div class="cp-news3-content">
                                                <span class="cp-news3-data">January 04, 2023</span>
                                                <h3 class="cp-news-title"><a href="news-details.html">What Mockup Type
                                                        Do
                                                        you Accept
                                                        for Printing</a></h3>
                                                <h5 class="cp-news-post-by">Author : <a href="#">Mr Harry</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- news area end here  -->

        <!-- cta area start here  -->
        <section class="cp-cta-area p-relative">
            <div class="cp-cta-top-bg p-absolute"></div>
            <div class="cp-cta-bottom-bg p-absolute cp-bg-6"></div>
            <div class="container">
                <div class="cp-cta-wrap">
                    <div class="row align-items-center">
                        <div class="col-xl-5">
                            <div class="cp-cta-title-wrap mb-40">
                                <div class="cp-section-title lh-1">
                           <span class="cp-subtitle mb-15 wow fadeInUp animated" data-wow-duration="1.5s"
                                 data-wow-delay="0.3s">Get in Touch</span>
                                    <h2 class="cp-title mb-25 wow fadeInUp animated" data-wow-duration="1.5s"
                                        data-wow-delay="0.4s">
                                        <span>Let's talk</span>
                                    </h2>
                                    <p class="mb-45 wow fadeInUp animated" data-wow-duration="1.5s"
                                       data-wow-delay="0.5s">
                                        Printing for
                                        what’s to come. What’s more, we do it right! A <br> full
                                        administration printing background..</p>
                                    <div class="cp-cta-icon-phone wow fadeInUp animated" data-wow-duration="1.5s"
                                         data-wow-delay="0.5s">
                                        <div class="cp-cta-icon">
                                            <img src="{{ asset('assets/img/faq/faq-phone-icon.png') }}" alt="phone">
                                        </div>
                                        <div class="cp-cta-number">
                                            <a href="tel:+910265362003">+91 0265 362 003</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7">
                            <div class="cp-cta-img-wrap mb-40 wow fadeInUp animated" data-wow-duration="1.5s"
                                 data-wow-delay="0.6s">
                                <div class=" cp-cta-img p-relative w-img js-tilt">
                                    <img src="{{ asset('assets/img/cta/cta-img.jpg') }}" alt="cta-img">
                                    <div class="cp-cta-video">
                                        <a class="popup-video play-btn"
                                           href="https://www.youtube.com/watch?v=ngmFMTeIl5A"><i
                                                class="fas fa-play"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- cta area end here  -->

        <!-- floating area start here  -->
        <div class="cp-floating-area d-none d-md-block zi-1100 p-relative ">
            <div class="cp-floating-action cp-bg-move-y">
            <span class="cp-floating-btn cp-floating-phone-btn cp" data-bs-toggle="modal"
                  data-bs-target="#phonePopup"><i class="fal fa-phone-alt"></i></span>
                <span class="cp-floating-btn cp-floating-location-btn cp" data-bs-toggle="modal"
                      data-bs-target="#locationPopup"><i class="fal fa-location-arrow"></i></span>
                <span class="cp-floating-btn cp-floating-form-btn cp" data-bs-toggle="modal"
                      data-bs-target="#formPopup"><i
                        class="fal fa-envelope-open-text"></i></span>
            </div>

            <!-- phone Modal start -->
            <div class="modal fade cp-floating-model" id="phonePopup" data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="phonePopupLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        <div class="cp-floating-item cp-phone-popup" id="phonePopupLabel">
                            <div class="cp-floating-left w-img">
                                <img src="{{ asset('assets/img/cta/popup2.jpg') }}" alt="contact">
                            </div>
                            <div class="cp-floating-text">
                                <h4 class="cp-floating-title">Our <span>Office Time</span></h4>
                                <div class="cp-floating-text-inner">
                           <span class="cp-floating-text-inner-icon">
                              <i class="fal fa-calendar-day"></i>
                           </span>
                                    <span class="cp-floating-text-inner-text">monday - sunday</span>
                                </div>
                                <div class="cp-floating-text-inner">
                           <span class="cp-floating-text-inner-icon">
                              <i class="fal fa-watch"></i>
                           </span>
                                    <span class="cp-floating-text-inner-text">8.00 am - 9.00 pm</span>
                                </div>
                                <div class="cp-floating-text-inner">
                           <span class="cp-floating-text-inner-icon">
                              <i class="far fa-phone-alt"></i>
                           </span>
                                    <span class="cp-floating-text-inner-text"><a
                                            href="tel:+910265362003">+910265362003</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- phone Modal end -->

            <!-- location Modal start -->
            <div class="modal fade cp-floating-model" id="locationPopup" data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="locationPopupLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="cp-floating-item cp-location-popup" id="locationPopupLabel">
                            <div class="cp-floating-left">
                                <div class="cp-floating-location">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d99370.14184006557!2d-77.0846156762382!3d38.89386718919168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m3!3e6!4m0!4m0!5e0!3m2!1sen!2sbd!4v1671881294236!5m2!1sen!2sbd"
                                        style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                            <div class="cp-floating-text">
                                <h4 class="cp-floating-title">know <span>our location</span></h4>
                                <div class="cp-floating-text-inner">
                           <span class="cp-floating-text-inner-icon">
                              <i class="fal fa-location-arrow"></i>
                           </span>
                                    <span class="cp-floating-text-inner-text"><a target="_blank"
                                                                                 href="https://www.google.com/maps/@38.8938672,-77.0846157,12z">88
                                 New Street,
                                 Washington DC,
                                 America</a></span>
                                </div>
                                <div class="cp-floating-text-inner">
                           <span class="cp-floating-text-inner-icon">
                              <i class="fal fa-location-arrow"></i>
                           </span>
                                    <span class="cp-floating-text-inner-text"><a target="_blank"
                                                                                 href="https://www.google.com/maps/@1.952577,44.3912535,3z">100 New
                                 Street, melbon,
                                 Australian</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- location Modal end -->

            <!-- form Modal start -->
            <div class="modal fade cp-floating-model" id="formPopup" data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="formPopupLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="cp-floating-item" id="formPopupLabel">
                            <div class="cp-floating-form-img w-img">
                                <img src="{{ asset('assets/img/cta/cta-img.png') }}" alt="contact">
                            </div>
                            <div class="cp-floating-left cp-signup-popup">
                                <h3 class="cp-floating-title">Do you have any question?</h3>
                                <div class="cp-floating-form">
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="cp-input-field">
                                                    <label for="name">Your Name</label>
                                                    <input type="text" id="name">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="cp-input-field">
                                                    <label for="email">Your Email</label>
                                                    <input type="email" id="email">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="cp-input-field">
                                                    <label for="message">Your question</label>
                                                    <textarea id="message" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="cp-btn mt-20">
                                            send question
                                            <span class="cp-btn__inner">
                                    <span class="cp-btn__blobs">
                                       <span class="cp-btn__blob"></span>
                                       <span class="cp-btn__blob"></span>
                                       <span class="cp-btn__blob"></span>
                                       <span class="cp-btn__blob"></span>
                                    </span>
                                 </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- form Modal end -->
        </div>
        <!-- floating area end here  -->

    </main>
@endsection
@push('js')
@endpush
