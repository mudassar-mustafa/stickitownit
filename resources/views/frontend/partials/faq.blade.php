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
                        <div class="video-container">
                            <video src="{{ asset('assets/video/template-video.mp4') }}" autoplay loop muted>
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- <div class="cp-faq-img-item p-relative w-img mb-30">
                                <div class="cp-img-overlay wow"></div>
                                <div class="cp-img-blur">
                                    <img src="{{ asset('assets/img/faq/faq-1.jpg') }}" alt="faq">
                                    <img src="{{ asset('assets/img/faq/faq-1.jpg') }}" alt="faq">
                                </div>
                            </div> -->
                            <div class="cp-faq-img-item p-relative w-img mb-30 js-tilt">
                                <div class="cp-img-overlay wow"></div>
                                <div class="cp-img-blur">
                                    <img src="{{ asset('assets/img/faq/faq-3.jpg') }}" alt="faq">
                                    <img src="{{ asset('assets/img/faq/faq-3.jpg') }}" alt="faq">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- <div class="cp-faq-img-item p-relative w-img mb-30 js-tilt">
                                <div class="cp-img-overlay wow"></div>
                                <div class="cp-img-blur cp-min-height-445">
                                    <img src="{{ asset('assets/img/faq/faq-2.jpg') }}" alt="faq">
                                    <img src="{{ asset('assets/img/faq/faq-2.jpg') }}" alt="faq">
                                </div>
                            </div> -->
                            <div class="cp-faq-img-item">
                                <div class="cp-faq-img-content">
                                    <div class="cp-faq-img-icon m-img">
                                        <img src="{{ asset('assets/img/faq/faq-phone-icon.png') }}" alt="faq">
                                    </div>
                                    <h4>Call us now</h4>
                                    <a href="tel:{{ $setting->phone_number }}">{{ $setting->phone_number }}</a>
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
                            <h2 class="cp-title wow fadeInUp animated" data-wow-delay="0.4s"><span>Decoding Stickitownit:</span>Explore Our FAQs</h2>
                        </div>
                        <p class="cp-faq-text mb-40 wow fadeInUp animated" data-wow-delay="0.5s">
                            We take pSeek answers to your most pressing questions about Stickitownit. Our FAQs
                            cover everything from creating custom designs to our unique on-demand printing process.
                            Discover clarity and ease here."
                        </p>
                        <div class="accordion" id="accordionExample">
                            @if(!empty($faqs) && count($faqs) > 0)
                                @foreach($faqs as $key=>$faq)
                                    <div class="accordion-item wow fadeInUp animated"
                                         data-wow-delay="0.{{$key+6}}s">
                                        <h2 class="accordion-header" id="heading{{$key}}">
                                            <button class="accordion-button {{ $key !== 0 ? 'collapsed' : '' }}"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{$key}}"
                                                    aria-expanded="{{ $key === 0  ? true : false }}"
                                                    aria-controls="collapse{{$key}}">{{$faq->name}}
                                            </button>
                                        </h2>
                                        <div id="collapse{{$key}}"
                                             class="accordion-collapse collapse {{ $key===0 ? 'show' : '' }}"
                                             aria-labelledby="heading{{$key}}"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">{{$faq->short_description}}
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
