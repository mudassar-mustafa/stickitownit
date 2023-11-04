@extends('frontend.layouts.app')
@section('title','Generations')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            height: 57px !important;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-top: 13px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 17px !important;
        }

        /* Absolute Center Spinner */
        .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

            background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 150ms infinite linear;
            -moz-animation: spinner 150ms infinite linear;
            -ms-animation: spinner 150ms infinite linear;
            -o-animation: spinner 150ms infinite linear;
            animation: spinner 150ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
@section('content')
    <div class="loading" style="display: none">Loading&#8230;</div>
    <main>
        <!-- quote area start  -->
        <section class="cp-quote-area pt-50 mb-25">
            <div class="container">
                <div class="row justify-content-center wow fadeInUp animated" data-wow-duration="1.5s">
                    <div class="col-xl-10">
                        <div class="cp-quote-wrapper cp-border5">
                            <div class="cp-quote-form">
                                <div class="alert alert-success" role="alert" id="successMsg" style="display: none">
                                </div>
                                <form id="SubmitForm">
                                    @csrf
                                    <div class="cp-quote-box mb-40">
                                        <h3 class="cp-quote-title"><span>Get Your Desire Designs</span></h3>
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4">
                                                <div class="cp-input-field">
                                                    <label for="project">Project Type * </label>
                                                    <select id="project" name="project" class="js-example-basic-single">
                                                        @if(!empty($categories) && count($categories) >0)
                                                            @foreach($categories as $category)
                                                                <option
                                                                    value="{{$category->name}}">{{$category->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <span class="text-danger" id="projectErrorMsg"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="prompt_text">Your name * </label>
                                                    <input type="text" id="prompt_text" name="prompt_text">
                                                    <i class="far fa-user"></i>
                                                    <span class="text-danger" id="prompt_textErrorMsg"></span>
                                                </div>

                                            </div>

                                            <div class="col-lg-2 col-lg-2">
                                                <div class="cp-input-field">
                                                    <label for="no_of_images">Number of Images * </label>
                                                    <select id="no_of_images" name="no_of_images"
                                                            class="js-example-basic-single">
                                                        @if (isset($setting->number_of_images))
                                                            @for ($i = 1; $i <= $setting->number_of_images; $i++)
                                                                <option value="{{ $i }}">{{ $i }}</option>  
                                                            @endfor
                                                        @endif
                                                    </select>
                                                    <span class="text-danger" id="no_of_imagesErrorMsg"></span>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="cp-quote-btn mb-10">
                                        <button type="submit" class="cp-border-btn mt-15">
                                            Generate
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
            $("#fileupload").change(function () {
                debugger;
                var imgControlName = ".ImgPreview";
                $(".hide").css('display', 'none');
                $(imgControlName).css('display', 'inline');
                readURL(this, imgControlName);

            });

            function readURL(input, imgControlName) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(imgControlName).prop('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });

        $('#SubmitForm').on('submit', function (e) {
            e.preventDefault();
            debugger;
            $('.loading').show();
            let project = $('#project').val();
            let prompt_text = $('#prompt_text').val();
            let no_of_images = $('#no_of_images').val();
            clearErrorMessages();
            $.ajax({
                type: 'POST',
                url: "{{ route('store.generation') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    project: project,
                    prompt_text: prompt_text,
                    no_of_images: no_of_images,
                },
                success: function (response) {
                    if (response.success) {
                        $('#successMsg').show().css('color', 'green').html(response.message + '<br>' + "Used Tokens:" + response.usedTokens + '<br>' + 'Generations Id' + response.generationId);
                    } else {
                        $('#successMsg').show().css('color', 'red').html('Something went wrong while generation your request .Please try again.');
                        
                        toastr.error(response.message);
                    }
                    $('.loading').hide();
                },
                error: function (response) {
                    $('.loading').hide();
                    $('#projectErrorMsg').text(response.responseJSON.errors.project);
                    $('#prompt_textErrorMsg').text(response.responseJSON.errors.prompt_text);
                    $('#no_of_imagesErrorMsg').text(response.responseJSON.errors.no_of_images);
                },
            });

        });

        function clearErrorMessages() {
            $('#projectErrorMsg').text('');
            $('#prompt_textErrorMsg').text('');
            $('#no_of_imagesErrorMsg').text('');
            $('#successMsg').text('');
        }
    </script>
@endpush
