@extends('frontend.layouts.app')

@section('content')




    <div class="container section-title text-left fw-600 text-dark fs-22 pt-10">

        <img class="mr-1" src="{{ static_asset('assets/img/bag.png') }}" width="30" />

        Your Carts

        <p class="fs-13 pt-3" style="color: gray;
    font-weight: 500;
    text-align: left;
    margin-bottom: 0;">
            {{ count($carts) }} {{ Str::plural('item', count($carts)) }} in your cart</p>
    </div>




    <section class="mb-4 mt-4" id="cart-summary">
        <div class="container">
            @if ($carts && count($carts) > 0)
                <div class="row">
                    <div class="col-xxl-8 col-xl-8 ">
                        <div class=" bg-white p-0 p-lg-0 rounded text-left">
                            <div class="mb-4">
                                <div style="  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; border-radius:10px;   border-top: 1px solid lightgray;     margin: 0;
    padding: 10px;
    padding-top: 15px;"
                                    class="row gutters-5 d-none d-lg-flex border-bottom mb-3 pb-3">
                                    <div class="col-md-4 fw-500 fs-14 text-center ">{{ translate('Product') }}</div>
                                    <div class="col-2 fw-500 fs-14 text-center">{{ translate('Price') }}</div>
                                    <div class="col fw-500 fs-14 d-none">{{ translate('Tax') }}</div>

                                    <div class="col-2 fw-500 fs-14 text-center">{{ translate('Quantity') }}</div>
                                    <div class="col-3 fw-500 text-center fs-14 d-none d-lg-block">{{ translate('Total') }}
                                    </div>
                                    <div class="col-1 fw-500 fs-14 text-center">{{ translate('Remove') }}</div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($carts as $key => $cartItem)
                                        @php
                                            $product = \App\Models\Product::find($cartItem['product_id']);
                                            $product_stock = $product->stocks
                                                ->where('variant', $cartItem['variation'])
                                                ->first();
                                            $total = $total + $cartItem['price'] * $cartItem['quantity'];
                                            $addon = $cartItem['addon_discount_applied'];
                                            $product_name_with_choice = $product->name;
                                            if ($cartItem['variation'] != null) {
                                                $product_name_with_choice =
                                                    $product->name . ' - ' . $cartItem['variation'];
                                            }
                                        @endphp
                                        <li style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; border-radius:10px;      padding: 20px; border-radius:10px "
                                            class="list-group-item px-0 px-lg-3 cart-table mb-2">
                                            <div class="row gutters-5">
                                                <div class="col-lg-4 col-md-8 d-flex ">
                                                    <span class="mr-2 ml-0">
                                                        <img style="object-fit:contain !important"
                                                            src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                            class=" size-120px rounded" alt="{{ $product->name }}">
                                                    </span>
                                                    <div class="d-flex flex-column m-auto">
                                                        <span style="line-height: 1.5;"
                                                            class="cart_productname fs-12 text-dark fw-500">
                                                            {{ $product_name_with_choice }}
                                                        </span>

                                                        @if ($cartItem->addon_discount_applied == 'via add-on')
                                                            <span
                                                                class="badge badge-success w-fit text-white fs-12 p-2 rounded-full mt-2">
                                                                addon product
                                                            </span>
                                                        @endif



                                                    </div>
                                                </div>

                                                <div
                                                    class="col-md-2 m-auto col-sm-3 col-4 order-1 order-lg-0 my-3 my-lg-0 d-none d-lg-block text-center">
                                                    <span
                                                        class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Price') }}</span>
                                                    <span
                                                        style="display: flex
;
    align-items: center;
    justify-content: center;
    height: 100%;"
                                                        class="fs-14 text-dark fw-500">{{ single_price($cartItem['price']) }}</span>
                                                </div>

                                                <div
                                                    class="col-lg-2 m-auto col-md-2 col-sm-2 col-4 order-2 order-lg-0 my-3 my-lg-0 d-none">
                                                    <span
                                                        class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Tax') }}</span>
                                                    <span class="fw-600 fs-14">{{ single_price($cartItem['tax']) }}</span>
                                                </div>

                                                <div class="col-md-2 m-auto col-sm-3 col-6 order-4 order-lg-0 text-center">
                                                    @if ($cartItem['digital'] != 1 && $product->auction_product == 0)
                                                        <div
                                                            class="row no-gutters align-items-center aiz-plus-minus mr-2 ml-0 add-cart-plus">
                                                            <button
                                                                style="    background: #ddd;
    display: flex
