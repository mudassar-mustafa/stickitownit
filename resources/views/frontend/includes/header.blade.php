<!-- header area start  -->
<header>
    <div class="cp-header2">
        <div class="cp-header2-top cp-bg-12 d-none d-md-block">
            <div class="container-fluid">
                <div class="cp-header2-top-wrap d-flex align-items-center justify-content-between">
                    <div class="cp-header2-top-item">
                        <div class="cp-header2-info">
                            <ul>
                                <li><a href="tel:+8801236985"><i class="far fa-phone-alt"></i> +88 0123 6985</a>
                                </li>
                                <li><a href="mailto:example@gmail.com"><i class="far fa-envelope"></i>
                                        example@gmail.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu-show-hide" class="cp-header2-bottom mobile-space white-bg">
            <div class="container-fluid">
                <div class="cp-header2-bottom-wrap">
                    <div class="cp-header2-bottom-item">
                        <div class="logo">
                            <a href="{{ route('/') }}"><img src="{{ asset('assets/img/logo/logo.png') }}" alt="logo"></a>
                        </div>
                    </div>
                    <div class="cp-header2-bottom-item">
                        <div class="main-menu main-menu1 t-center">
                            <nav id="mobile-menu">
                                <ul>
                                    <li>
                                        <a href="{{ route('/') }}">Home</a>

                                    </li>
                                    @if(!empty($categories) && count($categories) >0)
                                        @foreach($categories as $category)
                                            <li><a href="{{ route('get.products-by-category',$category->slug) }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    @endif
{{--                                    <li class="menu-item-has-children">--}}
{{--                                        <a href="javascript:void(0)">Products</a>--}}
{{--                                        <ul class="sub-menu">--}}
{{--                                            @if(!empty($categories) && count($categories) >0)--}}
{{--                                                @foreach($categories as $category)--}}
{{--                                                    <li><a href="#">{{ $category->name }}</a></li>--}}
{{--                                                @endforeach--}}
{{--                                            @endif--}}
{{--                                            <li><a href="shop.html">shop</a></li>--}}
{{--                                            <li><a href="shop-sidebar.html">shop sidebar</a></li>--}}
{{--                                            <li><a href="shop-details.html">shop details</a></li>--}}
{{--                                            <li><a href="cart.html">cart</a></li>--}}
{{--                                            <li><a href="quote.html">quote</a></li>--}}
{{--                                            <li><a href="checkout.html">checkout</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
                                    <li><a href="{{ route('blogs.list') }}">Blogs</a></li>

                                    @if(!empty($pages) && count($pages) >0)
                                        @foreach($pages as $page)
                                            <li><a href="{{ route('page.index',$page->slug) }}">{{$page->name}}</a></li>
                                        @endforeach
                                    @endif

                                    <li><a href="{{ route('contact-us.index') }}">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="cp-header2-bottom-item">
                        <div class="cp-header2-action d-flex align-items-center justify-content-end">
                            <div class="d-none d-md-block">
                                <ul>
                                    @auth
                                        <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}"   onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-sign-out"></i></a>
                                            </form>
                                        </li>
                                    @else
                                        <li><a href="{{ route('login') }}"><i class="fas fa-user-alt"></i></a></li>
                                    @endauth


                                    @php
                                        $userId = auth()->check() == true ? auth()->id() : 0;
                                        $cartCount=  \App\Models\Cart::where('user_id', $userId)->count();
                                    @endphp
                                    <li><a href="{{ route('cart.index') }}"><i
                                                class="fas fa-cart-plus"></i><span>{{ $cartCount }}</span></a></li>
                                </ul>
                            </div>
                            <div class="cp-header-toggle-btn ml-35 mt--5 d-xl-none">
                                <div class="menu-bar">
                                    <a class="side-toggle" href="javascript:void(0)">
                                        <div class="bar-icon">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end -->
