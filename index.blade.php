@extends('frontend.layouts.app')

<style>
/* ========================================
   BANNER CAROUSEL - FULL WIDTH FIX
   ======================================== */
#banner-carousel {
    position: relative;
    width: 100% !important;
    max-width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    overflow: hidden !important;
    box-sizing: border-box;
    opacity: 0;
    transition: opacity 0.3s ease;
}
#banner-carousel.is-initialized { opacity: 1; }

#banner-carousel .splide__track {
    width: 100% !important;
    overflow: hidden !important;
    margin: 0 !important;
    padding: 0 !important;
}
#banner-carousel .splide__list {
    display: flex !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    list-style: none !important;
}
#banner-carousel .splide__slide {
    flex-shrink: 0 !important;
    width: 100% !important;
    min-width: 100% !important;
    max-width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    box-sizing: border-box !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
}
#banner-carousel .splide__slide img {
    width: 100% !important;
    max-width: 100% !important;
    height: auto !important;
    display: block !important;
    object-fit: cover !important;
    margin: 0 !important;
    padding: 0 !important;
}

#banner-carousel .splide__arrows {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    pointer-events: none;
    z-index: 2;
}
#banner-carousel .splide__arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(193, 0, 7, 0.9) !important;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    pointer-events: auto;
    z-index: 10;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}
#banner-carousel .splide__arrow:hover {
    background: #C10007 !important;
    transform: translateY(-50%) scale(1.1);
}
#banner-carousel .splide__arrow svg {
    fill: white !important;
    width: 16px;
    height: 16px;
}
#banner-carousel .splide__arrow--prev { left: 20px; }
#banner-carousel .splide__arrow--next { right: 20px; }

#banner-carousel .splide__pagination {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    display: flex;
    gap: 8px;
}
#banner-carousel .splide__pagination__page {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}
#banner-carousel .splide__pagination__page.is-active {
    background: #C10007;
    width: 24px;
    border-radius: 5px;
}

/* ========================================
   PROMO CAROUSELS - FIRST LOAD CUT FIX
   (DO NOT OVERRIDE SPLIDE TRANSFORMS)
   ======================================== */
#promo-carousel,
#promo-carousel2 {
    width: 100%;
    max-width: 100%;
    overflow: hidden;
}
#promo-carousel .splide__track,
#promo-carousel2 .splide__track {
    overflow: hidden;
}

/* ========================================
   BREADCRUMB FIX - MOBILE
   ======================================== */
.breadcrumb-navigation,
.ps-breadcrumb {
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
    gap: 8px;
    padding: 10px 15px;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
}
.breadcrumb-navigation::-webkit-scrollbar,
.ps-breadcrumb::-webkit-scrollbar { display: none; }

.breadcrumb-navigation a,
.breadcrumb-navigation span,
.ps-breadcrumb a,
.ps-breadcrumb span {
    white-space: nowrap;
    flex-shrink: 0;
    font-size: 14px;
}
.breadcrumb-navigation > *,
.ps-breadcrumb > * {
    display: inline-flex;
    align-items: center;
}

/* ========================================
   COOKIE CONSENT BANNER
   ======================================== */
.cookie-consent {
    position: fixed;
    bottom: 20px;
    left: 20px;
    right: auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    max-width: 380px;
    width: calc(100% - 40px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    z-index: 99999;
    margin: 0;
}
.cookie-consent.hidden { display: none; }

.cookie-consent .cookie-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 10px;
}
.cookie-consent h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: #333;
}
.cookie-consent p {
    margin: 0 0 15px 0;
    font-size: 14px;
    line-height: 1.5;
    color: #666;
}
.cookie-consent .close-icon {
    cursor: pointer;
    font-size: 20px;
    font-weight: bold;
    color: #999;
    line-height: 1;
    background: none;
    border: none;
    padding: 0;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color 0.3s ease;
}
.cookie-consent .close-icon:hover { color: #333; }
.cookie-consent .btn-accept {
    background: #d10000;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    width: 100%;
    transition: background 0.3s ease;
}
.cookie-consent .btn-accept:hover { background: #a00000; }

/* ========================================
   PRODUCT CARDS & ANIMATIONS
   ======================================== */
.will-animate { will-change: transform, opacity; }

.ps-product.ps-product--standard,
.category-card,
.feature-box { transition: transform .35s ease, box-shadow .35s ease; }

.ps-product.ps-product--standard:hover,
.category-card:hover,
.feature-box:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
}
.ps-product__thumbnail { padding-top: 25px !important; }
.ps-product .badge {
    border-radius: 999px !important;
    background: unset !important;
    color: #c10007 !important;
    border: 1px solid #c10007;
}

/* ========================================
   HOW TO ORDER SECTION
   ======================================== */
.content h2 { margin-bottom: 15px; }
.steps { list-style: none; padding: 0; margin: 0 0 20px 0; }
.steps li {
    font-size: 17px;
    font-weight: 300;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #000;
}
.steps li span {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 14px;
    color: #000;
    font-weight: 500;
    background: #f2fafc;
    border: 1px solid #c10007;
}

/* ========================================
   DAILY DEALS CAROUSEL
   ======================================== */
.drmed-banner { height: 250px !important; }
#dailyrproduct-splide .splide__arrow--prev {
    position: absolute;
    top: -50px;
    right: 49px;
    left: initial !important;
}
#dailyrproduct-splide .splide__arrow--next {
    position: absolute;
    top: -50px;
    right: 0px !important;
    left: initial !important;
}
.ps-page { width: 100% !important; }
.daily-deals { background-color: #fff !important; }

/* ========================================
   PROMO CAROUSELS
   ======================================== */
#promo-carousel .splide__slide,
#promo-carousel2 .splide__slide { display: flex; }

#promo-carousel .ps-promo__item,
#promo-carousel2 .ps-promo__item { width: 100%; }

#promo-carousel .ps-promo__banner {
    display: block;
    width: 100%;
    aspect-ratio: 16 / 9;
    height: auto;
    object-fit: cover;
    object-position: center;
    border-radius: 12px;
}
#promo-carousel2 .ps-promo__banner {
    display: block;
    width: 100%;
    height: auto;
    object-fit: contain;
    object-position: center;
}