;
    align-items: center;
    justify-content: center;
    padding: 0;
    color: #000;
}"
                                                                class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                                type="button" data-type="minus"
                                                                data-field="quantity[{{ $cartItem['id'] }}]">
                                                                <i class="las la-minus "></i>
                                                            </button>
                                                            @php
                                                                // Load product + find the matching stock for this cart row
                                                                $product = \App\Models\Product::find(
                                                                    $cartItem['product_id'],
                                                                );

                                                                $variant = $cartItem['variation'] ?? null;

                                                                // try exact variant first
                                                                $product_stock = $product
                                                                    ? $product->stocks
                                                                        ->where('variant', (string) $variant)
                                                                        ->first()
                                                                    : null;

                                                                // fallbacks if no exact stock row found
                                                                if (!$product_stock && $product) {
                                                                    // if no variation selected, try the only/first stock row
                                                                    $product_stock = $product->stocks->first();
                                                                }

                                                                $minQty = max(1, (int) ($product->min_qty ?? 1));

                                                                // Determine maxQty
                                                                if (isset($cartItem['qty']) && $cartItem['qty'] > 0) {
                                                                    $maxQty = (int) $cartItem['qty'];
                                                                } else {
                                                                    $maxQty = $product_stock
                                                                        ? (int) $product_stock->qty
                                                                        : (int) ($product->current_stock ?? 0);
                                                                }

                                                                // If digital product or stock <= 0, remove max attribute
                                                                $maxAttr =
                                                                    ($product->digital ?? 0) == 1 || $maxQty <= 0
                                                                        ? ''
                                                                        : 'max="' . $maxQty . '"';
                                                            @endphp

                                                            <input type="number" name="quantity[{{ $cartItem['id'] }}]"
                                                                class="col border-0 text-center flex-grow-1 fs-16 input-number text-dark"
                                                                placeholder="1" value="{{ (int) $cartItem['quantity'] }}"
                                                                min="{{ $minQty }}" {!! $maxAttr !!}
                                                                onchange="updateQuantity({{ $cartItem['id'] }}, this)">

                                                            <button
                                                                style="    background: #ddd;
    display: flex
;
    align-items: center;
    justify-content: center;
    padding: 0;
    color: #000;
}"
                                                                class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                                type="button" data-type="plus"
                                                                data-field="quantity[{{ $cartItem['id'] }}]">
                                                                <i class="las la-plus "></i>
                                                            </button>
                                                        </div>
                                                    @elseif($product->auction_product == 1)
                                                        <span class="fw-600 fs-16">1</span>
                                                    @endif
                                                </div>
                                                <div
                                                    class="col-md-3 col-sm-3 col-4 order-3 order-lg-0 my-3 my-lg-0 text-center">
                                                    <span
                                                        class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Total') }}</span>
                                                    <span
                                                        style="display: flex
;
    align-items: center;
    justify-content: center;
    height: 100%;"
                                                        class="fs-14 fw-500 text-red">{{ single_price($cartItem['price'] * $cartItem['quantity']) }}</span>
                                                </div>
                                                <div
                                                    class="col-lg-1 m-auto col-md-2 col-sm-1 col-6 order-5 order-lg-0 text-center cartRemovebtn">
                                                    <a style="    display: flex
;
    align-items: center;
    justify-content: center;
    margin: auto;"
                                                        href="javascript:void(0)"
                                                        onclick="removeFromCartView(event, {{ $cartItem['id'] }})"
                                                        class="btn btn-icon btn-sm btn-soft-primary btn-circle add-cart-delete bg-white border-none">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>


                            <div class="row align-items-center">

                                <div class="col-md-12 text-center text-md-right checkbtn"
                                    style="    margin-left: auto;
    display: flex
