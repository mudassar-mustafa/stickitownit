@extends('frontend.layouts.app')
@section('title',ucfirst(str_replace('-',' ',$slug)) ?? 'Produce Digital Printing With Business Growing')
@section('description','Our mission is to take the pain out of sticker printing and make it simple, fast, and affordable without compromising quality.')
@section('keywords','Stickers, Labels, Printing, Digital Printing')
@section('canonical','https://stickitownit.com')
@section('og-locale','en_US')
@section('og-type','website')
@section('og-title','Stickitownit')
@section('og-description','Our mission is to take the pain out of sticker printing and make it simple, fast, and affordable without compromising quality.')
@section('og-url','https://stickitownit.com')
@section('og-site-name','Stickitownit')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
@endpush
@section('content')
    <main>

        <!-- page title area start  -->
        <section class="page-title-area breadcrumb-spacing cp-bg-12 z-index-zero">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-9">
                        <div class="page-title-wrapper t-center">
                            <h3 class="page-title mb-10">{{ucfirst(str_replace('-',' ',$slug))}}</h3>
                            <div class="breadcrumb-menu d-flex justify-content-center">
                                <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                                    <ul class="trail-items">
                                        <li class="trail-item trail-begin"><a href="{{ route('/') }}"><span>Home</span></a>
                                        </li>
                                        <li class="trail-item trail-end"><span>{{ucfirst(str_replace('-',' ',$slug))}}</span></li>
                                    </ul>


                                </nav>
                            </div>
                            @if (!empty($category) && isset($category->description) && $category->description != "")
                                <p class="my-2">
                                    {{ $category->description }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- page title area start  -->

        <!-- product area start  -->
        <div class="product-area pt-56 pb-10">
            <div class="container">
                <div class="cp-product-wrap mb-60 wow fadeInUp animated" data-wow-duration="1.5s" data-wow-delay="0.3s">

                    <div class="row">
                        @if(!empty($products) && count($products) > 0)
                            @foreach($products as $product)
                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                    <div class="product-single">
                                        <div class="product-thumb">
                                            <a href="{{ route('product.productDetail',$product->slug) }}" class="image">
                                                <img class="pic-1 sticker-page-image" src="{{ $product->main_image }}"
                                                     alt="{{ $product->title }}">
                                                <img class="pic-2 sticker-page-image" src="{{ $product->main_image }}"
                                                     alt="{{ $product->title }}">
                                            </a>
                                        </div>
                                        <div class="product-description">
                                            <h4 class="product-name">
                                                <a href="{{ route('product.productDetail',$product->slug) }}">{{ $product->title }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>

            </div>
        </div>
        <!-- product area end  -->
        <div class="cp-brand-area pb-130">
            <div class="container">
                <div class="row wow fadeInUp animated" data-wow-duration="1.5s" data-wow-delay="0.3">
                    <div class="col-xl-12">
                        <div class="cp-news3-left">
                            <div class="cp-news3-title-wrap mb-40">
                                <div class="cp-section-title text-center">
                                    <h3 class="cp-subtitle mb-15 wow fadeInUp animated sticker-slider-heading"
                                        data-wow-delay="0.3s">What we
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
                                                <div class="cp-brand-image-center">
                                                    <img src="{{$sticker->image}}" alt="{{$key+1}}.png"
                                                         class="what-we-are-printing-image">
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

    </main>
    @include('frontend.includes.social')
@endsection
@push('niceSelect')
    <script src="{{ asset('assets/js/nice-select.min.js') }}"></script>
@endpush