/* ========================================
   RESPONSIVE - MOBILE
   ======================================== */
@media (max-width: 768px) {
    .breadcrumb-navigation, .ps-breadcrumb {
        font-size: 12px;
        padding: 8px 10px;
        gap: 5px;
    }
    .breadcrumb-navigation a, .breadcrumb-navigation span,
    .ps-breadcrumb a, .ps-breadcrumb span { font-size: 12px; }
    .breadcrumb-navigation svg, .ps-breadcrumb svg { width: 12px; height: 12px; }

    .cookie-consent {
        left: 10px;
        right: 10px;
        bottom: 10px;
        max-width: none;
        width: calc(100% - 20px);
        padding: 15px;
    }
    .cookie-consent h4 { font-size: 14px; }
    .cookie-consent p { font-size: 13px; margin-bottom: 12px; }
    .cookie-consent .btn-accept { padding: 8px 16px; font-size: 13px; }

    #banner-carousel .splide__arrow { width: 32px; height: 32px; }
    #banner-carousel .splide__arrow--prev { left: 10px; }
    #banner-carousel .splide__arrow--next { right: 10px; }
    #banner-carousel .splide__arrow svg { width: 14px; height: 14px; }
    #banner-carousel .splide__pagination { bottom: 10px; }

    .home-banner { padding: 0 15px !important; }
    .tab-arrow { display: none !important; }
}

@media (max-width: 600px) {
    .daily-deals { background-color: #f0f2f5 !important; }
    section.hasbg { padding-bottom: 30px !important; }
    .mobile-arrow-btn .splide__arrows .splide__arrow { top: 40% !important; }
    section .ps-product__thumbnail img { height: 150px !important; }
    .drmed-banner { height: 100%; margin-bottom: 0 !important; }
    .dynamicBanner { margin-bottom: 0 !important; }
    .ps-product__title { height: fit-content !important; }
    .splide__arrow { background: var(--primary-color) !important; opacity: 1 !important; }
    .splide__arrow svg { fill: white !important; }
    .ps-product__rating { margin-bottom: 0 !important; }
    .ps-product__image { padding: 0px !important; }
    #main-banner-img { max-height: unset !important; height: 100% !important; }
    .medicine-tabs-wrapper, .medicine-tabs { margin-bottom: 0px !important; }
}

@media (max-width: 480px) {
    .breadcrumb-navigation, .ps-breadcrumb {
        font-size: 11px;
        gap: 3px;
    }
    .breadcrumb-navigation a, .breadcrumb-navigation span,
    .ps-breadcrumb a, .ps-breadcrumb span { font-size: 11px; }
}

@media (max-width: 767px) {
    .medicine-tabs .tab-item { flex: 0 0 50% !important; }
    .medicine-tabs .tab-item h4 { margin-top: 8px !important; }
}

@media (min-width: 1400px) {
    .home-banner { padding: 0 60px !important; }
    .tab-arrow.left-arrow { left: -30px !important; }
    .tab-arrow.right-arrow { right: -30px !important; }
}

@media (max-width: 1200px) {
    .home-banner { padding: 0 40px !important; }
    .tab-arrow.left-arrow { left: -15px !important; }
    .tab-arrow.right-arrow { right: -15px !important; }
}
</style>

@section('content')

{{-- BANNER CAROUSEL --}}
<div id="banner-carousel" class="splide-btn-lg splide">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach($banners as $banner)
            <li class="splide__slide">
                <img class="w-100" src="{{ uploaded_asset($banner->thumbnail_img) }}" alt="Banner"
                    loading="{{ $loop->first ? 'eager' : 'lazy' }}" />
            </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- MAIN CONTENT CONTAINER --}}
