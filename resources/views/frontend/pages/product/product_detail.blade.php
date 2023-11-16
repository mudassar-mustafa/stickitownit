@extends('frontend.layouts.app')

@section('title',ucfirst($product->title) ?? 'Produce Digital Printing With Business Growing')
@section('description',$product->meta_description ?? 'Our mission is to take the pain out of sticker printing and make
it simple, fast, and affordable without compromising quality.')
@section('keywords',$product->meta_keywords ?? 'Stickers, Labels, Printing, Digital Printing')
@section('canonical','https://stickitownit.com')
@section('og-locale','en_US')
@section('og-type','website')
@section('og-title','Stickitownit')
@section('og-description','Our mission is to take the pain out of sticker printing and make it simple, fast, and
affordable without compromising quality.')
@section('og-url','https://stickitownit.com')
@section('og-site-name','Stickitownit')
@section('og-image', $product->main_image ?? "")

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
@endpush

@section('content')
    <div class="loading" style="display: none">Loading&#8230;</div>
    <!-- shop details area start  -->
    <section class="shop-details-area pt-150 pb-110 fix">
        <div class="container">
            <div class="row wow align-items-xl-center fadeInUp" data-wow-delay=".3s">
                <input type="hidden" value="{{ $product->id }}" id="product_id">
                <div class="col-lg-7">
                    <div class="product-d-img-tab-wrapper mb-70">
                        <div class=" vertical-slider">

                            <!-- Vertical Slider Start -->
                            <section class="slider">
                                <div class="slider__flex">
                                    <div class="slider__col">

                                        <div class="slider__prev">Prev</div>
                                        <!-- Кнопка для переключения на предыдущий слайд -->

                                        <div class="slider__thumbs">
                                            <div class="swiper-container">
                                                <!-- Слайдер с превью -->
                                                <div class="swiper-wrapper">
                                                    @if ($product->main_image != null)
                                                        <div class="swiper-slide">
                                                            <div class="slider__image"><img
                                                                    src="{{ $product->main_image }}"
                                                                    alt="{{ $product->title }}"/></div>
                                                        </div>
                                                    @endif
                                                    @if (!empty($product->product_images) && count($product->product_images) > 0)
                                                        @foreach ($product->product_images as $key => $productImage)
                                                            <div class="swiper-slide">
                                                                <div class="slider__image"><img
                                                                        src="{{ asset('storage/uploads/products/images/' . $productImage->filename) }}"
                                                                        alt="{{ $productImage->name }}"/>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                </div>
                                            </div>
                                        </div>

                                        <div class="slider__next">Next</div>
                                        <!-- Кнопка для переключения на следующий слайд -->

                                    </div>

                                    <div class="slider__images">
                                        <div class="swiper-container">
                                            <!-- Слайдер с изображениями -->
                                            <div class="swiper-wrapper">
                                                @if ($product->main_image != null)
                                                    <div class="swiper-slide">
                                                        <div class="slider__image"><img
                                                                src="{{ $product->main_image }}"
                                                                alt="{{ $product->title }}"/></div>
                                                    </div>
                                                @endif
                                                @if (!empty($product->product_images) && count($product->product_images) > 0)
                                                    @foreach ($product->product_images as $key => $productImage)
                                                        <div class="swiper-slide">
                                                            <div class="slider__image"><img
                                                                    src="{{ asset('storage/uploads/products/images/' . $productImage->filename) }}"
                                                                    alt="{{ $productImage->name }}"/>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </section>
                            <!-- Vertical Slider End -->
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

                       <div class="cp-bg-14 contact-us-border">
                           <h4 class="product-name">{{ $product->title ?? "" }}</h4>
                           @if ($product->product_type == "normal")
                               <div class="product-price">
                                   <span class="price-now">${{ $product->normal_product_groups->price }}</span>
                               </div>
                           @endif

                           @if (!empty($product->short_description))
                               <p class="mb-30">{{ $product->short_description }}</p>
                           @endif
                           <input type="hidden" value="" id="product_attribute_group_id">
                           @if ($product->product_type != "normal" && !empty($product->attributes))
                               <div class="row">
                                   @foreach ($product->attributes as $key => $attribute)
                                       <div
                                           class="{{ $key + 1 == count($product->attributes) ? "col-lg-12 col-md-12 col-sm-12 col-xs-12" : "col-lg-6 col-md-6 col-sm-12 col-xs-12" }}">
                                           <div class="cp-input-field">
                                               <label for="attribute_{{ $key }}">{{ $attribute->name }}{{ $attribute->name === 'Size' ? ' (Inches)' : '' }}</label>
                                               <select id="attribute_{{ $key }}" class="attributes js-example-basic-single"
                                                       data-attribute_id="{{ $attribute->id }}"
                                                       data-attribute_name="{{ $attribute->name }}" data-key="{{ $key }}"
                                                       onchange="updateAttributeValue('{{ $key }}')">
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
                               <span>Total Price: </span>
{{--                               <span>Categories :</span>--}}
{{--                               <span>{{ $categoryString }}</span>--}}
                           </div>
                           @if ($product->product_type == "normal")
                               <div class="product-d-meta tags mb-10">
                                   <span>Available :</span>
                                   <span>{{ $product->normal_product_groups->quantity }}</span>
                               </div>
                           @endif

                           @if ($product->product_type != "normal" && !empty($product->attributes))
                               <div class="cp-input-wrap cp-file t-center upload-btn">
                                   <input class="form-control" type="file" id="uploadFile" name="uploadFile"
                                            onchange="uploadUserFile()">
                                   <button class="cp-border2-btn hide ">Upload File</button>

                               </div>
                               <div class="text-center mt-minus-19">
                                   <div>or</div>
                                   <a href="{{ route('create.generation') }}"  class="color-green col-12 col-sm-auto col-lg-12 col-xl-auto mb-2"> Try our Ai Stickers Generator </a>

                               </div>
{{--                               <div class="my-2 d-flex align-items-center">--}}
{{--                                   Try our Ai Stickers Generator--}}

{{--                                   <a href="{{ route('create.generation') }}" class="cp-border-btn mt-15">--}}
{{--                                       Link--}}
{{--                                       <span class="cp-border-btn__inner">--}}
{{--                                            <span class="cp-border-btn__blobs">--}}
{{--                                                <span class="cp-border-btn__blob"></span>--}}
{{--                                                <span class="cp-border-btn__blob"></span>--}}
{{--                                                <span class="cp-border-btn__blob"></span>--}}
{{--                                                <span class="cp-border-btn__blob"></span>--}}
{{--                                            </span>--}}
{{--                                        </span>--}}
{{--                                   </a>--}}
{{--                               </div>--}}
                               <img src="" class="rounded d-block hidden uploadImage pt-2 pb-4" alt=""
                                    style="width: 200px; height:200px">
                               <a href="javascript:void(0);"
                                  onclick="addToCart('{{ auth()->check() }}', '{{ auth()->check() == true && auth()->user()->hasRole('SuperAdmin|Admin|Seller') == true ? 'admin' : 'customer' }}', 'sticker')"
                                  class="cp-border-btn cp-il hidden shopping-basket">
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
                           @endif
                       </div>

                    </div>
                </div>
            </div>

            <div class="product_info-faq-area pb-0 pt-20 wow fadeInUp" data-wow-delay=".3s">
                <div class="product-details-tab-wrapper">
                    <nav class="product-details-nav mb-60">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="pro-info-1-tab" data-bs-toggle="tab"
                               href="#pro-info-1"
                               role="tab" aria-selected="true">Description</a>

                            <a class="nav-item nav-link" id="pro-info-3-tab" data-bs-toggle="tab" href="#pro-info-3"
                               role="tab" aria-selected="false">Reviews ({{ isset($reviews) ? count($reviews) : 0 }}
                                )</a>
                        </div>
                    </nav>
                    <div class="row">
                        <div class="col-xl-10">
                            <div class="product-details-content mb-30">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade active show" id="pro-info-1" role="tabpanel">
                                        <div class="tabs-wrapper">
                                            <div class="product__details-des">
                                                {!! $product->description !!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pro-info-3" role="tabpanel">
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <div class="tabs-wrapper">
                                                    @if (!empty($reviews) && count($reviews) > 0)
                                                        @foreach ($reviews as $review)
                                                            <div class="course-review-item mb-30">
                                                                <div class="course-reviews-img">
                                                                    <a href="#"><img
                                                                            src="https://ui-avatars.com/api/?name={{ $review->user_detail->name }}+&color=7F9CF5&background=EBF4FF"
                                                                            alt="{{ $review->user_detail->name }}"></a>
                                                                </div>
                                                                <div class="course-review-list">
                                                                    <h5><a href="#">{{ $review->user_detail->name }}
                                                                            ({{ $review->user_detail->id }})</a></h5>
                                                                    <div class="course-start-icon">
                                                                        @for($i =0; $i < $review->rating; $i++)
                                                                            <i class="fas fa-star"></i>
                                                                        @endfor

                                                                    </div>
                                                                    <p>{{ $review->remarks }}</p>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- shop details area end  -->

    @if(!empty($relatedProducts) && count($relatedProducts) > 0)
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
                                    class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="cp-related-product-wrap">
                            <div class="swiper-container cp-related-product-active">
                                <div class="swiper-wrapper">
                                    @foreach($relatedProducts as $relatedProduct)
                                        <div class="swiper-slide">
                                            <div class="product-single">
                                                <div class="product-thumb">
                                                    <a href="{{ route('product.productDetail',$relatedProduct->slug) }}"
                                                       class="image">
                                                        <img class="pic-1" src="{{ $relatedProduct->main_image }}"
                                                             alt="{{ $relatedProduct->title }}">
                                                        <img class="pic-2" src="{{ $relatedProduct->main_image }}"
                                                             alt="{{ $relatedProduct->title }}">
                                                    </a>
                                                </div>
                                                <div class="product-description">
                                                    <h4 class="product-name">
                                                        <a
                                                            href="{{ route('product.productDetail',$relatedProduct->slug) }}">{{ $relatedProduct->title }}</a>
                                                    </h4>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- shop related product area end  -->
    @endif


    @include('frontend.includes.social')

@endsection
@push('js')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .select2-results__option {
            display: flex;
            justify-content: space-between;
        }
    </style>
    <script>
        function formatState(state) {
            if (!state.id) {
                return state.text;
            }

            var text = state.text.split('(');
            if (text.length > 0) {
                if (text[1] !== undefined) {
                    var text2 = text[1].split(')');
                    var $state = $(
                        `<span>${text[0]}</span><span class="float-end">$ ${text2[0]}</span>`
                    );
                } else {
                    var $state = $(
                        `<span>${text[0]}</span>`
                    );
                }

                return $state;
            } else {
                return state;
            }

        }

        var sele;
        $(document).ready(function () {
            $('.js-example-basic-single').select2({
                templateResult: formatState,
                templateSelection: formatState
            });
        });
        window.onload = function () {
            setTimeout(myFunc, 1000);
        }

        var myFunc = function attributeValues() {
            var attributeId = $("#attribute_0").data('attribute_id');
            getAttributeValue(0, attributeId);

        }

        async function getAttributeValue(key, attributeId) {
            if (key == 1) {
                $('#uploadFile').val('');
                $(".uploadImage").prop("src", "");
                $('.uploadImage').addClass('hidden');
                $(".shopping-basket").addClass('hidden');
            }
            var selectedIds = [];
            $(".attributes").each(function () {
                if ($(this).find(':selected').val() != undefined) {
                    selectedIds.push($(this).find(':selected').val());
                }
            });
            var arrayIds = "";
            if (selectedIds.length > 0) {
                arrayIds = selectedIds.toString();
            }
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            const url = '{{route("product.getAttributeValue")}}';
            var data = {
                'product_id': $("#product_id").val(),
                'attribute_id': attributeId,
                'key': key,
                'selectedIds': arrayIds,
                _token: csrf_token
            };
            try {
                const result = await doAjax(url, data);
                if (result['data']['productAttributeValues'] != null) {
                    let productAttributeValues = JSON.parse(JSON.stringify(result['data']))
                    console.log('response: ', productAttributeValues)
                    var html = "";
                    for (let index = 0; index < result['data']['productAttributeValues'].length; index++) {
                        if (index == 0) {
                            if (key == 2) {
                                html += '<option style="display:flex; justify-content:space-between;" value= ' + result[
                                    'data']['productAttributeValues'][index]['id'] + ' selected>' + result['data'][
                                    'productAttributeValues'
                                    ][index]['name'] + '<span style="float:right;">(' + result['data']['groupData'][index][
                                    'price'
                                    ] + ')</span></option>';
                            } else {
                                html += '<option style="display:flex; justify-content:space-between;" value= ' + result[
                                    'data']['productAttributeValues'][index]['id'] + ' selected>' + result['data'][
                                    'productAttributeValues'
                                    ][index]['name'] + '</option>';
                            }

                        } else {

                            if (key == 2) {
                                html += '<option style="display:flex; justify-content:space-between;" value= ' + result[
                                    'data']['productAttributeValues'][index]['id'] + '>' + result['data'][
                                    'productAttributeValues'
                                    ][index]['name'] + ' <span style="float:right;">(' + result['data']['groupData'][index][
                                    'price'
                                    ] + ')</span></option>';
                            } else {
                                html += '<option style="display:flex; justify-content:space-between;" value= ' + result[
                                    'data']['productAttributeValues'][index]['id'] + '>' + result['data'][
                                    'productAttributeValues'
                                    ][index]['name'] + '</option>';
                            }

                        }
                    }


                    $("#attribute_" + key + "").append(html);
                    if (key == "0") {
                        var attributeId = $("#attribute_1").data('attribute_id');
                        $("#attribute_1").empty();
                        getAttributeValue(1, attributeId);
                    }

                    if (key == "1") {
                        var attributeId = $("#attribute_2").data('attribute_id');
                        $("#attribute_2").empty();
                        getAttributeValue(2, attributeId);
                    }

                    if (key == "2") {
                        var selectedIds = [];
                        $(".attributes").each(function () {
                            if ($(this).find(':selected').val() != undefined) {
                                selectedIds.push($(this).find(':selected').val());
                            }
                        });
                        var arrayIds = "";
                        if (selectedIds.length > 0) {
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
            const url = '{{route("product.getProductGroupValue")}}';
            var data = {
                'product_id': $("#product_id").val(),
                'selectedIds': selectedIds,
                _token: csrf_token
            };
            try {
                const result = await doAjax(url, data);
                if (result['data'] != null) {
                    $(".variable_product_price").removeClass('hidden');
                    var description = result['data']['short_description'];
                    var descriptionArray = description.split("-");
                    var qty = parseInt(descriptionArray[2]);
                    var unitPrice = parseFloat(result['data']['price']) / qty;
                    $(".variable_product_amount").html('$' + result['data']['price'] + '<br><small class="small-label">$' + unitPrice.toFixed(2) +
                        ' each</small>');
                    $("#product_attribute_group_id").val(result['data']['id']);
                } else {
                    $(".variable_product_price").addClass('hidden');
                    $(".variable_product_amount").html('');
                }
            } catch (error) {
                console.log('Error! InsertAssignments:', error);
            }

        }

        async function updateAttributeValue(key) {

            if (key == "2") {
                var selectedIds = [];
                $(".attributes").each(function () {
                    if ($(this).find(':selected').val() != undefined) {
                        selectedIds.push($(this).find(':selected').val());
                    }
                });
                var arrayIds = "";
                if (selectedIds.length > 0) {
                    arrayIds = selectedIds.toString();
                }
                getProductGroupValue(arrayIds);
            } else {
                var keyValue = parseInt(key) + 1;
                var attributeId = $("#attribute_" + keyValue + "").data('attribute_id');
                $("#attribute_" + keyValue + "").empty();
                getAttributeValue(keyValue, attributeId);
            }
        }

        function uploadUserFile() {
            var ext = $('#uploadFile').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['png', 'jpg', 'jepg']) == -1) {
                $.growl.error({
                    title: "Error",
                    message: "Please add Only PNG,JPG.",
                    duration: 3200
                });
                $('#uploadFile').val('');
                return false;
            }
            var files = $('#uploadFile')[0].files[0];
            var f = files;
            var fileReader = new FileReader();
            fileReader.onload = (function (e) {
                var file = e.target;

                $(".uploadImage").prop("src", e.target.result);
                $('.uploadImage').removeClass('hidden');
                $(".shopping-basket").removeClass('hidden');
            });
            fileReader.readAsDataURL(f);
        }

        function addToCart(user, userType, type) {
            $('.loading').show();
            if (user == false) {
                window.location.href = "{{ url('/login') }}";
            } else {
                if (userType == "admin") {
                    toastr.info("Admin can't add product in cart.");
                    return false;
                }
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                var form_data = new FormData();
                if (document.getElementById('uploadFile').files[0] != undefined) {
                    form_data.append("image", document.getElementById('uploadFile').files[0]);
                }
                form_data.append("product_attribute_group_id", $("#product_attribute_group_id").val());
                form_data.append("product_type", type);
                form_data.append("_token", csrf_token);
                $.ajax({
                    type: 'POST',
                    url: '{{route("product.addToCart")}}',
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.data == 1) {
                            toastr.success("Product added in cart successfully");
                            window.location.href = '{{ route('cart.index') }}';
                        } else if (data.data == -1) {
                            toastr.warning("Product already add in cart");
                        } else {
                            toastr.error("Something went Wrong.");

                        }
                        $('.loading').hide();
                    }
                });
            }
        }

        // -------------------------------------------------------------------------------------------
        const sliderThumbs = new Swiper('.vertical-slider .slider__thumbs .swiper-container', { // ищем слайдер превью по селектору
            // задаем параметры
            direction: 'vertical', // вертикальная прокрутка
            slidesPerView: 3, // показывать по 3 превью
            spaceBetween: 24, // расстояние между слайдами
            navigation: { // задаем кнопки навигации
                nextEl: '.vertical-slider .slider__next', // кнопка Next
                prevEl: '.vertical-slider .slider__prev' // кнопка Prev
            },
            freeMode: true, // при перетаскивании превью ведет себя как при скролле
            breakpoints: { // условия для разных размеров окна браузера
                0: { // при 0px и выше
                    direction: 'horizontal', // горизонтальная прокрутка,
                },
                768: { // при 768px и выше
                    direction: 'vertical' // вертикальная прокрутка
                }
            }
        });
        // Инициализация слайдера изображений
        const sliderImages = new Swiper('.vertical-slider .slider__images .swiper-container', { // ищем слайдер превью по селектору
            // задаем параметры
            direction: 'vertical', // вертикальная прокрутка
            slidesPerView: 1, // показывать по 1 изображению
            spaceBetween: 32, // расстояние между слайдами
            mousewheel: true, // можно прокручивать изображения колёсиком мыши
            navigation: { // задаем кнопки навигации
                nextEl: '.vertical-slider .slider__next', // кнопка Next
                prevEl: '.vertical-slider .slider__prev' // кнопка Prev
            },
            grabCursor: true, // менять иконку курсора
            thumbs: { // указываем на превью слайдер
                swiper: sliderThumbs // указываем имя превью слайдера
            },
            breakpoints: { // условия для разных размеров окна браузера
                0: { // при 0px и выше
                    direction: 'horizontal', // горизонтальная прокрутка
                },
                768: { // при 768px и выше
                    direction: 'vertical' // вертикальная прокрутка
                }
            }
        });
    </script>
@endpush
@push('niceSelect')
    <script src="{{ asset('assets/js/nice-select.min.js') }}"></script>
@endpush
