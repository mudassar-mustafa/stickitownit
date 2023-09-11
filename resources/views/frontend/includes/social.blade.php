<!-- floating area start here  -->
<div class="cp-floating-area d-none d-md-block zi-1100 p-relative ">
    <div class="cp-floating-action cp-bg-move-y">
            <span class="cp-floating-btn cp-floating-phone-btn cp" data-bs-toggle="modal"
                  data-bs-target="#phonePopup"><i class="fal fa-phone-alt"></i></span>
        <span class="cp-floating-btn cp-floating-location-btn cp" data-bs-toggle="modal"
              data-bs-target="#locationPopup"><i class="fal fa-location-arrow"></i></span>
        <span class="cp-floating-btn cp-floating-form-btn cp" data-bs-toggle="modal"
              data-bs-target="#formPopup"><i
                class="fal fa-envelope-open-text"></i></span>
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

    <!-- location Modal start -->
    <div class="modal fade cp-floating-model" id="locationPopup" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="locationPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="cp-floating-item cp-location-popup" id="locationPopupLabel">
                    <div class="cp-floating-left">
                        <div class="cp-floating-location">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d99370.14184006557!2d-77.0846156762382!3d38.89386718919168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m3!3e6!4m0!4m0!5e0!3m2!1sen!2sbd!4v1671881294236!5m2!1sen!2sbd"
                                style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="cp-floating-text">
                        <h4 class="cp-floating-title">know <span>our location</span></h4>
                        <div class="cp-floating-text-inner">
                           <span class="cp-floating-text-inner-icon">
                              <i class="fal fa-location-arrow"></i>
                           </span>
                            <span class="cp-floating-text-inner-text"><a target="_blank"
                                                                         href="https://www.google.com/maps/@38.8938672,-77.0846157,12z">88
                                 New Street,
                                 Washington DC,
                                 America</a></span>
                        </div>
                        <div class="cp-floating-text-inner">
                           <span class="cp-floating-text-inner-icon">
                              <i class="fal fa-location-arrow"></i>
                           </span>
                            <span class="cp-floating-text-inner-text"><a target="_blank"
                                                                         href="https://www.google.com/maps/@1.952577,44.3912535,3z">100 New
                                 Street, melbon,
                                 Australian</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- location Modal end -->

    <!-- form Modal start -->
    <div class="modal fade cp-floating-model" id="formPopup" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="formPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="cp-floating-item" id="formPopupLabel">
                    <div class="cp-floating-form-img w-img">
                        <img src="{{ asset('assets/img/cta/cta-img.png') }}" alt="contact">
                    </div>
                    <div class="cp-floating-left cp-signup-popup">
                        <h3 class="cp-floating-title">Do you have any question?</h3>
                        <div class="cp-floating-form">
                            <form action="#">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="cp-input-field">
                                            <label for="name">Your Name</label>
                                            <input type="text" id="name">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="cp-input-field">
                                            <label for="email">Your Email</label>
                                            <input type="email" id="email">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="cp-input-field">
                                            <label for="message">Your question</label>
                                            <textarea id="message" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="cp-btn mt-20">
                                    send question
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- form Modal end -->
</div>
<!-- floating area end here  -->
