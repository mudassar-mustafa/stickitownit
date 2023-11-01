@extends('frontend.layouts.app')
@section('title','Get a Quote')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-container {
            width: 100% !important;
        }
        .select2-container--default .select2-selection--single{
            height: 57px !important;
        }
        .select2-container .select2-selection--single .select2-selection__rendered{
            padding-top: 13px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            top: 17px !important;
        }

    </style>
@endpush
@section('content')
    <main>

        <!-- page title area start  -->
        <section class="page-title-area breadcrumb-spacing cp-bg-14">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-9">
                        <div class="page-title-wrapper t-center">
                            <h3 class="page-title mb-10">Get a Quote</h3>
                            <div class="breadcrumb-menu d-flex justify-content-center">
                                <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                                    <ul class="trail-items">
                                        <li class="trail-item trail-begin"><a href="{{ route('/') }}"><span>Home</span></a></li>
                                        <li class="trail-item trail-end"><span>Request a Quote</span></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area end  -->

        <!-- quote area start  -->
        <section class="cp-quote-area pt-150">
            <div class="container">
                <div class="row justify-content-center wow fadeInUp animated" data-wow-duration="1.5s">
                    <div class="col-xl-8">
                        <div class="cp-quote-wrapper cp-border5">
                            <div class="cp-quote-form">
                                <form method="POST" action="{{ route('get-quote.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="cp-quote-box mb-40">
                                        <h3 class="cp-quote-title"><span>Personal Information</span></h3>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="name">Your name</label>
                                                    <input type="text" id="name" name="name">
                                                    <i class="far fa-user"></i>
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="email">E-mail</label>
                                                    <input type="email" id="email" name="email">
                                                    <i class="far fa-envelope-open"></i>
                                                    @if ($errors->has('email'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('email') }}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="phone">Phone number</label>
                                                    <input type="text" id="phone" name="phone">
                                                    <i class="far fa-phone"></i>
                                                    @if ($errors->has('phone'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('phone') }}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="country">Country</label>
                                                    <select id="country" name="country" class="js-example-basic-single">
                                                        @if(!empty($countries) && count($countries) >0)
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->name}}">{{$country->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="company">Your company name</label>
                                                    <input type="text" id="company" name="company">
                                                    <i class="far fa-building"></i>
                                                </div>

                                            </div>
                                            <div class="col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="website">Your company website</label>
                                                    <input type="url" id="website" name="website">
                                                    <i class="far fa-browser"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cp-quote-box mb-40">
                                        <h3 class="cp-quote-title"><span>Product Type & Size</span></h3>
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="project">Project type</label>
                                                    <select id="project" name="project" class="js-example-basic-single">
                                                        @if(!empty($categories) && count($categories) >0)
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->name}}">{{$category->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="material_type">Material Type</label>
                                                    <select id="material_type" name="material_type" class="js-example-basic-single">
                                                        <option value="Paper">Paper</option>
                                                        <option value="Matte">Matte</option>
                                                        <option value="Holo">Holo</option>
                                                        <option value="Glossy">Glossy</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="width">Width</label>
                                                    <input type="text" id="width" name="width">
                                                    <span class="cp-in">in</span>
                                                    @if ($errors->has('width'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('width') }}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-xl-4 col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="height">Height</label>
                                                    <input type="text" id="height" name="height">
                                                    <span class="cp-in">in</span>
                                                    @if ($errors->has('height'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('height') }}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>

                                            <div class="col-xl-4 col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="number" id="quantity" name="quantity">
                                                    @if ($errors->has('quantity'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('quantity') }}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-xl-12">
                                                <div class="cp-input-field">
                                                    <label for="fileupload">Upload File Here</label>
                                                    <div class="cp-input-wrap cp-file t-center">
                                                        <img src="" style="height: 200px; width: 200px; display:none;" class="ImgPreview">
                                                        <h5 class="hide">Drag file here or click the button below</h5>
                                                        <input type="file" id="fileupload" name="file">
                                                        <button class="cp-border2-btn hide">Upload File Here</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cp-quote-box mb-30">
                                        <h3 class="cp-quote-title"><span>Your Message</span></h3>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="cp-input-field textarea">
                                                    <label for="message">Your Message</label>
                                                    <textarea id="message" cols="30" rows="10" name="message"></textarea>
                                                    <i class="far fa-edit"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cp-quote-btn mb-10">
                                        <button type="submit" class="cp-border-btn mt-15">
                                            Sent Quote
                                            <span class="cp-border-btn__inner">
                                            <span class="cp-border-btn__blobs">
                                                <span class="cp-border-btn__blob"></span>
                                                <span class="cp-border-btn__blob"></span>
                                                <span class="cp-border-btn__blob"></span>
                                                <span class="cp-border-btn__blob"></span>
                                            </span>
                                        </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- quote area end  -->
        @include('frontend.includes.social')

    </main>

@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
            $("#fileupload").change(function() {
                debugger;
                var imgControlName = ".ImgPreview";
                $(".hide").css('display','none');
                $(imgControlName).css('display','inline');
                readURL(this, imgControlName);

            });

            function readURL(input, imgControlName) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                    $(imgControlName).prop('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endpush
