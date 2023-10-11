@extends('frontend.layouts.app')
@section('title','Checkout')
@push('css')

@endpush
@section('content')
    <main>
        <!-- error area start here  -->
        <section class="cp-error-area pt-150 pb-140">
            <div class="container">
            <div class="row justify-content-center wow fadeInUp animated" data-wow-duration="1.5s">
                <div class="col-xl-6">
                    <div class="cp-error-wrap t-center">
                        <div class="cp-error-img mb-30 m-img">
                        <img src="assets/img/bg/error.png" alt="error">
                        </div>
                        <h3 class="cp-error-title mb-15">
                        Oops... Looks Like You Goto Lost
                        </h3>
                        <p class="mb-35">The page you are looking for might have been removed had its name changed or is
                        temporarily
                        unavailable.</p>
                        <div class="cp-error-btn">
                        <a href="index.html" class="cp-border-btn">
                            Back To Home
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
        </section>
        <!-- error area end here  -->

        @include('frontend.includes.social')

    </main>
@endsection
@push('js')
<script>
</script>
@endpush
