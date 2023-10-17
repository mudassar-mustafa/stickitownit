<!-- floating area start here  -->
<div class="cp-floating-area d-none d-md-block zi-1100 p-relative ">
    <div class="cp-floating-action cp-bg-move-y">
            <span class="cp-floating-btn cp-floating-phone-btn cp" data-bs-toggle="modal"
                  data-bs-target="#phonePopup"><i class="fal fa-phone-alt"></i></span>
        <span class="cp-floating-btn cp-floating-location-btn cp"><a href="{{ route('cart.index') }}">
                <i class="fal fa-cart-plus"></i>
            </a></span>
        <span class="cp-floating-btn cp-floating-form-btn cp" ><a href="{{ route('contact-us.index') }}">
                <i
                    class="fal fa-envelope-open-text"></i>
            </a></span>
    </div>

    <!-- phone Modal start -->
    <div class="modal fade cp-floating-model" id="phonePopup" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="phonePopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="cp-floating-item cp-phone-popup" id="phonePopupLabel">
                    <div class="cp-floating-left w-img">
                        <img src="{{ asset('assets/img/cta/popup2.jpg') }}" alt="contact">
                    </div>
                    <div class="cp-floating-text">
                        <h4 class="cp-floating-title">Our <span>Office Time</span></h4>
                        <div class="cp-floating-text-inner">
                           <span class="cp-floating-text-inner-icon">
                              <i class="fal fa-calendar-day"></i>
                           </span>
                            <span class="cp-floating-text-inner-text">monday - sunday</span>
                        </div>
                        <div class="cp-floating-text-inner">
                           <span class="cp-floating-text-inner-icon">
                              <i class="fal fa-watch"></i>
                           </span>
                            <span class="cp-floating-text-inner-text">8.00 am - 9.00 pm</span>
                        </div>
                        <div class="cp-floating-text-inner">
                           <span class="cp-floating-text-inner-icon">
                              <i class="far fa-phone-alt"></i>
                           </span>
                            <span class="cp-floating-text-inner-text"><a
                                    href="tel:+910265362003">+910265362003</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- phone Modal end -->

</div>
<!-- floating area end here  -->
