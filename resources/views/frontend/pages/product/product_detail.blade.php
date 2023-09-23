@extends('frontend.layouts.app')

@section('title',$product->title ?? 'Produce Digital Printing With Business Growing')
@section('description',$product->meta_description ?? 'Our mission is to take the pain out of sticker printing and make it simple, fast, and affordable without compromising quality.')
@section('keywords',$product->meta_keywords ?? 'Stickers, Labels, Printing, Digital Printing')
@section('canonical','https://stickitownit.com')
@section('og-locale','en_US')
@section('og-type','website')
@section('og-title','Stickitownit')
@section('og-description','Our mission is to take the pain out of sticker printing and make it simple, fast, and affordable without compromising quality.')
@section('og-url','https://stickitownit.com')
@section('og-site-name','Stickitownit')
@section('og-image', $product->main_image ?? "")
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container{
        width: 100% !important;
    }

</style>
@endpush
@section('content')

<!-- shop details area start  -->
<section class="shop-details-area pt-150 pb-110 fix">
    <div class="container">
        <div class="row wow align-items-xl-center fadeInUp" data-wow-delay=".3s">
            <input type="hidden" value="{{ $product->id }}" id="product_id">
            <div class="col-lg-7">
                <div class="product-d-img-tab-wrapper mb-70">
                    <div class="product-d-img-nav">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @if ($product->main_image != null)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pro-0-tab" data-bs-toggle="tab"
                                        data-bs-target="#pro-0" type="button" role="tab" aria-controls="pro-0"
                                        aria-selected="false">
                                        <img src="{{ $product->main_image }}" alt="{{ $product->title }}">
                                    </button>
                                </li>
                            @endif
                            @if (!empty($product->product_images) && count($product->product_images) > 0)
                                @foreach ($product->product_images as $key => $productImage)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pro-{{ $key + 1 }}-tab" data-bs-toggle="tab"
                                            data-bs-target="#pro-{{ $key + 1 }}" type="button" role="tab" aria-controls="pro-{{ $key + 1 }}"
                                            aria-selected="false">
                                            <img src="{{ $productImage->filename }}" alt="{{ $productImage->name }}">
                                        </button>
                                    </li>    
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="product-d-img-tab">
                        <div class="tab-content zooming" id="productDetailsTab">
                            <div class="tab-pane fade active show" id="pro-0" role="tabpanel" aria-labelledby="pro-0-tab">
                                <img class="active" src="{{ $product->main_image }}" alt="{{ $product->title }}">
                            </div>
                            @if (!empty($product->product_images) && count($product->product_images) > 0)
                                @foreach ($product->product_images as $key => $productImage)
                                    <div class="tab-pane fade" id="pro-{{ $key + 1 }}" role="tabpanel" aria-labelledby="pro-{{ $key + 1 }}-tab">
                                        <img class="active" src="{{ $productImage->filename }}" alt="{{ $productImage->name }}">
                                    </div>    
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="product-side-info mb-60">
                    @if (!empty($product->categories))
                        <div class="product-breadcrumb mb-30">
                            <ul>
                                <li><a href="#">{{ $product->categories[0]->name }}</a></li>
                                <li><span>{{ $product->title ?? "" }}</span></li>
                            </ul>
                        </div>    
                    @endif
                    
                    <h4 class="product-name">{{ $product->title ?? "" }}</h4>
                    @if ($product->product_type == "normal")
                        <div class="product-price">
                            <span class="price-now">${{ $product->price }}</span>
                        </div>    
                    @endif
                    
                    {{-- <div class="product-category-review">
                        <div class="product-d-review">
                            <div class="rating">
                                <a href="#"><i class="fas fa-star"></i></a>
                                <a href="#"><i class="fas fa-star"></i></a>
                                <a href="#"><i class="fas fa-star"></i></a>
                                <a href="#"><i class="fas fa-star"></i></a>
                                <a href="#"><i class="far fa-star"></i></a>
                            </div>
                            <span>(20 Customer Review)</span>
                        </div>
                    </div> --}}
                    @if (!empty($product->short_description))
                    <p class="mb-30">{{ $product->short_description }}</p>    
                    @endif

                    @if ($product->product_type != "normal" && !empty($product->attributes))
                    <div class="row">
                        @foreach ($product->attributes as $key => $attribute)
                            <div class="{{ $key + 1 == count($product->attributes) ? "col-lg-12 col-md-12 col-sm-12 col-xs-12" : "col-lg-6 col-md-6 col-sm-12 col-xs-12" }}">
                                <div class="cp-input-field">
                                <label for="attribute_{{ $key }}">{{ $attribute->name }}</label>
                                <select id="attribute_{{ $key }}" class="attributes js-example-basic-single" data-attribute_id ={{ $attribute->id }}  data-attribute_name ={{ $attribute->name }} data-key ={{ $key }} onchange="updateAttributeValue('{{ $key }}')"> 
                                </select>
                                </div>
                            </div>    
                        @endforeach
                    </div>
                    <div class="product-price hidden variable_product_price" style="float: right;">
                        <span class="price-now variable_product_amount"></span>
                    </div>
                    @endif
                    
                    @if ($product->product_type == "normal")
                        <div class="product-quantity-cart mb-30">
                            <div class="product-quantity-form">
                                <form action="#">
                                    <button class="cart-minus"><i class="far fa-minus"></i></button>
                                    <input class="cart-input" type="text" value="1">
                                    <button class="cart-plus"><i class="far fa-plus"></i></button>
                                </form>
                            </div>
                            <a href="cart.html" class="cp-border-btn cp-il">
                                <i class="fas fa-shopping-basket"></i>Add to
                                Cart
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
                    @endif

                    @if ($product->product_type == "normal")
                        <div class="product-d-meta sku mb-10">
                            <span>SKU :</span>
                            <span>001</span>
                        </div>
                    @endif
                    
                    @php
                        $categoryString = "";
                        if(!empty($product->categories)){
                            foreach ($product->categories as $key => $category) {
                                if($categoryString == ""){
                                    $categoryString = $category->name;
                                }else{
                                    $categoryString = $categoryString.', '.$category->name;
                                }
                            }
                        }
                    @endphp
                    <div class="product-d-meta ockcategories mb-10">
                        <span>Catagories :</span>
                        <span>{{ $categoryString }}</span>
                    </div>
                    @if ($product->product_type == "normal")
                        <div class="product-d-meta tags mb-10">
                            <span>Available :</span>
                            <span>{{ $product->quantity }}</span>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
        <div class="product_info-faq-area pb-0 pt-20 wow fadeInUp" data-wow-delay=".3s">
            <div class="product-details-tab-wrapper">
                <nav class="product-details-nav mb-60">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="pro-info-1-tab" data-bs-toggle="tab"
                            href="#pro-info-1" role="tab" aria-selected="true">Description</a>
                        <a class="nav-item nav-link" id="pro-info-2-tab" data-bs-toggle="tab" href="#pro-info-2"
                            role="tab" aria-selected="false">Additional Information</a>
                        <a class="nav-item nav-link" id="pro-info-3-tab" data-bs-toggle="tab" href="#pro-info-3"
                            role="tab" aria-selected="false">Reviews (3)</a>
                    </div>
                </nav>
                <div class="row">
                    <div class="col-xl-10">
                        <div class="product-details-content mb-30">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade active show" id="pro-info-1" role="tabpanel">
                                    <div class="tabs-wrapper">
                                        <div class="product__details-des">
                                            <p class="mb-25">Aenean dolor massa, rhoncus ut tortor in, pretium
                                                tempus
                                                neque.
                                                Vestibulum venenatis leo et dictum finibus. Nulla
                                                vulputate dolor sit amet tristique dapibus. Maecenas posuere
                                                luctus leo,
                                                non consequat felis ullamcorper non. Aliquam
                                                erat volutpat. Donec vitae porta enim. Cras eu volutpat dolor,
                                                vitae
                                                accumsan tellus. Donec pulvinar auctor nunc, et
                                                gravida elit porta non. Aliquam erat volutpat. Proin facilisis
                                                interdum
                                                felis, sit amet pretium purus feugiat ac. Donec
                                                in leo metus. Sed quis dui nec justo ullamcorper molestie.
                                                Mauris
                                                consequat lacinia est, eget tincidunt leo ornare sed</p>
                                            <div class="cp-list mb-25">
                                                <ul>
                                                    <li>Nunc nec porttitor turpis. In eu risus enim. In vitae
                                                        mollis
                                                        elit.</li>
                                                    <li>Vivamus finibus vel mauris ut vehicula.</li>
                                                    <li>Aliquam porttitor mauris sit amet orci. Aenean dignissim
                                                        pellentesque felis</li>
                                                </ul>
                                            </div>
                                            <p class="mb-0">Korem epsum dolor sit amet, consectetuer adipiscing
                                                elit.
                                                Donec odio.
                                                Quisque volutpat mattis eros. Nullam malesuada
                                                erat ut turpis. Suspendisse urna viverra non, semper suscipit,
                                                posuere
                                                a, pede. Donec nec justo eget felis facilisis
                                                fermentum. Aliquam porttitor mauris sit amet orci.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pro-info-2" role="tabpanel">
                                    <div class="tabs-wrapper">
                                        <div class="product__details-des">
                                            <h3 class="cp-product-info-title mb-25">Product Information</h3>
                                            <p class="cp-product-info-text mb-45">Korem epsum dolor sit amet,
                                                consectetuer
                                                adipiscing elit. Donec odio. Quisque volutpat mattis eros.
                                                Nullam
                                                malesuada
                                                erat ut turpis. Suspendisse urna viverra non, <br> semper
                                                suscipit,
                                                posuere
                                                a, pede. Donec nec justo eget felis facilisis
                                                fermentum. Aliquam porttitor mauris sit amet orci.</p>
                                            <div class="row">
                                                <div class="col-xl-8">
                                                    <div class="cp-product-feature">
                                                        <div class="cp-product-feature-item">
                                                            <h5>Fabric</h5>
                                                            <span>Faux suede fabric</span>
                                                        </div>
                                                        <div class="cp-product-feature-item">
                                                            <h5>Dimensions</h5>
                                                            <span>15 × 15 × 10 cm</span>
                                                        </div>
                                                        <div class="cp-product-feature-item">
                                                            <h5>Color</h5>
                                                            <div class="cp-product-feature-color-wrap">
                                                                <div class="cp-product-feature-color-list">
                                                                    <span></span>
                                                                    <span></span>
                                                                    <span></span>
                                                                    <span></span>
                                                                    <span></span>
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="cp-product-feature-item">
                                                            <h5>Dimensions</h5>
                                                            <span>Small, Medium, Extra Large, Extra Small,
                                                                Large.</span>
                                                        </div>
                                                        <div class="cp-product-feature-item">
                                                            <h5>Height</h5>
                                                            <span>31cm; Width: 32cm; Depth: 12cm; Handle Drop:
                                                                61cm</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pro-info-3" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-10">
                                            <div class="tabs-wrapper">
                                                <div class="course-review-item mb-30">
                                                    <div class="course-reviews-img">
                                                        <a href="#"><img src="assets/img/news/author-3.png"
                                                                alt="image not found"></a>
                                                    </div>
                                                    <div class="course-review-list">
                                                        <h5><a href="#">Sotapdi Kunda</a></h5>
                                                        <div class="course-start-icon">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <span>55 min ago</span>
                                                        </div>
                                                        <p>Very clean and organized with easy to follow
                                                            tutorials,
                                                            Exercises,
                                                            and
                                                            solutions.
                                                            This course does start from the beginning with very
                                                            little
                                                            knowledge
                                                            and
                                                            gives a
                                                            great overview of common tools used for data science
                                                            and
                                                            progresses
                                                            into
                                                            more
                                                            complex concepts and ideas.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="course-review-item mb-30">
                                                    <div class="course-reviews-img">
                                                        <a href="#"><img src="assets/img/news/author-2.jpg"
                                                                alt="image not found"></a>
                                                    </div>
                                                    <div class="course-review-list">
                                                        <h5><a href="#">Samantha</a></h5>
                                                        <div class="course-start-icon">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <span>45 min ago</span>
                                                        </div>
                                                        <p>The course is good at explaining very basic intuition
                                                            of the
                                                            concepts. It
                                                            will get
                                                            you scratching the surface so to say. where this
                                                            course is
                                                            unique is
                                                            the
                                                            implementation methods are so well defined Thank you
                                                            to the
                                                            team !.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-10">
                                                        <div class="product__details-comment ">
                                                            <div class="comment-title mb-20">
                                                                <h3>Add a review</h3>
                                                                <p>Your email address will not be published.
                                                                    Required
                                                                    fields are
                                                                    marked
                                                                    *</p>
                                                            </div>
                                                            <div class="comment-rating mb-20">
                                                                <span>Overall ratings</span>
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="fas fa-star"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="fas fa-star"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="fas fa-star"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="fas fa-star"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="fal fa-star"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="comment-input-box">
                                                                <form action="#">
                                                                    <div class="row">
                                                                        <div class="col-xxl-6">
                                                                            <div class="cp-input-field">
                                                                                <label for="name">Your full
                                                                                    name</label>
                                                                                <input type="text" id="name">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xxl-6">
                                                                            <div class="cp-input-field">
                                                                                <label for="email">Your email
                                                                                    (required)</label>
                                                                                <input type="email" id="email"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xxl-12">
                                                                            <div class="cp-input-field">
                                                                                <label for="message">Write your
                                                                                    review*</label>
                                                                                <textarea id="message" required
                                                                                    cols="30"
                                                                                    rows="10"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xxl-12">
                                                                            <div class="comment-submit mt-10">
                                                                                <a href="about.html"
                                                                                    class="cp-border-btn">
                                                                                    Submit review
                                                                                    <span
                                                                                        class="cp-border-btn__inner">
                                                                                        <span
                                                                                            class="cp-border-btn__blobs">
                                                                                            <span
                                                                                                class="cp-border-btn__blob"></span>
                                                                                            <span
                                                                                                class="cp-border-btn__blob"></span>
                                                                                            <span
                                                                                                class="cp-border-btn__blob"></span>
                                                                                            <span
                                                                                                class="cp-border-btn__blob"></span>
                                                                                        </span>
                                                                                    </span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- shop details area end  -->

