
<!-- side toggle start -->
<div class="fix">
    <div class="side-info">
        <div class="side-info-content">
            <div class="offset-widget offset-logo mb-50">
                <div class="row align-items-center">
                    <div class="col-9">
                        <a href="{{ route('/') }}">
                            <img width="100" src="{{ asset('storage/uploads/settings/'.$setting->logo_header) }}"  alt="Logo">
                        </a>
                    </div>
                    <div class="col-3 text-end">
                        <button class="side-info-close">
                            <i class="fal fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="mobile-menu fix"></div>
            <div class="offset-widget offset-support mb-30">
                <h3 class="cp-offset-widget-title">Contact Info</h3>
                <div class="footer-support">
                    <div class="irc-item support-meta">
                        <div class="irc-item-icon">
                            <i class="fal fa-phone-alt"></i>
                        </div>
                        <div class="irc-item-content">
                            <p>Call Now</p>
                            <div class="support-number">
                                <a href="tel:{{ $setting->phone_number }}">{{ $setting->phone_number }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="irc-item support-meta">
                        <div class="irc-item-icon">
                            <i class="fal fa-envelope"></i>
                        </div>
                        <div class="irc-item-content">
                            <p>Mail Us</p>
                            <div class="support-number">
                                <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="irc-item support-meta">
                        <div class="irc-item-icon">
                            <i class="fal fa-map-marker-alt"></i>
                        </div>
                        <div class="irc-item-content">
                            <p>Location</p>
                            <div class="support-number">
                                <a href="#" target="_blank">{{ $setting->address }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offset-widget offset-social mb-30">
                <div class="footer-social">
                    <div class="social-links">
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- side toggle end -->

<div class="offcanvas-overlay"></div>
<div class="offcanvas-overlay-white"></div>
