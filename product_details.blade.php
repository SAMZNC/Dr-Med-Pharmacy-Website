@extends('frontend.layouts.app')
@section('meta_title'){{ $detailedProduct->meta_title }}@stop
@section('meta_description'){{ $detailedProduct->meta_description }}@stop
@section('meta_keywords'){{ $detailedProduct->tags }}@stop
@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">
    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
    <meta property="product:price:currency"
        content="{{ \App\Models\Currency::findOrFail(get_setting('system_default_currency'))->code }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection
<style>
    .header-bottom:not(.fixed) .dropdown-box {
        opacity: 0 !important;
        visibility: hidden !important;
    }

    .dropdown:hover .dropdown-box {
        opacity: 1 !important;
        visibility: visible !important;
    }

    .zoomContainer div.zoomWindow {
        top: 100px !important;
        transform: translateY(0) !important;
    }

    .zoomContainer {
        top: 100px !important;
        /* Forces zoom window to align to the top of the image */
    }

    .btn-addprescription:hover {
        color: white !important;
    }

    .col-lg-4 .card {
        -webkit-box-shadow: 0 0 13px 0 rgba(82, 63, 105, 0.05);
        box-shadow: 0 0 13px 0 rgb(82 63 105 / 19%) !important;
        background-color: #fff;
        margin-bottom: 20px;
        border-color: #ebedf2;
        border-radius: 10px;
        padding: 20px !important;
    }

    .text-green {
        color: #006400;
        font-weight: 500;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        color: #fff !important;
        background-color: #262626 !important;


    }

    .aiz-megabox>input:checked~.aiz-megabox-elem,
    .aiz-megabox>input:checked~.aiz-megabox-elem {
        border-color: #c10007 !important;
        border-width: 2px;
        background: #c10007;
        color: white;
    }

    .aiz-megabox .aiz-megabox-elem {
        border-radius: 6px !important;
    }

    /* when this option is selected */
    .aiz-megabox input.variant-option:checked+.aiz-megabox-elem .stock-status.text-success {
        color: #fff !important;
        /* turn green text to white */
        opacity: 1 !important;
        /* remove the faded look */
    }


    .nav-tabs .nav-link {
        font-weight: 500;
        height: 40px;
        display: flex;
        align-items: center;
        font-size: 14px;
        border-radius: 6px !important;
        padding: 10px 16px;
        border-radius: 6px;
        white-space: nowrap;

    }

    .nav-tabs .nav-item:hover .nav-link {
        color: #fff !important;
        background-color: #262626 !important;
    }

    .nav-tabs .nav-item {
        margin-bottom: -1px;
        margin-right: 1rem !important;
    }


    form label {
        font-size: 13px;
        font-weight: 500;
    }

    #main-image {
        height: 300px;
        width: 100%;
        border: 1px solid lightgray;
    }

    .ps-product--detail .ps-product__quantity .number-input button {
        background-color: transparent;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        padding: 16px;
        cursor: pointer;
        border: 1px solid gray !important;
        border-radius: 6px !important;
        padding: 12px !important;
    }

    form .form-control {
        display: block;
        width: 100%;
        min-height: 4.7rem;
        padding: 0.85rem 2rem;
        border: 1px solid #8080808c;
    }

    .modal-header .close:before {
        font-family: "Line Awesome Free";
        font-weight: 900;
        content: "\f00d";
        font-size: 20px;
        color: white;
        opacity: 1;
    }

    .getquote {
        display: flex;
        align-items: center;
        text-align: center;
        justify-content: center;
        background-color: #3c78b4 !important;
        color: white !important;
        height: 48px;
        font-size: 12px;
        border-color: #3c78b4;
        border-radius: .3rem;
    }

    .nav-tabs {
        flex-wrap: nowrap !important;
    }

    .quotemodal .modal-content .modal-body {
        padding: 20px 25px;
        overflow-y: auto;
        max-height: 100%;
    }

    .zoomLens {
        display: none !important;
    }

    @media(max-width:600px) {
        .modal.show .modal-dialog {
            max-width: 100% !important;
        }

        .thumbnail img {
            width: 80px !important;
        }

        .quotemodal .modal-content {
            height: 100%;
        }

        .ps-page {
            width: 100% !important;
            padding: 0 !important;
        }

        .ps-breadcrumb__item,
        .ps-breadcrumb__item a {
            font-size: 12px !important;
        }

        .ps-breadcrumb {
            overflow-x: scroll;
            white-space: nowrap;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .ps-breadcrumb::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .ps-breadcrumb {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    }

    .product-short-desc p {
        color: #000 !important;
        font-size: 12px !important;
    }

    .product-summary-row {
        align-items: flex-start;
    }

    @media (min-width: 992px) {
        .product-summary-row {
            flex-wrap: nowrap;
        }
    }

    /* Keep summary card aligned next to the gallery */
    .product-summary-col {
        align-self: flex-start;
    }

    @media (min-width: 992px) {
        .product-summary-sticky {
            position: sticky;
            top: 10px;
        }
    }

    @media (max-width: 991.98px) {
        .product-summary-sticky {
            position: static;
        }
    }


    @media(min-width:600px) {
        div.lgflex {
            display: flex !important;
        }
    }
</style>
@section('content')
    <main class="main">
        <!-- Start of Breadcrumb -->

        <!-- End of Breadcrumb -->
        <!-- Start of Page Content -->
        <div class="page-content">

            <div class="container">
                <ul class="ps-breadcrumb">
                    <li class="ps-breadcrumb__item" style="text-wrap: nowrap;"><a href="{{ route('home') }}">Home</a></li>
                    <li class="ps-breadcrumb__item" style="text-wrap: nowrap;"><a
                            href="{{ route('products.category', $detailedProduct->category->slug) }}">{{ $detailedProduct->category->name }}</a>
                    </li>
                    <li class="ps-breadcrumb__item active">{{ $detailedProduct->name }}</li>
                </ul>


                {{-- TODO: Add in admin panel --}}

                {{-- <div class="autoship-banner text-center"> --}}
                    {{-- <h6 class="text-red fs-23 font-weight-bold mb-1">Autoship &amp; Save Special</h6> --}}
                    {{-- <p class="mb-0 text-black fs-18">Enjoy <strong>20%</strong> off or greater available discount on
                        your --}}
                        {{-- first order, and <strong>10%</strong> off on future orders.</p> --}}
                    {{-- </div> --}}

                <div class="">
                    <div class="row gutter-lg">
                        <div class="main-content">
                            <div class="product product-single row ps-product--detail ps-product--full ">
                                <div class="col-md-4 mb-6">
                                    <div class="mt-4 text-center d-none" style="    position: absolute;
                                            top: 0;
                                            right: 20px;
                                            z-index: 99;">
                                        <button id="viewAllImages" style="    background: white;
                                            border: none;
                                            padding: 10px;
                                            border-radius: 50%;">
                                            <img width="30" src="{{ static_asset('assets/img/zoom-in.png') }}" />
                                        </button>
                                    </div>


                                    <div class="z-3 row gutters-10 product-gallery  m-0">

                                        @php
                                            $photos = array_unique(explode(',', $detailedProduct->photos));
                                        @endphp
                                        <!-- Main Image Display -->
                                        <!-- Main Image with Zoom -->
                                        <div id="image-zoom-wrapper" class="image-zoom-wrapper d-none d-lg-block"
                                            style="display: inline-block; position: relative;">
                                            <img id="main-image" src="{{ uploaded_asset($photos[0]) }}"
                                                data-zoom-image="{{ uploaded_asset($photos[0]) }}"
                                                style="object-fit: contain; max-width: 100%; max-height: 400px; display: block;"
                                                alt="Main Image">
                                        </div>
                                        <div class=" d-lg-none">
                                            <img id="mobile-main-image" src="{{ uploaded_asset($photos[0]) }}"
                                                style="object-fit: contain; max-width: 100%; max-height: 400px; display: block;"
                                                alt="Main Image">
                                        </div>
                                        <!-- Thumbnails -->
                                        <div class="d-none d-lg-block flex-wrap gap-2 mt-3 lgflex">
                                            @foreach ($photos as $photo)
                                                <div class="thumbnail h-100 mr-1"
                                                    style="padding: 3px;border: 1px solid lightgray;cursor: pointer;"
                                                    onclick="changeMainImage('{{ uploaded_asset($photo) }}')">
                                                    <img src="{{ uploaded_asset($photo) }}"
                                                        style=" height: 80px; width: 80px; object-fit: contain;"
                                                        alt="Thumbnail">
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="d-lg-none flex-wrap gap-2 mt-3">
                                            @foreach ($photos as $photo)
                                                <div class="thumbnail h-100 mr-1"
                                                    style="padding: 3px;border: 1px solid lightgray;cursor: pointer;"
                                                    onclick="smallchangeMainImage('{{ uploaded_asset($photo) }}')">
                                                    <img src="{{ uploaded_asset($photo) }}"
                                                        style=" height: 80px; width: 80px; object-fit: contain;"
                                                        alt="Thumbnail">
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>

                                    @if ($detailedProduct->pad != null)
                                        <img src="{{ uploaded_asset($detailedProduct->pad) }}" class="w-100 d-none d-lg-block"
                                            style="    margin-top: 40px;" alt="Thumbnail">
                                    @else

                                        <!--<img class="d-none d-lg-block" style="    margin-top: 40px;" src=""/>-->
                                    @endif
                                    <!-- Hidden Field to Store Selected Variant -->
                                </div>
                                <div class="col-md-8 mb-4 mb-md-6">

                                    <div class="row product-summary-row">

                                        <div class="col-12 col-lg-8">

                                            @if (!empty($addonBadge))
                                                <span class="badge badge-success rounded-full"
                                                    style="    background-color: darkgreen;">
                                                    {{ $addonBadge['label'] }}
                                                </span>

                                            @endif

                                            @if (!empty($bogoBadge))
                                                <span class="badge badge-warning rounded-full">
                                                    {{ $bogoBadge['text'] }}
                                                </span>
                                            @endif


                                            <div class="text-left">
                                                <div
                                                    class="ps-product__title d-flex align-items-center justify-content-between mb-0">
                                                    <a href="#">{{ $detailedProduct->name }}</a>
                                                    @php
                                                        $inWishlist = auth()->check() && auth()->user()->wishlists->contains('product_id', $detailedProduct->id);
                                                    @endphp
                                                    <button type="button" class="btn pl-0 btn-link fw-600 wishprodetail"
                                                        onclick="toggleWishlist(this, {{ $detailedProduct->id }})">
                                                        <i class="{{ $inWishlist ? 'la la-heart text-red' : 'la la-heart-o opacity-80 text_color' }}
                                                                    fs-20 la-5x pr-1" style="font-size:25px;"
                                                            data-toggle="tooltip" data-placement="left"></i>
                                                    </button>
                                                </div>

                                                <div class="row align-items-center mb-2">
                                                    <div class="col-12">
                                                        @php
                                                            $total = 0;
                                                            $total += $detailedProduct->reviews->count();
                                                        @endphp
                                                        <span class="rating">
                                                            {{ renderStarRating($detailedProduct->rating) }}
                                                        </span>
                                                        <span class="ml-1 opacity-50">({{ $total }}
                                                            {{ translate('reviews') }})</span>
                                                    </div>
                                                    @if ($detailedProduct->est_shipping_days)
                                                        <div class="col-auto ml">
                                                            <small
                                                                class="mr-2 opacity-50">{{ translate('Estimate Shipping
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Time') }}:
                                                            </small>{{ $detailedProduct->est_shipping_days }}
                                                            {{ translate('Days') }}
                                                        </div>
                                                    @endif
                                                </div>



                                                @if ($detailedProduct->unit_price != null)
                                                    @if ($detailedProduct->wholesale_product)
                                                        <table class="aiz-table mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ translate('Min Qty') }}</th>
                                                                    <th>{{ translate('Max Qty') }}</th>
                                                                    <th>{{ translate('Unit Price') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($detailedProduct->stocks->first()->wholesalePrices as $wholesalePrice)
                                                                    <tr>
                                                                        <td>{{ $wholesalePrice->min_qty }}</td>
                                                                        <td>{{ $wholesalePrice->max_qty }}</td>
                                                                        <td>{{ single_price($wholesalePrice->price) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        @if (home_price($detailedProduct) != home_discounted_price($detailedProduct))
                                                            <div class="d-flex" id="p1">
                                                                <div class="row no-gutters align-items-center ">
                                                                    <div class="">
                                                                        <div class="fs-20 opacity-60">
                                                                            <del>
                                                                                {{ home_price($detailedProduct) }}
                                                                            </del>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row no-gutters align-items-center my-2 ml-1">
                                                                    <div class="">
                                                                        <div class="product-detailed-price">
                                                                            <strong class="h2 fw-600">
                                                                                {{ home_discounted_price($detailedProduct) }}
                                                                            </strong>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div id="p2" class="row no-gutters d-none align-items-center m-0 mt-3">
                                                                <div class="col-sm-2">
                                                                    <div class="opacity-50 my-2">{{ translate('Price') }}:</div>
                                                                </div>
                                                                <div class="col-sm-10">
                                                                    <div class="product-detailed-price">
                                                                        <strong class="h2 fw-600">
                                                                            {{ home_discounted_price($detailedProduct) }}
                                                                        </strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endif
                                                @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)
                                                    <div class="row no-gutters align-items-center mt-4">
                                                        <div class="col-sm-2">
                                                            <div class="opacity-50 my-2">{{ translate('Club Point') }}:
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <div
                                                                class="d-inline-block rounded px-2 bg-soft-primary border-soft-primary border">
                                                                <span
                                                                    class="strong-700">{{ $detailedProduct->earn_point }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <hr>

                                                <div class="mt-3 d-none">
                                                    @if ($detailedProduct->unit_price == null)
                                                        <button type="button" class="btn btn-soft-primary mr-2 fw-600 getquote"
                                                            data-toggle="modal" data-target="#exampleModal">
                                                            <span class=" d-md-inline-block">
                                                                {{ translate('Get a
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            quote') }}</span>
                                                        </button>
                                                    @else



                                                    @endif

                                                    <button type="button"
                                                        class="btn btn-secondary out-of-stock fw-600 d-none" disabled>
                                                        <i class="la la-cart-arrow-down"></i>
                                                        {{ translate('Out of
                                                                                                                                                                                                                                                                                                                                                                                                                                                            Stock') }}
                                                    </button>


                                                </div>

                                                @php
                                                    $rawShort = $detailedProduct->short_description ?? '';
                                                    // Strip any broken/unsafe tags to avoid layout breakage and keep text readable
                                                    $cleanShort = trim(strip_tags($rawShort));
                                                @endphp
                                                @if (!empty($cleanShort))
                                                    <p class="product-short-intro">{!! nl2br($cleanShort) !!}</p>
                                                @endif

                                                <div class="product-sku mb-3">
                                                    <span class="text-dark fw-600"> FDA Registration Number:</span>
                                                    <span class="text-dark fw-500"> {{ $detailedProduct->fdanum }}</span>
                                                </div>

                                                @if ($detailedProduct->addonProducts->isNotEmpty())
                                                    <div class="mt-2 d-none" style="background: #ff000012;padding: 40px 20px;">
                                                        <h3 class="mb-3">Special Offer – Bundle & Save</h3>
                                                        <div class="row g-3">
                                                            @foreach ($detailedProduct->addonProducts as $addon)
                                                                @php
                                                                    $stock = $addon->stocks->first();
                                                                    $basePrice = optional($stock)->price ?? $addon->unit_price;

                                                                    $dv = (float) $addon->pivot->discount_value;
                                                                    if ($addon->pivot->discount_type === 'percent') {
                                                                        $finalPrice = max(0, $basePrice * (1 - $dv / 100));
                                                                        $badge = number_format($dv, 0) . '% off';
                                                                    } else {
                                                                        $finalPrice = max(0, $basePrice - $dv);
                                                                        $badge = '- ' . (function_exists('single_price') ? single_price($dv) : number_format($dv, 2));
                                                                    }
                                                                @endphp

                                                                <div class="col-md-6 col-sm-6">
                                                                    <div class="card h-100 shadow-sm">
                                                                        <img style="    width: 150px;
                                                                                        text-align: center;
                                                                                        display: flex;
                                                                                        align-items: center;
                                                                                        justify-content: center;
                                                                                        margin: auto;"
                                                                            src="{{ uploaded_asset($addon->thumbnail_img) }}"
                                                                            class="card-img-top img-fit" alt="{{ $addon->name }}">
                                                                        <div class="card-body d-flex flex-column">
                                                                            <h6 class="fw-600">{{ $addon->name }}</h6>
                                                                            <span style="    color: white;
                                                                                        width: fit-content;
                                                                                        padding: 10px;
                                                                                        border-radius: 999px;
                                                                                        background: red;
                                                                                        background-color: #c10007 !important;
                                                                                        position: absolute;
                                                                                        top: 0;
                                                                                        right: 0;"
                                                                                class="badge bg-success mb-2">{{ $badge }}</span>

                                                                            <div class="mt-auto">
                                                                                <div class="fw-bold text-red ps-product__price fs-14"
                                                                                    style="font-size:17px">
                                                                                    {!! function_exists('single_price') ? single_price($finalPrice) : number_format($finalPrice, 2) !!}
                                                                                </div>
                                                                                <small
                                                                                    class="text-muted text-decoration-line-through d-none">
                                                                                    {!! function_exists('single_price') ? single_price($basePrice) : number_format($basePrice, 2) !!}
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                                @php
                                                    $prescription = \App\Models\Prescription::where('user_id', auth()->id())
                                                        ->where('product_id', $detailedProduct->id)
                                                        ->latest()
                                                        ->first();
                                                @endphp

                                                @php
                                                    $discounts = \App\Models\Discount::where('user_id', auth()->id())
                                                        ->where('product_id', $detailedProduct->id)
                                                        ->latest()
                                                        ->first();
                                                @endphp

                                                @if (Auth::check() && Auth::user()->senior == 1)


                                                    <div class="alert alert-success mt-3"
                                                        style="border-radius: 10px; background-color: #e9f9ed;">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-check-circle text-success me-2"
                                                                style="font-size: 20px;"></i>
                                                            <div style="font-size: 13px; margin-left: 10px;">
                                                                You are eligible for the Senior Citizen Discount. Please check
                                                                your email to redeem your discount code.
                                                            </div>
                                                        </div>
                                                    </div>

                                                @elseif(!$discounts || $discounts->status === null)

                                                    <div class="d-flex flex-column mt-3 mb-3"
                                                        style="background: #d3d3d35e; padding: 20px; border-radius: 10px;">
                                                        <label class="d-flex align-items-center" style="cursor:pointer;">
                                                            <input type="checkbox" id="discount-checkbox" class="mr-2"
                                                                style="width: 17px;height: 17px;" />
                                                            <h5 class="mb-0">Senior Citizen / PWD Discount</h5>
                                                        </label>

                                                        <small style="padding-top: 10px; color: #000;">
                                                            Discounts are available for qualified customers.<br>
                                                            Submit a valid ID, booklet, and prescription (if needed) to
                                                            avail.<br>
                                                            Discount will be applied after validation. Final amount will be sent
                                                            via email or SMS.
                                                        </small>
                                                    </div>

                                                    <form id="discountForm" action="{{ route('discount.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" value="{{ $detailedProduct->id }}" name="pname" />
                                                        <input type="hidden" value="{{ $detailedProduct->name }}"
                                                            name="pdetailname" />

                                                        <input type="hidden" value="{{ $detailedProduct->slug }}"
                                                            name="pslug" />
                                                        <input type="file" name="file" id="discount-file-input"
                                                            style="display: none;">

                                                        <div id="discount-upload-section" class="d-none"
                                                            style="background: #d3d3d35e; padding: 20px; border-radius: 10px;">
                                                            <div class="d-flex align-items-center">
                                                                <a id="discount-upload-btn" href="#"
                                                                    class="ps-btn primary-btn mt-0 w-fit text-white"
                                                                    style="padding: 10px 20px;">
                                                                    <i class="fa fa-upload me-2"></i> Upload File
                                                                </a>
                                                                <button id="submit-btnfile" type="button"
                                                                    class="btn btn-border w-fit mt-0 ml-3 btn-addprescription">Submit</button>
                                                            </div>
                                                             <small id="discount-selected-file-name" style="color: #666; padding-top: 10px; display: none;">
                                                                        Selected file: <strong></strong>
                                                                    </small>
                                                            <small id="discount-upload-text"
                                                                style="color: #000; display: none; padding-top: 10px;">
                                                                Please upload a clear photo of your Senior Citizen or PWD ID
                                                                (with visible birthdate), and the last entry page of your
                                                                purchase booklet.
                                                            </small>
                                                        </div>
                                                        <script>
                                                                document.getElementById('discount-file-input').addEventListener('change', function(e) {
                                                                    const fileName = e.target.files[0]?.name;
                                                                    const fileNameDisplay = document.getElementById('discount-selected-file-name');
                                                                    if (fileName) {
                                                                        fileNameDisplay.querySelector('strong').textContent = fileName;
                                                                        fileNameDisplay.style.display = 'block';
                                                                    } else {
                                                                        fileNameDisplay.style.display = 'none';
                                                                    }
                                                                });
                                                            </script>
                                                    </form>

                                                @elseif($discounts->status === 'pending')

                                                    <div class="alert alert-success mt-3"
                                                        style="border-radius: 10px;">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-clock-o text-success me-2"
                                                                style="font-size: 20px;"></i>
                                                            <div style="font-size: 13px; margin-left: 10px;">
                                                                <strong>Your discount card is under review.</strong><br>
                                                                Once it's approved by our team, you’ll get a discount code.
                                                            </div>
                                                        </div>
                                                    </div>

                                                @elseif($discounts->status === 'rejected')

                                                    <div class="alert alert-danger mt-3"
                                                        style="border-radius: 10px; background-color: #ffe5e5;">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-times-circle text-danger me-2"
                                                                style="font-size: 20px;"></i>
                                                            <div style="font-size: 13px; margin-left: 10px;">
                                                                <strong>Your discount card was rejected.</strong><br>
                                                                Please upload a valid prescription to proceed with the purchase.
                                                            </div>
                                                        </div>
                                                    </div>

                                                @elseif($discounts->status === '1')

                                                    <div class="alert alert-success mt-3"
                                                        style="border-radius: 10px; background-color: #e9f9ed;">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-check-circle text-success me-2"
                                                                style="font-size: 20px;"></i>
                                                            <div style="font-size: 13px; margin-left: 10px;">
                                                                <strong>Your discount card is approved.</strong><br>
                                                                Please check your email to get your coupon code.
                                                           
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endif


                                                @if ($detailedProduct->prescription == 1)
                                                    @if (!$prescription || $prescription->status === null)
                                                        {{-- Upload Form --}}
                                                        <form id="prescriptionForm" action="{{ route('prescription.store') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="d-flex flex-column">
                                                                <input type="hidden" value="{{ $detailedProduct->id }}"
                                                                    name="pname" />
                                                                <input type="file" name="file" required id="prescription-file"
                                                                    style="display: none;">
                                                                <div class="d-flex flex-column"
                                                                    style="background: #d3d3d35e; padding: 20px; border-radius: 10px;">

                                                                    <div class="d-flex align-items-center">
                                                                        <a id="upload-btn"
                                                                            style="width: fit-content; padding: 10px 20px;"
                                                                            class="ps-btn primary-btn mt-0 w-fit text-white">
                                                                            <i class="fa fa-upload me-2"></i> Upload Prescription
                                                                        </a>
                                                                        <button id="submit-btn" type="button"
                                                                            class="btn btn-addprescription btn-border w-fit mt-0 ml-3">Submit</button>
                                                                    </div>

                                                                    <small id="selected-file-name" style="color: #666; padding-top: 10px; display: none;">
                                                                        Selected file: <strong></strong>
                                                                    </small>

                                                                    <small style="color: #000; padding-top: 10px;">
                                                                        Please upload a clear photo of your valid prescription
                                                                        before adding the item to your cart or checking out.
                                                                    </small>
                                                                </div>

                                                            </div>
                                                            <script>
                                                                document.getElementById('prescription-file').addEventListener('change', function(e) {
                                                                    const fileName = e.target.files[0]?.name;
                                                                    const fileNameDisplay = document.getElementById('selected-file-name');
                                                                    if (fileName) {
                                                                        fileNameDisplay.querySelector('strong').textContent = fileName;
                                                                        fileNameDisplay.style.display = 'block';
                                                                    } else {
                                                                        fileNameDisplay.style.display = 'none';
                                                                    }
                                                                });
                                                            </script>
                                                        </form>

                                                    @elseif($prescription->status === 'pending' || $prescription->status === '0')
                                                        {{-- Pending Card --}}
                                                        <div class="alert alert-warning mt-3"
                                                            style="border-radius: 10px; background-color: #fff8e1;">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fa fa-clock-o text-warning me-2"
                                                                    style="font-size: 20px;"></i>
                                                                <div style="font-size: 13px; margin-left: 10px;">
                                                                    <strong>Your prescription is under review.</strong><br>
                                                                    Once it's approved by our team, you’ll be able to add this
                                                                    product to your cart.
                                                                </div>
                                                            </div>
                                                        </div>

                                                    @elseif($prescription->status === 'rejected')
                                                        {{-- Rejected Card --}}
                                                        <div class="alert alert-danger mt-3"
                                                            style="border-radius: 10px; background-color: #ffe5e5;">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fa fa-times-circle text-danger me-2"
                                                                    style="font-size: 20px;"></i>
                                                                <div style="font-size: 13px; margin-left: 10px;">
                                                                    <strong>Your prescription was rejected.</strong><br>
                                                                    Please upload a valid prescription to proceed with the purchase.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- Re-upload Form --}}
                                                        <form id="prescriptionForm" action="{{ route('prescription.store') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="d-flex flex-column"
                                                                style="background: #d3d3d35e; padding: 20px; border-radius: 10px; margin-top: 10px;">
                                                                <input type="hidden" value="{{ $detailedProduct->id }}"
                                                                    name="pname" />
                                                                <input type="file" name="file" id="prescription-file"
                                                                    style="display: none;">

                                                                <a id="upload-btn" style="width: fit-content; padding: 10px 20px;"
                                                                    class="ps-btn primary-btn mt-0 w-fit text-white">
                                                                    <i class="fa fa-upload me-2"></i> Upload New Prescription
                                                                </a>

                                                                <small style="color: gray; padding-top: 10px;">
                                                                    Please upload a clear photo of your valid prescription again.
                                                                </small>

                                                                <button id="submit-btn" type="button"
                                                                    class="btn btn-border w-fit mt-2">Submit</button>
                                                            </div>
                                                        </form>

                                                    @elseif($prescription->status === '1')
                                                        {{-- Approved Card --}}
                                                        <div class="alert alert-primary mt-3"
                                                            style="border-radius: 10px;">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fa fa-check-circle me-2"
                                                                    style="font-size: 20px; color:blue;"></i>
                                                                <div style="font-size: 13px; margin-left: 10px;">
                                                                    <strong>Your prescription is approved.</strong><br>
                                                                    You can now add this product to your cart and proceed with your
                                                                    order.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif

                                                <div class="modal fade quotemodal" id="exampleModal" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                                    style="overflow:scroll">
                                                    <div class="modal-dialog" role="document" style="max-width:70%">
                                                        <div class="modal-content" style="background: #172f47;">
                                                            <div class="modal-header border-none" style="border:none">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-5">
                                                                        <img src="https://images.vexels.com/content/145821/preview/rocket-illustration-rocket-illustration-6e1e4f.png"
                                                                            style="
                                                                                    width: 200px;
                                                                                    position: absolute;
                                                                                    bottom: 0;
                                                                                    opacity: 0.5;
                                                                                    left: 38%;
                                                                                    ">
                                                                        <h4 class="text-white">Get a Quote</h4>
                                                                        <p class="text-white mt-2"
                                                                            style="max-width: 300px;opacity: 0.6;">
                                                                            Fill up the form and our Team will get back
                                                                            to you
                                                                            within 24
                                                                            hours.
                                                                        </p>
                                                                        <div style="padding: 30px 0;color: white;">
                                                                            <div class="d-flex align-items-center">
                                                                                <i class="fa fa-phone"></i>
                                                                                <p class="text-white ml-2">(+63)
                                                                                    917-848-8831, (+63) 2-8630-7812</p>
                                                                            </div>
                                                                            <div class="d-flex align-items-center mt-3">
                                                                                <i class="fa fa-envelope"></i>
                                                                                <p class="text-white ml-2">
                                                                                    <a
                                                                                        href="mailto:info@drmedpharmacy.com.ph">info@drmedpharmacy.com.ph</a>
                                                                                </p>
                                                                            </div>
                                                                            <div class="d-flex align-items-center mt-3">
                                                                                <i class="fa fa-map-marker-alt"></i>
                                                                                <p class="text-white ml-2">9127 Ajbel Bldg.,
                                                                                    San Antonio Avenue, San Antonio Valley
                                                                                    1, Paranaque City 1700 Philippines
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <form action="{{ route('enquiry.store') }}"
                                                                            method="POST"
                                                                            style="background: white; padding: 30px; border-radius: 20px; margin-bottom:30px">
                                                                            @csrf
                                                                            <div class="form-row">
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="name">Name</label>
                                                                                    <input type="text" name="name"
                                                                                        class="form-control" id="name"
                                                                                        placeholder="Name" required>
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="email">Email</label>
                                                                                    <input type="email" name="email"
                                                                                        class="form-control" id="email"
                                                                                        placeholder="Email" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="phone_number">Phone
                                                                                    Number</label>
                                                                                <input type="number" name="phone_number"
                                                                                    class="form-control" id="phone_number"
                                                                                    placeholder="Phone Number" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="address">Address</label>
                                                                                <input type="text" name="address"
                                                                                    class="form-control" id="address"
                                                                                    placeholder="Address" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="product_name">Product
                                                                                    Name</label>
                                                                                <input type="text"
                                                                                    value="{{ $detailedProduct->name }}"
                                                                                    name="product_name" class="form-control"
                                                                                    id="product_name"
                                                                                    placeholder="{{ $detailedProduct->name }}"
                                                                                    required>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label for="product_name">Product
                                                                                            Brand</label>
                                                                                        <input type="text"
                                                                                            value="{{ $detailedProduct->brand ? $detailedProduct->brand->name : '' }}"
                                                                                            name="product_brandname"
                                                                                            class="form-control"
                                                                                            placeholder="{{ $detailedProduct->brand ? $detailedProduct->brand->name : '' }}"
                                                                                            required>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label for="product_name">Model
                                                                                            Number</label>
                                                                                        <input type="text"
                                                                                            value="{{ $detailedProduct->mnum ?? 'N/A' }}"
                                                                                            name="product_mnumber"
                                                                                            class="form-control"
                                                                                            placeholder="{{ $detailedProduct->mnum ?? 'N/A' }}"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="product_name">Category</label>
                                                                                        <input type="text"
                                                                                            value="{{ $detailedProduct->category->name }}"
                                                                                            name="product_categoryname"
                                                                                            class="form-control"
                                                                                            placeholder="{{ $detailedProduct->category->name }}"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="message">Any Message</label>
                                                                                <textarea name="message"
                                                                                    class="form-control" id="message"
                                                                                    placeholder="Any enquiry"
                                                                                    rows="3"></textarea>
                                                                            </div>
                                                                            <button type="submit"
                                                                                class="btn btn-soft-primary mr-2 fw-600 getquote">
                                                                                Submit
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $refund_sticker = get_setting('refund_sticker');
                                                @endphp
                                                @if (addon_is_activated('refund_request'))
                                                    <div class="row no-gutters align-items-center mt-3">
                                                        <div class="col-2">
                                                            <div class="opacity-50 mt-2">{{ translate('Refund') }}:</div>
                                                        </div>
                                                        <div class="col-10">
                                                            <a href="{{ route('returnpolicy') }}" target="_blank">
                                                                @if ($refund_sticker != null)
                                                                    <img src="{{ uploaded_asset($refund_sticker) }}" loading="lazy"
                                                                        height="36">
                                                                @else
                                                                    <img src="{{ static_asset('assets/img/refund-sticker.jpg') }}"
                                                                        loading="lazy" height="36">
                                                                @endif</a>
                                                            <a href="{{ route('returnpolicy') }}" class="ml-2"
                                                                target="_blank">{{ translate('View Policy') }}</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4 product-summary-col">
                                            <div class="card p-4 d-flex flex-column product-summary-sticky">
                                                @php
                                                    $qty = 0;
                                                    foreach ($detailedProduct->stocks as $key => $stock) {
                                                        $qty += $stock->qty;
                                                    }
                                                @endphp
                                                <div>
                                                    @if ($qty >= 1)
                                                        {{-- @dd($qty) --}}
                                                        <span id="badge" class="badge" style="
                                                                    background-color: #006400;
                                                                    color: #fff;
                                                                    font-size: 13px;
                                                                    padding: 10px;
                                                                    border-radius: 6px;
                                                                    font-weight: 600;
                                                                    margin: auto;
                                                                    display: flex;
                                                                    align-items: center;
                                                                    justify-content: center;
                                                                    width: fit-content;
                                                                    margin-bottom: 15px;">
                                                            In Stock
                                                        </span>
                                                    @else

                                                        <span id="badge" class="badge " style="
                                                                    color: #fff;
                                                                    font-size: 13px; background: #c10007;
                                                                    padding: 10px;
                                                                    border-radius: 6px;
                                                                    font-weight: 600;
                                                                    margin: auto;
                                                                    display: flex;
                                                                    align-items: center;
                                                                    justify-content: center;
                                                                    width: fit-content;
                                                                    margin-bottom: 15px;
                                                                ">
                                                            Out of Stock
                                                        </span>

                                                    @endif
                                                </div>


                                                @php
                                                    // Get raw numeric price WITHOUT currency formatting
                                                    $basePrice = floatval($detailedProduct->unit_price); // use actual database price field

                                                    // Determine if discount is applicable
                                                    $discount_applicable = false;
                                                    if ($detailedProduct->discount_start_date == null) {
                                                        $discount_applicable = true;
                                                    } elseif (
                                                        strtotime(date('d-m-Y H:i:s')) >= $detailedProduct->discount_start_date &&
                                                        strtotime(date('d-m-Y H:i:s')) <= $detailedProduct->discount_end_date
                                                    ) {
                                                        $discount_applicable = true;
                                                    }

                                                    // VAT percentage
                                                    $vatPercent = floatval($detailedProduct->vat);

                                                    // Get variant prices and calculate lowest price with discount
                                                    $stockPrices = $detailedProduct->stocks->pluck('price')->filter(fn($p) => !is_null($p))->all();

                                                    $lowestVariantPrice = null;
                                                    $lowestOriginalPrice = null;
                                                    $hasVariantDiscount = false;

                                                    if (!empty($stockPrices)) {
                                                        // Get the lowest variant price
                                                        $lowestVariantPrice = min($stockPrices);
                                                        $lowestOriginalPrice = $lowestVariantPrice;

                                                        // Apply discount to lowest variant price if applicable
                                                        if ($discount_applicable && $detailedProduct->discount > 0) {
                                                            if ($detailedProduct->discount_type == 'percent') {
                                                                $lowestVariantPrice = $lowestOriginalPrice - (($lowestOriginalPrice * $detailedProduct->discount) / 100);
                                                            } elseif ($detailedProduct->discount_type == 'amount') {
                                                                $lowestVariantPrice = $lowestOriginalPrice - $detailedProduct->discount;
                                                            }
                                                            $hasVariantDiscount = true;
                                                        }
                                                    }

                                                    // Calculate unit price with discount
                                                    $originalUnitPrice = $basePrice;
                                                    $discountedUnitPrice = $basePrice;
                                                    $hasUnitDiscount = false;

                                                    if ($discount_applicable && $detailedProduct->discount > 0 && $basePrice > 0) {
                                                        if ($detailedProduct->discount_type == 'percent') {
                                                            $discountedUnitPrice = $basePrice - (($basePrice * $detailedProduct->discount) / 100);
                                                        } elseif ($detailedProduct->discount_type == 'amount') {
                                                            $discountedUnitPrice = $basePrice - $detailedProduct->discount;
                                                        }
                                                        $hasUnitDiscount = true;
                                                    }

                                                    // Decide which price to display
                                                    $displayPrice = null;
                                                    $displayOriginalPrice = null;
                                                    $hasDiscount = false;

                                                    if ($lowestVariantPrice !== null) {
                                                        // Variants exist - show lowest variant price
                                                        $displayPrice = $lowestVariantPrice;
                                                        $displayOriginalPrice = $lowestOriginalPrice;
                                                        $hasDiscount = $hasVariantDiscount;
                                                    } elseif ($basePrice > 0) {
                                                        // No variants - show unit price
                                                        $displayPrice = $discountedUnitPrice;
                                                        $displayOriginalPrice = $originalUnitPrice;
                                                        $hasDiscount = $hasUnitDiscount;
                                                    }

                                                @endphp

                                                <div class="ps-product__quantity">
                                                    @php
                                                        $choiceOptions = json_decode($detailedProduct->choice_options, true);
                                                    @endphp

                                                    <div class="mb-3">
                                                        <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
                                                            @if ($displayPrice !== null)
                                                                @if ($hasDiscount)
                                                                    <del class="fw-600 opacity-50 fs-14"
                                                                        style="white-space: nowrap;">{{ single_price($displayOriginalPrice) }}</del>
                                                                @endif
                                                                <h4 id="product-attprice"
                                                                    style="font-size: 18px; white-space: nowrap" class="mb-0">
                                                                    {{ single_price($displayPrice) }}
                                                                </h4>
                                                            @else
                                                                <h4 id="product-attprice"
                                                                    style="font-size: 18px; white-space: nowrap" class="mb-0">
                                                                    N/A
                                                                </h4>
                                                            @endif
                                                        </div>
                                                        <div class="mt-1">
                                                            <span style="font-size: 12px; color: gray;">
                                                                @if ($detailedProduct->vat > 0)
                                                                    (VATable)
                                                                @else
                                                                    (VAT - Exempted)
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <form id="option-choice-form">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $detailedProduct->id }}">

                                                        @if (!empty($addonBadge))
                                                            <input type="hidden" name="addon_discount_enabled" value="1">
                                                            <input type="hidden" name="addon_discount"
                                                                value="{{ $addonBadge['discount_text'] ?? '' }}">
                                                        @endif


                                                        @if ($detailedProduct->choice_options)
                                                            @foreach (json_decode($detailedProduct->choice_options) as $choice)
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col-sm-12">
                                                                        @php
                                                                            $attributeName = \App\Models\Attribute::find($choice->attribute_id)->name ?? '';
                                                                        @endphp

                                                                        <div class="my-2 mb-3"
                                                                            style="font-size: 15px !important;font-weight: 500;color: #c10007;">
                                                                            {{ $attributeName }}
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-12">
                                                                        <div class="aiz-radio-inline d-flex flex-column">
                                                                            @php
                                                                                // If product requires Rx, only allow admin-approved values
                                                                                $requiresRx = $detailedProduct->prescription ?? true;
                                                                                $allowed = $allowedMap[$choice->attribute_id] ?? []; // array of values like ['100mg','200mg']
                                                                                
                                                                                // Get all allowedOptions for this prescription
                                                                                $prescription = null;
                                                                                $allowedOptions = collect();
                                                                                if (auth()->check()) {
                                                                                    $prescription = \App\Models\Prescription::where('user_id', auth()->id())
                                                                                        ->where('product_id', $detailedProduct->id)
                                                                                        ->where('status', '1')
                                                                                        ->latest()
                                                                                        ->with('allowedOptions')
                                                                                        ->first();
                                                                                    if ($prescription) {
                                                                                        $allowedOptions = $prescription->allowedOptions;
                                                                                    }
                                                                                }
                                                                            @endphp

                                                                            @php
                                                                                // Helper to find the stock row for specific attribute and value
                                                                                $stocks = $detailedProduct->stocks ?? collect();
                                                                                $findStockFor = function ($attributeId, $doseValue) use ($stocks) {
                                                                                    $cleanValue = str_replace(' ', '', $doseValue);
                                                                                    $expectedVariantKey = $attributeId . '_' . $cleanValue;

                                                                                    // First try exact match with attribute-specific key
                                                                                    $exactMatch = $stocks->first(function ($st) use ($expectedVariantKey) {
                                                                                        return $st->variant === $expectedVariantKey;
                                                                                    });

                                                                                    if ($exactMatch) {
                                                                                        return $exactMatch;
                                                                                    }

                                                                                    // Fallback: try to find by value alone (for backwards compatibility)
                                                                                    return $stocks->first(function ($st) use ($cleanValue) {
                                                                                        $variant = $st->variant ?? '';
                                                                                        return str_contains(strtolower($variant), strtolower($cleanValue));
                                                                                    });
                                                                                };
                                                                            @endphp

                                                                                @php
                                                                                    $selected_value = null;
                                                                                @endphp
                                                                            @foreach ($choice->values as $value)
                                                                                @php
                                                                                    $clean = str_replace(' ', '', $value);
                                                                                    $isDisabled = $requiresRx && (!in_array($clean, $allowed, true));

                                                                                    // find stock for this attribute and dose
                                                                                    $stock = $findStockFor($choice->attribute_id, $value);   // App\Models\ProductStock|NULL
                                                                                    $qty = $stock->qty ?? 0;
                                                                                    $selectedweight = $stock->wt ?? 0;
                                                                                    $originalPrice = $stock->price ?? null;
                                                                                    $price = $originalPrice;
                                                                                    
                                                                                    // Get allowed quantity for this specific variant from allowedOptions
                                                                                    $allowedQty = 0;
                                                                                    if ($requiresRx && !$isDisabled) {
                                                                                        $allowedOption = $allowedOptions->where('value', $clean)->first();
                                                                                        $allowedQty = $allowedOption ? $allowedOption->quantity : 0;
                                                                                    } else if (!$requiresRx) {
                                                                                        $allowedQty = $qty; // If no prescription required, use stock quantity
                                                                                    }

                                                                                    // Apply discount to variant price if applicable
                                                                                    $variantHasDiscount = false;
                                                                                    if (!is_null($price) && $discount_applicable && $detailedProduct->discount > 0) {
                                                                                        if ($detailedProduct->discount_type == 'percent') {
                                                                                            $price = $originalPrice - (($originalPrice * $detailedProduct->discount) / 100);
                                                                                        } elseif ($detailedProduct->discount_type == 'amount') {
                                                                                            $price = $originalPrice - $detailedProduct->discount;
                                                                                        }
                                                                                        $variantHasDiscount = true;
                                                                                    }

                                                                                    // format prices
                                                                                    $priceText = null;
                                                                                    $originalPriceText = null;
                                                                                    if (!is_null($price)) {
                                                                                        if (function_exists('single_price')) {
                                                                                            $priceText = single_price($price);
                                                                                            $originalPriceText = single_price($originalPrice);
                                                                                        } elseif (function_exists('format_price')) {
                                                                                            $priceText = format_price($price);
                                                                                            $originalPriceText = format_price($originalPrice);
                                                                                        } else {
                                                                                            $priceText = number_format($price, 2);
                                                                                            $originalPriceText = number_format($originalPrice, 2);
                                                                                        }
                                                                                    }

                                                                                    if(!$isDisabled && $qty>0){
                                                                                        $selected_value = $clean;
                                                                                    }
                                                                                @endphp

                                                                                <label
                                                                                    class="aiz-megabox pl-0 mr-0 {{ $isDisabled ? 'opacity-50' : '' }}">
                                                                                    <input type="radio" name="selected_variant"
                                                                                        value="{{ $choice->attribute_id }}_{{ $clean }}"
                                                                                        data-attribute-id="{{ $choice->attribute_id }}"
                                                                                        data-value="{{ $clean }}"
                                                                                        data-weight="{{ $selectedweight ?? '' }}"
                                                                                        data-price="{{ $priceText ?? '' }}"
                                                                                        data-original-price="{{ $originalPriceText ?? '' }}"
                                                                                        data-has-discount="{{ $variantHasDiscount ? '1' : '0' }}"
                                                                                        data-quantity="{{ $qty ?? 0 }}"
                                                                                        data-allowed-qty="{{ $allowedQty }}"
                                                                                        @if ($selected_value && $selected_value == $clean) checked @endif
                                                                                        class="variant-option" {{ $isDisabled ? 'disabled' : '' }}>

                                                                                    <span
                                                                                        class="aiz-megabox-elem rounded d-flex align-items-center justify-content-between py-2 px-3 mb-2">
                                                                                        <div
                                                                                            class="d-flex align-items-center justify-content-between gap-2 w-100">
                                                                                            <div class="flex-shrink-0">
                                                                                                <!--<p class="fs-13 mb-0">Tablet</p>-->
                                                                                                <p class="opacity-80 mb-0">
                                                                                                    {{ $value }}
                                                                                                    @if (!$isDisabled && $allowedQty > 0)
                                                                                                    <span class="d-block">Max Allowed: {{ $allowedQty }}</span>
                                                                                                    @endif
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="d-flex flex-column align-items-end flex-shrink-0"
                                                                                                style="min-width: 0;">
                                                                                                @if ($priceText)
                                                                                                    <div class="d-flex flex-column align-items-end"
                                                                                                        style="line-height: 1.2;">
                                                                                                        @if ($variantHasDiscount)
                                                                                                            <del class="fw-400 opacity-50"
                                                                                                                style="font-size: 11px; white-space: nowrap;">{{ $originalPriceText }}</del>
                                                                                                        @endif
                                                                                                        <span class="fw-600 text-right"
                                                                                                            style="white-space: nowrap; font-size: 14px;">{{ $priceText }}</span>
                                                                                                    </div>
                                                                                                @endif
                                                                                                <small
                                                                                                    class="stock-status text-right {{ $qty > 0 ? 'text-green' : 'text-primary' }}"
                                                                                                    style="white-space: nowrap; margin-top: 2px;">
                                                                                                    {{ $qty > 0 ? 'In stock' : 'Out of stock' }}
                                                                                                </small>
                                                                                            </div>

                                                                                            {{-- Price --}}


                                                                                            {{-- Stock status --}}

                                                                                        </div>
                                                                                    </span>
                                                                                </label>
                                                                            @endforeach

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif



                                                        @if (count(json_decode($detailedProduct->colors)) > 0)
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col-sm-2">
                                                                    <div class="opacity-50 my-2">{{ translate('Color') }}:</div>
                                                                </div>
                                                                <div class="col-sm-10">
                                                                    <div class="aiz-radio-inline">
                                                                        @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                                                            <label class="aiz-megabox pl-0 mr-2"
                                                                                data-toggle="tooltip"
                                                                                data-title="{{ \App\Models\Color::where('code', $color)->first()->name }}">
                                                                                <input type="radio" name="color"
                                                                                    value="{{ \App\Models\Color::where('code', $color)->first()->name }}"
                                                                                    @if ($key == 0) checked @endif>
                                                                                <span
                                                                                    class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                                                    <span class="size-30px d-inline-block rounded"
                                                                                        style="background: {{ $color }};"></span>
                                                                                </span>
                                                                            </label>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        @endif
                                                        @if ($detailedProduct->unit_price != null)
                                                            <!-- Quantity + Add to cart -->
                                                            <div class="d-none row no-gutters align-items-center m-0">
                                                                <div class="col-sm-2">
                                                                    <div class="opacity-50 my-2">{{ translate('Quantity') }}:
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-10">
                                                                    <div class="product-quantity d-flex align-items-center">
                                                                        <div class="row no-gutters align-items-center align-items-center aiz-plus-minus mr-3"
                                                                            style="width: 130px;">
                                                                            <button
                                                                                class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                                                style="background: #d3d3d394;
                                                                                            padding: 15px;
                                                                                            text-align: center;
                                                                                            display: flex;
                                                                                            align-items: center;
                                                                                            justify-content: center;
                                                                                            border-radius: 50%;" type="button"
                                                                                data-type="minus" data-field="quantity"
                                                                               >
                                                                                <i class="las la-minus"></i>
                                                                            </button>
                                                                            <input type="number" name="quantity"
                                                                                class="col border-0 text-center flex-grow-1 fs-16 input-number text-dark"
                                                                                placeholder="1"
                                                                                value="{{ $detailedProduct->min_qty }}"
                                                                                min="{{ $detailedProduct->min_qty }}" max="100">
                                                                            <button style="background: #d3d3d394;
                                                                                            padding: 15px;
                                                                                            text-align: center;
                                                                                            display: flex;
                                                                                            align-items: center;
                                                                                            justify-content: center;
                                                                                            border-radius: 50%;"
                                                                                class="btn  col-auto btn-icon btn-sm btn-circle btn-light"
                                                                                type="button" data-type="plus"
                                                                                data-field="quantity">
                                                                                <i class="las la-plus"></i>
                                                                            </button>
                                                                        </div>
                                                                        @php
                                                                            $qty = 0;
                                                                            foreach ($detailedProduct->stocks as $key => $stock) {
                                                                                $qty += $stock->qty;
                                                                            }
                                                                        @endphp
                                                                        <div class="avialable-amount opacity-60">
                                                                            @if ($qty >= 1)
                                                                                (<span>{{ translate('In Stock') }}</span>)
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($detailedProduct->unit_price != null)
                                                            <div class="row no-gutters align-items-center pb-3 d-none m-0"
                                                                id="chosen_price_div">
                                                                <div class="col-sm-2">
                                                                    <div class="opacity-50 my-2">{{ translate('Total Price') }}:
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-10">
                                                                    <div class="product-price mb-0">
                                                                        <strong id="chosen_price" class="h2 fw-600">
                                                                        </strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <input type="hidden" name="prodweight" id="prodweight"
                                                            value="{{ $detailedProduct->weight }}"
                                                            data-base-weight="{{ $detailedProduct->weight }}">

                                                        <input type="hidden" name="prodtax" id="prodtax"
                                                            value="{{ $detailedProduct->vat }}" />

                                                        <input type="hidden" value="{{ $max_total_qty }}" name="newqty" />



                                                        <div id="maindesdiv" class="product-short-desc d-none"
                                                            style="width: 100%;">
                                                            <p style="font-size: 12px;line-height: 1.5;color: #000;">
                                                                {!! $detailedProduct->description !!}</p>
                                                        </div>
                                                        <div class="product-short-desc d-none" id="chosen_des_div">
                                                            <li class="nav-item" style="
                                                                    list-style: none;
                                                                    text-align: left;
                                                                    border-bottom: 1px solid #172f47;
                                                                    width: fit-content;
                                                                    height: fit-content;
                                                                    margin-bottom: 10px;
                                                                    ">
                                                                <a class="nav-link " style="
                                                                        text-align: left;
                                                                        padding: 0;
                                                                        margin-bottom: 10px;
                                                                        /* text-decoration: underline; */
                                                                        /* padding-bottom: 10px; */
                                                                        ">
                                                                    Description
                                                                </a>
                                                            </li>
                                                            <p id="chosen_des"
                                                                style="font-size: 12px;line-height: 1.5;color: #000;"> </p>
                                                        </div>

                                                    </form>
                                                    
                                                    @php
                                                        // For products without choice_options (simple products)
                                                        $simpleProductAllowedQty = 0;
                                                        if (!$detailedProduct->choice_options || json_decode($detailedProduct->choice_options) == null) {
                                                            if ($detailedProduct->prescription == 1 && auth()->check()) {
                                                                $prescription = \App\Models\Prescription::where('user_id', auth()->id())
                                                                    ->where('product_id', $detailedProduct->id)
                                                                    ->where('status', '1')
                                                                    ->latest()
                                                                    ->with('allowedOptions')
                                                                    ->first();
                                                                if ($prescription && $prescription->allowedOptions->isNotEmpty()) {
                                                                    $allowedOption = $prescription->allowedOptions->first();
                                                                    $simpleProductAllowedQty = $allowedOption->quantity ?? 0;
                                                                }
                                                            } else {
                                                                // No prescription required, use stock quantity
                                                                $simpleProductAllowedQty = $detailedProduct->stocks->sum('qty');
                                                            }
                                                        }
                                                    @endphp
                                                    
                                                    {{-- Hidden variant option for simple products --}}
                                                    @if (!$detailedProduct->choice_options || json_decode($detailedProduct->choice_options) == null)
                                                        <input type="radio" name="selected_variant" value="0_default" 
                                                            class="variant-option d-none" 
                                                            data-attribute="0" 
                                                            data-clean="default"
                                                            data-allowed-qty="{{ $simpleProductAllowedQty }}"
                                                            checked>
                                                    @endif
                                                    
                                                    <div class="">
                                                        @if ($simpleProductAllowedQty > 0 && $detailedProduct->prescription == 1)
                                                            <div class="text-center mb-2" style="font-size: 14px; color: #c10007; font-weight: 600;">
                                                                Max Allowed: {{ $simpleProductAllowedQty }}
                                                            </div>
                                                        @endif
                                                        <div class="text-center  mb-3"
                                                            style="margin-top: -10px !important;font-size:13px!important; font-weight:500;">
                                                            Quantity</div>
                                                        <div style="width: 100%;
                                                                        margin: auto;
                                                                        max-width: 100%;"
                                                            class=" my-4 def-number-input number-input safari_only bg-white border-none mr-0">
                                                            <div
                                                                class="product-quantity mx-auto d-flex align-items-center justify-content-center">
                                                                <div class="row no-gutters align-items-center align-items-center aiz-plus-minus"
                                                                    style="flex-wrap: nowrap;">
                                                                    <button
                                                                        class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                                        type="button" data-type="minus"
                                                                        data-field="quantity">
                                                                        <i class="las la-minus"></i>
                                                                    </button>
                                                                    <input id="qty" style="margin: 0 20px;" type="number"
                                                                        name="quantity"
                                                                        class="col border-0 text-center flex-grow-1 fs-16 input-number text-dark"
                                                                        placeholder="1"
                                                                        value="{{ $detailedProduct->min_qty }}"
                                                                        min="{{ $detailedProduct->min_qty }}"
                                                                        max="{{ $simpleProductAllowedQty > 0 && $detailedProduct->prescription == 1 ? $simpleProductAllowedQty : $max_total_qty }}">

                                                                    <button
                                                                        class="btn  col-auto btn-icon btn-sm btn-circle btn-light"
                                                                        type="button" data-type="plus"
                                                                        data-field="quantity">
                                                                        <i class="las la-plus"></i>
                                                                    </button>
                                                                </div>

                                                            </div>
                                                        </div>


                                                        @php
                                                            $qty = 0;
                                                            foreach ($detailedProduct->stocks as $key => $stock) {
                                                                $qty += $stock->qty;
                                                            }
                                                        @endphp

                                                        <a id="add-to-cart"
                                                            class="ps-btn primary-btn d-flex align-items-center justify-content-center w-100
                                                                    {{ ($detailedProduct->prescription == 1 && (!isset($prescription) || $prescription->status !== '1')) || $qty == 0 ? 'disabled' : '' }}"
                                                            href="#"
                                                            onclick="addToCart(document.getElementById('qty').value)">
                                                            <span id="add-to-cart-loader" style="margin-right: 10px;"
                                                                class="spinner-border spinner-border-sm d-none"
                                                                role="status" aria-hidden="true"></span>
                                                            Add to cart
                                                        </a>

                                                        @if ($detailedProduct->prescription == 1 && (!isset($prescription) || $prescription->status !== '1'))
                                                            <small class="text-danger d-block mt-2">
                                                                Prescription approval is required to add this product to cart.
                                                            </small>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card p-4 mt-3">
                                                <ul class="list-unstyled mb-0 platform-features">
                                                    <li class="d-flex align-items-start mb-3">
                                                        <i class="fa fa-check-circle fa-lg mr-3 thin-icon"
                                                            style="margin-top: 4px; color: #262626;"></i>
                                                        <div>
                                                            <h5 class="mb-1">Guaranteed Original</h5>
                                                            <small>Products sourced from trusted suppliers.</small>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex align-items-start mb-3">
                                                        <i class="fa fa-star fa-lg mr-3 thin-icon"
                                                            style="margin-top: 4px; color: #262626;"></i>
                                                        <div>
                                                            <h5 class="mb-1">Highly Rated</h5>
                                                            <small>Trusted by thousands of satisfied customers.</small>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex align-items-start mb-3">
                                                        <i class="fas fa-medal fa-lg mr-3 thin-icon"
                                                            style="margin-top: 4px; color: #262626;"></i>
                                                        <div>
                                                            <h5 class="mb-1">Proven Quality</h5>
                                                            <small>Committed to quality care for you and your
                                                                family.</small>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex align-items-start mb-3">
                                                        <i class="fas fa-certificate fa-lg mr-3 thin-icon"
                                                            style="margin-top: 4px; color: #262626;"></i>
                                                        <div>
                                                            <h5 class="mb-1">FDA Registered</h5>
                                                            <small>Compliant with Philippine FDA standards for your
                                                                safety.</small>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex align-items-start mb-3">
                                                        <i class="fa fa-truck fa-lg mr-3 thin-icon"
                                                            style="margin-top: 4px; color: #262626;"></i>
                                                        <div>
                                                            <h5 class="mb-1">Fast &amp; Secure Shipping</h5>
                                                            <small>Safely packed and quickly delivered nationwide.</small>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex align-items-start">
                                                        <i class="fas fa-wallet fa-lg mr-3 thin-icon"
                                                            style="margin-top: 4px; color: #262626;"></i>
                                                        <div>
                                                            <h5 class="mb-1">Easy Payment Options</h5>
                                                            <small>Pay via Cash on Delivery and other secure
                                                                methods.</small>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container my-1 card p-0">

                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs" id="exampleTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                            aria-controls="home" aria-selected="true">Product overview</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content border-left border-right border-bottom p-3" id="exampleTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        {!! $detailedProduct->description !!}
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <h5>Product Dimensions</h5>
                                        <table class="table table-bordered table-striped mt-3 fs-14">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Length</th>
                                                    <td>{{ number_format($detailedProduct->length, 0) }} cm</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Width</th>
                                                    <td>{{ number_format($detailedProduct->width, 0) }} cm</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Height</th>
                                                    <td>{{ number_format($detailedProduct->height, 0) }} cm</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Weight</th>
                                                    <td>{{ number_format($detailedProduct->weight, 0) }} kg</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($detailedProduct->pad != null)
                        <img src="{{ uploaded_asset($detailedProduct->pad) }}" class="w-100 d-lg-none"
                            style="    margin-top: 40px;" alt="Thumbnail">
                    @else
                        <!--                        <img class="d-lg-none" style="    margin-top: 40px;" src="https://cdn.intellemo.ai/int-stock/62c568e6559398348699ca99/62c568e7559398348699ca9a-v377/herbal_beauty_products_for_skin_caread_l.jpg"/>-->
                    @endif

                    <div class="my-5 container card p-5">
                        <div class="col-lg-12 mt-0 p-0">
                            <h3 class="mb-4">Customer Reviews</h3>
                            <div class="pt-4 px-0">
                                <ul class="list-group list-group-flush">
                                    @foreach ($detailedProduct->reviews as $key => $review)
                                        @if ($review->user != null)
                                            <li class="media list-group-item d-flex p-0">
                                                <span class="avatar avatar-md mr-3">
                                                    @if ($review->user->avatar_original)
                                                        <img class="lazyload rounded-circle"
                                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            data-src="{{ uploaded_asset($review->user->avatar_original) }}"
                                                            alt="{{ $review->user->name }}" width="40" height="40">
                                                    @else
                                                        @php
                                                            $initials = strtoupper(substr($review->user->name, 0, 1));
                                                        @endphp
                                                        <div style="
                                                                            width: 40px;
                                                                            height: 40px;
                                                                            background: #ccc;
                                                                            color: #fff;
                                                                            border-radius: 50%;
                                                                            display: flex;
                                                                            align-items: center;
                                                                            justify-content: center;
                                                                            font-weight: bold;
                                                                            font-size: 16px;
                                                                        ">
                                                            {{ $initials }}
                                                        </div>
                                                    @endif

                                                </span>
                                                <div class="media-body text-left">
                                                    <div class="d-flex justify-content-between">
                                                        <h3 class="fs-15 fw-600 mb-0">{{ $review->user->name }}</h3>
                                                        <span class="rating rating-lg">
                                                            @for ($i = 0; $i < $review->rating; $i++)
                                                                <i class="las la-star fs-14 active"></i>
                                                            @endfor
                                                            @for ($i = 0; $i < 5 - $review->rating; $i++)
                                                                <i class="las la-star fs-14"></i>
                                                            @endfor
                                                        </span>
                                                    </div>
                                                    <div class="opacity-60 mb-2">{{ date('m-d-Y', strtotime($review->created_at)) }}
                                                    </div>
                                                    <p class="comment-text">
                                                        {{ $review->comment }}
                                                    </p>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>

                                @if (count($detailedProduct->reviews) <= 0)
                                    <div class="text-center fs-14 text-dark mb-5 d-flex flex-column align-items-center">
                                        <div>
                                            <i class="fa fa-star" style="    color: orange;"></i>
                                            <i class="fa fa-star" style="    color: orange;"></i>
                                            <i class="fa fa-star" style="    color: orange;"></i>
                                            <i class="fa fa-star" style="    color: orange;"></i>
                                            <i class="fa fa-star" style="    color: orange;"></i>

                                        </div>
                                        {{ translate('There have been no reviews for this product yet.') }}
                                    </div>
                                @endif

                                @if (Auth::check())
                                    @php
                                        $commentable = false;
                                    @endphp
                                    @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                        @if (
                                            $orderDetail->order != null &&
                                                $orderDetail->order->user_id == Auth::user()->id &&
                                                $orderDetail->delivery_status == 'delivered' &&
                                                \App\Models\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                            @php
                                                $commentable = true;
                                            @endphp
                                        @endif
                                    @endforeach
                                @endif
                                @if (Auth::user())
                                    <div class="mainhereputreview">
                                        <div class=" mb-2 mainwrite">
                                            <h3 class="fs-17 fw-600 mb-4">
                                                {{ translate('Write a review') }}
                                            </h3>
                                        </div>
                                        <form class="form-default mainform" role="form" action="{{ route('reviews.store') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="c-gray-light">{{ translate('Your Name') }}</label>
                                                        <input type="text" name="name" value="{{ Auth::user()->name }}"
                                                            class="form-control" disabled required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""
                                                            class="c-gray-light">{{ translate('Email Address') }}</label>
                                                        <input type="text" name="email" value="{{ Auth::user()->email }}"
                                                            class="form-control" required disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="opacity-60">{{ translate('Rating') }}</label>
                                                <div class="rating rating-input">
                                                    <label>
                                                        <input type="radio" name="rating" value="1" required>
                                                        <i class="las la-star fs-14"></i>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="rating" value="2">
                                                        <i class="las la-star fs-14"></i>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="rating" value="3">
                                                        <i class="las la-star fs-14"></i>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="rating" value="4">
                                                        <i class="las la-star fs-14"></i>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="rating" value="5">
                                                        <i class="las la-star fs-14"></i>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="opacity-60">{{ translate('Comment') }}</label>
                                                <textarea class="form-control" rows="4" name="comment"
                                                    placeholder="{{ translate('Your review') }}" required></textarea>
                                            </div>

                                            <div class="text-right">
                                                <button type="submit" class="btn primary-btn mt-3">
                                                    {{ translate('Submit review') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <div class="loginpadds" style="
                                                background: linear-gradient(#7d010124 0%, #7d010117 70%);
                                                padding-bottom: 70px;
                                                padding: 20px;
                                                border-radius: 10px;">
                                        <a href="{{ route('user.login') }}" class="loginCart fs-14">
                                            Please <span>login</span> to give a review about this product.
                                        </a>
                                    </div>
                                @endif
                            </div>

                        </div>

                    </div>


                </div>
            </div>

            <section class="ps-section--featured bg-lightgray" style="padding: 30px 3vw 50px 3vw !important;">
                <div class="d-flex align-items-center justify-content-between container">
                    <h3 class="ps-section__title text-left mb-0">You Might Like This</h3>
                </div>
                <div class="ps-section__content container pt-5">
                    <div id="fproduct-splide" class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($fproducts as $product)
                                    <li class="splide__slide">
                                        <div class="ps-section__product">
                                            <div class="ps-product ps-product-suggestion ps-product--standard will-animate h-100"
                                                data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-left' }}"
                                                data-aos-delay="{{ 80 + $loop->index * 60 }}">
                                                <div style="position: absolute; top: 15px; left: 15px">
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

                                                    @php
                                                        $qty = 0;
                                                        foreach ($product->stocks as $key => $stock) {
                                                            $qty += $stock->qty;
                                                        }
                                                    @endphp
                                                    <div>
                                                        @if ($qty >= 1)

                                                        @else
                                                            <span class="badge " style="
                                                                        color: #fff;
                                                                        font-size: 13px; background: #c10007;
                                                                        padding: 10px;
                                                                        border-radius: 6px;
                                                                        font-weight: 600;
                                                                        margin: auto;
                                                                        display: flex;
                                                                        align-items: center;
                                                                        justify-content: center;
                                                                        width: fit-content;
                                                                        margin-bottom: 15px;
                                                                        border-radius: 999px;
                                                                        font-size: 12px;
                                                                        line-height: 1;
                                                                        padding: 5px;">
                                                                Out of Stock
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="ps-product__thumbnail">
                                                    <a class="ps-product__image" href="{{ route('product', $product->slug) }}">
                                                        <figure>
                                                            <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                                alt="{{ $product->name }}" />
                                                        </figure>
                                                    </a>
                                                    @php
                                                        $choiceOptions = json_decode($product->choice_options, true);

                                                    @endphp
                                                    <div class="ps-product__actions">
                                                        <div class="ps-product__item" data-toggle="tooltip">
                                                            @if ($product->prescription == 1 || !empty($choiceOptions))
                                                                <a href="{{ route('product', $product->slug) }}">View Details</a>
                                                            @else
                                                                <a href="#"
                                                                    onclick="addToCartHome(event, {{ $product->id }}, this)">Add To
                                                                    Cart</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="ps-product__content text-left">
                                                    <h5 class="ps-product__title">
                                                        <a
                                                            href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                                    </h5>
                                                    <!--<div class="ps-product__meta"><span class="ps-product__price">{{ home_discounted_price($product) }}</span></div>-->
                                                    <h5 class="fs-13 mt-3" style="width: 100%;
                                                            overflow: hidden;
                                                            display: -webkit-box;
                                                            -webkit-line-clamp: 2;
                                                            -webkit-box-orient: vertical; color: gray; font-weight:400;"
                                                        class="ps-product__title">Category:
                                                        <a style="color: #c10007; line-height:1.8rem;"
                                                            href="{{ route('product', $product->slug) }}">{{ $product->category->name }}</a>
                                                    </h5>

                                                    <div class="fs-15 text-left product__item__price d-flex flex-column">
                                                        @php
                                                            $unitPrice = $product->unit_price;
                                                            $discount = $product->discount;
                                                            $discountedPrice = $discount > 0 ? $unitPrice - ($unitPrice * $discount / 100) : $unitPrice;
                                                            $choiceOptions = json_decode($product->choice_options, true);
                                                            $stockPrices = $product->stocks->pluck('price')->filter(fn($p) => !is_null($p))->all();
                                                            // Get the lowest price (or null if no prices)
                                                            $lowestPrice = !empty($stockPrices) ? min($stockPrices) : '';
                                                        @endphp

                                                        @if (empty($choiceOptions))
                                                            @if ($discount > 0)
                                                                <del class="fw-600 opacity-50 mr-1">{{ single_price($unitPrice) }}</del>
                                                                <div class="d-flex align-items-center justify-content-start">
                                                                    <span class="fw-700 ps-product__price mr-1 mb-0"
                                                                        style="white-space: nowrap;">{{ single_price($discountedPrice) }}</span>
                                                                    @if (($product->discount ?? 0) > 0)
                                                                        @php
                                                                            // Build the label based on discount type
                                                                            $discountLabel = ($product->discount_type ?? 'amount') === 'percent'
                                                                                ? '' . (int) $product->discount . '%'
                                                                                : '' . single_price($product->discount);
                                                                        @endphp
                                                                        <div style="font-weight: 500;color: #c10007;">({{ $discountLabel }}
                                                                            OFF)</div>
                                                                    @endif
                                                                    <!--        <span style="font-size: 12px; color: gray; white-space: nowrap;">-->
                                                                    <!--   @if ($product->vat > 0)-->
                                                                    <!--        (VATable)-->
                                                                    <!--    @else-->
                                                                    <!--       (VAT - Exempted)-->
                                                                    <!--    @endif-->
                                                                    <!--</span>-->
                                                                </div>
                                                            @else
                                                                <div class="d-flex align-items-center justify-content-start">

                                                                    <span class="fw-700 ps-product__price mr-1"
                                                                        style="white-space: nowrap;">{{ single_price($unitPrice) }}</span>
                                                                    <!--      <span style="font-size: 12px; color: gray; white-space: nowrap;">-->
                                                                    <!--    @if ($product->vat > 0)-->
                                                                    <!--        (VATable)-->
                                                                    <!--    @else-->
                                                                    <!--       (VAT - Exempted)-->
                                                                    <!--    @endif-->
                                                                    <!--</span>-->
                                                                </div>
                                                            @endif

                                                        @else
                                                            <span class="fw-700 ps-product__price mr-1"
                                                                style="white-space: nowrap;">{{ single_price($lowestPrice) }}</span>
                                                        @endif

                                                    </div>
                                                    <div class="ps-product__rating">
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star"></i>
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
                <div class="ps-shop__more"><a href="#">Show all</a></div>

            </section>
            <!-- End of Page Content -->
    </main>
@endsection
@section('modal')
    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title fw-600 h5">{{ translate('Any query about this product') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}"
                                placeholder="{{ translate('Product Name') }}" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required
                                placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary fw-600"
                            data-dismiss="modal">{{ translate('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary fw-600">{{ translate('Send') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">{{ translate('Login') }}</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                @if (addon_is_activated('otp_system'))
                                    <input type="text"
                                        class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone') }}" name="email"
                                        id="email">
                                @else
                                    <input type="email"
                                        class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        value="{{ old('email') }}" placeholder="{{ translate('Email') }}" name="email">
                                @endif
                                @if (addon_is_activated('otp_system'))
                                    <span class="opacity-60">{{ translate('Use country code before number') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control h-auto form-control-lg"
                                    placeholder="{{ translate('Password') }}">
                            </div>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class=opacity-60 fs-14>{{ translate('Remember Me') }}</span>
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('password.request') }}"
                                        class="text-reset opacity-60 fs-14">{{ translate('Forgot password?') }}</a>
                                </div>
                            </div>
                            <div class="mb-5">
                                <button type="submit"
                                    class="btn primary-btn btn-primary btn-block fw-600">{{ translate('Login') }}</button>
                            </div>
                        </form>
                        <div class="text-center mb-3">
                            <p class="text-muted mb-0">Dont have an account?</p>
                            <a class="text-red" href="{{ route('user.registration') }}">{{ translate('Register Now') }}</a>
                        </div>
                        @if (get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1)
                            <div class="separator mb-3">
                                <span class="bg-white px-3 opacity-60">{{ translate('Or Login With') }}</span>
                            </div>
                            <ul class="list-inline social colored text-center mb-5">
                                @if (get_setting('facebook_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                            <i class="lab la-facebook-f"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (get_setting('google_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                            <i class="lab la-google"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (get_setting('twitter_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                            <i class="lab la-twitter"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .disabled-link {
            pointer-events: none;
            /* disables clicking */
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            getVariantPrice();
        });

        function CopyToClipboard(e) {
            var url = $(e).data('url');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            try {
                document.execCommand("copy");
                AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
            } catch (err) {
                AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
            }
            $temp.remove();
            // if (document.selection) {
            //     var range = document.body.createTextRange();
            //     range.moveToElementText(document.getElementById(containerid));
            //     range.select().createTextRange();
            //     document.execCommand("Copy");

            // } else if (window.getSelection) {
            //     var range = document.createRange();
            //     document.getElementById(containerid).style.display = "block";
            //     range.selectNode(document.getElementById(containerid));
            //     window.getSelection().addRange(range);
            //     document.execCommand("Copy");
            //     document.getElementById(containerid).style.display = "none";

            // }
            // AIZ.plugins.notify('success', 'Copied');
        }
        function show_chat_modal() {
            @if (Auth::check())
                $('#chat_modal').modal('show');
            @else
                $('#login_modal').modal('show');
            @endif
            }

        function valueChanged() {
            if ($('#flexCheckChecked').is(":checked"))
                $(".caketext").show();
            else
                $(".caketext").hide();
        }





    </script>
    <script>
        // Destroy existing Swiper instance if it exists
        if (window.swiper) window.swiper.destroy(true, true);
        if (window.swiper2) window.swiper2.destroy(true, true);

        // Reinitialize Swiper for Thumbnails
        window.swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            loop: false, // Disable loop to prevent duplicate slides
            slideToClickedSlide: true, // Ensure the clicked thumbnail shows the corresponding image in the main swiper
            watchSlidesProgress: true, // Track progress for better thumbnail sync
            freeMode: true, // Allows free scrolling of thumbnails
        });

        // Reinitialize Swiper for Main Images
        window.swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

        });
    </script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const variantOptions = document.querySelectorAll('.variant-option'); // Variant selection buttons
            const mainSlides = document.querySelectorAll('.mySwiper2 .swiper-slide'); // Large images
            const thumbContainer = document.querySelector('.mySwiper .swiper-wrapper'); // Thumbnails container

            function updateVariantSwipers(selectedVariant) {
                // Hide all variant swipers and show the selected one
                document.querySelectorAll('.variant-swiper-wrapper').forEach(wrapper => {
                    wrapper.style.display = 'none';
                });
                const selectedVariantWrapper = document.querySelector(`.variant-swiper-wrapper[data-variant="${selectedVariant}"]`);
                if (selectedVariantWrapper) {
                    selectedVariantWrapper.style.display = 'block';
                }

                // Initialize the swiper for the selected variant
                const variantThumbSwiper = new Swiper(`.mySwiper-${selectedVariant}.mt-3`, {
                    spaceBetween: 10,
                    slidesPerView: 4,
                    freeMode: true,
                    watchSlidesProgress: true
                });

                new Swiper(`.mySwiper2-${selectedVariant}`, {
                    spaceBetween: 10,
                    navigation: {
                        nextEl: `.swiper-button-next`,
                        prevEl: `.swiper-button-prev`,
                    },
                    thumbs: {
                        swiper: variantThumbSwiper,
                    },
                });
            }

            function showDefaultImages() {
                // Hide all images
                mainSlides.forEach(slide => slide.style.display = 'none');
                // Show default images
                document.querySelectorAll('.swiper-slide[data-variant="default"]').forEach(slide => {
                    slide.style.display = 'block';
                });
                updateThumbnails(document.querySelectorAll('.swiper-slide[data-variant="default"]'));
            }

            function updateThumbnails(selectedImages) {
                thumbContainer.innerHTML = ""; // Clear old thumbnails
                selectedImages.forEach(image => {
                    let thumb = image.cloneNode(true); // Clone main image
                    let newDiv = document.createElement("div");
                    newDiv.classList.add("swiper-slide");
                    newDiv.appendChild(thumb.querySelector("img").cloneNode(true));
                    thumbContainer.appendChild(newDiv);
                });

                // Reinitialize Swiper for thumbnails
                if (window.thumbSwiper) {
                    window.thumbSwiper.update();
                }
            }

            // Show default images on page load
            showDefaultImages();

            variantOptions.forEach(option => {
                option.addEventListener('change', function () {
                    let selectedVariant = this.getAttribute('data-value').trim();

                    // Hide the default swiper and show the variant swiper
                    showDefaultImages();
                    updateVariantSwipers(selectedVariant);
                });
            });

            // Initialize default thumbnail swiper
            window.thumbSwiper = new Swiper(".mySwiper.default", {
                spaceBetween: 10,
                slidesPerView: 4,

            });

            // Initialize default main swiper
            new Swiper(".mySwiper2.default", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {
                    swiper: window.thumbSwiper,
                },
            });
        });







    </script>

    <script>
        function changeMainImage(imageSrc) {
            document.getElementById('main-image').src = imageSrc;
        }
    </script>
    <script>
        function smallchangeMainImage(imageSrc) {
            document.getElementById('mobile-main-image').src = imageSrc;
        }
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("viewAllImages").addEventListener("click", function () {
                let activeImages = document.querySelectorAll(".mySwiper2 .swiper-slide img"); // Get only currently displayed images
                let lightboxHTML = "";

                activeImages.forEach((img, index) => {
                    let imageUrl = img.getAttribute("src");
                    lightboxHTML += `<a href="${imageUrl}" data-lightbox="product-gallery" data-title="Image ${index + 1}"></a>`;
                });

                // Append images to a hidden div to trigger Lightbox
                let lightboxContainer = document.getElementById("lightbox-container");
                if (!lightboxContainer) {
                    lightboxContainer = document.createElement("div");
                    lightboxContainer.id = "lightbox-container";
                    document.body.appendChild(lightboxContainer);
                }

                lightboxContainer.innerHTML = lightboxHTML;

                // Open Lightbox for the first image
                document.querySelector('#lightbox-container a').click();
            });
        });
    </script>

    <script>
        const serverMaxQty = {{ $max_total_qty }};
    </script>

    <script>
        $(window).on("load", function () {
            getProductDetails();
            // Initialize max quantity based on selected variant
            updateMaxQuantityFromVariant();
        });

        // Update max quantity when variant selection changes
        $(document).on('change', '.variant-option', function() {
            updateMaxQuantityFromVariant();
            //also reset the quantity
             const qtyInput = document.getElementById('qty');
             qtyInput.value=1;
             document.getElementById('qty').value = 1;
                const quantityInput = document.querySelector('input[name="quantity"]');
                quantityInput.value = 1;

        });

        function updateMaxQuantityFromVariant() {
            const selectedVariant = document.querySelector('.variant-option:checked');
            if (selectedVariant) {
                const allowedQty = parseInt(selectedVariant.getAttribute('data-allowed-qty')) || 0;
                const qtyInput = document.getElementById('qty');
                
                if (qtyInput && allowedQty > 0) {
                    // Update max attribute
                    qtyInput.setAttribute('max', allowedQty);
                    
                    // Reset value if current value exceeds max
                    const currentVal = parseInt(qtyInput.value) || 1;
                    const minQty = parseInt(qtyInput.getAttribute('min')) || 1;
                    
                    if (currentVal > allowedQty) {
                        qtyInput.value = Math.min(allowedQty, Math.max(currentVal, minQty));
                    }
                }
            }
        }

        function getProductDetails() {
            $.ajax({
                type: "POST",
                url: '{{ route('products.details') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    product_id: '{{ $detailedProduct->id }}' // Pass product ID
                },
                success: function (data) {
                    if (Array.isArray(data.photos) && data.photos.every(img => img !== null && img !== '')) {
                        let images = data.photos; // Now contains full URLs

                        // Update Main Image
                        let mainImageHtml = `
                            <div class="swiper-wrapper">
                                ${images.map(img => `
                                    <div class="swiper-slide">
                                        <figure class="product-image">
                                            <img src="${img}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        </figure>
                                    </div>
                                `).join('')}
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        `;
                        $('.mySwiper2').html(mainImageHtml);

                        // Update Thumbnail Images
                        let thumbImageHtml = `
                            <div class="swiper-wrapper">
                                ${images.map(img => `
                                    <div class="swiper-slide">
                                        <img src="${img}">
                                    </div>
                                `).join('')}
                            </div>
                        `;
                        $('.mySwiper').html(thumbImageHtml);

                        // Reinitialize Swiper (Important)
                        initializeSwiper();
                    }

                },
                error: function (xhr) {
                    console.error("Error fetching product details:", xhr);
                }
            });
        }

        $('#option-choice-form input').on('change', function () {
            getVariantPrice();
        });

        function getVariantPrice() {
            // Get selected variant
            var selectedVariant = $('input[name="selected_variant"]:checked').val();
            var formData = $('#option-choice-form').serializeArray();

            // Add selected variant data if available
            if (selectedVariant) {
                var parts = selectedVariant.split('_');
                if (parts.length >= 2) {
                    var attributeId = parts[0];
                    var variantValue = parts.slice(1).join('_'); // Handle cases like "51_50mg"
                    formData.push({ name: 'attribute_id_' + attributeId, value: variantValue });
                }
            }

            $.ajax({
                type: "POST",
                url: '{{ route('products.variant_price') }}',
                data: formData,
                success: function (data) {

                    // Update Description
                    if (data.des) {
                        $('#chosen_des').html(data.des);
                        $('#chosen_des_div').removeClass('d-none');
                        $('#maindesdiv, #p1, #p2').addClass('d-none');
                    } else {
                        $('#chosen_des_div').addClass('d-none');
                    }

                    // Update Price & Stock Status
                    $('#chosen_price').html(data.price);
                    $('#available-quantity').html(data.quantity);

                    // Get allowed quantity from selected variant
                    const selectedVariantElement = document.querySelector('.variant-option:checked');
                    const allowedQty = selectedVariantElement ? parseInt(selectedVariantElement.getAttribute('data-allowed-qty')) || 0 : 0;
                    
                    // Use allowedQty if available and product requires prescription, otherwise use server max or data max
                    const isPrescriptionProduct = {{ $detailedProduct->prescription ?? 0 }};
                    let finalMax;
                    
                    if (isPrescriptionProduct && allowedQty > 0) {
                        finalMax = allowedQty;
                    } else {
                        finalMax = data.max_limit;
                    }
                    
                    const minQty = parseInt($('.input-number').prop('min')) || 1;

                    // Reset button states
                    if(data.quantity<=1){
                        $('[data-type="minus"]').prop('disabled', true);
                    }
                    $('[data-type="plus"]').prop('disabled', minQty >= finalMax);

                    $('.input-number').prop('max', finalMax);

                    if (parseInt(data.in_stock) == 0 && data.digital == 0) {
                        $('.buy-now, .add-to-cart').addClass('d-none');
                        $('.out-of-stock').removeClass('d-none');
                    } else {
                        $('.buy-now, .add-to-cart').removeClass('d-none');
                        $('.out-of-stock').addClass('d-none');
                    }

                    if (Array.isArray(data.variantimages) && data.variantimages.every(img => img !== null && img !== '')) {
                        let images = data.variantimages; // Now contains full URLs

                        // Update Main Image
                        let mainImageHtml = `
                            <div class="swiper-wrapper">
                                ${images.map(img => `
                                    <div class="swiper-slide">
                                        <figure class="product-image">
                                            <img src="${img}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        </figure>
                                    </div>
                                `).join('')}
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        `;
                        $('.mySwiper2').html(mainImageHtml);

                        // Update Thumbnail Images
                        let thumbImageHtml = `
                            <div class="swiper-wrapper">
                                ${images.map(img => `
                                    <div class="swiper-slide">
                                        <img src="${img}">
                                    </div>
                                `).join('')}
                            </div>
                        `;
                        $('.mySwiper').html(thumbImageHtml);

                        // Reinitialize Swiper (Important)
                        initializeSwiper();
                    }
                }
            });
        }

        // Function to reinitialize Swiper after updating images
        function initializeSwiper() {
            new Swiper(".mySwiper2", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {
                    swiper: new Swiper(".mySwiper", {
                        spaceBetween: 10,
                        slidesPerView: 4,
                        freeMode: true,
                        watchSlidesProgress: true,
                        loop: false
                    })
                }
            });
        }
    </script>

    <script>
        var swiper = new Swiper('.swiper', {
            loop: true,
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        });
    </script>

    <script>
        document.getElementById('viewAllImages').addEventListener('click', function () {
            // Trigger the first image in the gallery
            const firstImage = document.querySelector('#lightboxGallery a');
            if (firstImage) {
                firstImage.click();
            }
        });
    </script>


    <script>
        function changeMainImage(imageSrc) {
            // Remove old zoom container
            $('.zoomContainer').remove();

            // Replace the image element
            $('#image-zoom-wrapper').html(`
                    <img
                        id="main-image"
                        src="${imageSrc}"
                        data-zoom-image="${imageSrc}"
                        style="object-fit: contain; max-width: 100%; max-height: 400px; display: block;"
                        alt="Main Image"
                    >
                `);

            // Re-initialize zoom
            $('#main-image').elevateZoom({
                zoomType: "window",
                cursor: "crosshair",
                zoomWindowWidth: 400,
                zoomWindowHeight: 400,
                zoomWindowOffset: 20,
                borderSize: 1,
                lensShape: "square",
                lensSize: 150,
                scrollZoom: true,
                easing: true
            });
        }

        $(document).ready(function () {
            $('#main-image').elevateZoom({
                zoomType: "window",
                cursor: "crosshair",
                zoomWindowWidth: 400,
                zoomWindowHeight: 400,
                zoomWindowOffset: 20,
                borderSize: 1,
                lensShape: "square",
                lensSize: 150,
                scrollZoom: true,
                easing: true
            });
        });
    </script>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("continueshopping").addEventListener("click", function () {
                alert('Clicked!');
                document.body.classList.remove("side-menu-open");
            });
        });
    </script>

    <script>
        (function () {
            var hidden = document.getElementById('prodweight');
            if (!hidden) return;
            var base = hidden.dataset.baseWeight || hidden.value;

            function applyWeight(fromEl) {
                var w = parseFloat(fromEl?.dataset?.weight || '');
                hidden.value = (!isNaN(w) && w > 0) ? w : base;
            }

            // On load, if any dose is pre-checked
            var pre = document.querySelector('.variant-option:checked');
            if (pre) applyWeight(pre);

            // On change
            document.addEventListener('change', function (e) {
                if (e.target.matches('.variant-option')) applyWeight(e.target);
            });
        })();
    </script>


    <script>
        function toggleWishlist(el, productId) {
            let icon = el.querySelector("i");
            const isAdding = icon.classList.contains("la-heart-o");

            // toggle UI instantly
            if (isAdding) {
                icon.classList.remove("la-heart-o", "opacity-80", "text_color");
                icon.classList.add("la-heart", "text-red");
            } else {
                icon.classList.remove("la-heart", "text-red");
                icon.classList.add("la-heart-o", "opacity-80", "text_color");
            }

            updateWishlist(productId, isAdding);
        }

        function updateWishlist(productId, isAdding) {
            @if (Auth::check() && (Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'seller'))
                $.post('{{ route('wishlists.toggle') }}', {
                    _token: AIZ.data.csrf,
                    id: productId
                }, function (response) {
                    if (response.status === 'added') {
                        $('#wishlist-count').text(response.count);
                        AIZ.plugins.notify('success', "{{ translate('Item has been added to wishlist') }}");
                    } else if (response.status === 'removed') {
                        $('#wishlist-count').text(response.count);
                        AIZ.plugins.notify('info', "{{ translate('Item has been removed from wishlist') }}");
                    }
                });
            @else
            AIZ.plugins.notify('warning', "{{ translate('Please login first') }}"); @endif
                }
        </script>


        <script>
            // Unified Price Management System
            (function() {
                const priceDisplay = document.getElementById('product-attprice');
                const quantityInput = document.querySelector('input[name="quantity"]');
                const variantOptions = document.querySelectorAll('.variant-option');
                const addToCartButton = document.getElementById('add-to-cart');
                const stockBadge = document.getElementById('badge');

                if (!priceDisplay || !quantityInput) return;

                // Default PHP-calculated values
                let unitPrice = {{ $displayPrice ?? 0 }};
                let hasDiscount = {{ $hasDiscount ? 'true' : 'false' }};
                let originalPrice = {{ $displayOriginalPrice ?? 0 }};

                // Format price consistently
                const formatPrice = (amount) => {
                    try {
                        return new Intl.NumberFormat('en-PH', {
                            style: 'currency',
                            currency: 'PHP',
                            minimumFractionDigits: 2
                        }).format(amount);
                    } catch (_) {
                        return `₱ ${Number(amount).toFixed(2)}`;
                    }
                };

                // Get selected variant data
                function getSelectedVariant() {
                    const checked = document.querySelector('.variant-option:checked');
                    if (!checked) return null;

                    return {
                        discountedPrice: parseFloat((checked.getAttribute('data-price') || '').replace(/[^0-9.]/g, '')) ||
                            0,
                        originalPrice: parseFloat((checked.getAttribute('data-original-price') || '').replace(/[^0-9.]/g,
                            '')) || 0,
                        hasDiscount: (checked.getAttribute('data-has-discount') || '0') === '1',
                        quantity: parseInt(checked.getAttribute('data-quantity') || '0')
                    };
                }

                // Update price display
                function updatePriceDisplay() {
                    const qty = parseInt(quantityInput.value, 10) || 1;
                    const variant = getSelectedVariant();
                    const wrapper = priceDisplay.closest('.d-flex.align-items-center.flex-wrap');

                    let price, originalPriceValue, showDiscount;

                    if (variant && variant.discountedPrice > 0) {
                        price = variant.discountedPrice * qty;
                        originalPriceValue = variant.originalPrice * qty;
                        showDiscount = variant.hasDiscount && variant.originalPrice > 0;
                    } else {
                        price = unitPrice * qty;
                        originalPriceValue = originalPrice * qty;
                        showDiscount = hasDiscount && originalPrice > 0;
                    }

                    // Update main price
                    priceDisplay.textContent = formatPrice(price);

                    // Handle discount display
                    if (wrapper) {
                        let delEl = wrapper.querySelector('del');
                        if (showDiscount) {
                            if (!delEl) {
                                delEl = document.createElement('del');
                                delEl.className = 'fw-600 opacity-50 fs-14';
                                delEl.style.whiteSpace = 'nowrap';
                                wrapper.insertBefore(delEl, priceDisplay);
                            }
                            delEl.style.display = 'inline';
                            delEl.textContent = formatPrice(originalPriceValue);
                        } else if (delEl) {
                            delEl.style.display = 'none';
                        }
                    }
                }

                // Handle variant selection
                function handleVariantChange(option) {



                    quantityInput.value = 1;
                    const selectedQty = parseInt(option.getAttribute('data-quantity') || '0');

                    // Update stock status
                    if (selectedQty > 0) {
                        stockBadge.textContent = 'In Stock';
                        stockBadge.style.backgroundColor = '#006400';
                        addToCartButton.classList.remove('disabled-link');
                    } else {
                        stockBadge.textContent = 'Out Of Stock';
                        stockBadge.style.backgroundColor = '#c10007';
                        addToCartButton.classList.add('disabled-link');
                    }

                    if (selectedHasDiscount && selectedOriginalPrice) {
                        updatePriceDisplay(true, selectedOriginalPrice, selectedPrice);
                    } else {
                        hasDiscount = false;
                        updatePriceDisplay();
                    }
                }

                // Event listeners
                variantOptions.forEach(option => {
                    option.addEventListener('change', () => handleVariantChange(option));
                });

                quantityInput.addEventListener('input', updatePriceDisplay);

                document.querySelectorAll('[data-type="plus"], [data-type="minus"]').forEach(btn => {
                    btn.addEventListener('click', () => setTimeout(updatePriceDisplay, 50));
                });

                // Prevent price reset after cart actions
                if (addToCartButton) {
                    addToCartButton.addEventListener('click', () => {
                        setTimeout(updatePriceDisplay, 100);
                        setTimeout(updatePriceDisplay, 500);
                        setTimeout(updatePriceDisplay, 1000);
                    });
                }

                // Handle AJAX completion (success/failure)
                if (typeof jQuery !== 'undefined') {
                    $(document).ajaxComplete(() => setTimeout(updatePriceDisplay, 100));
                }

                // Handle visibility changes
                document.addEventListener('visibilitychange', () => {
                    if (!document.hidden) setTimeout(updatePriceDisplay, 100);
                });

                // Initialize price display
                document.addEventListener('DOMContentLoaded', updatePriceDisplay);
                updatePriceDisplay();
            })();
        </script>



@endsection
