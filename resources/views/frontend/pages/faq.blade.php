@extends('frontend.layouts.app')
@section('title','FAQ')
@push('css')
@endpush
@section('content')
    <main>

        <!-- page title area start  -->
        <section class="page-title-area breadcrumb-spacing cp-bg-14">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-9">
                        <div class="page-title-wrapper t-center">
                            <h3 class="page-title mb-10">FAQ</h3>
                            <div class="breadcrumb-menu d-flex justify-content-center">
                                <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                                    <ul class="trail-items">
                                        <li class="trail-item trail-begin"><a href="{{ route('/') }}"><span>Home</span></a>
                                        </li>
                                        <li class="trail-item trail-end"><span>FAQ</span></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area start  -->

        <!-- faq area start here  -->
        @include('frontend.partials.faq')
        <!-- faq area end here  -->

        @include('frontend.includes.social')

    </main>

@endsection
@push('js')
@endpush
