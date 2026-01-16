@php
    $cart = collect();
    $wish = collect();

    if (auth()->user() != null) {
        $user_id = Auth::user()->id;
        $cart = \App\Models\Cart::where('user_id', $user_id)->get();
        $wish = \App\Models\Wishlist::where('user_id', $user_id)->get();
    } else {
        $temp_user_id = Session()->get('temp_user_id');
        if ($temp_user_id) {
            $cart = \App\Models\Cart::where('temp_user_id', $temp_user_id)->get();
        }
    }
@endphp

<style>
    .dropdown-menu i{ font-size: 2rem; }
    a.dropdown-item{ display:flex; color:#000; font-size:1.4rem; }
    .nav-box-text{ font-size: 1.4rem; }

    .modal.show{ display:flex; align-items:center; }
    .modal.show .modal-dialog{ height:100%; display:flex; align-items:center; }

    .align-center{ transform: translate3d(-14px, 44px, 0px) !important; }

    #search-content-mobile a img{ max-width: unset !important; }
    #search-content-mobile .list-group-item{ margin:10px 0; }

    /* Small improvements for mobile/tap targets */
    @media (max-width: 576px){
        .ps-header__middle .nav-box-text{ display:none; }
    }
</style>

<div class="ps-page">
    <header class="ps-header ps-header--1">
        <div class="ps-noti">
            <div class="container">
                <div class="alert alert-dismissible fade show" role="alert" style="position:relative;padding:0;margin-bottom:0;border:none;border-radius:.25rem;">
                    <p class="m-0 text-white">{!! $about->information !!}</p>
                </div>
            </div>
            <a class="ps-noti__close" aria-label="Close notification"><i class="icon-cross"></i></a>
        </div>

        <div class="ps-header__top">
            <div class="container">
                <div class="ps-header__text"></div>
            </div>
        </div>

        <div class="ps-header__middle">
            <div class="container d-flex">
                <div class="ps-logo">
                    <a href="{{ route('home') }}">
                        <img width="130" src="{{ uploaded_asset($about->wl) }}" alt="Dr. Med Pharmacy">
                        <img class="sticky-logo" src="{{ uploaded_asset($about->wl) }}" alt="Dr. Med Pharmacy">
                    </a>
                </div>

                <a class="ps-menu--sticky" href="#" aria-label="Open menu"><i class="fa fa-bars"></i></a>

                <div class="ps-header__right">

                    {{-- CART --}}
                    <div class="header-action-icon-2 position-relative" style="margin-left:20px;">
                        <a class="text-center d-flex align-items-center ml-3 mr-3"
                           href="{{ route('cart') }}"
                           aria-label="Open cart">

                            <img src="{{ static_asset('assets/img/cart.png') }}" width="25" height="25" alt="Cart" loading="lazy" />
                            <p class="nav-box-text mb-0 ml-2"></p>

                            <span class="cart-count"
                                  style="background:#C10007;color:#fff;position:absolute;top:0;right:-17px;border-radius:50%;width:25px;height:25px;display:flex;align-items:center;justify-content:center;font-size:13px;">
                                {{ isset($cart) ? count($cart) : 0 }}
                            </span>
                        </a>

                        <div class="cart-dropdown-wrap cart-dropdown-hm2 p-0" id="navcart_items">
                            <ul>
                                @if(isset($cart) && count($cart) > 0)

                                    <div class="p-3 fs-17 text-left fw-600 text-dark border-bottom cart-item-heading">
                                        {{ translate('Your Cart') }}
                                    </div>

                                    <p style="color:gray;font-weight:500;text-align:left;padding:10px;margin-bottom:0;">
                                        {{ count($cart) }} {{ Str::plural('item', count($cart)) }} in your cart
                                    </p>

                                    <ul class="overflow-auto c-scrollbar-light h-100 flex-1 list-group list-group-flush">
                                        @php $total = 0; @endphp

                                        @foreach($cart as $key => $cartItem)
                                            @php
                                                $product = \App\Models\Product::find($cartItem['product_id']);
                                                $total = $total + $cartItem['price'] * $cartItem['quantity'];
                                            @endphp

                                            @if ($product != null)
                                                <li class="list-group-item mb-3">
                                                    <span class="d-flex align-items-center nostyle" style="background:#f0f8ff3b;padding:10px;box-shadow:rgba(100,100,111,0.2) 0px 7px 29px 0px;">
                                                        <a href="{{ route('product', $product->slug) }}"
                                                           class="text-reset d-flex align-items-center flex-grow-1">

                                                            <img src="{{ asset('assets/img/placeholder.jpg') }}"
                                                                 data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                                 class="img-fit lazyload size-60px rounded"
                                                                 alt="{{ $product->getTranslation('name') }}">

                                                            <span class="minw-0 fs-14 text-left pl-2 flex-grow-1">
                                                                <span style="line-height:1.5;" class="fw-600 mb-1 text-truncate-2 cart-product-name text-dark">
                                                                    {{ $product->getTranslation('name') }}
                                                                </span>

                                                                <div class="d-flex align-items-center mt-1">
                                                                    <span class="cart-product-quantity mr-2">
                                                                        <button
                                                                            onclick="updateCartQuantity({{ $cartItem['id'] }}, {{ $cartItem['quantity'] - 1 }})"
                                                                            class="btn btn-sm btn-icon stop-propagation"
                                                                            style="padding:6px 2px;"
                                                                            {{ $cartItem['quantity'] <= 1 ? 'disabled' : '' }}>
                                                                            <i class="la la-minus text-primary"></i>
                                                                        </button>

                                                                        <span class="mx-2" style="border-radius:8px;padding:0 8px;background:var(--primary-color);color:#fff;">
                                                                            {{ $cartItem['quantity'] }}
                                                                        </span>

                                                                        <button
                                                                            onclick="updateCartQuantity({{ $cartItem['id'] }}, {{ $cartItem['quantity'] + 1 }})"
                                                                            class="btn btn-sm btn-icon stop-propagation"
                                                                            style="padding:6px 2px;">
                                                                            <i class="la la-plus text-primary"></i>
                                                                        </button>
                                                                    </span>

                                                                    <span class="cart-product-price">{{ single_price($cartItem['price'] * $cartItem['quantity']) }}</span>
                                                                </div>
                                                            </span>
                                                        </a>

                                                        <span>
                                                            <button onclick="removeFromCart({{ $cartItem['id'] }})"
                                                                    class="btn btn-sm btn-icon btn-no-hover stop-propagation"
                                                                    aria-label="Remove item">
                                                                <i class="la la-close"></i>
                                                            </button>
                                                        </span>
                                                    </span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    <div class="px-3 py-2 fs-15 border-top d-flex justify-content-between" style="background:#fff;color:#000;font-weight:600;margin:20px 0;">
                                        <span class="fw-600">{{ translate('Total') }}</span>
                                        <span class="fw-600">{{ single_price($total) }}</span>
                                    </div>

                                    <div class="px-3 py-2 text-center border-top">
                                        <ul class="list-inline mb-0 d-flex flex-column">
                                            <li class="list-inline-item">
                                                <a href="{{ route('cart') }}" class="btn primary-btn w-100 text-white rounded-full">
                                                    {{ translate('View All Cart') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                @else
                                    <div class="text-center p-3">
                                        <img src="{{ static_asset('assets/img/empty-cart.png') }}" width="220" height="220" alt="Empty cart" loading="lazy" />
                                        <h3 class="h6 fs-14 fw-700">{{ translate('Your Cart is empty') }}</h3>
                                    </div>
                                @endif
                            </ul>
                        </div>
                    </div>

                    {{-- WISHLIST --}}
                    <a class="text-center d-flex align-items-center ml-3 mt-1 wishlist-link"
                       href="{{ route('wishlists.index') }}"
                       aria-label="Wishlist">

                        <i class="la la-heart"></i>
                        <i class="la la-heart-o"></i>

                        <span style="background:#C10007;color:#fff;position:absolute;top:-10px;right:-26px;border-radius:50%;width:25px;height:25px;display:flex;align-items:center;justify-content:center;font-size:13px;"
                              id="wishlist-count">
                            {{ isset($wish) ? count($wish) : 0 }}
                        </span>
                    </a>

                    {{-- USER / AUTH --}}
                    @auth
                        @if(isAdmin())
                            <a class="d-flex align-items-center usernav"
                               style="background:#C10007;color:#fff;padding:0 20px;border-radius:999px;"
                               href="{{ route('admin.dashboard') }}">
                                <i class="fa fa-user"></i>
                                <p class="mb-0 pl-2">Admin Portal</p>
                            </a>
                        @else
                            <div class="align-items-stretch d-flex dropdown">
                                <a class="text-center noafter d-flex align-items-center usernav"
                                   style="background:#C10007;color:#fff;padding:0 20px;border-radius:999px;"
                                   data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                    <p class="nav-box-text mb-0 ml-2">
                                        Hello,
                                        @php
                                            $name = Auth::user()->name;
                                            $firstName = explode(' ', $name)[0];
                                        @endphp
                                        {{ $firstName }}
                                    </p>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-md p-0 align-center">
                                    <a href="{{ route('dashboard') }}" class="dropdown-item p-3">
                                        <i class="las la-user-circle mr-2"></i>
                                        <span>{{ translate('Profile Dashboard') }}</span>
                                    </a>

                                    <a href="{{ route('logout') }}" class="dropdown-item p-3">
                                        <i class="las la-sign-out-alt mr-2"></i>
                                        <span>{{ translate('Logout') }}</span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @else
                        <a class="d-flex align-items-center usernav"
                           style="background:#C10007;color:#fff;padding:0 20px;border-radius:999px;"
                           href="{{ route('user.login') }}">
                            <i class="fa fa-user"></i>
                            <p class="mb-0 pl-2">Sign In</p>
                        </a>
                    @endauth

                    {{-- SEARCH --}}
                    <div class="ps-header__search position-relative">
                        <form action="{{ route('search') }}" method="GET" class="stop-propagation mb-0">
                            <div class="ps-search-table">
                                <div class="input-group">
                                    <input type="text" class="form-control ps-input" id="search" name="keyword"
                                           @isset($query) value="{{ $query }}" @endisset
                                           placeholder="{{ translate('Search for products..') }}" autocomplete="off">
                                    <div class="input-group-append">
                                        <a href="#" aria-label="Search"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100"
                             style="z-index:99;min-height:200px;">
                            <div class="search-preloader absolute-top-center">
                                <div class="dot-loader"><div></div><div></div><div></div></div>
                            </div>
                            <div class="search-nothing d-none p-3 text-center fs-16"></div>
                            <div id="search-content" class="text-left"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="ps-navigation" style="background:#262626;">
            <div class="container">
                <div class="ps-navigation__left">
                    <nav class="ps-main-menu">
                        <ul class="menu">

                            <li class="has-mega-menu">
                                <a href="{{ route('categories.all') }}">
                                    <i class="fa fa-bars"></i>All Categories
                                    <span class="sub-toggle"><i class="fa fa-chevron-down"></i></span>
                                </a>

                                <div class="mega-menu">
                                    <div class="container">
                                        <div class="mega-menu__row">
                                            @foreach (\App\Models\Category::where('level', 0)->orderBy('order_level','desc')->get() as $main_category)
                                                <div class="mega-menu__column">
                                                    <a style="font-weight:600;font-size:15px;color:#C10007;text-transform:capitalize;margin-bottom:0;"
                                                       href="{{ route('products.category', $main_category->slug) }}">
                                                        {{ $main_category->getTranslation('name') }}
                                                    </a>

                                                    @php
                                                        $subcategories = \App\Models\Category::where('parent_id', $main_category->id)->get();
                                                    @endphp

                                                    @if ($subcategories->count())
                                                        <ul class="sub-menu--mega">
                                                            @foreach ($subcategories as $subcategory)
                                                                <li>
                                                                    <a href="{{ route('products.category', $subcategory->slug) }}">
                                                                        {{ $subcategory->getTranslation('name') }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>

                            @foreach (\App\Models\Category::where('level', 0)->where('featured', 1)->orderBy('order_level', 'desc')->get() as $secondmain_category)
                                <li>
                                    <a href="{{ route('products.category', $secondmain_category->slug) }}">
                                        {{ $secondmain_category->name }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </nav>
                </div>

                <div class="ps-navigation__right" style="display:flex">
                    @if(Auth::check())
                        <a href="{{ route('orders.track') }}">{{ translate('Track My Order') }}</a>
                    @else
                        <a onclick="showCheckoutModal()">{{ translate('Track My Order') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </header>

    {{-- MOBILE HEADER --}}
    <header class="ps-header ps-header--1 ps-header--mobile">
        <div class="ps-noti">
            <div class="container">
                <p class="m-0">{!! $about->information !!}</p>
            </div>
            <a class="ps-noti__close" aria-label="Close notification"><i class="icon-cross"></i></a>
        </div>

        <div class="ps-header__middle">
            <div class="container d-flex px-4">
                <div class="d-flex align-items-center">
                    <a href="javascript:void(0)" style="padding:20px;margin-left:-20px;"
                       class="mobile-menu-toggle" aria-label="menu-toggle">
                        <i class="fa fa-bars"></i>
                    </a>

                    <div class="ps-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ static_asset('assets/img/logo.svg') }}" alt="Dr. Med Pharmacy" loading="lazy">
                        </a>
                    </div>
                </div>

                <div class="d-flex">

                    @auth
                        @if(!isAdmin())
                            <a class="text-center d-flex align-items-center" href="{{ route('dashboard') }}">
                                <img src="{{ static_asset('assets/img/user.png') }}" width="25" height="25" alt="User" loading="lazy" />
                            </a>
                        @endif
                    @else
                        <a href="{{ route('user.login') }}" aria-label="Sign in">
                            <img src="{{ static_asset('assets/img/user.png') }}" width="25" height="25" alt="User" loading="lazy" />
                        </a>
                    @endauth

                    <a class="text-center d-flex align-items-center ml-3" href="{{ route('wishlists.index') }}" aria-label="Wishlist">
                        <img src="{{ static_asset('assets/img/heart.png') }}" width="25" height="25" alt="Wishlist" loading="lazy" />
                        <span style="background:#C10007;color:#fff;position:absolute;top:0;right:-12px;border-radius:50%;width:25px;height:25px;display:flex;align-items:center;justify-content:center;font-size:13px;"
                              id="wishlist-count">
                            {{ isset($wish) ? count($wish) : 0 }}
                        </span>
                    </a>

                    <a class="text-center d-flex align-items-center ml-3 mr-3" href="{{ route('cart') }}" aria-label="Cart">
                        <img src="{{ static_asset('assets/img/cart.png') }}" width="25" height="25" alt="Cart" loading="lazy" />
                        @if(isset($cart) && count($cart) > 0)
                            <span class="cart-count" style="background:#C10007;color:#fff;position:absolute;top:0;right:-17px;border-radius:50%;width:25px;height:25px;display:flex;align-items:center;justify-content:center;font-size:13px;">
                                {{ count($cart) }}
                            </span>
                        @else
                            <span class="cart-count" style="background:#C10007;color:#fff;position:absolute;top:0;right:-17px;border-radius:50%;width:25px;height:25px;display:flex;align-items:center;justify-content:center;font-size:13px;">
                                0
                            </span>
                        @endif
                    </a>

                </div>
            </div>

            <div class="ps-header__search position-relative">
                <form action="{{ route('search') }}" method="GET" class="stop-propagation mb-0">
                    <div class="ps-search-table">
                        <div class="input-group">
                            <input type="text" class="form-control ps-input" id="search-mobile" name="keyword"
                                   @isset($query) value="{{ $query }}" @endisset
                                   placeholder="{{ translate('Search for products..') }}" autocomplete="off">
                            <div class="input-group-append">
                                <a href="#" aria-label="Search"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="typed-search-box-mobile stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100"
                     style="z-index:99;min-height:200px;">
                    <div class="search-preloader absolute-top-center">
                        <div class="dot-loader"><div></div><div></div><div></div></div>
                    </div>
                    <div class="search-nothing d-none p-3 text-center fs-16"></div>
                    <div id="search-content-mobile" class="text-left"></div>
                </div>
            </div>
        </div>
    </header>

    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-overlay"></div>
        <a href="#" class="mobile-menu-close" aria-label="Close menu"><i class="close-icon"></i></a>

        <div class="mobile-menu-container scrollable px-0">
            <div class="tab-content">
                <h4 style="padding:20px 10px;">Menu</h4>

                <div class="tab-pane active mt-4" id="categories">
                    <ul class="mobile-menu">
                        @foreach ($categories as $category)
                            <li>
                                <a>{{ $category->name }}</a>

                                @if ($category->children->isNotEmpty())
                                    <ul>
                                        <li>
                                            <a class="mt-2"
                                               style="width:100%;padding:10px 22px;font-size:14px;display:flex;justify-content:space-between;border-radius:10px;"
                                               href="{{ route('products.category', $category->slug) }}">
                                                View All <i class="fas fa-layer-group"></i>
                                            </a>
                                        </li>

                                        @foreach ($category->children as $child)
                                            <li>
                                                <a href="{{ route('products.category', $child->slug) }}">{{ $child->name }}</a>

                                                @if ($child->children->isNotEmpty())
                                                    <ul>
                                                        @foreach ($child->children as $subChild)
                                                            <li><a href="{{ route('products.category', $subChild->slug) }}">{{ $subChild->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>

@section('modal')
    <div class="modal fade" id="login-modal">
        <div class="modal-dialog modal-dialog-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-16 fw-600">{{ translate('Login') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf

                            @if (addon_is_activated('otp_system') && env("DEMO_MODE") != "On")
                                <div class="form-group phone-form-group mb-1">
                                    <input type="tel" id="phone-code" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                           value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">
                                </div>

                                <input type="hidden" name="country_code" value="">

                                <div class="form-group email-form-group mb-1 d-none">
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           value="{{ old('email') }}" placeholder="{{ translate('Email') }}" name="email" id="email" autocomplete="off">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                                    @endif
                                </div>

                                <div class="form-group text-right">
                                    <button class="btn btn-link p-0 opacity-50 text-reset" type="button" onclick="toggleEmailPhone(this)">
                                        {{ translate('Use Email Instead') }}
                                    </button>
                                </div>
                            @else
                                <div class="form-group">
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           value="{{ old('email') }}" placeholder="{{ translate('Email') }}" name="email" id="email" autocomplete="off">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                                    @endif
                                </div>
                            @endif

                            <div class="form-group">
                                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       placeholder="{{ translate('Password') }}" name="password" id="password">
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="opacity-60 fs-14">{{ translate('Remember Me') }}</span>
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">
                                        {{ translate('Forgot password?') }}
                                    </a>
                                </div>
                            </div>

                            <div class="mb-5">
                                <button type="submit" class="w-100 btn primary-btn">{{ translate('Login') }}</button>
                            </div>
                        </form>
                    </div>

                    <div class="text-center mb-3">
                        <p class="fs-14 mb-2">Don't have an account?</p>
                        <a class="fs-14 text-red" href="{{ route('user.registration') }}">{{ translate('Register Now') }}</a>
                    </div>

                    {{-- Social login: ONLY keep Facebook + Google (NO TWITTER) --}}
                    @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1)
                        <div class="separator mb-3">
                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With') }}</span>
                        </div>

                        <ul class="list-inline social colored text-center mb-3">
                            @if (get_setting('facebook_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook" aria-label="Login with Facebook">
                                        <i class="lab la-facebook-f"></i>
                                    </a>
                                </li>
                            @endif

                            @if(get_setting('google_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google" aria-label="Login with Google">
                                        <i class="lab la-google"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function showCheckoutModal(){
            $('#login-modal').modal();
        }
    </script>
@endsection
