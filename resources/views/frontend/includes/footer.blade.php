<!-- footer area start  -->
<footer>
    <div class="cp-footer-wrap cp-bg-6 pt-45">
        <div class="container">
            <div class="row">
            <div class="col-xl-6 col-lg-10">
                    <div class="cp-footer-widget mb-50">
                        <!-- <h4 class="cp-footer-widget-title">Our Company</h4> -->
                        <div class="cp-footer-logo mb-15">
                            <a href="{{ route('/') }}">
                                <img class="width-17"
                                    src="{{ asset('storage/uploads/settings/'.$setting->logo_footer) }}"
                                    alt="white-logo"></a>
                        </div>
                        <div class="footer-description pr-20">
                            <p class="mb-35 ">{{ $setting->company_short_description }}</p>
                        </div>
                        
                        <div class="cp-footer-social">
                            <ul>
                                @if(!is_null($setting->facebook_url))
                                    <li><a target="_blank" href="{{$setting->facebook_url}}">facebook <i
                                                class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if(!is_null($setting->twitter_url))
                                    <li><a target="_blank" href="{{$setting->twitter_url}}">Twitter <i
                                                class="fab fa-twitter"></i></a></li>
                                @endif
                                @if(!is_null($setting->instagram_url))
                                    <li><a target="_blank" href="{{$setting->instagram_url}}">Instagram <i
                                                class="fab fa-instagram"></i></a></li>
                                @endif
                                @if(!is_null($setting->youtube_url))
                                    <li><a target="_blank" href="{{$setting->youtube_url}}">YouTube <i
                                                class="fab fa-youtube"></i></a></li>
                                @endif
                                @if(!is_null($setting->linkedin_url))
                                    <li><a target="_blank" href="{{$setting->linkedin_url}}">Linkedin <i
                                                class="fab fa-linkedin-in"></i></a></li>
                                @endif

                            </ul>
                        </div>
                        <div class="cp-copy-item">
                            <div class=" m-img mb-15">
                                <img src="{{ asset('assets/img/footer/stripe.png') }}" alt="payment-method" width="150">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6">
                    <div class="cp-footer-widget mb-50">
                        <h4 class="cp-footer-widget-title">Our Products</h4>
                        <ul class="cp-footer-widget-link">
                            @if(!empty($categories) && count($categories) >0)
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('get.products-by-category',$category->slug) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6">
                    <div class="cp-footer-widget mb-50">
                        <h4 class="cp-footer-widget-title">Useful Links</h4>
                        <ul class="cp-footer-widget-link">
                            @if(!empty($pages) && count($pages) >0)
                                @foreach($pages as $page)
                                    <li><a href="{{ route('page.index',$page->slug) }}">{{$page->name}}</a></li>
                                @endforeach
                            @endif
                            <li><a href="{{ route('blogs.list') }}">Blogs</a></li>
                            <li><a href="{{ route('contact-us.index') }}">Contact Us</a></li>
                            <li><a href="{{ route('get-quote.index') }}">Get a Quote</a></li>
                            <li><a href="{{ route('faqs') }}">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
    <!-- <div class="cp-copy-right cp-footer-bg pt-20 pb-5">
        <div class="container">
            <div class="cp-copy-item-wrap d-flex align-items-center justify-content-center">
                
                <div class="cp-copy-item text-center">
                    <div class="cp-copy-text mb-15">
                        <p class="mb-0 black-color">© 2023 <a href="https://devsleagues.com">Design & Developed by
                                Devsleagues</a>. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</footer>
<!-- footer area end  -->