<!-- faq area start here  -->
<section class="cp-faq-area cp-bg-14 pt-145 pb-150">
    <div class="container">
        <div class="cp-question-title-wrap">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="cp-section-title mb-45 t-center">
                        <span class="cp-subtitle mb-15 wow fadeInUp animated" data-wow-delay="0.3s">FAQ</span>
                        <h2 class="cp-title wow fadeInUp animated" data-wow-delay="0.4s"> <span>Customer
                                questions</span> <br>
                            &
                            answers</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="cp-faq-wrap cp-faq-p-space-right">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item wow fadeInUp animated" data-wow-delay="0.3s">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">Is the white thick enough to wear
                                    alone?</button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">Communications det, consec tetur adipiscing elit
                                    duis nec
                                    fringi communications company We build and activate brands through
                                    cultural insight,
                                    str vision, and.</div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeInUp animated" data-wow-delay="0.4s">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">We
                                    provide fast on-demand printing</button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">Communications det, consec tetur adipiscing elit
                                    duis nec
                                    fringi communications company We build and activate brands through
                                    cultural insight,
                                    str vision, and.</div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeInUp animated" data-wow-delay="0.5s">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree">Activate
                                    brands through cultural insight</button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">Communications det, consec tetur adipiscing elit
                                    duis nec
                                    fringi communications company We build and activate brands through
                                    cultural insight,
                                    str vision, and.</div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeInUp animated" data-wow-delay="0.6s">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                    aria-expanded="false" aria-controls="collapseFour">Which color is darker:
                                    evergreen or hunter green?</button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse"
                                aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">Communications det, consec tetur adipiscing elit
                                    duis nec
                                    fringi communications company We build and activate brands through
                                    cultural insight,
                                    str vision, and.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="cp-faq-wrap cp-faq-p-space-left">
                    <div class="accordion" id="accordionExample2">
                        <div class="accordion-item wow fadeInUp animated" data-wow-delay="0.3s">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                    aria-expanded="false" aria-controls="collapseFive">Would an extra small fit
                                    a woman?</button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse"
                                aria-labelledby="headingFive" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">Communications det, consec tetur adipiscing elit
                                    duis nec
                                    fringi communications company We build and activate brands through
                                    cultural insight,
                                    str vision, and.</div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeInUp animated" data-wow-delay="0.4s">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                    aria-expanded="false" aria-controls="collapseSix">Is fit and standard fit in
                                    mens short sleeved shirts?</button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse"
                                aria-labelledby="headingSix" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">Communications det, consec tetur adipiscing elit
                                    duis nec
                                    fringi communications company We build and activate brands through
                                    cultural insight,
                                    str vision, and.</div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeInUp animated" data-wow-delay="0.5s">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                    aria-expanded="false" aria-controls="collapseSeven">Does this shirt need
                                    to be ironed?</button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse"
                                aria-labelledby="headingSeven" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">Communications det, consec tetur adipiscing elit
                                    duis nec
                                    fringi communications company We build and activate brands through
                                    cultural insight,
                                    str vision, and.</div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeInUp animated" data-wow-delay="0.6s">
                            <h2 class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseEight"
                                    aria-expanded="false" aria-controls="collapseEight">What it the waist size
                                    for medium versus large?</button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse"
                                aria-labelledby="headingEight" data-bs-parent="#accordionExample2">
                                <div class="accordion-body">Communications det, consec tetur adipiscing elit
                                    duis nec
                                    fringi communications company We build and activate brands through
                                    cultural insight,
                                    str vision, and.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- faq area end here  -->

