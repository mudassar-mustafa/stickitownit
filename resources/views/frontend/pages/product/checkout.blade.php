@extends('frontend.layouts.app')
@section('title','Checkout')
@push('css')
@endpush
@section('content')
    <main>
        <!-- cart area start here  -->
        <section class="cp-cart-area pt-20">
            <div class="container">
                <div class="row wow fadeInUp animated" data-wow-duration="1.5s">
                    <div class="col-xl-8">

                        <div class="cp-cart-left mb-80 mr-10">
                            <h4 class="cp-checkout-title">Product Information</h4>
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
                        </div>
                    </div>
                    <div class="col-xl-4 pt-70">
                        <div class="cp-cart-total-area mb-100 ml-10">
                            <h4 class="cp-cart-subtotal">Cart Totals</h4>
                            <div class="cp-cart-total d-flex align-items-center justify-content-between mb-20">
                                <h5>Cart Totals</h5><span>{{ $cartTotal }}$</span>
                            </div>
                            <div class="cp-cart-free d-flex align-items-center justify-content-between">
                                <h5>Extra fee <span>( tax excl.)</span></h5><span>{{ $extraFee }}$</span>
                            </div>
                            <div class="cp-cart-f-total d-flex align-items-center justify-content-between mb-30">
                                <h6>Total : </h6><span>{{ $cartTotal + $extraFee }}$</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- cart area end here  -->
        <!-- checkout area start here  -->
        <section class="cp-checkout-area pt-5 pb-90">
            <div class="container">
                <form action="#">
                    <div class="row wow fadeInUp animated" data-wow-duration="1.5s">
                        <div class="col-xl-8">
                            <div class="cp-checkout-left mb-30 mr-10">

                                <div class="cp-checkout-field-area">
                                    <div class="cp-checkout-box mb-30">
                                        <h4 class="cp-checkout-title">Billing Details</h4>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="name">First name *</label>
                                                    <input type="text" id="name" required>
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="lname">Last Name *</label>
                                                    <input type="text" required id="lname">
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="phone">Phone *</label>
                                                    <input type="text" required id="phone">
                                                    <i class="far fa-phone"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="cp-input-field">
                                                    <label for="email">Email address *</label>
                                                    <input type="email" required id="email">
                                                    <i class="far fa-envelope-open"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="cp-input-field">
                                                    <label for="region">Country / Region *</label>
                                                    <input type="text" required id="region">
                                                    <i class="far fa-place-of-worship"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="cp-input-field">
                                                    <label for="city">Town / City *</label>
                                                    <input type="text" required id="city">
                                                    <i class="far fa-city"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="cp-input-field">
                                                    <label for="zip">ZIP Code *</label>
                                                    <input type="text" required id="zip">
                                                    <i class="far fa-file-archive"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="cp-input-field">
                                                    <label for="address">Street address *</label>
                                                    <input type="text" required id="address">
                                                    <i class="far fa-map-marker-alt"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="cp-checkout-box mb-30">
                                        <h4 class="cp-checkout-subtitle">Additional Information</h4>
                                        <div class="row">
                                            <div class="col-lg-12">
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
                        <div class="col-xl-4">
                            <div class="cp-checkout-right mb-20 ml-10">
                                <div class="cp-checkout-payment mb-40">
                                    <label class="cp-checkout-payment-list">
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
                                    </label>
                                    <div class="cp-checkout-payment-terms mb-30">
                                        <input type="checkbox" id="cp-terms">
                                        <label for="cp-terms">I have read and agree to the website <a href="#">Terms and
                                                conditions</a></label>
                                    </div>
                                    <div class="cp-checkout-btn t-center">
                                        <button type="submit" class="cp-border2-btn">Proceed to Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- checkout area end here  -->


        @include('frontend.includes.social')

    </main>
@endsection
@push('js')
@endpush
