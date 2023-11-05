@extends('frontend.layouts.app')
@section('title','Blogs')
@push('css')
@endpush
@section('content')
    <main>


        <!-- news area start here  -->
        <div class="cp-news-area cp-bg-19 pt-150 pb-150">
            <div class="container">
                <div class="row">
                    @if(!empty($blogs) && count($blogs) > 0)
                        @foreach($blogs as $key=>$blog)
                            <div class="col-xl-4 col-md-6">
                                <article>
                                    <div class="cp-news-item white-bg mb-40 wow fadeInUp animated"
                                         data-wow-duration="1.{{$key}}s"
                                         data-wow-delay="0.{{$key}}">
                                        <div class="cp-news-img fix p-relative w-img blogs-card-div">
                                            <div class="cp-img-overlay wow"></div>
                                            <a href="{{ route('blog.detail',$blog->slug) }}">
                                                <img src="{{ $blog->image }}" alt="{{ $blog->name }}"  class="blogs-card-div-img">
                                            </a>
                                        </div>
                                        <div class="cp-news-content one blog-card-description-container">
                                            <div class="cp-news1-meta">
                                                <span>{{date('F j, Y', strtotime($blog->created_at))}}</span>
                                            </div>
                                            <h3 class="cp-news-title"><a href="{{ route('blog.detail',$blog->slug) }}">{{ $blog->name }}</a>
                                            </h3>
                                            <h5 class="cp-news-post-by">Author : <a
                                                    href="javascript:void(0)">{{ $blog->author_name }}</a></h5>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    @endif

                </div>
                {!! $blogs->links('pagination::bootstrap-5') !!}

            </div>
        </div>
        <!-- news area end here  -->


    </main>
    @include('frontend.includes.social')
@endsection
@push('js')
@endpush
