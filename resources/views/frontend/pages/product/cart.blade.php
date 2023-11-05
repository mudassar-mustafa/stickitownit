@extends('frontend.layouts.app')
@section('title','Cart')
@push('css')
@endpush
@section('content')
    <div class="loading" style="display: none">Loading&#8230;</div>
    <!-- page title area start  -->
    <section class="page-title-area breadcrumb-spacing cp-bg-14">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-9">
                    <div class="page-title-wrapper t-center">
                        <h3 class="page-title mb-10">Cart</h3>
                        <div class="breadcrumb-menu d-flex justify-content-center">
                            <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                                <ul class="trail-items">
                                    <li class="trail-item trail-begin"><a href="{{ route('/') }}"><span>Home</span></a>
                                    </li>
                                    <li class="trail-item trail-end"><span>Cart</span></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page title area end  -->

    <!-- cart area start here  -->
    <section class="cp-cart-area pt-150 pb-50">
        <div class="container">
            <div class="row wow fadeInUp animated" data-wow-duration="1.5s">
                <div class="col-xl-8">
                    <div class="cp-cart-left mb-80 mr-10">
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
                                    <th class="cp-cart-product-total">Action</th>
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
                                                        <form action="#">
                                                            {{--                                            <button type="button" {{ $cart->product_type =="sticker" ? "disabled" : "" }} class="cart-minus"><i class="far fa-minus"></i></button>--}}
                                                            <input class="cart-input" type="text"
                                                                   value="{{ $cart->qty }}" {{ $cart->product_type =="sticker" ? "readonly" : "" }}>
                                                            {{--                                            <button class="cart-plus" type="button" {{ $cart->product_type =="sticker" ? "disabled" : "" }}><i class="far fa-plus"></i></button>--}}
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ round(($cart->product_attribute_group_detail->price /  $cart->qty ) ,2) }}</td>
                                            <td>{{ $cart->product_attribute_group_detail->price }}$</td>
                                            <td><a href="javascript:void(0)" onclick="removeProduct('{{ $cart->id }}')"><i
                                                        class="fas fa-trash"></i></a></td>
                                        </tr>
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
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
                        <div class="cp-cart-checkout-btn">
                            <a href="javascript:void(0)" class="cp-border2-btn" onclick="checkout()">
                                Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cart area end here  -->

    @include('frontend.includes.social')
@endsection
@push('js')

    <script>
        async function removeProduct(cartId) {

            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            const url = '{{route("product.removeToCart")}}';
            var data = {
                'cartId': cartId,
                _token: csrf_token
            };
            try {
                const result = await doAjax(url, data);
                if (result['data'] == true) {
                    location.reload(true);
                } else {
                }
            } catch (error) {

                console.log('Error! InsertAssignments:', error);
            }

        }

        function checkout(){
            $('.loading').show();
            {{   session()->forget(['status']) }}
            window.location.href = '{{ route('checkout.index') }}'
        }

    </script>

@endpush
