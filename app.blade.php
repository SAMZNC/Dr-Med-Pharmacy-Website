<!DOCTYPE html>
@php
    $locale = Session::get('locale', Config::get('app.locale'));
    $lang = \App\Models\Language::where('code', $locale)->first();
    $isRtl = ($lang && (int)$lang->rtl === 1);
@endphp

@if($isRtl)
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <title>Dr. Med Pharmacy</title>

    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description'))">
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords'))">

    {{-- Open Graph (Facebook / Instagram ONLY) --}}
    <meta property="og:title" content="{{ get_setting('meta_title') }}">
    <meta property="og:description" content="{{ get_setting('meta_description') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:image" content="{{ uploaded_asset(get_setting('meta_image')) }}">
    <meta property="og:site_name" content="Dr. Med Pharmacy">
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">

    {{-- Schema --}}
    <meta itemprop="name" content="{{ get_setting('meta_title') }}">
    <meta itemprop="description" content="{{ get_setting('meta_description') }}">
    <meta itemprop="image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

    {{-- Progressive Web App --}}
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ static_asset('assets/img/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ static_asset('assets/img/favicon.png') }}">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

    {{-- Core CSS --}}
    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    @if($isRtl)
        <link rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-rtl.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/custom-style.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/new.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/f5.css') }}">

    {{-- Icons --}}
    <link rel="stylesheet" href="{{ static_asset('assets/css/fontawesome-free/css/all.min.css') }}">

    {{-- UI / Sliders --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    {{-- Font scaling safety (mobile fix) --}}
    <style>
        * {
            -webkit-text-size-adjust: 100%;
            -moz-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            text-size-adjust: 100%;
        }
        body {
            font-family: {{ config('app.font_stack_web') }};
        }
    </style>

    {{-- Google Analytics (if enabled) --}}
    @if (get_setting('google_analytics') == 1)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('TRACKING_ID') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ env('TRACKING_ID') }}');
        </script>
    @endif

    {{-- Header injected scripts (admin controlled) --}}
    @php echo get_setting('header_script'); @endphp
</head>

<body>
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column">

        <!-- Header -->
        @include('frontend.inc.nav')

        <div class="fb-send-to-messenger"
             messenger_app_id="1300389408771397"
             page_id="121908061870262"
             color="white"
             size="standard">
        </div>

        @yield('content')

        @include('frontend.inc.footer')

    </div>

    @if (get_setting('show_cookies_agreement') == 'on')
        <div class="aiz-cookie-alert shadow-xl">
            <div class="p-3 bg-dark rounded">
                <div class="text-white mb-3">
                    @php echo get_setting('cookies_agreement_text'); @endphp
                </div>
                <button class="btn btn-primary aiz-cookie-accept">
                    {{ translate('Ok. I Understood') }}
                </button>
            </div>
        </div>
    @endif

    @if (get_setting('show_website_popup') == 'on')
        <div class="modal website-popup removable-session d-none" data-key="website-popup" data-value="removed">
            <div class="absolute-full bg-black opacity-60"></div>
            <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-md">
                <div class="modal-content position-relative border-0 rounded-0">
                    <div class="aiz-editor-data">
                        {!! get_setting('website_popup_content') !!}
                    </div>
                    @if (get_setting('show_subscribe_form') == 'on')
                        <div class="pb-5 pt-4 px-5">
                            <form method="POST" action="{{ route('subscribers.store') }}">
                                @csrf
                                <div class="form-group mb-0">
                                    <input type="email" class="form-control" placeholder="{{ translate('Your Email Address') }}" name="email" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block mt-3">
                                    {{ translate('Subscribe Now') }}
                                </button>
                            </form>
                        </div>
                    @endif
                    <button class="absolute-top-right bg-white shadow-lg btn btn-circle btn-icon mr-n3 mt-n3 set-session"
                            data-key="website-popup"
                            data-value="removed"
                            data-toggle="remove-parent"
                            data-parent=".website-popup">
                        <i class="la la-close fs-20"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="distributorFormModal" tabindex="-1" role="dialog" aria-labelledby="distributorFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="display:flex;align-items:center;height:100%;max-width:600px;">
            <div class="modal-content" style="border-radius:20px">
                <div class="modal-header d-flex flex-column" style="align-items:initial;">
                    <h5 class="modal-title fs-18">Become A Distributor</h5>
                    <p style="font-size:12px;margin-top:10px;margin-bottom:0;">
                        Join our growing network of partners and help us bring quality health, pharmacy, and wellness products to Filipino communities nationwide.
                        Fill out the form below and we'll get in touch with you shortly.
                    </p>

                    <button style="position:absolute;top:10px;right:10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="max-height:55vh; overflow-y:auto;">
                    <form id="distributorForm" action="{{ route('distributor.store') }}" method="post">
                        @csrf

                        <h6 class="mb-5 fs-16">Personal / Business Information</h6>

                        <div class="form-group">
                            <label>Full Name / Business Name <span style="color:var(--primary-color)">*</span></label>
                            <input type="text" class="form-control" name="full_name" required>
                        </div>

                        <div class="form-group">
                            <label>Contact Number <span style="color:var(--primary-color)">*</span></label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>

                        <div class="form-group">
                            <label>Email Address <span style="color:var(--primary-color)">*</span></label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="form-group">
                            <label>Address / Business Location <span style="color:var(--primary-color)">*</span></label>
                            <input type="text" class="form-control mb-2" name="address_line1" required>
                            <input type="text" class="form-control mb-2" name="address_line2">
                            <div class="form-row">
                                <div class="col"><input type="text" class="form-control mb-2" name="city" required></div>
                                <div class="col"><input type="text" class="form-control mb-2" name="state" required></div>
                                <div class="col"><input type="text" class="form-control mb-2" name="zip" required></div>
                            </div>
                        </div>

                        <h6 class="mb-5 fs-16">Business Profile</h6>

                        <div class="form-group">
                            <label><strong>Business Type</strong></label>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="business_type[]" value="Individual" id="businessIndividual">
                                <label class="form-check-label" for="businessIndividual">Individual</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="business_type[]" value="Pharmacy" id="businessPharmacy">
                                <label class="form-check-label" for="businessPharmacy">Pharmacy</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="business_type[]" value="Distributor" id="businessDistributor">
                                <label class="form-check-label" for="businessDistributor">Distributor</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="business_type[]" value="Retail Store" id="businessRetail">
                                <label class="form-check-label" for="businessRetail">Retail Store</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="business_type[]" value="Online Seller" id="businessOnline">
                                <label class="form-check-label" for="businessOnline">Online Seller</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Years in Business</label>
                            <input type="number" class="form-control" name="years_in_business">
                        </div>

                        <div class="form-group">
                            <label>Current Products Carried (Optional)</label>
                            <textarea class="form-control" name="current_products" rows="2"></textarea>
                        </div>

                        <h6 class="mb-5 fs-16">Distribution Interest <span style="color:var(--primary-color)">*</span></h6>

                        <div class="form-group">
                            <label>Products of Interest <span style="color:var(--primary-color)">*</span></label>
                            <input type="text" class="form-control" name="products_of_interest" required>
                        </div>

                        <div class="form-group">
                            <label>Preferred Distribution Area (City / Province) <span style="color:var(--primary-color)">*</span></label>
                            <input type="text" class="form-control" name="distribution_area" required>
                        </div>

                        <div class="form-group">
                            <label>Estimated Initial Order Quantity <span style="color:var(--primary-color)">*</span></label>
                            <input type="text" class="form-control" name="initial_order_quantity" required>
                        </div>

                        <h6 class="mb-5 fs-16">Additional Notes</h6>

                        <div class="form-group">
                            <label>Message or Special Requests</label>
                            <textarea class="form-control" name="additional_message" rows="3"></textarea>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="consent" id="consentCheck" required>
                            <label class="form-check-label" for="consentCheck">
                                I consent to the collection and processing of my personal data in accordance with the Data Privacy Act of 2012.
                                <span style="color:var(--primary-color)">*</span>
                            </label>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary primary-btn">Submit</button>
                        </div>

                        <input type="hidden" name="formID" value="240429518807966">
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.partials.modal')

    <div class="modal fade" id="addToCart">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
                <button type="button" class="close absolute-top-right btn-icon close z-1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la-2x">&times;</span>
                </button>
                <div id="addToCart-modal-body"></div>
            </div>
        </div>
    </div>

    <div class="aiz-sidebar-wrap aiz-sidecartbar-wrap">
        <div class="aiz-sidebar left c-scrollbar cartsidebar" id="cart_items">
            <div class="aiz-side-nav-wrap">
                <div class="p-0 stop-propagation">

                    @if(isset($cart) && count($cart) > 0)
                        <div class="p-3 fs-15 fw-600 border-bottom cart-item-heading">
                            {{ translate('Cart Items') }}
                        </div>

                        <ul class="h-250px overflow-auto c-scrollbar-light list-group list-group-flush">
                            @php $total = 0; @endphp

                            @foreach($cart as $cartItem)
                                @php
                                    $product = \App\Models\Product::find($cartItem['product_id']);
                                    if ($product) {
                                        $total += $cartItem['price'] * $cartItem['quantity'];
                                    }
                                @endphp

                                @if ($product)
                                    <li class="list-group-item">
                                        <span class="d-flex align-items-center">
                                            <a href="{{ route('product', $product->slug) }}" class="text-reset d-flex align-items-center flex-grow-1">
                                                <img
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ static_asset($product->thumbnail_img) }}"
                                                    class="img-fit lazyload size-60px rounded"
                                                    alt="{{ $product->getTranslation('name') }}"
                                                >
                                                <span class="minw-0 pl-2 flex-grow-1">
                                                    <span class="fw-600 mb-1 text-truncate-2 cart-product-name">
                                                        {{ $product->getTranslation('name') }}
                                                    </span>
                                                    <span class="cart-product-quantity">{{ $cartItem['quantity'] }}x</span>
                                                    <span class="cart-product-price">{{ single_price($cartItem['price']) }}</span>
                                                </span>
                                            </a>
                                            <span>
                                                <button onclick="removeFromCart({{ $cartItem['id'] }})" class="btn btn-sm btn-icon stop-propagation">
                                                    <i class="la la-close"></i>
                                                </button>
                                            </span>
                                        </span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>

                        <div class="px-3 py-2 fs-15 border-top d-flex justify-content-between">
                            <span class="opacity-60">{{ translate('Subtotal') }}</span>
                            <span class="fw-600">{{ single_price($total) }}</span>
                        </div>

                        <div class="px-3 py-2 text-center border-top">
                            <a href="{{ route('cart') }}" class="btn btn-soft-primary btn-sm">
                                {{ translate('View cart') }}
                            </a>
                        </div>
                    @else
                        <div class="text-center p-3">
                            <img src="{{ static_asset('assets/img/empty-cart.png') }}" width="300" alt="Empty cart">
                            <h3 class="h6 fw-700">{{ translate('Your Cart is empty') }}</h3>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="aiz-sidebar-overlay aiz-sidecartbar-overlay"></div>

    @yield('modal')

    <!-- Core Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="{{ static_asset('assets/js/vendors.js') }}"></script>
    <script src="{{ static_asset('assets/js/main.js') }}"></script>
    <script src="{{ static_asset('assets/js/aiz-core.js') }}"></script>
    <script src="{{ static_asset('assets/js/new.js') }}"></script>
    <script src="{{ asset('assets/js/mobile.js') }}"></script>

    <!-- UI / Media -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.4.0/dist/js/splide-extension-auto-scroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Guard to avoid double-init across pages
        if (window.AOS && !window.__AOS_INIT__) {
            window.__AOS_INIT__ = true;
            AOS.init({ once: true });
        }
    </script>

    {{-- Splide sliders (centralized) --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const splideConfigs = [
            // IMPORTANT: banner-carousel handled separately in FINAL fix script (Part 6) to avoid double init.
            { id: '#promo-carousel', perPage: 3 },
            { id: '#promo-carousel2', perPage: 3 },
            { id: '#fproduct-splide', perPage: 5 },
            { id: '#rproduct-splide', perPage: 5 },
            { id: '#dailyrproduct-splide', perPage: 2 },
            { id: '#life-carousel', perPage: 5 },
            { id: '#client-carousel', perPage: 4, autoScroll: true }
        ];

        splideConfigs.forEach(cfg => {
            const el = document.querySelector(cfg.id);
            if (!el || typeof Splide === 'undefined') return;

            const instance = new Splide(el, {
                type: 'loop',
                perPage: cfg.perPage,
                gap: '1rem',
                arrows: true,
                pagination: cfg.pagination ?? false,
                autoplay: cfg.autoplay ?? false,
                pauseOnHover: true,
                drag: true,
                breakpoints: {
                    1200: { perPage: Math.min(cfg.perPage, 4) },
                    992:  { perPage: Math.min(cfg.perPage, 3) },
                    768:  { perPage: Math.min(cfg.perPage, 2) },
                    480:  { perPage: 1 }
                }
            });

            const extensions = (cfg.autoScroll && window.splide && window.splide.Extensions) ? window.splide.Extensions : {};
            instance.mount(extensions);
        });
    });
    </script>

    <script>
    @foreach (session('flash_notification', collect())->toArray() as $message)
    AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
    @endforeach
    </script>

    <script>
    $(document).ready(function () {
        $('.owl-carousel').each(function () {
            const $this = $(this);
            const options = {
                autoplay: $this.data('owl-auto') === true || $this.data('owl-auto') === "true",
                loop: $this.data('owl-loop') === true || $this.data('owl-loop') === "true",
                smartSpeed: parseInt($this.data('owl-speed')) || 600,
                margin: parseInt($this.data('owl-gap')) || 0,
                nav: $this.data('owl-nav') === true || $this.data('owl-nav') === "true",
                dots: $this.data('owl-dots') === true || $this.data('owl-dots') === "true",
                items: parseInt($this.data('owl-item')) || 1,
                mouseDrag: $this.data('owl-mousedrag') === "on",
                responsive: {
                    0: { items: parseInt($this.data('owl-item-xs')) || 1 },
                    576: { items: parseInt($this.data('owl-item-sm')) || 1 },
                    768: { items: parseInt($this.data('owl-item-md')) || 1 },
                    992: { items: parseInt($this.data('owl-item-lg')) || 1 },
                    1200: { items: parseInt($this.data('owl-item-xl')) || 1 }
                }
            };
            $this.owlCarousel(options);
        });

        $(".carousel .owl-carousel").each(function(){
            try {
                $(this).owlCarousel({
                    autoplay: true,
                    animateOut: 'fadeOut',
                    animateIn: 'fadeIn',
                    items: 1,
                    dots: false,
                    loop: true,
                    nav: true,
                    navText: [
                        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                        '<i class="fa fa-angle-right" aria-hidden="true"></i>'
                    ]
                });
            } catch (e) {}
        });
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle=search-form]').click(function() {
            $('.search-form-wrapper').toggleClass('open');
            $('.search-form-wrapper .search').focus();
            $('html').toggleClass('search-form-open');
        });
        $('[data-toggle=search-form-close]').click(function() {
            $('.search-form-wrapper').removeClass('open');
            $('html').removeClass('search-form-open');
        });
        $('.search-close').click(function() {
            $('.search-form-wrapper').removeClass('open');
            $('html').removeClass('search-form-open');
        });

        $('.mobile-menu-toggle').click(function() {
            $('body').addClass('mmenu-active');
        });
        $('.mobile-menu-overlay').click(function() {
            $('body').removeClass('mmenu-active');
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $('.category-nav-element').each(function(i, el) {
            $(el).on('mouseover', function(){
                if(!$(el).find('.sub-cat-menu').hasClass('loaded')){
                    $.post('{{ route('category.elements') }}', {_token: AIZ.data.csrf, id:$(el).data('id')}, function(data){
                        $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                    });
                }
            });
        });

        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e){
                    e.preventDefault();
                    var locale = $(this).data('flag');
                    $.post('{{ route('language.change') }}',{_token: AIZ.data.csrf, locale:locale}, function(){
                        location.reload();
                    });
                });
            });
        }

        if ($('#currency-change').length > 0) {
            $('#currency-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e){
                    e.preventDefault();
                    var currency_code = $(this).data('currency');
                    $.post('{{ route('currency.change') }}',{_token: AIZ.data.csrf, currency_code:currency_code}, function(){
                        location.reload();
                    });
                });
            });
        }
    });

    function search(inputSelector, boxSelector, contentSelector){
        var searchKey = $(inputSelector).val();
        var catKey = $("#category").val();

        if(searchKey && searchKey.length > 0){
            $('body').addClass("typed-search-box-shown");
            $(boxSelector).removeClass('d-none');
            $(boxSelector + ' .search-preloader').removeClass('d-none');

            $.post('{{ route('search.ajax') }}', { _token: AIZ.data.csrf, search:searchKey, category: catKey}, function(data){
                var resp = (data === undefined || data === null) ? '' : data.toString().trim();
                if(resp === '0' || resp.length === 0){
                    $(contentSelector).html('');
                    $(boxSelector + ' .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+searchKey+'"</strong>');
                    $(boxSelector + ' .search-preloader').addClass('d-none');
                } else {
                    $(boxSelector + ' .search-nothing').addClass('d-none').html('');
                    $(contentSelector).html(resp);
                    $(boxSelector + ' .search-preloader').addClass('d-none');
                }
            });
        } else {
            $(boxSelector).addClass('d-none');
            $('body').removeClass("typed-search-box-shown");
        }
    }

    $('#search').on('keyup focus input', function(){
        search('#search', '.typed-search-box', '#search-content');
    });

    if ($('#search-mobile').length) {
        $('#search-mobile').on('keyup focus input', function(){
            search('#search-mobile', '.typed-search-box-mobile', '#search-content-mobile');
        });
        $('#search-mobile').on('keypress', function (e) {
            if (e.which === 13) e.preventDefault();
        });
    }

    $('#category').on('change', function () {
        if (document.activeElement && $(document.activeElement).is('#search-mobile')) {
            search('#search-mobile', '.typed-search-box-mobile', '#search-content-mobile');
        } else {
            search('#search', '.typed-search-box', '#search-content');
        }
    });

    function updateNavCart(view, count){
        $('.cart-count').html(count);
        $('#cart_items').html(view);
        $('#navcart_items').html(view);
    }

    function removeFromCart(key){
        $.post('{{ route('cart.removeFromCart') }}', {
            _token : AIZ.data.csrf,
            id     : key
        }, function(data){
            updateNavCart(data.nav_cart_view, data.cart_count);
            $('#cart-summary').html(data.cart_view);
            AIZ.plugins.notify('success', "{{ translate('Item has been removed from cart') }}");
            $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
        });
    }

    function updateCartQuantity(cartId, quantity) {
        event.preventDefault();
        $.post('{{ route('cart.updateQuantity') }}', {
            _token  : AIZ.data.csrf,
            id      : cartId,
            quantity: quantity
        }, function(data) {
            updateNavCart(data.nav_cart_view, data.cart_count);
            AIZ.plugins.notify('success', "{{ translate('Cart Updated') }}");
        });
    }
    </script>

    <script>
    function checkAddToCartValidity(){
        var hasVariants = $('#option-choice-form input:radio[name="selected_variant"]').length > 0;
        if (hasVariants) return $('input:radio[name="selected_variant"]:checked').length > 0;
        return true;
    }

    function addToCart(quantity = 1)  {
        if (!checkAddToCartValidity()) {
            AIZ.plugins.notify('warning', "{{ translate('Please choose all the options') }}");
            return;
        }

        $('.c-preloader').show();
        $('#add-to-cart-loader').removeClass('d-none');

        var formData = $('#option-choice-form').serializeArray();

        var selectedVariant = $('input[name="selected_variant"]:checked').val();
        if (selectedVariant) {
            var parts = selectedVariant.split('_');
            if (parts.length >= 2) {
                var attributeId = parts[0];
                var variantValue = parts.slice(1).join('_');

                formData = formData.filter(function(item) {
                    return !item.name.startsWith('attribute_id_');
                });

                formData.push({ name: 'attribute_id_' + attributeId, value: variantValue });
                formData.push({ name: 'quantity', value: quantity });
            }
        }

        $.ajax({
            type: "POST",
            url: '{{ route('cart.addToCart') }}',
            data: formData,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data) {
                $('.c-preloader').hide();
                $('#add-to-cart-loader').addClass('d-none');

                if (data.status === 1) {
                    $('body').addClass('side-menu-open');
                    $('#modal-size').removeClass('modal-lg');
                    AIZ.extra.plusMinus();
                    updateNavCart(data.nav_cart_view, data.cart_count);

                    if (data.addons_modal && data.addons_modal.trim().length) {
                        $('#addonsModal').remove();
                        $('body').append(data.addons_modal);
                        $('#addonsModal').modal('show');
                    }
                } else if (data.status === 2) {
                    AIZ.plugins.notify('warning', data.message || 'Item already in cart');
                } else {
                    AIZ.plugins.notify('warning', 'Product is out of stock');
                }
            },
            error: function(xhr, status, error) {
                console.error('Cart AJAX Error:', {xhr: xhr, status: status, error: error});
                $('.c-preloader').hide();
                $('#add-to-cart-loader').addClass('d-none');
                AIZ.plugins.notify('danger', "Something went wrong. Please try again.");
            }
        });
    }

    function addToCartHome(event, productId, el) {
        event.preventDefault();

        if (!checkAddToCartValidity()) {
            AIZ.plugins.notify('warning', "{{ translate('Please choose all the options') }}");
            return;
        }

        let originalHTML = el.innerHTML;
        el.innerHTML = '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Adding...';
        el.classList.add('disabled');

        $.ajax({
            type: "POST",
            url: '{{ route('cart.addToCart') }}',
            data: { _token: '{{ csrf_token() }}', id: productId, quantity: 1 },
            success: function(data) {
                el.innerHTML = originalHTML;
                el.classList.remove('disabled');

                if (data.status === 1) {
                    $('body').addClass('side-menu-open');
                    $('#modal-size').removeClass('modal-lg');
                    AIZ.extra.plusMinus();
                    updateNavCart(data.nav_cart_view, data.cart_count);
                } else if (data.status === 2) {
                    AIZ.plugins.notify('warning', data.message || "Product already in cart.");
                } else {
                    AIZ.plugins.notify('danger', "Could not add to cart.");
                }
            },
            error: function() {
                el.innerHTML = originalHTML;
                el.classList.remove('disabled');
                AIZ.plugins.notify('danger', "Something went wrong. Please try again.");
            }
        });
    }
    </script>

    <script>
    $(window).on('scroll', function () {
        var scrollTop = $(this).scrollTop();
        var windowWidth = $(this).innerWidth();

        if (scrollTop > 200 && windowWidth > 760) {
            $('.ps-header').addClass('ps-header--sticky');
        } else if (scrollTop > 700 && windowWidth <= 760) {
            $('.ps-header').addClass('ps-header--sticky');
            $('.ps-search--result').removeClass('active');
        } else {
            $('.ps-header').removeClass('ps-header--sticky');
        }

        if (scrollTop > 100) $('.scroll-top').fadeIn();
        else $('.scroll-top').fadeOut();
    });
    </script>

    <script>
    const isAuthenticated = @json(auth()->check());
    </script>

    {{-- Facebook SDK (kept) --}}
    <script>
    window.fbAsyncInit = function() {
        FB.init({
            appId   : '1300389408771397',
            xfbml   : true,
            version : 'v24.0'
        });
    };
    </script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

    {{-- Cookies UI (kept) --}}
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const cookieConsent = document.getElementById("cookieConsent");
        const acceptBtn = document.getElementById("acceptCookies");
        const closeBtn = document.getElementById("closeCookies");

        if (!cookieConsent || !acceptBtn || !closeBtn) return;

        if (!localStorage.getItem("cookiesAccepted")) {
            cookieConsent.classList.remove("hidden");
        }

        acceptBtn.addEventListener("click", function () {
            localStorage.setItem("cookiesAccepted", "true");
            cookieConsent.classList.add("hidden");
        });

        closeBtn.addEventListener("click", function () {
            cookieConsent.classList.add("hidden");
        });
    });
    </script>

    @yield('script')

    @php echo get_setting('footer_script'); @endphp

    {{-- FINAL: Banner carousel first-load cut fix (single init) --}}
    <script>
    (function () {
        function triggerResize() {
            try { window.dispatchEvent(new Event('resize')); } catch (e) {}
        }

        function safeInitBannerSplide() {
            var el = document.querySelector('#banner-carousel');
            if (!el || typeof Splide === 'undefined') return;

            if (el.getAttribute('data-splide-initialized') === '1') return;
            el.setAttribute('data-splide-initialized', '1');

            var bannerCarousel = new Splide('#banner-carousel', {
                type: 'loop',
                perPage: 1,
                perMove: 1,
                gap: 0,
                padding: 0,
                arrows: true,
                pagination: true,
                autoplay: true,
                interval: 4000,
                pauseOnHover: true,
                speed: 800,
                trimSpace: false,
                drag: true,
                updateOnMove: true,
                waitForTransition: false
            });

            bannerCarousel.mount();

            setTimeout(function () {
                try { bannerCarousel.refresh(); } catch (e) {}
                triggerResize();
            }, 120);

            if (document.fonts && document.fonts.ready) {
                document.fonts.ready.then(function () {
                    setTimeout(function () {
                        try { bannerCarousel.refresh(); } catch (e) {}
                        triggerResize();
                    }, 80);
                });
            }

            var imgs = el.querySelectorAll('img');
            var pending = 0;

            imgs.forEach(function (img) {
                if (!img.complete) {
                    pending++;
                    img.addEventListener('load', function () {
                        pending--;
                        if (pending <= 0) {
                            setTimeout(function(){ try { bannerCarousel.refresh(); } catch(e) {} triggerResize(); }, 80);
                        }
                    }, { once: true });

                    img.addEventListener('error', function () {
                        pending--;
                        if (pending <= 0) {
                            setTimeout(function(){ try { bannerCarousel.refresh(); } catch(e) {} triggerResize(); }, 80);
                        }
                    }, { once: true });
                }
            });

            if (pending === 0) {
                setTimeout(function(){ try { bannerCarousel.refresh(); } catch(e) {} triggerResize(); }, 80);
            }

            var resizeTimer;
            window.addEventListener('resize', function () {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function () {
                    try { bannerCarousel.refresh(); } catch (e) {}
                    triggerResize();
                }, 250);
            });
        }

        window.addEventListener('load', function () {
            safeInitBannerSplide();
            setTimeout(triggerResize, 250);
            setTimeout(triggerResize, 800);
        });

        window.addEventListener('pageshow', function (e) {
            if (e.persisted) {
                setTimeout(function(){
                    triggerResize();
                    var el = document.querySelector('#banner-carousel');
                    if (el) {
                        el.removeAttribute('data-splide-initialized');
                    }
                    safeInitBannerSplide();
                }, 60);
            }
        });
    })();
    </script>

</body>
</html>
