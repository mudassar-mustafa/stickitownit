<!-- header area start  -->
<header class="header-sticky">
    <div class="cp-header2">
        <div class="cp-header2-top cp-bg-12 d-none d-md-block">
            <div class="container-fluid">
                <div class="cp-header2-top-wrap d-flex align-items-center justify-content-between">
                    <div class="cp-header2-top-item">
                        <div class="cp-header2-info">
                            <ul>
                                <li><a href="tel:{{ $setting->phone_number }}"><i class="far fa-phone-alt"></i> {{ $setting->phone_number }}</a>
                                </li>
                                <li><a href="mailto:{{ $setting->email }}"><i class="far fa-envelope"></i>
                                        {{ $setting->email }}</a>
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
                            <a href="{{ route('/') }}">
                                <img class="my-3 width-17" src="{{ asset('storage/uploads/settings/'.$setting->logo_header) }}" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="cp-header2-bottom-item">
                        <div class="main-menu main-menu1 t-center">
                            <nav id="mobile-menu">
                                <ul>
                                    <li>
                                        <a href="{{ route('/') }}">Home</a>

                                    </li>

                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0)">Custom</a>
                                        <ul class="sub-menu">
                                            @if(!empty($categories) && count($categories) >0)
                                                @foreach($categories as $category)
                                                    <li><a href="{{ route('get.products-by-category',$category->slug) }}">{{ $category->name }}</a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('blogs.list') }}">Blogs</a></li>

                                    @if(!empty($pages) && count($pages) >0)
                                        @foreach($pages as $page)
                                            <li><a href="{{ route('page.index',$page->slug) }}">{{$page->name}}</a></li>
                                        @endforeach
                                    @endif

                                    <li><a href="{{ route('contact-us.index') }}">Contact</a></li>
                                    <li><a href="{{ route('packages') }}">Packages</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="cp-header2-bottom-item">
                        <div class="cp-header2-action d-flex align-items-center justify-content-end">
                            <div class="d-none d-md-block">
                                <ul>
                                    @php
                                        $userId = auth()->check() == true ? auth()->id() : 0;
                                        $cartCount=  \App\Models\Cart::where('user_id', $userId)->count();
                                    @endphp
                                    <li>
                                        <a href="{{ route('cart.index') }}">
                                            <i class="fas fa-cart-plus"  data-bs-toggle="tooltip" title="Cart"></i>
                                            <span>{{ $cartCount }}</span>
                                        </a>
                                    </li>

                                    @auth
                                        <li  data-bs-toggle="tooltip" title="Dashboard">
                                            <a href="{{ route('dashboard') }}">
                                            <i class="fa fa-server" aria-hidden="true"></i>
                                                <!-- <i class="fas fa-home"></i> -->
                                            </a>
                                        </li>
                                        <li  data-bs-toggle="tooltip" title="Logout">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}"   onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="fas fa-sign-out"></i></a>
                                            </form>
                                        </li>
                                    @else
                                        <li  data-bs-toggle="tooltip" title="Loginn">
                                            <a href="{{ route('login') }}">
                                                <i class="fas fa-user-alt"></i>
                                            </a>
                                        </li>
                                    @endauth

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