<!-- shop related product area start  -->
<section class="cp-related-product pt-145 pb-100 wow fadeInUp" data-wow-delay=".3s">
    <div class="container">
        <div class="row mb-30">
            <div class="col-md-10">
                <div class="cp-section-title mb-30">
                    <h2 class="cp-subhead lh-1">Related products</h2>
                </div>
            </div>
            <div class="col-md-2">
                <div
                    class="cp-testimonial2-nav cp-slider-round-button-wrap d-flex justify-content-lg-end p-relative cp mb-20">
                    <div class="cp-slider-round-button cp-product-button-prev"><i
                            class="fas fa-chevron-left"></i></div>
                    <div class="cp-slider-round-button cp-product-button-next"><i
                            class="fas fa-chevron-right"></i></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="cp-related-product-wrap">
                    <div class="swiper-container cp-related-product-active">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="product-single">
                                    <div class="product-thumb">
                                        <a href="shop-details.html" class="image">
                                            <img class="pic-1" src="assets/img/product/product-01.png"
                                                alt="product">
                                            <img class="pic-2" src="assets/img/product/product-11.png"
                                                alt="product">
                                        </a>
                                        <ul class="product-links">
                                            <li><a href="cart.html"><i class="fal fa-shopping-cart"></i></a>
                                            </li>
                                            <li><a href="assets/img/product/product-shop-1.html"
                                                    data-bs-toggle="modal" data-bs-target="#productModalId"><i
                                                        class="fal fa-eye"></i></a></li>
                                            <li><a href="wishlist.html"><i class="fal fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product-description">
                                        <h4 class="product-name">
                                            <a href="shop-details.html">T-shirts & tank tops</a>
                                        </h4>
                                        <div class="product-price">
                                            <span class="price-old">139.00$</span>
                                            <span class="price-now">100.00$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product-single">
                                    <div class="product-thumb">
                                        <span class="product-badge product-badge-new">new</span>
                                        <a href="shop-details.html" class="image">
                                            <img class="pic-1" src="assets/img/product/product-06.png"
                                                alt="product">
                                            <img class="pic-2" src="assets/img/product/product-11.png"
                                                alt="product">
                                        </a>
                                        <ul class="product-links">
                                            <li><a href="cart.html"><i class="fal fa-shopping-cart"></i></a>
                                            </li>
                                            <li><a href="assets/img/product/product-shop-1.html"
                                                    data-bs-toggle="modal" data-bs-target="#productModalId"><i
                                                        class="fal fa-eye"></i></a></li>
                                            <li><a href="wishlist.html"><i class="fal fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product-description">
                                        <h4 class="product-name">
                                            <a href="shop-details.html">White Woman T-Shirt.</a>
                                        </h4>
                                        <div class="product-price">
                                            <span class="price-now">120.00$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product-single">
                                    <div class="product-thumb">
                                        <a href="shop-details.html" class="image">
                                            <img class="pic-1" src="assets/img/product/product-10.png"
                                                alt="product">
                                            <img class="pic-2" src="assets/img/product/product-09.png"
                                                alt="product">
                                        </a>
                                        <ul class="product-links">
                                            <li><a href="cart.html"><i class="fal fa-shopping-cart"></i></a>
                                            </li>
                                            <li><a href="assets/img/product/product-shop-1.html"
                                                    data-bs-toggle="modal" data-bs-target="#productModalId"><i
                                                        class="fal fa-eye"></i></a></li>
                                            <li><a href="wishlist.html"><i class="fal fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product-description">
                                        <h4 class="product-name">
                                            <a href="shop-details.html">Graphic T-Shirt Trendy</a>
                                        </h4>
                                        <div class="product-price">
                                            <span class="price-now">12.00$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product-single">
                                    <div class="product-thumb">
                                        <span class="product-badge product-badge-sale">sale</span>
                                        <a href="shop-details.html" class="image">
                                            <img class="pic-1" src="assets/img/product/product-07.png"
                                                alt="product">
                                            <img class="pic-2" src="assets/img/product/product-09.png"
                                                alt="product">
                                        </a>
                                        <ul class="product-links">
                                            <li><a href="cart.html"><i class="fal fa-shopping-cart"></i></a>
                                            </li>
                                            <li><a href="assets/img/product/product-shop-1.html"
                                                    data-bs-toggle="modal" data-bs-target="#productModalId"><i
                                                        class="fal fa-eye"></i></a></li>
                                            <li><a href="wishlist.html"><i class="fal fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product-description">
                                        <h4 class="product-name">
                                            <a href="shop-details.html">Dark Green T-Shirt</a>
                                        </h4>
                                        <div class="product-price">
                                            <span class="price-now">100.00$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="product-single">
                                    <div class="product-thumb">
                                        <span class="product-badge product-badge-best">best sale</span>
                                        <a href="shop-details.html" class="image">
                                            <img class="pic-1" src="assets/img/product/product-08.png"
                                                alt="product">
                                            <img class="pic-2" src="assets/img/product/product-11.png"
                                                alt="product">
                                        </a>
                                        <ul class="product-links">
                                            <li><a href="cart.html"><i class="fal fa-shopping-cart"></i></a>
                                            </li>
                                            <li><a href="assets/img/product/product-shop-1.html"
                                                    data-bs-toggle="modal" data-bs-target="#productModalId"><i
                                                        class="fal fa-eye"></i></a></li>
                                            <li><a href="wishlist.html"><i class="fal fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product-description">
                                        <h4 class="product-name">
                                            <a href="shop-details.html">White T-Shirt</a>
                                        </h4>
                                        <div class="product-price">
                                            <span class="price-old">120.00$</span>
                                            <span class="price-now">100.00$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- shop related product area end  -->