<div class="ps-home ps-home--1" style="margin-top: 20px; margin-bottom:0; padding-bottom:0">

    {{-- MEDICINE TABS SECTION --}}
    @if ($bannerstwo->isNotEmpty())
    <div class="position-relative px-0 container home-banner" style="padding:0 50px !important; overflow: visible !important;">
        <section class="ps-section--banner dynamicBanner will-animate"
            style="min-height: 100%; overflow: visible !important; padding: 0 !important; margin-bottom: 0 !important;"
            data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-out-quart">
            <img id="main-banner-img" src="{{ uploaded_asset($bannerstwo->first()->thumbnail_img) }}"
                style="width: 100%; height: auto; max-height: 320px; object-fit: contain; object-position: center; cursor: pointer; display: block; margin-bottom: 0;"
                alt="Main Banner" data-aos="zoom-in" data-aos-delay="120" loading="eager" />
        </section>

        <button class="tab-arrow left-arrow" data-aos="fade-right" data-aos-delay="180"
            style="position: absolute; left: -5px; background: #C10007; border-radius: 50%; height: 32px; width: 32px;
                   display: flex !important; align-items: center; justify-content: center; top: 40%; transform: translateY(-50%);
                   border: none; font-size: 16px; color: white; cursor: pointer; z-index: 10; transition: all 0.3s ease;">&#10094;</button>

        <button class="tab-arrow right-arrow" data-aos="fade-left" data-aos-delay="180"
            style="position: absolute; right: -5px; background: #C10007; border-radius: 50%; height: 32px; width: 32px;
                   display: flex !important; align-items: center; justify-content: center; top: 40%; transform: translateY(-50%);
                   border: none; font-size: 16px; color: white; cursor: pointer; z-index: 10; transition: all 0.3s ease;">&#10095;</button>

        <div class="medicine-tabs-wrapper container will-animate"
            style="max-width:1232px; position: relative; overflow: visible !important; padding: 0 !important; margin-top: 0;"
            data-aos="fade-up" data-aos-duration="1200" data-aos-easing="ease-out-quart">
            <div class="medicine-tabs" style="display: flex; overflow: hidden; scroll-behavior: smooth;">
                @foreach ($bannerstwo as $index => $banner)
                <div class="tab-item {{ $index === 0 ? 'active' : '' }} will-animate"
                    data-banner="{{ uploaded_asset($banner->thumbnail_img) }}" data-link=""
                    data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-left' }}"
                    data-aos-delay="{{ 80 + ($loop->index * 60) }}"
                    style="flex: 0 0 25%; box-sizing: border-box; text-align:center; cursor:pointer; border:none">
                    <h4>{{ strtoupper($banner->title) }}</h4>
                    <p class="mb-0">{{ $banner->subtitle }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <div class="ps-home__content" style="margin-top: 20px;">

        {{-- FEATURES SECTION --}}
        <section class="section-padding ps-section--latest pt-2 pb-2 bg-red mb-0 will-animate" style="margin-top: 0;"
            data-aos="fade-up" data-aos-duration="1200" data-aos-easing="ease-out-quart">
            <div class="container">
                <div class="col-lg-12">
                    <div class="features">
                        <div class="feature-box will-animate" data-aos="fade-right" data-aos-delay="60">
                            <img src="{{static_asset('assets/img/f1.png')}}" alt="Authentic products" loading="lazy">
                            <div class="feature-title">Nationwide Delivery</div>
                            <div class="feature-desc">Directly sourced from authorized distributors.</div>
                        </div>

                        <div class="feature-box will-animate" data-aos="fade-up" data-aos-delay="120">
                            <img src="{{static_asset('assets/img/f2.png')}}" alt="Freshness" loading="lazy">
                            <div class="feature-title">Customer Care</div>
                            <div class="feature-desc">Stored in temperature-controlled facilities to maintain quality.</div>
                        </div>

                        <div class="feature-box will-animate" data-aos="fade-up" data-aos-delay="180">
                            <img src="{{static_asset('assets/img/f3.png')}}" alt="Support" loading="lazy">
                            <div class="feature-title">Membership Benefits</div>
                            <div class="feature-desc">Our team is always ready to assist you.</div>
                        </div>

                        <div class="feature-box will-animate" data-aos="fade-left" data-aos-delay="240">
                            <img src="{{static_asset('assets/img/f4.png')}}" alt="Reviews" loading="lazy">
                            <div class="feature-title">Trusted Source</div>
                            <div class="feature-desc">Verified customer feedback to help you buy smart.</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- NEW ARRIVALS SECTION --}}
        @if($about->newarr != 0)
        <section data-aos="fade-up" data-aos-duration="1500"
            class="section-padding ps-section--featured bg-white will-animate"
            style="padding-bottom: 0px; padding-top:30px">
            <div class="d-flex align-items-center justify-content-between container">
                <h3 class="ps-section__title text-left mb-0" data-aos="fade-right">New Arrivals</h3>
                <a href="https://drmedpharmacy.com.ph/search" class="primary-btn text-white will-animate"
                    data-aos="fade-left">View All</a>
            </div>
            <div class="ps-section__content container pt-5">
                <div class="ps-section__carousel">
                    <div id="fproduct-splide" class="splide will-animate" data-aos="fade-up" data-aos-duration="1200"
                        data-aos-easing="ease-out-quart">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach($fproducts as $product)
                                <li class="splide__slide" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                                    <div class="ps-section__product">
                                        <div class="ps-product ps-product--standard will-animate h-100"
                                            data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-left' }}"
                                            data-aos-delay="{{ 80 + ($loop->index * 60) }}">

                                            @if (!empty($addonBadges[$product->id]))
                                            <span class="badge badge-success">
                                                {{ $addonBadges[$product->id]['label'] }}
                                            </span>
                                            @endif

                                            @if (!empty($bogoBadges[$product->id]))
                                            <span class="badge badge-warning ">
                                                {{ $bogoBadges[$product->id]['text'] }}
                                            </span>
                                            @endif

                                            <div class="ps-product__thumbnail">
                                                <a class="ps-product__image" href="{{ route('product', $product->slug) }}">
                                                    <figure><img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                            alt="{{ $product->name }}" loading="lazy" /></figure>
                                                </a>
                                                <div class="ps-product__actions ps-product__actions_sm">
                                                    <div class="ps-product__item" data-toggle="tooltip">
                                                        @if ($product->prescription == 1)
                                                        <a href="{{ route('product', $product->slug) }}">View Details</a>
                                                        @else
                                                        <a href="#" onclick="addToCartHome(event, {{ $product->id }}, this)">Add To Cart</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            @php
                                            $qty = 0;
                                            foreach ($product->stocks as $key => $stock) { $qty += $stock->qty; }
                                            @endphp

                                            @if($qty < 1)
                                            <span class="badge" style="color: #fff; font-size: 12px; background: #c10007; padding: 5px; border-radius: 999px;
                                                font-weight: 600; margin: auto; display: flex; align-items: center; justify-content: center;
                                                width: fit-content; margin-bottom: 15px; line-height: 1;">
                                                Out of Stock
                                            </span>
                                            @endif

                                            <div class="ps-product__content text-left">
                                                <h5 class="ps-product__title">
                                                    <a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                                </h5>
                                                <h5 class="fs-13 mt-1 mb-0" style="width: 100%; overflow: hidden; display: -webkit-box;
                                                    -webkit-line-clamp: 2; -webkit-box-orient: vertical; color: gray; font-weight:400;">
                                                    Category: <a style="color: #c10007; line-height:1.8rem; padding: 2px 0 0 0 !important;"
                                                        href="{{ route('product', $product->slug) }}">{{$product->category->name}}</a>
                                                </h5>

                                                <div class="fs-15 text-left product__item__price d-flex flex-column">
                                                    @php
                                                        $baseNoTaxFormatted = product_lowest_base_price($product, true, false);
                                                        $baseNoTaxRaw = product_lowest_base_price($product, false, false);
                                                        $discountedNoTaxFormatted = product_lowest_price($product, true, false);
                                                        $discountedNoTaxRaw = product_lowest_price($product, false, false);
                                                    @endphp

                                                    <div class="d-flex align-items-center justify-content-start">
                                                        @if($baseNoTaxRaw !== $discountedNoTaxRaw)
                                                            <del class="fw-600 opacity-50 mr-1">{{ $baseNoTaxFormatted }}</del>
                                                        @endif
                                                        <span class="fw-700 ps-product__price mr-1 mb-0" style="white-space: nowrap;">
                                                            {{ $discountedNoTaxFormatted }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="ps-product__rating">
                                                    <i class="fa fa-star active"></i>
                                                    <i class="fa fa-star active"></i>
                                                    <i class="fa fa-star active"></i>
                                                    <i class="fa fa-star active"></i>
                                                    <i class="fa fa-star active"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        {{-- TRENDING PRODUCTS SECTION --}}
        @if($about->trending != 0)
        <section data-aos="fade-up" data-aos-duration="1500"
            class="section-padding section-categories ps-section--featured pt-3 will-animate"
            style="margin: 20px 0 10px;padding: 0 3vw 20px 3vw !important;">
            <div class="d-flex align-items-center justify-content-between container">
                <h3 class="ps-section__title text-left mb-0" data-aos="fade-right">Trending Products</h3>
                <a href="https://drmedpharmacy.com.ph/search" class="primary-btn text-white will-animate"
                    data-aos="fade-left">View All</a>
            </div>
            <div class="ps-section__content container pt-5">
                <div id="rproduct-splide" class="splide will-animate mobile-arrow-btn" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-easing="ease-out-quart">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach($fproducts as $product)
                            <li class="splide__slide" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                                <div class="ps-section__product">
                                    <div class="ps-product ps-product--standard will-animate h-100"
                                        data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-left' }}"
                                        data-aos-delay="{{ 80 + ($loop->index * 60) }}">
                                        <div style="position: absolute; top: 15px; left: 15px">
                                            @if (!empty($addonBadges[$product->id]))
                                            <span class="badge badge-success">{{ $addonBadges[$product->id]['label'] }}</span>
                                            @endif

                                            @if (!empty($bogoBadges[$product->id]))
                                            <span class="badge badge-warning ">{{ $bogoBadges[$product->id]['text'] }}</span>
                                            @endif

                                            @php
                                            $qty = 0;
                                            foreach ($product->stocks as $key => $stock) { $qty += $stock->qty; }
                                            @endphp

                                            @if($qty < 1)
                                            <span class="badge" style="color: #fff; font-size: 12px; background: #c10007; padding: 5px;
                                                border-radius: 999px; font-weight: 600; line-height: 1;">
                                                Out of Stock
                                            </span>
                                            @endif
                                        </div>

                                        <div class="ps-product__thumbnail">
                                            <a class="ps-product__image" href="{{ route('product', $product->slug) }}">
                                                <figure><img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        alt="{{ $product->name }}" loading="lazy" /></figure>
                                            </a>
                                            @php $choiceOptions = json_decode($product->choice_options, true); @endphp
                                            <div class="ps-product__actions ps-product__actions_sm">
                                                <div class="ps-product__item" data-toggle="tooltip">
                                                    @if ($product->prescription == 1 || !empty($choiceOptions))
                                                    <a href="{{ route('product', $product->slug) }}">View Details</a>
                                                    @else
                                                    <a href="#" onclick="addToCartHome(event, {{ $product->id }}, this)">Add To Cart</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="ps-product__content text-left">
                                            <h5 class="ps-product__title">
                                                <a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                            </h5>
                                            <h5 class="fs-13 mt-1 mb-0" style="width: 100%; overflow: hidden; display: -webkit-box;
                                                -webkit-line-clamp: 2; -webkit-box-orient: vertical; color: gray; font-weight:400;">
                                                Category: <a style="color: #c10007; line-height: 1.8rem; padding: 2px 0 0 0 !important;"
                                                    href="{{ route('product', $product->slug) }}">{{$product->category->name}}</a>
                                            </h5>

                                            <div class="fs-15 text-left product__item__price d-flex flex-column">
                                                @php
                                                    $baseNoTaxFormatted = product_lowest_base_price($product, true, false);
                                                    $baseNoTaxRaw = product_lowest_base_price($product, false, false);
                                                    $discountedNoTaxFormatted = product_lowest_price($product, true, false);
                                                    $discountedNoTaxRaw = product_lowest_price($product, false, false);
                                                @endphp

                                                <div class="d-flex align-items-center justify-content-start">
                                                    @if($baseNoTaxRaw !== $discountedNoTaxRaw)
                                                        <del class="fw-600 opacity-50 mr-1">{{ $baseNoTaxFormatted }}</del>
                                                    @endif
                                                    <span class="fw-700 ps-product__price mr-1 mb-0" style="white-space: nowrap;">
                                                        {{ $discountedNoTaxFormatted }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="ps-product__rating">
                                                <i class="fa fa-star active"></i>
                                                <i class="fa fa-star active"></i>
                                                <i class="fa fa-star active"></i>
                                                <i class="fa fa-star active"></i>
                                                <i class="fa fa-star active"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        @endif

        {{-- DAILY DEALS SECTION --}}
        @if($about->deals != 0)
        <section data-aos="fade-up" data-aos-duration="1500"
            class="section-padding hasbg ps-section--featured pt-3 will-animate"
            style="padding-top: 30px !important; padding-bottom: 50px; margin: 20px 0; background: #f0f2f5;">
            <div class="container d-flex align-items-center justify-content-between">
                <h3 class="ps-section__title text-left mb-0" data-aos="fade-right">Daily Deals Of The Day</h3>
            </div>

            <div class="ps-section__content container pt-5">
                <div id="dailyrproduct-splide" class="splide-btn-lg splide will-animate" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-easing="ease-out-quart">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach($dproducts as $product)
                            @php
                            $qty = $product->stocks->sum('qty');
                            $choiceOptions = json_decode($product->choice_options, true);
                            @endphp

                            <li class="splide__slide" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                                <div class="ps-section__product">
                                    <div class="ps-product daily-deals ps-product--standard d-flex align-items-center position-relative will-animate h-100"
                                        style="border-radius: 8px; padding: 50px; display: grid !important; grid-template-columns: 55% 45%;"
                                        data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-left' }}"
                                        data-aos-delay="{{ 100 + ($loop->index * 80) }}">

                                        <div style="position: absolute; top: 15px; left: 15px">
                                            @if(!empty($addonBadges[$product->id]))
                                            <span class="badge badge-success" style="border-radius: 5px; padding: 5px 10px;">
                                                {{ $addonBadges[$product->id]['label'] }}
                                            </span>
                                            @endif

                                            @if(!empty($bogoBadges[$product->id]))
                                            <span class="badge badge-warning" style="border-radius: 5px; padding: 5px 10px;">
                                                {{ $bogoBadges[$product->id]['text'] }}
                                            </span>
                                            @endif

                                            @if ($qty < 1)
                                            <span class="badge text-white" style="background: #c10007; padding: 5px 10px;
                                                border-top-left-radius: 999px; border-bottom-left-radius: 999px; font-size: 12px; font-weight: 600;">
                                                Out of Stock
                                            </span>
                                            @elseif ($qty < 10)
                                            <span class="badge text-white" style="background: #c17c00; padding: 5px 10px;
                                                border-top-left-radius: 999px; border-bottom-left-radius: 999px; font-size: 12px; font-weight: 600;">
                                                Limited Stock
                                            </span>
                                            @endif
                                        </div>

                                        <div class="ps-product__thumbnail" style="position:initial">
                                            <a class="ps-product__image" href="{{ route('product', $product->slug) }}">
                                                <figure data-aos="zoom-in" data-aos-delay="160">
                                                    <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        alt="{{ $product->name }}" loading="lazy">
                                                </figure>
                                            </a>
                                        </div>

                                        <div class="ps-product__content text-left ml-auto d-flex flex-column">
                                            <h5 class="ps-product__title" data-aos="fade-up" data-aos-delay="200">
                                                <a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                            </h5>

                                            <h5 style="font-weight: 400;" class="fs-13 mt-1 mb-0 text-gray"
                                                data-aos="fade-up" data-aos-delay="240">
                                                Category: <a style="color: #c10007; line-height: 1.8rem; padding: 2px 0 0 0 !important;"
                                                    href="{{ route('product', $product->slug) }}">{{ $product->category->name }}</a>
                                            </h5>

                                            <div class="fs-15 text-left product__item__price d-flex flex-column h-auto"
                                                data-aos="fade-up" data-aos-delay="280">
                                                @php
                                                    $baseNoTaxFormatted = product_lowest_base_price($product, true, false);
                                                    $baseNoTaxRaw = product_lowest_base_price($product, false, false);
                                                    $discountedNoTaxFormatted = product_lowest_price($product, true, false);
                                                    $discountedNoTaxRaw = product_lowest_price($product, false, false);
                                                @endphp

                                                <div class="d-flex align-items-center justify-content-start">
                                                    @if($baseNoTaxRaw !== $discountedNoTaxRaw)
                                                        <del class="fw-600 opacity-50 mr-1">{{ $baseNoTaxFormatted }}</del>
                                                    @endif
                                                    <span class="fw-700 ps-product__price mr-1 mb-0" style="white-space: nowrap;">
                                                        {{ $discountedNoTaxFormatted }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="ps-product__rating" data-aos="fade-up" data-aos-delay="320">
                                                <i class="fa fa-star active"></i>
                                                <i class="fa fa-star active"></i>
                                                <i class="fa fa-star active"></i>
                                                <i class="fa fa-star active"></i>
                                                <i class="fa fa-star active"></i>
                                            </div>

                                            <div class="ps-product__actions" style="position: initial; visibility: visible; opacity: 1;
                                                display: block; transform: none !important; margin-top: auto; margin-bottom: 0px;"
                                                data-aos="fade-up" data-aos-delay="360">
                                                <div class="ps-product__item" data-toggle="tooltip">
                                                    @if ($product->prescription == 1 || !empty($choiceOptions))
                                                    <a href="{{ route('product', $product->slug) }}">View Details</a>
                                                    @else
                                                    <a href="#" onclick="addToCartHome(event, {{ $product->id }}, this)">Add To Cart</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        @endif

        {{-- PROMO CAROUSEL --}}
        <div data-aos="fade-up" data-aos-duration="1200" data-aos-easing="ease-out-quart"
            class="section-padding ps-promo ps-promo--home container pt-0 will-animate" style="margin-top: 20px;">
            <div id="promo-carousel" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($adtop as $top)
                        <li class="splide__slide" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 80 }}">
                            <a class="ps-promo__item" href="{{ $top->link }}">
                                <img class="ps-promo__banner" src="{{ uploaded_asset($top->thumbnail_img) }}" alt="alt" loading="lazy">
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- BROWSE BY CATEGORY --}}
        <section data-aos="fade-up" data-aos-duration="1200" data-aos-easing="ease-out-quart"
            class="section-padding ps-section--latest pb-5 mb-4 shopcat will-animate" style="padding-top: 30px;">
            <div class="container">
                <h3 class="ps-section__title text-left" data-aos="fade-right">Browse by Category</h3>

                <div id="life-carousel" class="splide will-animate" data-aos="fade-up" data-aos-duration="1000">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach($flifes as $life)
                            <li class="splide__slide" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                                <a href="{{ route('products.category', $life->category->slug) }}">
                                    <div class="category-card will-animate"
                                        data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-left' }}"
                                        data-aos-delay="{{ 80 + ($loop->index * 60) }}">
                                        <div class="icon-circle">
                                            <img class="default" src="{{ uploaded_asset($life->logo) }}" alt="" loading="lazy">
                                            <img class="hover" src="{{ uploaded_asset($life->logo) }}" alt="" loading="lazy">
                                        </div>
                                        <p>{{ $life->name }}</p>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- CATEGORY PRODUCTS LOOP --}}
        @foreach ($fcategories as $index => $lifestyle)
        <section data-aos="fade-up" data-aos-duration="1500" class="section-padding section-categories ps-section--featured bg-white will-animate mb-0"
            style="padding: 0 3vw 50px 3vw !important;">
            <div class="d-flex align-items-center justify-content-between container">
                <h3 class="ps-section__title text-left mb-0" data-aos="fade-right">{{ $lifestyle->name }}</h3>
                <a class="primary-btn text-white will-animate" href="{{route('products.category',$lifestyle->slug)}}"
                    data-aos="fade-left">View All</a>
            </div>
            <div class="ps-section__content container pt-5">
                <div class="ps-section__carousel">
                    <div id="lifestyle-products-carousel-{{ $index }}" class="splide mobile-arrow-btn lifecarousel will-animate"
                        data-aos="fade-up" data-aos-duration="1200">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($lifestyle->products as $product)
                                <li class="splide__slide" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                                    <div class="ps-section__product">
                                        <div class="ps-product ps-product--standard will-animate h-100"
                                            data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-left' }}"
                                            data-aos-delay="{{ 80 + ($loop->index * 60) }}">
                                            <div style="position: absolute; top: 15px; left: 15px">
                                                @if (!empty($addonBadges[$product->id]))
                                                <span class="badge badge-success">{{ $addonBadges[$product->id]['label'] }}</span>
                                                @endif

                                                @if (!empty($bogoBadges[$product->id]))
                                                <span class="badge badge-warning">{{ $bogoBadges[$product->id]['text'] }}</span>
                                                @endif

                                                @php
                                                $qty = 0;
                                                foreach ($product->stocks as $key => $stock) { $qty += $stock->qty; }
                                                @endphp

                                                @if($qty < 1)
                                                <span class="badge" style="color: #fff; font-size: 12px; background: #c10007;
                                                    padding: 5px; border-radius: 999px; font-weight: 600; line-height: 1;">
                                                    Out of Stock
                                                </span>
                                                @endif
                                            </div>

                                            <div class="ps-product__thumbnail">
                                                <a class="ps-product__image" href="{{ route('product', $product->slug) }}">
                                                    <figure><img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                            alt="{{ $product->name }}" loading="lazy" /></figure>
                                                </a>
                                                @php $choiceOptions = json_decode($product->choice_options, true); @endphp
                                                <div class="ps-product__actions ps-product__actions_sm">
                                                    <div class="ps-product__item" data-toggle="tooltip">
                                                        @if ($product->prescription == 1 || !empty($choiceOptions))
                                                        <a href="{{ route('product', $product->slug) }}">View Details</a>
                                                        @else
                                                        <a href="#" onclick="addToCartHome(event, {{ $product->id }}, this)">Add To Cart</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="ps-product__content text-left">
                                                <h5 class="ps-product__title">
                                                    <a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                                </h5>
                                                <h5 class="fs-13 mt-1 mb-0" style="width: 100%; overflow: hidden; display: -webkit-box;
                                                    -webkit-line-clamp: 2; -webkit-box-orient: vertical; color: gray; font-weight:400;">
                                                    Category: <a style="color: #c10007; line-height: 1.8rem; padding: 2px 0 0 0 !important;"
                                                        href="{{ route('product', $product->slug) }}">{{$product->category->name}}</a>
                                                </h5>

                                                <div class="fs-15 text-left product__item__price d-flex flex-column">
                                                    @php
                                                        $baseNoTaxFormatted = product_lowest_base_price($product, true, false);
                                                        $baseNoTaxRaw = product_lowest_base_price($product, false, false);
                                                        $discountedNoTaxFormatted = product_lowest_price($product, true, false);
                                                        $discountedNoTaxRaw = product_lowest_price($product, false, false);
                                                    @endphp

                                                    <div class="d-flex align-items-center justify-content-start">
                                                        @if($baseNoTaxRaw !== $discountedNoTaxRaw)
                                                            <del class="fw-600 opacity-50 mr-1">{{ $baseNoTaxFormatted }}</del>
                                                        @endif
                                                        <span class="fw-700 ps-product__price mr-1 mb-0" style="white-space: nowrap;">
                                                            {{ $discountedNoTaxFormatted }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="ps-product__rating">
                                                    <i class="fa fa-star active"></i>
                                                    <i class="fa fa-star active"></i>
                                                    <i class="fa fa-star active"></i>
                                                    <i class="fa fa-star active"></i>
                                                    <i class="fa fa-star active"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- HOW TO ORDER & BRANDS (After first lifestyle) --}}
        @if ($index === 0)
        <section data-aos="fade-up" data-aos-duration="1500"
            class="section-padding ps-section--featured pt-10 howtoorder position-relative will-animate"
            style="padding-bottom: 40px; background: #f0f2f5; padding: 50px; padding-top: 50px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6" data-aos="fade-right">
                        <img style="width:500px" src="{{static_asset('assets/img/how-to-order-img.png')}}" loading="lazy" />
                    </div>
                    <div class="col-lg-6 content m-auto howtordercontent" data-aos="fade-left" data-aos-delay="120">
                        <h2 class="fs-28 fw-700 text-red">How to order prescription medicines?</h2>
                        <p class="fs-20">It's Simple.</p>
                        <ul class="steps">
                            <li><span>1</span> Upload valid Prescription</li>
                            <li><span>2</span> Receive a confirmation call</li>
                            <li><span>3</span> Delivery at your door step</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section data-aos="fade-up" data-aos-duration="1500" class="section-padding section-categories ps-section--featured pt-5 will-animate"
            style="padding: 30px 3vw 40px 3vw !important;">
            <div class="d-flex align-items-center justify-content-between container">
                <h3 class="ps-section__title text-left mb-0" data-aos="fade-right">Our Brands</h3>
            </div>
            <div class="ps-section__content container pt-0">
                <div id="client-carousel" class="splide cursor-pointer will-animate" aria-label="Client Logos Carousel"
                    data-aos="fade-up" data-aos-duration="1000">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach($fbrands as $brand)
                            <li class="splide__slide text-center" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 70 }}">
                                <a href="{{ route('products.brand', $brand->slug) }}">
                                    <img src="{{ uploaded_asset($brand->logo) }}" alt="brand" width="200" height="200" loading="lazy">
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @endforeach

        {{-- LIFESTYLE PRODUCTS LOOP --}}
        @foreach ($lifestyles as $index => $lifestyle)
        <section data-aos="fade-up" data-aos-duration="1500" class="section-padding ps-section--featured bg-white will-animate"
            style="padding-bottom: 50px; padding-top: 35px;">
            <div class="d-flex align-items-center justify-content-between container">
                <h3 class="ps-section__title text-left mb-0" data-aos="fade-right">{{ $lifestyle->name }}</h3>
                <a class="primary-btn text-white will-animate" href="{{route('products.life',$lifestyle->slug)}}"
                    data-aos="fade-left">View All</a>
            </div>
            <div class="ps-section__content container pt-5">
                <div class="ps-section__carousel">
                    <div id="lifestyle-products-carouseltwo-{{ $index }}" class="splide mobile-arrow-btn will-animate"
                        data-aos="fade-up" data-aos-duration="1200">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($lifestyle->products as $product)
                                <li class="splide__slide" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                                    <div class="ps-section__product">
                                        <div class="ps-product ps-product--standard will-animate h-100"
                                            data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-left' }}"
                                            data-aos-delay="{{ 80 + ($loop->index * 60) }}">
                                            <div style="position: absolute; top: 15px; left: 15px">
                                                @if (!empty($addonBadges[$product->id]))
                                                <span class="badge badge-success">{{ $addonBadges[$product->id]['label'] }}</span>
                                                @endif

                                                @if (!empty($bogoBadges[$product->id]))
                                                <span class="badge badge-warning">{{ $bogoBadges[$product->id]['text'] }}</span>
                                                @endif

                                                @php
                                                $qty = 0;
                                                foreach ($product->stocks as $key => $stock) { $qty += $stock->qty; }
                                                @endphp

                                                @if($qty < 1)
                                                <span class="badge" style="color: #fff; font-size: 12px; background: #c10007;
                                                    padding: 5px; border-radius: 999px; font-weight: 600; line-height: 1;">
                                                    Out of Stock
                                                </span>
                                                @endif
                                            </div>

                                            <div class="ps-product__thumbnail">
                                                <a class="ps-product__image" href="{{ route('product', $product->slug) }}">
                                                    <figure><img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                            alt="{{ $product->name }}" loading="lazy" /></figure>
                                                </a>
                                                @php $choiceOptions = json_decode($product->choice_options, true); @endphp
                                                <div class="ps-product__actions ps-product__actions_sm">
                                                    <div class="ps-product__item" data-toggle="tooltip">
                                                        @if ($product->prescription == 1 || !empty($choiceOptions))
                                                        <a href="{{ route('product', $product->slug) }}">View Details</a>
                                                        @else
                                                        <a href="#" onclick="addToCartHome(event, {{ $product->id }}, this)">Add To Cart</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="ps-product__content text-left">
                                                <h5 class="ps-product__title">
                                                    <a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                                </h5>
                                                <h5 class="fs-13 mt-1 mb-0" style="width: 100%; overflow: hidden; display: -webkit-box;
                                                    -webkit-line-clamp: 2; -webkit-box-orient: vertical; color: gray; font-weight:400;">
                                                    Category: <a style="color: #c10007; line-height: 1.8rem; padding: 2px 0 0 0 !important;"
                                                        href="{{ route('product', $product->slug) }}">{{$product->category->name}}</a>
                                                </h5>

                                                <div class="fs-15 text-left product__item__price d-flex flex-column">
                                                    @php
                                                        $baseNoTaxFormatted = product_lowest_base_price($product, true, false);
                                                        $baseNoTaxRaw = product_lowest_base_price($product, false, false);
                                                        $discountedNoTaxFormatted = product_lowest_price($product, true, false);
                                                        $discountedNoTaxRaw = product_lowest_price($product, false, false);
                                                    @endphp

                                                    <div class="d-flex align-items-center justify-content-start">
                                                        @if($baseNoTaxRaw !== $discountedNoTaxRaw)
                                                            <del class="fw-600 opacity-50 mr-1">{{ $baseNoTaxFormatted }}</del>
                                                        @endif
                                                        <span class="fw-700 ps-product__price mr-1 mb-0" style="white-space: nowrap;">
                                                            {{ $discountedNoTaxFormatted }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="ps-product__rating">
                                                    <i class="fa fa-star active"></i>
                                                    <i class="fa fa-star active"></i>
                                                    <i class="fa fa-star active"></i>
                                                    <i class="fa fa-star active"></i>
                                                    <i class="fa fa-star active"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endforeach

        {{-- BOTTOM PROMO CAROUSEL --}}
        <div data-aos="fade-up" data-aos-duration="1200" data-aos-easing="ease-out-quart"
            class="section-padding ps-promo ps-promo--home container pt-0 will-animate" style="margin-top: 0px;">
            <div id="promo-carousel2" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($adbottom as $top)
                        <li class="splide__slide" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 80 }}">
                            <div class="ps-promo__item">
                                <img class="ps-promo__banner" src="{{ uploaded_asset($top->thumbnail_img) }}" alt="alt" loading="lazy">
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- DR MED PHARMACY BANNER --}}
        <div data-aos="fade-up" data-aos-duration="1500" class="drmed-banner section-padding will-animate"
            style="margin-top: 50px; background-image: url('{{ uploaded_asset($about->fly1) }}'); background-size: cover; background-position: center;">
            <div class="drmed-banner-content p-5" data-aos="fade-right" data-aos-delay="140">
                <img src="{{uploaded_asset($about->wlf)}}" alt="Dr. Med Pharmacy Logo" data-aos="zoom-in"
                    data-aos-delay="220" loading="lazy">
                <p class="text-white" data-aos="fade-up" data-aos-delay="260">
                    Dr. Med Pharmacy is your trusted partner in health and everyday living. We provide authentic, affordable
                    medicines, supplements, and general merchandise - all compliant with Philippine FDA regulations. Our mission
                    is to make quality healthcare and daily essentials accessible to Filipino families through safe, fast, and
                    reliable service.
                </p>
            </div>
        </div>

    </div>
