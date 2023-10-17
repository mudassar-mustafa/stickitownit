@extends('frontend.layouts.app')
@section('title','Contact Us')
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
                            <h3 class="page-title mb-10">Contact Us</h3>
                            <div class="breadcrumb-menu d-flex justify-content-center">
                                <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                                    <ul class="trail-items">
                                        <li class="trail-item trail-begin"><a href="{{ route('/') }}"><span>Home</span></a>
                                        </li>
                                        <li class="trail-item trail-end"><span>Contact Us</span></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area end  -->

        <!-- contact us area start here  -->
        <section class="cp-contact-area pt-140 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="cp-contact-content mb-70 wow fadeInUp animated" data-wow-duration="1.5s">
                            <h3 class="cp-contact-title mb-20">Let's Talk to us.</h3>
                            <p class="cp-contact-text mb-50">Etiam convallis, felis quis dapibus dictum, libero mauris
                                luctus
                                nunc, <br> fringilla purus ligula non justo. Non fringilla
                                purus ligula justo.</p>
                            <div class="cp-contact-info mb-50">
                                <ul>
                                    <li><i class="far fa-phone-alt"></i><a href="tel:{{ $setting->phone_number }}">{{ $setting->phone_number }}</a></li>
                                    <li><i class="fal fa-envelope"></i><a href="mailto:{{ $setting->email }}">
                                            {{ $setting->email }}</a></li>
                                    <li><i class="fal fa-home-lg-alt"></i><a href="javascript:void(0)">
                                            {{ $setting->address }}</a></li>
                                </ul>
                            </div>
                            <h4 class="cp-contact-subtitle">Administrative Hours</h4>
                            <p class="cp-contact-text mb-0">We’re available from {{ $setting->office_hours }},
                                <br> {{ $setting->office_working_days }} a week.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="cp-contact-form-wrap mb-70 wow fadeInUp animated" data-wow-duration="1.5s">
                            <h3 class="cp-contact-title mb-25">Send us a message</h3>
                            <div class="cp-contact-form">
                                <form action="{{ route('contact-us.store') }}" method="POST" >
                                    @csrf
                                    <div class="cp-input-field">
                                        <label for="name">Your Name (required)</label>
                                        <input type="text" id="name" name="name">
                                        <i class="far fa-user"></i>
                                        @if ($errors->has('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="cp-input-field">
                                        <label for="email">Your E-Mail (required)</label>
                                        <input type="email" name="email" id="email">
                                        <i class="far fa-envelope-open"></i>
                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="cp-input-field textarea">
                                        <label for="message">Type Your Message (required)</label>
                                        <textarea id="message" cols="30" rows="10" name="message"></textarea>
                                        <i class="far fa-edit"></i>
                                        @if ($errors->has('message'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('message') }}
                                            </div>
                                        @endif
                                    </div>
                                    <button type="submit" class="cp-border-btn mt-15">
                                        send message
                                        <span class="cp-border-btn__inner">
                                            <span class="cp-border-btn__blobs">
                                                <span class="cp-border-btn__blob"></span>
                                                <span class="cp-border-btn__blob"></span>
                                                <span class="cp-border-btn__blob"></span>
                                                <span class="cp-border-btn__blob"></span>
                                            </span>
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact us area end here  -->


    </main>

@endsection
@push('js')

@endpush