<!-- shop modal start -->
<div class="modal fade" id="productModalId" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered product__modal" role="document">
        <div class="modal-content">
            <div class="product__modal-wrapper p-relative">
                <div class="product__modal-close p-absolute">
                    <button data-bs-dismiss="modal">
                        <i class="fal fa-times"></i>
                    </button>
                </div>
                <div class="product__modal-inner">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="product__modal-box">
                                <div class="tab-content" id="modalTabContent">
                                    <div class="tab-pane fade show active" id="nav1" role="tabpanel"
                                        aria-labelledby="nav1-tab">
                                        <div class="product__modal-img w-img">
                                            <img src="assets/img/product/product-06.png" alt="img not found">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav2" role="tabpanel"
                                        aria-labelledby="nav2-tab">
                                        <div class="product__modal-img w-img">
                                            <img src="assets/img/product/product-07.png" alt="img not found">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav3" role="tabpanel"
                                        aria-labelledby="nav3-tab">
                                        <div class="product__modal-img w-img">
                                            <img src="assets/img/product/product-10.png" alt="img not found">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav4" role="tabpanel"
                                        aria-labelledby="nav4-tab">
                                        <div class="product__modal-img w-img">
                                            <img src="assets/img/product/product-12.png" alt="img not found">
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav nav-tabs" id="modalTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="nav1-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav1" type="button" role="tab" aria-controls="nav1"
                                            aria-selected="true">
                                            <img src="assets/img/product/product-06.png" alt="img not found">
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="nav2-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav2" type="button" role="tab" aria-controls="nav2"
                                            aria-selected="false">
                                            <img src="assets/img/product/product-07.png" alt="img not found">
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="nav3-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav3" type="button" role="tab" aria-controls="nav3"
                                            aria-selected="false">
                                            <img src="assets/img/product/product-10.png" alt="img not found">
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="nav4-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav4" type="button" role="tab" aria-controls="nav4"
                                            aria-selected="false">
                                            <img src="assets/img/product/product-12.png" alt="img not found">
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="product__modal-content">
                                <h4>
                                    <a href="shop-details.html">maranta lemon lime</a>
                                </h4>
                                <div class="product__modal-des mb-40">
                                    <p>
                                        Typi non habent claritatem insitam, est usus legentis
                                        in iis qui facit eorum claritatem. Investigationes
                                        demonstraverunt
                                    </p>
                                </div>
                                <div class="product__stock">
                                    <span>Availability :</span>
                                    <span>In Stock</span>
                                </div>
                                <div class="product__stock sku mb-30">
                                    <span>SKU :</span>
                                    <span>Juicera C49J89: £875, Debenhams Plus</span>
                                </div>
                                <div class="product__review d-sm-flex">
                                    <div class="rating rating__shop mb-15">
                                        <ul>
                                            <li>
                                                <a href="#"><i class="fal fa-star"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fal fa-star"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fal fa-star"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fal fa-star"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fal fa-star"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product__add-review mb-15">
                                        <span><a href="shop-details.html">1 Review</a></span>
                                        <span><a href="shop-details.html">Add Review</a></span>
                                    </div>
                                </div>
                                <div class="product__price">
                                    <span>$59.00</span>
                                </div>
                                <div class="product__modal-form">
                                    <div class="product-quantity-cart mb-30">
                                        <div class="product-quantity-form">
                                            <form action="#">
                                                <button class="cart-minus">
                                                    <i class="far fa-minus"></i>
                                                </button>
                                                <input class="cart-input" type="text" value="1">
                                                <button class="cart-plus">
                                                    <i class="far fa-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <a href="cart.html" class="cp-border-btn">Add to Cart
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
                                <div class="product__modal-links">
                                    <ul>
                                        <li>
                                            <a href="#" title="Add to Wishlist"><i class="fal fa-heart"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" title="Compare"><i class="far fa-sliders-h"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" title="Print"><i class="fal fa-print"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" title="Share"><i class="fal fa-share-alt"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- shop modal end -->