</div>

{{-- WELCOME MODAL --}}
@if($about->modal == 1)
<div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 800px;">
        <div class="modal-content medpop will-animate" data-aos="zoom-in" data-aos-duration="800">
            <div class="newsletter-popup-content">
                <div class="membership-left">
                    <div class="membership-icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/9592/9592257.png" alt="Membership" loading="lazy">
                    </div>
                    <div class="membership-text">
                        <h2>Premium Health Membership</h2>
                        <p>Unlock exclusive deals and free deliveries.</p>
                        <p>Earn 2% Health Cash on every purchase.</p>
                    </div>
                    <div class="membership-buttons">
                        <button class="primary-btn">View Benefits</button>
                    </div>
                </div>
            </div>
            <div class="modal-close" data-dismiss="modal">
                <i class="fa fa-times"></i>
            </div>
        </div>
    </div>
</div>
@endif

{{-- COOKIE CONSENT --}}
<div id="cookieConsent" class="cookie-consent hidden will-animate" data-aos="fade-up" data-aos-duration="800">
    <div class="cookie-header">
        <h4 class="fs-16">Cookies</h4>
        <span id="closeCookies" class="close-icon">&times;</span>
    </div>
    <p class="mb-1">We use cookies to make our site work smoothly and improve usability.</p>
    <button id="acceptCookies" class="w-100 primary-btn mt-1">Accept</button>