;">
                                    @if (Auth::check())
                                        <a href="{{ route('checkout.store_delivery_info') }}"
                                            style="    margin-left: auto;
    width: fit-content;"
                                            class="btn add-to-cart primary-btn rounded-full fw-600">
                                            {{ translate('Continue to Shipping') }}
                                        </a>
                                    @else
                                        <button class="primary-btn fw-600 rounded-full"
                                            onclick="showCheckoutModal()">{{ translate('Continue to Shipping') }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" id="cart_summary"
                        style="    position: sticky;
    top: 0;
    height: 100%;">
                        @include('frontend.partials.cart_summary')
                    </div>

                </div>
            @else
                <div class="row">
                    <div class="col-xl-8 mx-auto">
                        <div class="shadow-sm bg-white p-4 rounded">
                            <div class="text-center p-3">
                                <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-cart-illustration-download-in-svg-png-gif-file-formats--wishlist-bucket-shopping-state-pack-design-development-illustrations-1800917.png"
                                    width="400" height="400" />
                                <h3 class="h4 fw-700">{{ translate('Your Cart is empty') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection

@section('modal')
    <div class="modal fade" id="login-modal">
        <div class="modal-dialog modal-dialog-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-16 fw-600">{{ translate('Login') }}</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}"
                            method="POST">
                            @csrf
                            @if (addon_is_activated('otp_system') && env('DEMO_MODE') != 'On')
                                <div class="form-group phone-form-group mb-1">
                                    <input type="tel" id="phone-code"
                                        class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                        value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">
                                </div>

                                <input type="hidden" name="country_code" value="">

                                <div class="form-group email-form-group mb-1 d-none">
                                    <input type="email"
                                        class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        value="{{ old('email') }}" placeholder="{{ translate('Email') }}"
                                        name="email" id="email" autocomplete="off">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group text-right">
                                    <button class="btn btn-link p-0 opacity-50 text-reset" type="button"
                                        onclick="toggleEmailPhone(this)">{{ translate('Use Email Instead') }}</button>
                                </div>
                            @else
                                <div class="form-group">
                                    <input type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        value="{{ old('email') }}" placeholder="{{ translate('Email') }}"
                                        name="email" id="email" autocomplete="off">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @endif

                            <div class="form-group">
                                <input type="password"
                                    class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
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
                                    <a href="{{ route('password.request') }}"
                                        class="text-reset opacity-60 fs-14">{{ translate('Forgot password?') }}</a>
                                </div>
                            </div>

                            <div class="mb-5">
                                <button type="submit" class="w-100 btn primary-btn">{{ translate('Login') }}</button>
                            </div>
                        </form>

                    </div>
                    <div class="text-center mb-3">
                        <p class="fs-14 mb-2">Don't have an account?</p>
                        <a class="fs-14 text-red"
                            href="{{ route('user.registration') }}">{{ translate('Register Now') }}</a>
                    </div>
                    @if (get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1)
                        <div class="separator mb-3">
                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With') }}</span>
                        </div>
                        <ul class="list-inline social colored text-center mb-3">
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
@endsection

@section('script')
    <script type="text/javascript">
        function removeFromCartView(e, key) {
            e.preventDefault();
            removeFromCart(key);
        }

        function updateQuantity(key, element) {
            $.post('{{ route('cart.updateQuantity') }}', {
                _token: AIZ.data.csrf,
                id: key,
                quantity: element.value
            }, function(data) {
                if (data.status == 1) {
                    // Success - update cart view
                    updateNavCart(data.nav_cart_view, data.cart_count);
                    $('#cart-summary').html(data.cart_view);
                    AIZ.plugins.notify('success', 'Quantity updated successfully');
                } else {
                    // Error - show alert message
                    AIZ.plugins.notify('danger', data.message || 'Failed to update quantity');
                }
            }).fail(function(xhr) {
                // Handle server errors
                var errorMessage = 'Failed to update quantity';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                AIZ.plugins.notify('danger', errorMessage);
                //also update the quantity input to the max allowed quantity if provided
                if (xhr.responseJSON && xhr.responseJSON.quantity) {
                    $(element).val(xhr.responseJSON.quantity);
                }
            });
        }

        function showCheckoutModal() {
            $('#login-modal').modal();
        }

        // Country Code
        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if (country.iso2 == 'bd') {
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "{{ static_asset('assets/js/intlTelutils.js') }}?1590403638580",
            onlyCountries: @php echo json_encode(\App\Models\Country::where('status', 1)->pluck('code')->toArray()) @endphp,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if (selectedCountryData.iso2 == 'bd') {
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;

            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });

        function toggleEmailPhone(el) {
            if (isPhoneShown) {
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                $('input[name=phone]').val(null);
                isPhoneShown = false;
                $(el).html('{{ translate('Use Phone Instead') }}');
            } else {
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                $('input[name=email]').val(null);
                isPhoneShown = true;
                $(el).html('{{ translate('Use Email Instead') }}');
            }
        }
    </script>
@endsection
