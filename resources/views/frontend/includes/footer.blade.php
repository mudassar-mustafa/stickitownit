<!-- footer area start  -->
<footer>
    <div class="cp-footer-wrap cp-bg-6 pt-145 pb-85">
        <div class="container">
            <div class="row">
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
                <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6">
                    <div class="cp-footer-widget mb-50">
                        <h4 class="cp-footer-widget-title">Our Products</h4>
                        <ul class="cp-footer-widget-link">
                            @if(!empty($categories) && count($categories) >0)
                                @foreach($categories as $category)
                                    <li><a href="javascript:void(0)">{{ $category->name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-10">
                    <div class="cp-footer-widget mb-50">
                        <h4 class="cp-footer-widget-title">Newsletter</h4>
                        <p class="mb-35">Printing for what’s to come. What’s more, we do it right! A full administration
                            printing Get the latest news, events & more delivered to your inbox.</p>
                        <div class="cp-footer-email-form mb-45">
                            <form action="#">
                                <input type="email" placeholder="Enter Your Mail Address">
                                <button type="submit" class="cp-btn">
                                    Subscribe Now <i class="fal fa-paper-plane"></i>
                                    <span class="cp-btn__inner">
                                 <span class="cp-btn__blobs">
                                    <span class="cp-btn__blob"></span>
                                    <span class="cp-btn__blob"></span>
                                    <span class="cp-btn__blob"></span>
                                    <span class="cp-btn__blob"></span>
                                 </span>
                              </span>
                                </button>
                            </form>
                        </div>
                        <div class="cp-footer-social">
                            <ul>
                                <li>
                                    <a target="_blank" href="#">facebook <i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li><a target="_blank" href="#">Twitter <i class="fab fa-twitter"></i></a></li>
                                <li><a target="_blank" href="#">Instagram <i class="fab fa-instagram"></i></a></li>
                                <li><a target="_blank" href="#">YouTube <i class="fab fa-youtube"></i></a></li>
                                <li><a target="_blank" href="#">Linkedin <i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cp-copy-right cp-footer-bg pt-35 pb-20">
        <div class="container">
            <div class="cp-copy-item-wrap d-flex align-items-center justify-content-between">
                <div class="cp-copy-item">
                    <div class="cp-footer-logo mb-15">
                        <a href="index.html"><img src="{{ asset('assets/img/logo/white-logo.png') }}" alt="white-logo"></a>
                    </div>
                </div>
                <div class="cp-copy-item">
                    <div class="cp-footer-payment m-img mb-15">
                        <img src="{{ asset('assets/img/footer/pament-method.png') }}" alt="payment-method">
                    </div>
                </div>
                <div class="cp-copy-item">
                    <div class="cp-copy-text mb-15 text-xl-end">
                        <p class="mb-0 white-color">© 2023 <a href="https://devsleagues.com">Design & Developed by
                                Devsleagues</a>. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end  -->