</div>

@endsection

@section('script')
<script>
/* AOS global tuning */
if (window.AOS) {
  AOS.init({ duration: 700, easing: 'ease-out-quart', once: true, offset: 80 });
}

/**
 * Splide first-load cut fix:
 * - mount AFTER window load (images/layout ready)
 * - then refresh on next frame + small timeout
 * - DO NOT override Splide transforms in CSS
 */
(function () {
  function raf(cb){ try{ requestAnimationFrame(cb); } catch(e){ setTimeout(cb, 16); } }
  function safeMountSplide(id, options) {
    var el = document.getElementById(id);
    if (!el || !window.Splide) return null;
    if (el.__drmedSplideMounted) return el.__drmedSplideInstance || null;

    try {
      var inst = new Splide(el, options || {});
      inst.mount();
      el.__drmedSplideMounted = true;
      el.__drmedSplideInstance = inst;

      raf(function(){
        try { inst.refresh(); } catch(e) {}
        setTimeout(function(){ try { inst.refresh(); } catch(e) {} }, 120);
      });

      return inst;
    } catch (e) {
      return null;
    }
  }

  function mountAll() {
    // Banner (perPage 1)
    var banner = safeMountSplide('banner-carousel', {
      type: 'loop',
      perPage: 1,
      perMove: 1,
      pagination: true,
      arrows: true,
      autoplay: true,
      interval: 5000,
      pauseOnHover: true,
      rewind: true
    });
    if (banner) {
      document.getElementById('banner-carousel').classList.add('is-initialized');
    }

    // New Arrivals / Trending / Daily deals
    safeMountSplide('fproduct-splide', { type:'loop', perPage: 5, gap: '16px', pagination: false, arrows: true, breakpoints: { 1200:{perPage:4}, 992:{perPage:3}, 768:{perPage:2}, 480:{perPage:2} } });
    safeMountSplide('rproduct-splide', { type:'loop', perPage: 5, gap: '16px', pagination: false, arrows: true, breakpoints: { 1200:{perPage:4}, 992:{perPage:3}, 768:{perPage:2}, 480:{perPage:2} } });
    safeMountSplide('dailyrproduct-splide', { type:'loop', perPage: 1, gap: '16px', pagination: false, arrows: true });

    // Promo carousels (the ones cutting on first load)
    safeMountSplide('promo-carousel', { type:'loop', perPage: 3, gap:'16px', pagination: false, arrows: true, breakpoints: { 992:{perPage:2}, 768:{perPage:1} } });
    safeMountSplide('promo-carousel2', { type:'loop', perPage: 1, gap:'16px', pagination: false, arrows: true });

    // Category carousel / brands
    safeMountSplide('life-carousel', { type:'loop', perPage: 6, gap:'14px', pagination: false, arrows: true, breakpoints: { 1200:{perPage:5}, 992:{perPage:4}, 768:{perPage:3}, 480:{perPage:2} } });
    safeMountSplide('client-carousel', { type:'loop', perPage: 6, gap:'14px', pagination: false, arrows: true, breakpoints: { 1200:{perPage:5}, 992:{perPage:4}, 768:{perPage:3}, 480:{perPage:2} } });

    // Multiple lifestyle carousels (dynamic IDs)
    var els = document.querySelectorAll('.splide.lifecarousel, .splide[id^="lifestyle-products-carouseltwo-"], .splide[id^="lifestyle-products-carousel-"]');
    els.forEach(function(node){
      if (!node.id) return;
      safeMountSplide(node.id, { type:'loop', perPage: 5, gap:'16px', pagination: false, arrows: true, breakpoints: { 1200:{perPage:4}, 992:{perPage:3}, 768:{perPage:2}, 480:{perPage:2} } });
    });
  }

  function hardRefreshAllSplides() {
    var nodes = document.querySelectorAll('.splide');
    nodes.forEach(function(node){
      var inst = node.__drmedSplideInstance;
      if (inst && typeof inst.refresh === 'function') {
        try { inst.refresh(); } catch(e) {}
      }
    });
  }

  // Mount on full load (fixes “cut until refresh”)
  window.addEventListener('load', function () {
    mountAll();
    raf(hardRefreshAllSplides);
    setTimeout(hardRefreshAllSplides, 250);
    setTimeout(hardRefreshAllSplides, 700);
  });

  // Also refresh after orientation/resize
  window.addEventListener('resize', function(){
    setTimeout(hardRefreshAllSplides, 120);
  });
  window.addEventListener('orientationchange', function(){
    setTimeout(hardRefreshAllSplides, 200);
  });

  // Cookie consent minimal wiring (safe)
  document.addEventListener('DOMContentLoaded', function(){
    var consent = document.getElementById('cookieConsent');
    var accept = document.getElementById('acceptCookies');
    var close = document.getElementById('closeCookies');

    try {
      var key = 'drmed_cookie_consent';
      var has = localStorage.getItem(key) === '1';
      if (!has && consent) consent.classList.remove('hidden');

      function hide(){ if (consent) consent.classList.add('hidden'); }
      if (accept) accept.addEventListener('click', function(){ try{ localStorage.setItem(key,'1'); }catch(e){} hide(); });
      if (close) close.addEventListener('click', function(){ hide(); });
    } catch(e) {}
  });
})();
</script>
@endsection
