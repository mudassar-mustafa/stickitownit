@extends('frontend.layouts.app')
@section('title','Home')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <style>
        html {
            scroll-behavior: smooth;
        }

    </style>
@endpush
@section('content')
    <main>
        <!-- banner area start  -->
        <section class="cp-banner-area cp-bg-1 cp-banner-area1 p-relative cp-banner-height fix">
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
                                            <img class="cp-bg-move-x"
                                                 src="{{ asset('assets/img/shape/banner-shape-3.png') }}"
                                                 alt="img not found">
                                        </div>
                                        <div class="cp-banner-4 p-absolute cp-rotation zi--1">
                                            <img src="{{ asset('assets/img/shape/banner-shape-4.png') }}"
                                                 alt="img not found">
                                        </div>
                                        <div class="cp-banner-5 p-absolute cp-rotation">
                                            <img src="{{ asset('assets/img/shape/banner-shape-5.png') }}"
                                                 alt="img not found">
                                        </div>
                                        <div class="wow fadeInUp animated" data-wow-duration="3s">
                                            <div class="js-tilt w-img cp-banner-main-img">
                                                <img src="{{ asset('storage/uploads/settings/'.$setting->banner_one) }}" alt="banner">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-6 order-md-1">
                                <div class="cp-banner-content mb-85">
                                    <h2 class="cp-banner-title mb-50 wow fadeInUp animated" data-wow-duration="1.5s"
                                        data-wow-delay="1.1s"> {{ $setting->banner_tag_line }}</h2>
                                    <p class="cp-banner-text mb-60 wow fadeInUp animated" data-wow-duration="1.5s"
                                       data-wow-delay="1.4s">{{$setting->banner_tag_line_description}}</p>
                                    <div class="cp-banner-btn cp-two-btn wow fadeInUp animated" data-wow-duration="1.5s"
                                         data-wow-delay="1.7s">
                                        <a href="#generations" class="cp-border-btn">
                                            Generations
                                            <span class="cp-border-btn__inner">
                                    <span class="cp-border-btn__blobs">
                                       <span class="cp-border-btn__blob"></span>
                                       <span class="cp-border-btn__blob"></span>
                                       <span class="cp-border-btn__blob"></span>
                                       <span class="cp-border-btn__blob"></span>
                                    </span>
                                 </span>
                                        </a>
                                        <a href="{{ route('contact-us.index') }}" class="cp-border-btn black">
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
            <!-- <div class="cp-services-bottom-img p-absolute m-img cp-bg-move-x d-none d-xl-block">
                <img src="{{ asset('assets/img/service/services-7.png') }}" alt="img not found">
            </div> -->
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-xl-6 col-lg-10 d-xl-none">
                        <div class="cp-services-title-wrap space cp-section-title mb-30 ml-30">
                            <span class="cp-subtitle mb-15">Our Main Services</span>
                            <h2 class="cp-title mb-25">Premier One-stop Custom <span>Print Solutions</span></h2>
                            <p class="mb-50">ABC Printing Co, a solutions-driven graphic communications company with a
                                history
                                of success connecting brands with consumers.</p>
                        </div>
                    </div>
                    @if(!empty($categories) && count($categories) > 0)
                        @if(count($categories) === 2)
                            <div class="col-xl-3 col-lg-4 col-md-6"></div>
                        @endif
                        @foreach($categories as $key=>$category)

                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="cp-services-item t-center mb-30 wow fadeInUp animated"
                                     data-wow-duration="1.5s"
                                     data-wow-delay=".3s">
                                    <span class="cp-services-num">0{{ $key+1 }}</span>
                                    <div class="cp-services-img w-img">
                                        <img src="{{ $category->image }}" alt="{{ $category->name }}">
                                    </div>
                                    <h4 class="cp-services-title"><a href="#">{{ $category->name }}</a></h4>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if(count($categories) === 2)
                        <div class="col-xl-3 col-lg-4 col-md-6"></div>
                    @endif
                </div>
            </div>
        </section>
        <!-- services area end here  -->


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
                    @if(!empty($features) && count($features) >0)
                        @foreach($features as $key=>$feature)
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="cp-feature-item mb-40 wow fadeInUp animated"
                                     data-wow-duration="1.{{$key+5}}s"
                                     data-wow-delay="0.{{$key+1}}s">
                                    <div class="cp-feature-icon mb-30">
                                        <img src="{{$feature->image}}" alt="{{ $feature->name }}">
                                    </div>
                                    <h4 class="cp-feature-title mb-20">{{ $feature->name }}</h4>
                                    <p class="cp-feature-text">{{ $feature->short_description }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </section>
        <!-- feature area start end  -->

        <!-- about area start here  -->
        <section class="cp-about-area p-relative pb-115 fix" id="generations">
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

                            <div
                                class="js-tilt cp-about-inner ml-5 mr-5 t-center d-flex align-items-center justify-content-center"
                                data-background="assets/img/about/about-round.jpg">
                                <div class="cp-about-content">
                                    <span class="cp-about-subtitle mb-15">About Our Company</span>
                                    <h2 class="cp-about-title mb-70">We are just <br> <span>better Quality</span> <br> for over
                                        35 <br> <span>years</span> -</h2>
                                    <div class="cp-about-btn">
                                        <a class="cp-btn-2" href="{{ route('create.generation') }}">
                                           Generations
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

        <!-- faq area start here  -->

        @include('frontend.partials.faq')
        <!-- faq area end here  -->


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
                                    <p class="wow fadeInUp animated" data-wow-delay="0.5s">
                                        Stay Informed and Inspired – Explore Our Latest Blogs
                                    </p>
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
                                    @if(!empty($blogs) && count($blogs) > 0)
                                        @foreach($blogs as $blog)
                                            <div class="swiper-slide">
                                                <div class="cp-news3-item">
                                                    <div class="cp-news3-img w-img">
                                                        <a href="{{ route('blog.detail',$blog->slug) }}">
                                                            <img
                                                                class="cp-news-card-image"
                                                                src="{{ $blog->image }}"
                                                                alt="{{ $blog->name }}">
                                                            </a>
                                                    </div>
                                                    <div class="cp-news3-content">
                                                        <span
                                                            class="cp-news3-data">{{date('F j, Y', strtotime($blog->created_at))}}</span>
                                                        <h3 class="cp-news-title"><a
                                                                href="{{ route('blog.detail',$blog->slug) }}">{{ $blog->name }}</a>
                                                        </h3>
                                                        <h5 class="cp-news-post-by">Author : <a
                                                                href="javascript:void(0)">{{ $blog->author_name }}</a>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- news area end here  -->

        <div class="cp-brand-area pb-130" >
            <div class="container">
                <div class="row wow fadeInUp animated" data-wow-duration="1.5s" data-wow-delay="0.3">
                    <div class="col-xl-12">
                        <div class="cp-news3-left">
                            <div class="cp-news3-title-wrap mb-40">
                                <div class="cp-section-title text-center">
                                    <h3 class="cp-subtitle mb-15 wow fadeInUp animated sticker-slider-heading" data-wow-delay="0.3s">What we
                                        are printing</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">

                        <div class="cp-brand-wrap">
                            <div class="swiper-container cp-brand-active">
                                <div class="swiper-wrapper">
                                    @if(!empty($stickers) && count($stickers) > 0)
                                        @foreach($stickers as $key=>$sticker)
                                            <div class="swiper-slide">
                                                <div class="cp-brand-img">
                                                    <img 
                                                        class="what-we-are-printing-image"
                                                        src="{{$sticker->image}}" 
                                                        alt="{{$key+1}}.png"
                                                    >
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @include('frontend.includes.social')

    </main>
@endsection
@push('niceSelect')
    <script src="{{ asset('assets/js/nice-select.min.js') }}"></script>
@endpush
