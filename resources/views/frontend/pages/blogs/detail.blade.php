@extends('frontend.layouts.app')

@section('title',$blog->meta_title ?? 'Produce Digital Printing With Business Growing')
@section('description',$blog->meta_description ?? 'Our mission is to take the pain out of sticker printing and make it simple, fast, and affordable without compromising quality.')
@section('keywords',$blog->meta_keywords ?? 'Stickers, Labels, Printing, Digital Printing')
@section('canonical','https://stickitownit.com')
@section('og-locale','en_US')
@section('og-type','website')
@section('og-title','Stickitownit')
@section('og-description','Our mission is to take the pain out of sticker printing and make it simple, fast, and affordable without compromising quality.')
@section('og-url','https://stickitownit.com')
@section('og-site-name','Stickitownit')
@section('og-image',$blog->image)
@push('css')
@endpush
@section('content')
    <!-- news area start here  -->
    <section class="cp-news-details-area white-bg pt-150 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="cp-news-details-wrap pr-30">
                        <div class="wow fadeInUp animated" data-wow-duration="1.5s" data-wow-delay="0.3">
                            <div class="cp-news-details-img p-relative w-img">
                                <div class="cp-img-overlay wow"></div>
                                <img src="{{ $blog->image }}" alt="news">
                            </div>
                            <div class="cp-news-details-content mb-40">
                                <div class="cp-news1-meta mb-25">
                                    <span><a href="javascript:void(0)">

                                            @if(!empty($blog->categories) && count($blog->categories) > 0)
                                                @foreach($blog->categories as $category)
                                                    {{$category->name}}@if($loop->index >= 0 && $loop->index < count($blog->categories) - 1)
                                                        ,&nbsp;
                                                    @endif
                                                @endforeach
                                            @endif
                                        </a></span>
                                    <span>{{date('F j, Y', strtotime($blog->created_at))}}</span>
                                    {{--                                    <span><a href="javascript:void(0)"><i class="fal fa-comments"></i> 04--}}
                                    {{--                                    Comments</a></span>--}}
                                </div>
                                <h2 class="cp-news2-title mb-25">{{ $blog->name }}</h2>
                                {!! $blog->description !!}
                                <div
                                    class="cp-news-details-tag-wrap d-flex align-items-center justify-content-between cp-news-border-top-bottom">
                                    <div class="cp-news-details-tag d-flex align-items-center flex-wrap">
                                        <h5 class="line-height1 mb-0">Tags :</h5>
                                        <div class="cp-news-details-tag-list line-height1">
                                            @if(!empty($blog->tags) && count($blog->tags) > 0)
                                                @foreach($blog->tags as $tags)
                                                    <a href="javascript:void(0)">{{ $tags->name }}</a>@if($loop->index >= 0 && $loop->index < count($blog->tags) - 1)
                                                        ,
                                                    @endif
                                                @endforeach
                                            @endif


                                        </div>
                                    </div>
                                    {{--                                    <div class="cp-news-share t-right">--}}
                                    {{--                                        <div class="cp-news-social-link two d-xl-none">--}}
                                    {{--                                            <ul>--}}
                                    {{--                                                <li>--}}
                                    {{--                                                    <a onclick="window.open('http://www.facebook.com/sharer.php?u={{route('blog.detail',$blog->slug)}}','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"--}}
                                    {{--                                                       href="http://www.facebook.com/sharer.php?u={{route('blog.detail',$blog->slug)}}"><i class="fab fa-facebook"></i></a></li>--}}
                                    {{--                                                <li><a href="http://twitter.com/share?url={{route('blog.detail',$blog->slug)}}&text={{$blog->name}}"--}}
                                    {{--                                                    onclick="window.open('http://twitter.com/share?url={{route('blog.detail',$blog->slug)}}&text={{$blog->name}}','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"--}}
                                    {{--                                                    ><i class="fab fa-twitter"></i></a></li>--}}
                                    {{--                                                <li><a href="https://www.linkedin.com/cws/share?url={{route('blog.detail',$blog->slug)}}&text={{$blog->name}}"--}}
                                    {{--                                                    onclick="window.open('https://www.linkedin.com/cws/share?url={{route('blog.detail',$blog->slug)}}&text={{$blog->name}}','Linkedin share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"--}}
                                    {{--                                                    ><i class="fab fa-linkedin-in"></i></a></li>--}}

                                    {{--                                            </ul>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="cp-news-share-text p-relative d-none d-xl-block">--}}
                                    {{--                                            <span>Share <i class="far fa-share-alt"></i></span>--}}
                                    {{--                                            <div class="cp-news-social-link p-absolute">--}}
                                    {{--                                                <ul>--}}
                                    {{--                                                    <li>--}}
                                    {{--                                                        <a onclick="window.open('http://www.facebook.com/sharer.php?u={{route('blog.detail',$blog->slug)}}','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"--}}
                                    {{--                                                           href="http://www.facebook.com/sharer.php?u={{route('blog.detail',$blog->slug)}}"><i class="fab fa-facebook"></i></a></li>--}}
                                    {{--                                                    <li><a href="http://twitter.com/share?url={{route('blog.detail',$blog->slug)}}&text={{$blog->name}}"--}}
                                    {{--                                                           onclick="window.open('http://twitter.com/share?url={{route('blog.detail',$blog->slug)}}&text={{$blog->name}}','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"--}}
                                    {{--                                                        ><i class="fab fa-twitter"></i></a></li>--}}
                                    {{--                                                    <li><a href="https://www.linkedin.com/cws/share?url={{route('blog.detail',$blog->slug)}}&text={{$blog->name}}"--}}
                                    {{--                                                           onclick="window.open('https://www.linkedin.com/cws/share?url={{route('blog.detail',$blog->slug)}}&text={{$blog->name}}','Linkedin share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"--}}
                                    {{--                                                        ><i class="fab fa-linkedin-in"></i></a></li>--}}
                                    {{--                                                </ul>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                        @if(!empty($relatedBlogs) && count($relatedBlogs) > 0)
                            <div class="cp-news2-d-related-post mb-60 wow fadeInUp animated" data-wow-duration="1.5s"
                                 data-wow-delay="0.3">
                                <div class="cp-news2-d-related-wrap mb-30">
                                    <h4 class="cp-news2-subtitle mb-0 line-height1">Related Post</h4>
                                    <div class="cp-news2-d-related-wrap">
                                        <div class="cp-news2-d-related-navigation">
                                            <button class="cp-news2-button-prev"><i class="fas fa-chevron-left"></i>
                                            </button>
                                            <button class="cp-news2-button-next"><i class="fas fa-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-container cp-news2-related-active">
                                    <div class="swiper-wrapper">

                                        @foreach($relatedBlogs as $relatedBlog)
                                            <div class="swiper-slide">
                                                <article>
                                                    <div class="cp-news-item">
                                                        <div class="cp-news-img fix p-relative ">
                                                            <div class="cp-img-overlay wow"></div>
                                                            <a href="{{ route('blog.detail',$relatedBlog->slug) }}">
                                                                <img
                                                                    src="{{ $relatedBlog->image }}"
                                                                    alt="{{ $relatedBlog->name }}"
                                                                >
                                                            </a>
                                                        </div>
                                                        <div class="cp-news-content one">
                                                            <div class="cp-news1-meta mb-25">
                                                                <span>{{date('F j, Y', strtotime($relatedBlog->created_at))}}</span>
                                                            </div>
                                                            <h3 class="cp-news-title"><a
                                                                    href="{{ route('blog.detail',$relatedBlog->slug) }}">{{ $relatedBlog->name }}</a>
                                                            </h3>
                                                            <h5 class="cp-news-post-by">Author : <a
                                                                    href="javascript:void(0)">{{ $relatedBlog->author_name }}</a>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        @endif
                        {{--                        <div class="post-comments mb-60 wow fadeInUp animated" data-wow-duration="1.5s"--}}
                        {{--                             data-wow-delay="0.3">--}}
                        {{--                            <div class="post-comment-title">--}}
                        {{--                                <h3 class="cp-news2-subtitle mb-35">3 Comments</h3>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="latest-comments">--}}
                        {{--                                <ul>--}}
                        {{--                                    <li>--}}
                        {{--                                        <div class="comments-box">--}}
                        {{--                                            <div class="comments-avatar">--}}
                        {{--                                                <img src="{{ asset('assets/img/news/author-2.jpg') }}" class="img-fluid"--}}
                        {{--                                                     alt="img">--}}
                        {{--                                            </div>--}}
                        {{--                                            <div class="comments-text">--}}
                        {{--                                                <div class="avatar-name">--}}
                        {{--                                                    <h5>David Angel Makel</h5>--}}
                        {{--                                                    <span class="post-meta">February 26, 2022</span>--}}
                        {{--                                                </div>--}}
                        {{--                                                <p>The bee's knees bite your arm off bits and bobs he nicked it gosh--}}
                        {{--                                                    gutted mate--}}
                        {{--                                                    blimey, old off his nut argy bargy vagabond buggered dropped.</p>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </li>--}}
                        {{--                                </ul>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="post-comment-form mb-40 wow fadeInUp animated" data-wow-duration="1.5s"--}}
                        {{--                             data-wow-delay="0.3">--}}
                        {{--                            <h3 class="cp-news2-subtitle mb-35">Leave a Reply</h3>--}}
                        {{--                            <div class="bd-contact-form-wrapper mb-10">--}}
                        {{--                                <form action="#">--}}
                        {{--                                    <div class="row">--}}
                        {{--                                        <div class="col-xl-12">--}}
                        {{--                                            <div class="cp-input-field">--}}
                        {{--                                                <label for="name">Your Full Name</label>--}}
                        {{--                                                <input id="name" type="text">--}}
                        {{--                                                <i class="far fa-user"></i>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="col-xl-6">--}}
                        {{--                                            <div class="cp-input-field">--}}
                        {{--                                                <label for="email">Your Email</label>--}}
                        {{--                                                <input type="email" id="email">--}}
                        {{--                                                <i class="far fa-envelope"></i>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="col-xl-6">--}}
                        {{--                                            <div class="cp-input-field">--}}
                        {{--                                                <label for="browser">Your Website</label>--}}
                        {{--                                                <input type="url" id="browser">--}}
                        {{--                                                <i class="far fa-browser"></i>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="col-xl-12">--}}
                        {{--                                            <div class="cp-input-field textarea">--}}
                        {{--                                                <label for="message">Write Your message</label>--}}
                        {{--                                                <textarea id="message"></textarea>--}}
                        {{--                                                <i class="far fa-edit"></i>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="col-xl-12">--}}
                        {{--                                            <div class="comment-reply-btn mt-20">--}}
                        {{--                                                <button type="submit" class="cp-border-btn">--}}
                        {{--                                                    submit Comment--}}
                        {{--                                                    <span class="cp-border-btn__inner">--}}
                        {{--                                             <span class="cp-border-btn__blobs">--}}
                        {{--                                                <span class="cp-border-btn__blob"></span>--}}
                        {{--                                                <span class="cp-border-btn__blob"></span>--}}
                        {{--                                                <span class="cp-border-btn__blob"></span>--}}
                        {{--                                                <span class="cp-border-btn__blob"></span>--}}
                        {{--                                             </span>--}}
                        {{--                                          </span>--}}
                        {{--                                                </button>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </form>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="cp-news-sidebar">
                        <div class="cp-news-widget mb-40 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay="0.3">
                            <h4 class="cp-news-widget-title">Posted Category</h4>
                            <div class="cp-news-widget-cat">
                                <ul>
                                    @if(!empty($blogCategories) && count($blogCategories) > 0)
                                        @foreach($blogCategories as $category)
                                            <li><a href="javascript:void(0)">{{$category->name}}
                                                    <span>{{ $category->blogs_count }}</span></a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="cp-news-widget mb-40 wow fadeInUp animated" data-wow-duration="1.5s"
                             data-wow-delay="0.3">
                            <h4 class="cp-news-widget-title">Popular Tags</h4>
                            <div class="cp-tag">
                                @if(!empty($blog->tags) && count($blog->tags) > 0)
                                    @foreach($blog->tags as $tags)
                                        <a href="javascript:void(0)">{{ $tags->name }}</a>
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
    @include('frontend.includes.social')
@endsection
@push('js')
@endpush
