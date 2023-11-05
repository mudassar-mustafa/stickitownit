@extends('frontend.layouts.app')
@section('title','Checkout')
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
        <!-- cart area start here  -->
        <section class="cp-cart-area pt-20">
            <div class="container">
                <div class="row wow fadeInUp animated" data-wow-duration="1.5s">

                    <!-- Product Information -->
                    <div class="col-xl-12 padding-right-0">

                        <div class="cp-cart-left mb-80 mr-10">
                            @if (Session::has('status') && Session::get('status') == "package")
                                <h4 class="cp-checkout-title">Package Information</h4>
                            @else
                                <h4 class="cp-checkout-title">Product Information</h4>
                            @endif
                            @if (Session::has('status') && Session::get('status') == "package")
                            <div class="cp-cart-table mb-50">
                                <h4>Package Name: {{ Session::get('packageName') }}</h4>
                            </div>

                            @else
                            <div class="cp-cart-table mb-50">
                                @php
                                    $cartTotal = 0;
                                    $extraFee = 0;
                                @endphp
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="cp-cart-product-name">PRODUCT NAME</th>
                                        <th class="cp-cart-product-quantity">QUANTITY</th>
                                        <th class="cp-cart-product-price">UNIT PRICE</th>
                                        <th class="cp-cart-product-total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (!empty($carts))
                                        @foreach ($carts as $cart)
                                            <tr>
                                                <td>
                                                    @php
                                                        $image = "";
                                                        if($cart->product_type =="sticker"){
                                                            $image = $cart->image_path;
                                                        }else{
                                                            $image = $cart->product_attribute_group_detail->main_image;
                                                        }

                                                        $cartTotal += $cart->product_attribute_group_detail->price;
                                                    @endphp
                                                    <a href="{{ route('product.productDetail', $cart->product_attribute_group_detail->product->slug) }}">
                                                        <img src="{{ $image }}"
                                                             alt="{{ $cart->product_attribute_group_detail->product->title }}">{{ $cart->product_attribute_group_detail->product->title }}
                                                        <small>{{ $cart->product_attribute_group_detail->short_description }}</small>
                                                    </a>
                                                </td>
                                                <td class="product-quantity text-center">
                                                    <div class="product-quantity mt-10 mb-10">
                                                        <div class="product-quantity-form cp-cart-quantity">
                                                                 <input class="cart-input" type="text"
                                                                       value="{{ $cart->qty }}" {{ $cart->product_type =="sticker" ? "readonly" : "" }}>

                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ round(($cart->product_attribute_group_detail->price /  $cart->qty ) ,2) }}</td>
                                                <td>{{ $cart->product_attribute_group_detail->price }}$</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- Product Information -->
                </div>
            </div>
        </section>
        <!-- cart area end here  -->
        <!-- checkout area start here  -->
        <section class="cp-checkout-area pt-5 pb-90">
            <div class="container">
                <form id="place_order" action="{{ route('placeOrder') }}" enctype="multipart/form-data" data-stripe-publishable-key="{{ config('app.stripe')['STRIPE_KEY'] }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ Session::has('status') && Session::get('status') == "package" ? "Package" : "Sale" }}" name="checkOutType">
                    <div class="row wow fadeInUp animated" data-wow-duration="1.5s">

                        <!-- Billing Detail -->
                        <div class="col-xl-12">
                            @if (Session::has('status') && Session::get('status') == "package")
                            @else
                            <div class="cp-checkout-left mb-30 mr-10">

                                <div class="cp-checkout-field-area">
                                    <div class="cp-checkout-box mb-30">
                                        <h4 class="cp-checkout-title">Billing Details</h4>
                                    </div>
                                    <div class="generator-button:hover">
                                        <div class="row">
                                            <div class="col-lg-4 padding-right-0">
                                                <div class="cp-input-field">
                                                    <label for="name">Name *</label>
                                                    <input type="text" id="name" name="name" value="{{ !empty($user) ? $user->name : "" }}" required>
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 padding-right-0">
                                                <div class="cp-input-field">
                                                    <label for="email">Email address *</label>
                                                    <input type="email" required id="email" name="email" value="{{ !empty($user) ? $user->email : "" }}">
                                                    <i class="far fa-envelope-open"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 padding-right-0">
                                                <div class="cp-input-field">
                                                    <label for="phone">Phone *</label>
                                                    <input type="text" required id="phone_number" name="phone_number" value="{{ !empty($user) ? $user->phone_number : "" }}">
                                                    <i class="far fa-phone"></i>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 padding-right-0">
                                                <div class="cp-input-field">
                                                    <label for="region">Country / Region *</label>
                                                    <select id="country" name="country_id" class="js-example-basic-single" onchange="getStates();" required>
                                                        <option value="">Please Select Country</option>
                                                        @if(!empty($countries) && count($countries) >0)
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->id}}" {{isset($user->country_id) && $user->country_id == $country->id ? "selected" : ""}}>{{$country->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <i class="far fa-place-of-worship"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 padding-right-0">
                                                <div class="cp-input-field">
                                                    <label for="state">State *</label>
                                                    <select id="state" name="state_id" class="js-example-basic-single" onchange="getCities();" required>
                                                        <option value="">Please Select State</option>
                                                        @if(!empty($states) && count($states) >0)
                                                            @foreach($states as $state)
                                                                <option value="{{$state->id}}" {{isset($user->state_id) && $user->state_id == $state->id ? "selected" : ""}}>{{$state->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <i class="far fa-city"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 padding-right-0">
                                                <div class="cp-input-field">
                                                    <label for="city">Town / City *</label>
                                                    <select id="city" name="city_id" class="js-example-basic-single" required>
                                                        <option value="">Please Select City</option>
                                                        @if(!empty($cities) && count($cities) > 0 )
                                                            @foreach($cities as $city)
                                                                <option value="{{$city->name}}" {{isset($user->city_id) && $user->city_id == $city->id ? "selected" : ""}}>{{$city->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <i class="far fa-city"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 padding-right-0">
                                                <div class="cp-input-field">
                                                    <label for="zip">ZIP Code *</label>
                                                    <input type="text" required id="zip" name="zip_code" value="{{ !empty($user) ? $user->zip_code : "" }}">
                                                    <i class="far fa-file-archive"></i>
                                                </div>
                                            </div>
                                            

                                            <div class="col-lg-8 padding-right-0">
                                                <div class="cp-input-field">
                                                    <label for="address">Street address *</label>
                                                    <input type="text" required id="address" name="address" value="{{ !empty($user) ? $user->address : "" }}">
                                                    <i class="far fa-map-marker-alt"></i>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="cp-checkout-box mb-30">
                                            <h4 class="cp-checkout-subtitle">Additional Information</h4>
                                            <div class="row">
                                                <div class="col-lg-12 padding-right-0">
                                                    <div class="cp-input-field textarea">
                                                        <label for="message">Order notes (optional)</label>
                                                        <textarea id="message" cols="30" rows="10"></textarea>
                                                        <i class="far fa-clipboard"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                        <!-- Billing Detail -->

                        <!-- Cart Information -->
                        <div class="col-xl-6 padding-right-0">
                            @if (Session::has('status') && Session::get('status') == "package")
                                <div class="cp-cart-total-area mb-40 ">
                                    <h4 class="cp-cart-subtotal">Package Totals</h4>
                                    <div class="cp-cart-total d-flex align-items-center justify-content-between mb-20">
                                        <h5>Package Totals</h5><span>{{ Session::get('packagePrice') }}$</span>
                                    </div>
                                    <div class="cp-cart-free d-flex align-items-center justify-content-between">
                                        <h5>Extra fee <span>( tax excl.)</span></h5><span>0$</span>
                                    </div>
                                    <div class="cp-cart-f-total d-flex align-items-center justify-content-between mb-30">
                                        <h6>Total : </h6><span>{{ Session::get('packagePrice') }}$</span>
                                    </div>
                                </div>
                            @else
                                <div class="cp-cart-total-area mb-40">
                                    <h4 class="cp-cart-subtotal">Cart Totals</h4>
                                    <div class="cp-cart-total d-flex align-items-center justify-content-between mb-20">
                                        <h5>Cart Totals</h5><span>{{ $cartTotal }}$</span>
                                    </div>
                                    <div class="cp-cart-free d-flex align-items-center justify-content-between">
                                        <h5>Extra fee <span>( tax excl.)</span></h5><span>{{ $extraFee }}$</span>
                                    </div>
                                    <div class="cp-cart-f-total d-flex align-items-center justify-content-between ">
                                        <h6>Total : </h6><span>{{ $cartTotal + $extraFee }}$</span>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <!-- Cart Information -->

                        <!-- Card Information -->
                        <div class="col-xl-6 padding-right-0">
                            <div class="cp-checkout-right mb-20 ml-10">
                                <div class="cp-checkout-payment mb-40">
                                    <label for="card-element">
                                        Credit or debit card
                                    </label>
                                    <div id="card-element" class="mb-25 ml-25 mt-25 mr-25">
                                        <!-- a Stripe Element will be inserted here. -->
                                    </div>

                                    <!-- Used to display form errors -->
                                    <div id="card-errors"></div>

                                    {{-- <label class="cp-checkout-payment-list">
                                        <input type="radio" checked="checked" name="payment">
                                        <span class="checkmark"></span>
                                        <span class="cp-checkout-payment-title">Check payments</span>
                                        <span>Please send a check to Store Name, Store Street, Store Town.</span>
                                    </label>
                                    <label class="cp-checkout-payment-list">
                                        <input type="radio" name="payment">
                                        <span class="checkmark"></span>
                                        <span class="cp-checkout-payment-title">Cash on delivery</span>
                                        <span>Pay with cash upon delivery.</span>
                                    </label>
                                    <label class="cp-checkout-payment-list">
                                        <input type="radio" name="payment">
                                        <span class="checkmark"></span>
                                        <span class="cp-checkout-payment-paypal d-flex align-items-center m-img">
                                            <span class="cp-checkout-payment-title">PayPal</span>
                                            <img src="assets/img/product/payment-getway.html" alt="payment-getway">
                                        </span>
                                        <a href="#">What is PayPal</a>
                                    </label> --}}
                                    <div class="cp-checkout-payment-terms mb-30">
                                        <input type="checkbox" id="cp-terms">
                                        <label for="cp-terms">I have read and agree to the website <a href="#">Terms and
                                                conditions</a></label>
                                    </div>
                                    <div class="cp-checkout-btn t-center pt-25">
                                        <button type="submit" class="cp-border2-btn">Proceed to Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card Information -->
                    </div>
                </form>
            </div>
        </section>
        <!-- checkout area end here  -->


        @include('frontend.includes.social')

    </main>
@endsection
@push('js')
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {


        $('#country').select2();
        $('#state').select2();
        $('#city').select2();

        var stripe = Stripe($("#place_order").data('stripe-publishable-key'));
        var elements = stripe.elements();
        var card = elements.create('card');

        // Add an instance of the card UI component into the `card-element` <div>
        card.mount('#card-element');

        const form = document.getElementById('place_order');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server

                    stripeTokenHandler(result.token);
                }
            });
        });
    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        const form = document.getElementById('place_order');
        const hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        //Submit the form
        form.submit();
      }

    async function getStates() {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        const url = '{{route("getStates")}}';
        var data = {
            'country_id': $("#country").val(),
            _token: csrf_token
        };
        try {
            const result = await doAjax(url, data);
            if (result['data'] != null) {
                var html = '<option value="">Please Select State</option>';
                $("#state").empty();
                if(result['data'] != null){
                    for (let index = 0; index < result['data'].length; index++) {
                        html +='<option value='+result['data'][index]['id']+'>'+result['data'][index]['name']+'</option>';
                    }
                    $("#state").append(html);
                    $("#state").select2();
                }
            } else {
            }
        } catch (error) {
            console.log('Error! InsertAssignments:', error);
        }

    }

    async function getCities() {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        const url = '{{route("getCities")}}';
        var data = {
            'state_id': $("#state").val(),
            _token: csrf_token
        };
        try {
            const result = await doAjax(url, data);
            if (result['data'] != null) {
                var html = '<option value="">Please Select City</option>';
                $("#city").empty();
                if(result['data'] != null){
                    for (let index = 0; index < result['data'].length; index++) {
                        html +='<option value='+result['data'][index]['id']+'>'+result['data'][index]['name']+'</option>';
                    }
                    $("#city").append(html);
                    $("#city").select2();
                }
            } else {
            }
        } catch (error) {
            console.log('Error! InsertAssignments:', error);
        }
    }

</script>
@endpush