<!-- floating area start here  -->
<div class="cp-floating-area d-none d-md-block zi-1100 p-relative ">
    <div class="cp-floating-action cp-bg-move-y">
        <span class="cp-floating-btn cp-floating-phone-btn cp" data-bs-toggle="modal"
            data-bs-target="#phonePopup"><i class="fal fa-phone-alt"></i></span>
        <span class="cp-floating-btn cp-floating-location-btn cp" data-bs-toggle="modal"
            data-bs-target="#locationPopup"><i class="fal fa-location-arrow"></i></span>
        <span class="cp-floating-btn cp-floating-form-btn cp" data-bs-toggle="modal"
            data-bs-target="#formPopup"><i class="fal fa-envelope-open-text"></i></span>
    </div>

    <!-- phone Modal start -->
    <div class="modal fade cp-floating-model" id="phonePopup" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="phonePopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="cp-floating-item cp-phone-popup" id="phonePopupLabel">
                    <div class="cp-floating-left w-img">
                        <img src="assets/img/cta/popup2.jpg" alt="contact">
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
                        <img src="assets/img/cta/cta-img.png" alt="contact">
                    </div>
                    <div class="cp-floating-left cp-signup-popup">
                        <h3 class="cp-floating-title">Do you have any question?</h3>
                        <div class="cp-floating-form">
                            <form action="#">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="cp-input-field">
                                            <label for="flname">Your Name</label>
                                            <input type="text" id="flname">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="cp-input-field">
                                            <label for="flemail">Your Email</label>
                                            <input type="email" id="flemail">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="cp-input-field">
                                            <label for="flmessage">Your question</label>
                                            <textarea id="flmessage" cols="30" rows="10"></textarea>
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
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var sele
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    window.onload = function() {
        setTimeout(myFunc, 1000);
    }

    var myFunc = function attributeValues() {
        var attributeId = $("#attribute_0").data('attribute_id');
        getAttributeValue(0, attributeId);    
      
    }

    async function getAttributeValue(key, attributeId) {
        var selectedIds = [];
        $(".attributes").each(function() {
            if($(this).find(':selected').val() != undefined){
                selectedIds.push($(this).find(':selected').val());
            }
        });
        var arrayIds = "";
        if(selectedIds.length > 0){
            arrayIds = selectedIds.toString(); 
        }
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        const url ='{{route("product.getAttributeValue")}}';
        var data = {
            'product_id': $("#product_id").val(),
            'attribute_id': attributeId,
            'key': key,
            'selectedIds': arrayIds,
            _token: csrf_token
        };
        try {
            const result = await doAjax(url, data);
            if(result['data']['productAttributeValues'] != null){
                var html = "";
                for (let index = 0; index < result['data']['productAttributeValues'].length; index++) {
                    if(index == 0){
                        if(key == 2){
                            html +='<option value= '+result['data']['productAttributeValues'][index]['id']+' selected>'+result['data']['productAttributeValues'][index]['name']+' ('+result['data']['groupData'][index]['price']+')</option>';
                        }else{
                            html +='<option value= '+result['data']['productAttributeValues'][index]['id']+' selected>'+result['data']['productAttributeValues'][index]['name']+'</option>';
                        }
                        
                    }else{

                        if(key == 2){
                            html +='<option value= '+result['data']['productAttributeValues'][index]['id']+'>'+result['data']['productAttributeValues'][index]['name']+' ('+result['data']['groupData'][index]['price']+')</option>';
                        }else{
                            html +='<option value= '+result['data']['productAttributeValues'][index]['id']+'>'+result['data']['productAttributeValues'][index]['name']+'</option>';
                        }
                        
                    }
                }

                $("#attribute_"+key+"").append(html);
                if(key == "0"){
                    var attributeId = $("#attribute_1").data('attribute_id');
                    $("#attribute_1").empty();
                    getAttributeValue(1, attributeId);
                }

                if(key == "1"){
                    var attributeId = $("#attribute_2").data('attribute_id');
                    $("#attribute_2").empty();
                    getAttributeValue(2, attributeId);
                }

                if(key == "2"){
                    var selectedIds = [];
                    $(".attributes").each(function() {
                        if($(this).find(':selected').val() != undefined){
                            selectedIds.push($(this).find(':selected').val());
                        }
                    });
                    var arrayIds = "";
                    if(selectedIds.length > 0){
                        arrayIds = selectedIds.toString(); 
                    }
                    getProductGroupValue(arrayIds);
                }
            }
        } catch (error) {
            console.log('Error! InsertAssignments:', error);
        }
        
    }


    async function getProductGroupValue(selectedIds) {
        
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        const url ='{{route("product.getProductGroupValue")}}';
        var data = {
            'product_id': $("#product_id").val(),
            'selectedIds': selectedIds,
            _token: csrf_token
        };
        try {
            const result = await doAjax(url, data);
            if(result['data'] != null){
                $(".variable_product_price").removeClass('hidden');
                $(".variable_product_amount").text('$'+result['data']['price']+'');
            }else{
                
                $(".variable_product_price").addClass('hidden');
                $(".variable_product_amount").text('');
            }
        } catch (error) {
            console.log('Error! InsertAssignments:', error);
        }
        
    }

    async function updateAttributeValue(key) {
        
        if(key == "2"){
            var selectedIds = [];
            $(".attributes").each(function() {
                if($(this).find(':selected').val() != undefined){
                    selectedIds.push($(this).find(':selected').val());
                }
            });
            var arrayIds = "";
            if(selectedIds.length > 0){
                arrayIds = selectedIds.toString(); 
            }
            getProductGroupValue(arrayIds);
        }else{
            var keyValue = parseInt(key) + 1;
            var attributeId = $("#attribute_"+keyValue+"").data('attribute_id');
            $("#attribute_"+keyValue+"").empty();
            getAttributeValue(keyValue, attributeId);
        }
        
        
    }

    async function doAjax(url, params = {}, method = 'POST') {
        return $.ajax({
        url: url,
        type: method,
        async: false,
        dataType: 'json',
        data: params
        });
    }
</script>
@endpush