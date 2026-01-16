@extends('frontend.layouts.app')

<style>
    .terms a:focus{
        color:initial;
    }

    .bootstrap-select .dropdown-toggle {
    font-size: 13px !important;
}

.free-shipping {
    color: #c10007;
    font-weight: 600;
    font-size: 12px;
}

.show.dropdown-menu {
    z-index: 1;
}


    .card{
            border: 1px solid lightgray !important;
    padding: 10px;
    border-radius: 20px !important;
    }

    i.text-secondary{
        color:gray !important;
    }
      .terms a{
        padding-top:0!important;
        padding-bottom:0 !important;
            text-transform: capitalize;
    color: #c10007;
    }

    .dropdown-header{
             font-size: 13px !important;
    background: #808080a8;
    color: white !important;
    }

    .cityselct .dropdown-menu{
            height: 400px;
    overflow-y: scroll;
    }
    .province-location div button{
        height: 50px;
    }
    .province-location div button .filter-option{
        display: flex;
        align-items: center;
    }
    .cityselct div button{
        height: 50px;
    }
    .cityselct div button .filter-option{
        display: flex;
        align-items: center;
    }
</style>

@section('content')
              <div class="container section-title text-left fw-600 text-dark fs-22 pt-10">
                              <img class="mr-2" src="{{static_asset('assets/img/express-delivery.png')}}" width="30"/>

                  Checkout</div>





<section class="mb-4 mt-4">
    <div class="container text-left">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('payment.checkout') }}" class="form-default" role="form" method="POST" id="checkout-form">
                    @csrf
                    <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] }}">
                                  <div class="card ">
                        <div class="card-header p-3">

                            <h3 class="fs-16 fw-600 mb-0">
Step 1:
                                {{ translate('Delivery Information')}}
                            </h3>
                        </div>

<div class="card-body text-center">
  <!-- Row: Full Name -->
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEmail4">
        <i class="far fa-user text-secondary mr-2"></i> First Name<span class="text-danger">*</span>
      </label>
      <input type="text" name="fname" class="form-control" id="inputEmail4" placeholder="First Name" required value="{{ Auth::user()->name }}"/>
      <span class="text-danger">@error('fname') {{ $message }} @enderror</span>
    </div>
            <div class="form-group col-md-4">
      <label for="inputEmail4">
        <i class="far fa-user text-secondary mr-2"></i> Middle Name
      </label>
      <input type="text" name="mname"class="form-control" id="inputEmail4" placeholder="Middle Name" value="{{ Auth::user()->mname }}"/>


    </div>

        <div class="form-group col-md-4">
      <label for="inputEmail4">
        <i class="far fa-user text-secondary mr-2"></i> Last Name<span class="text-danger">*</span>
      </label>
      <input type="text" name="lname" class="form-control" id="inputEmail4" placeholder="Last Name" required value="{{ Auth::user()->lname }}"/>
         <span class="text-danger">@error('lname') {{ $message }} @enderror</span>
    </div>

  </div>

  @php
    $totalweight = 0;
    foreach ($carts as $cartItem) {
        $totalweight += $cartItem['prodweight']*$cartItem['quantity'];
    }
  @endphp

  <!-- Hidden weight input for shipping calculation -->
  <input type="number" id="weight" name="shipping_weight" min="0" step="0.1" hidden value="{{ $totalweight }}" placeholder="Enter weight in kg">

  <!-- Hidden fields -->
  <input type="hidden" name="shipping_cost" id="shipping_cost_input" value="0">
  <input type="hidden" name="shipping_location" id="shipping_location_input" value="">
  <input type="hidden" name="shipping_weight" id="shipping_weight_input" value="">
  <input type="hidden" name="gtotal" id="gtotal" value="">
  <input type="hidden" id="seniordis" name="seniordis" value="">
  <input type="hidden" id="firstdis" name="firstdis" value="">
    <input type="hidden" id="newsub" name="newsub" value="">
  <input type="hidden" id="newtax" name="newtax" value="">

    <input type="hidden" id="first" name="first" value="">
    <input type="hidden" id="vatable" name="vatable" value="">
  <input type="hidden" id="nonvatable" name="nonvatable" value="">


  <!-- Mobile Number -->
    <div class="form-row">

  <div class="form-group col-md-6">
    <label for="inputAddress">
      <i class="fas fa-mobile-alt text-secondary mr-2"></i> Mobile Number
    </label>
    <input type="text"
           name="sphone"
           class="form-control"
           id="inputAddress"
           placeholder="Phone Number"
           maxlength="11"
           pattern="\d{11}" value="{{ Auth::user()->phone }}"
           oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11);"
           required>
    <span class="text-danger">@error('sphone') {{ $message }} @enderror</span>
  </div>

      <div class="form-group col-md-6">
      <label for="s_email">
        <i class="far fa-envelope text-secondary mr-2"></i> Email Address <span class="text-danger">*</span>
      </label>
      <input type="email" name="s_email" class="form-control" id="s_email" value="{{ Auth::user()->email }}" placeholder="your.email@example.com" required>
      <span class="text-danger">@error('s_email') {{ $message }} @enderror</span>
    </div>

  </div>

  <!-- Row: Email + Country -->
  <div class="form-row">

    <div class="form-group col-md-12">
      <label for="s_country">
        <i class="fas fa-flag text-secondary mr-2"></i> Country
      </label>
      <input type="text" name="s_country" class="form-control" id="s_country" value="Philippines">
      <span class="text-danger">@error('s_country') {{ $message }} @enderror</span>
    </div>
  </div>

  <!-- Row: Province + City/Municipality -->
<div class="form-row">

  <!-- Province / Location -->
  <div class="form-group col-md-6 province-location">
    <label for="location">
      <i class="fas fa-map-marked-alt text-secondary mr-2"></i>
      Province / Location <span class="text-danger">*</span>
    </label>

    <select class="form-control aiz-selectpicker"
            name="shipping_location"
            id="location"
            data-live-search="false"
            required>
      <option value="NCR" {{ old('shipping_location', $user->shipping_location ?? '') === 'NCR' ? 'selected' : '' }}>
        National Capital Region (NCR) / Metro Manila
      </option>
      <option value="omm" {{ old('shipping_location', $user->shipping_location ?? '') === 'omm' ? 'selected' : '' }}>
        Outside Metro Manila
      </option>
    </select>
    <span class="text-danger">@error('s_province') {{ $message }} @enderror</span>
  </div>

  <!-- City -->
  <div class="form-group col-md-6 cityselct">
    <label for="city">
      <i class="fas fa-city text-secondary mr-2"></i>
      City / Municipality <span class="text-danger">*</span>
    </label>

    <!-- make city a select, searchable -->
    <select class="form-control aiz-selectpicker"  placeholder="Search"
            name="city"
            id="city"
            data-live-search="true"
            title="Select city / municipality"
            required></select>

    <span class="text-danger">@error('s_city') {{ $message }} @enderror</span>
  </div>
</div>

  <!-- Row: Barangay + ZIP -->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="s_barangay">
        <i class="fas fa-map-pin text-secondary mr-2"></i> Barangay <span class="text-danger">*</span>
      </label>
      <input type="text" name="barangay" id="barangay" class="form-control" value="{{ Auth::user()->barangay }}" placeholder="Enter your barangay" value="{{ old('barangay', $user->barangay ?? '') }}" required>
      <span class="text-danger">@error('s_barangay') {{ $message }} @enderror</span>
    </div>

    <div class="form-group col-md-6">
      <label for="s_zip">
        <i class="fas fa-mail-bulk text-secondary mr-2"></i> Postal Code / ZIP <span class="text-danger">*</span>
      </label>
      <input type="text" name="s_zip" class="form-control" id="s_zip" value="{{ Auth::user()->s_zip }}" placeholder="e.g., 1101" pattern="\d{4,5}" inputmode="numeric" required>
      <span class="text-danger">@error('s_zip') {{ $message }} @enderror</span>
    </div>
  </div>

  <!-- Street Address -->
  <div class="form-group">
    <label for="s_address">
      <i class="far fa-building text-secondary mr-2"></i> Street Address / House or Building Number <span class="text-danger">*</span>
    </label>
    <input type="text" name="s_address" class="form-control" id="s_address" value="{{ Auth::user()->s_address }}" placeholder="House/Unit/Floor #, Building Name, Street, Subdivision" required>
    <small style="    text-align: left;
    width: 100%;
    display: flex
;
    margin-top: 10px;">Include house number, building name, street name, and subdivision if applicable

</small>
    <span class="text-danger">@error('s_address') {{ $message }} @enderror</span>
  </div>

    <div class="form-group">
    <label for="s_address">
      <i class="far fa-comment text-secondary mr-2"></i> Optional Notes To Rider
    </label>
   <!-- Optional Notes to Rider -->
<div class="mb-4">


  <textarea
    name="rider_notes"
    id="rider_notes"
    class="form-control bg-light rounded-3"
    rows="4"
    placeholder="Landmarks, gate instructions, delivery preferences, special instructions..."
    aria-describedby="rider_notes_help"
  ></textarea>
    <small style="    text-align: left;
    width: 100%;
    display: flex
;
    margin-top: 10px;">Help the delivery rider locate your address with landmarks, gate codes, or special instructions

</small>


</div>

  </div>

</div>

<!-- Add Font Awesome 5.15.4 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</div>
                    <div class="card pay_img">
                        <div class="card-header p-3 flex-column" style="    justify-content: start;
    align-items: flex-start;">
                            <h3 class="fs-16 fw-600 mb-0 d-flex flex-row">
                               Step 2: Payment Option<span class="text-danger">*</span>


                            </h3>
                             <small class="text-gray pt-1">Available payment methods</small>
                        </div>



                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-xxl-12 col-xl-12">
                                    <div class="row gutters-10" style="    display: grid
;
    flex-wrap: nowrap;
    grid-template-columns: 50% 50%;">
                                        @if(get_setting('paypal_payment') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="paypal" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/paypal.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Paypal')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('stripe_payment') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="stripe" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/stripe.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Stripe')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('sslcommerz_payment') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="sslcommerz" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/sslcommerz.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('sslcommerz')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('instamojo_payment') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="instamojo" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/instamojo.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Instamojo')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('razorpay') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="razorpay" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/rozarpay.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Razorpay')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('paystack') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="paystack" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/paystack.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Paystack')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('voguepay') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="voguepay" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/vogue.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('VoguePay')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('payhere') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="payhere" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/payhere.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('payhere')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('ngenius') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="ngenius" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/ngenius.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('ngenius')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('iyzico') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="iyzico" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/iyzico.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Iyzico')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('nagad') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="nagad" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/nagad.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Nagad')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('bkash') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="bkash" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/bkash.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Bkash')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('aamarpay') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="aamarpay" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/aamarpay.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Aamarpay')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('authorizenet') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="authorizenet" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/authorizenet.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Authorize Net')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('payku') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="payku" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/payku.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Payku')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(addon_is_activated('african_pg'))
                                            @if(get_setting('mpesa') == 1)
                                                <div class="col-6 col-md-4">
                                                    <label class="aiz-megabox d-block mb-3">
                                                        <input value="mpesa" class="online_payment" type="radio" name="payment_option">
                                                        <span class="d-block p-3 aiz-megabox-elem">
                                                            <img src="{{ static_asset('assets/img/cards/mpesa.png')}}" class="img-fluid mb-2">
                                                            <span class="d-block text-center">
                                                                <span class="d-block fw-600 fs-15">{{ translate('mpesa')}}</span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            @endif
                                            @if(get_setting('flutterwave') == 1)
                                                <div class="col-6 col-md-4">
                                                    <label class="aiz-megabox d-block mb-3">
                                                        <input value="flutterwave" class="online_payment" type="radio" name="payment_option">
                                                        <span class="d-block p-3 aiz-megabox-elem">
                                                            <img src="{{ static_asset('assets/img/cards/flutterwave.png')}}" class="img-fluid mb-2">
                                                            <span class="d-block text-center">
                                                                <span class="d-block fw-600 fs-15">{{ translate('flutterwave')}}</span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            @endif
                                            @if(get_setting('payfast') == 1)
                                                <div class="col-6 col-md-4">
                                                    <label class="aiz-megabox d-block mb-3">
                                                        <input value="payfast" class="online_payment" type="radio" name="payment_option">
                                                        <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/payfast.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('payfast')}}</span>
                                                        </span>
                                                    </span>
                                                    </label>
                                                </div>
                                            @endif
                                        @endif

    <div class=" nepal">
                                                    <label class="aiz-megabox d-block mb-3">
                                                        <input value="xendit" class="online_payment" type="radio"
                                                               name="payment_option">
                                                        <span class="d-flex align-items-center p-3 aiz-megabox-elem">
                                                            <img width="40" src="https://cdn-icons-png.flaticon.com/128/9966/9966619.png"
                                                                 class="img-fluid">
                                                                <span class="d-block ml-3">
                                                                        <span class="d-block fw-600 fs-15 text-left">Online Payment</span>
                                                                    <div>
                                                                        <p class="mb-0">Credit/Debit Cards and E-Wallets etc.</p>
                                                                    </div>

                                                                </span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>


                                        @if(addon_is_activated('paytm'))
                                            <div class="col-6 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="paytm" class="online_payment" type="radio" name="payment_option">
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/paytm.jpg')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Paytm')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('cash_payment') == 1)
                                            @php
                                                $digital = 0;
                                                $cod_on = 1;
                                                foreach($carts as $cartItem){
                                                    $product = \App\Models\Product::find($cartItem['product_id']);
                                                    if($product['digital'] == 1){
                                                        $digital = 1;
                                                    }
                                                    if($product['cash_on_delivery'] == 0){
                                                        $cod_on = 0;
                                                    }
                                                }
                                            @endphp
                                            @if($digital != 1 && $cod_on == 1)
                                                <div class="col-6col-md-4 " id="codPaymentOption">
                                                    <label class="aiz-megabox d-block mb-3">
                                                        <input value="cash_on_delivery" class="online_payment cod_payment" type="radio" name="payment_option" checked>


                                                          <span class="d-flex align-items-center p-3 aiz-megabox-elem">
                                                            <img width="40" src="https://cdn-icons-png.flaticon.com/128/4458/4458023.png"
                                                                 class="img-fluid">
                                                                <span class="d-block ml-3">
                                                                        <span class="d-block fw-600 fs-15 text-left">Cash on Delivery</span>
                                                                    <div>
                                                                        <p class="mb-0">Pay when you receive.</p>
                                                                    </div>

                                                                </span>
                                                            </span>

                                                    </label>
                                                </div>
                                            @endif
                                        @endif








                                        @if (Auth::check())
                                            @if (addon_is_activated('offline_payment'))
                                                @foreach(\App\Models\ManualPaymentMethod::all() as $method)
                                                    <div class="col-6 col-md-4">
                                                        <label class="aiz-megabox d-block mb-3">
                                                            <input value="{{ $method->heading }}" type="radio" name="payment_option" onchange="toggleManualPaymentData({{ $method->id }})" data-id="{{ $method->id }}" checked>
                                                            <span class="d-block p-3 aiz-megabox-elem">
                                                                <img src="{{ uploaded_asset($method->photo) }}" class="img-fluid mb-2">
                                                                <span class="d-block text-center">
                                                                    <span class="d-block fw-600 fs-15">{{ $method->heading }}</span>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endforeach

                                                @foreach(\App\Models\ManualPaymentMethod::all() as $method)
                                                    <div id="manual_payment_info_{{ $method->id }}" class="d-none">
                                                        @php echo $method->description @endphp
                                                        @if ($method->bank_info != null)
                                                            <ul>
                                                                @foreach (json_decode($method->bank_info) as $key => $info)
                                                                    <li>{{ translate('Bank Name') }} - {{ $info->bank_name }}, {{ translate('Account Name') }} - {{ $info->account_name }}, {{ translate('Account Number') }} - {{ $info->account_number}}, {{ translate('Routing Number') }} - {{ $info->routing_number }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>


                            @if (addon_is_activated('offline_payment'))
                                <div class="bg-white border mb-3 p-3 rounded text-left d-none">
                                    <div id="manual_payment_description">

                                    </div>
                                </div>
                            @endif
                            @if (Auth::check() && get_setting('wallet_system') == 1)
                                <div class="separator mb-3">
                                    <span class="bg-white px-3">
                                        <span class="opacity-60">{{ translate('Or')}}</span>
                                    </span>
                                </div>
                                <div class="text-center py-4">
                                    <div class="h6 mb-3">
                                        <span class="opacity-80">{{ translate('Your wallet balance :')}}</span>
                                        <span class="fw-600">{{ single_price(Auth::user()->balance) }}</span>
                                    </div>
                                    @if(Auth::user()->balance < $total)
                                        <button type="button" class="btn btn-secondary" disabled>
                                            {{ translate('Insufficient balance')}}
                                        </button>
                                    @else
                                        <button  type="button" onclick="use_wallet()" class="btn btn-primary fw-600">
                                            {{ translate('Pay with wallet')}}
                                        </button>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>



                    <div class="pt-3 agree-terms-line terms fs-14">
                        <label class="aiz-checkbox">
                            <input type="checkbox" required id="agree_checkbox">
                            <span class="aiz-square-check"></span>
                            <p class="">{{ translate('I agree to the ')}}</p>
                        </label>

        <a href="/page/privacy-policy" target="_blank" class="">{{ translate('Privacy Policy') }}</a>, <a href="/page/return-refunds-policy" class="" target="_blank">{{ translate('Return & Refunds Policy') }}</a> & <a href="/page/terms-conditions" class="" target="_blank">{{ translate('Terms & Conditions') }}</a><span class="text-danger">*</span>


                    </div>

                        <div class="text-right checkbtn">
        <button type="submit" onclick="submitOrder(this)" style="margin-left: auto; width: 100%;" class="btn primary-btn text-white rounded-full">
            {{ translate('Place Order') }}
        </button>
    </div>


                </form>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0" id="cart_summary" style="    position: sticky;
    top: 0;
    height: 100%;">
                @include('frontend.partials.cart_summary')
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
        <script src="https://unpkg.com/khalti-checkout-web@latest/dist/khalti-checkout.iffe.js"></script>
    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
            var
        closeURL = APP_URL + '/khalti/payment/verification'

        var config = {
            // replace the publicKey with yours
            "publicKey": '{{env('KHALTI_PUBLIC_KEY') ? env('KHALTI_PUBLIC_KEY') : 'live_public_key_a3e5a93aa9f1467f81787b24e42f9a91'}}',
            "productIdentity": 1,
            "productName": "test",
            "productUrl": "http://test.com",
            "paymentPreference": [
                "KHALTI",
            ],
            "eventHandler": {
                onSuccess(payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                    alert('Payment has been done by Khalti');
                    window.location.href = APP_URL + '/khalti/payment/verification';
                },
                onError(error) {
                    console.log(error);
                },
                onClose() {
                    window.location.href = closeURL;
                }
            }
        };
        var checkout = new KhaltiCheckout(config);

        function khaltiPayment() {
            var amount = '{!! $total ? $total*100 : '0' !!}'
            checkout.show({amount: amount});
        }

    </script>
    <script type="text/javascript">



        $(document).ready(function(){
            $(".online_payment").click(function(){
                $('#manual_payment_description').parent().addClass('d-none');
            });
            toggleManualPaymentData($('input[name=payment_option]:checked').data('id'));
        });

        function use_wallet(){
            $('input[name=payment_option]').val('wallet');
            if($('#agree_checkbox').is(":checked")){
                $('#checkout-form').submit();
            }else{
                AIZ.plugins.notify('danger','{{ translate('You need to agree with our policies') }}');
            }
        }
     function submitOrder(el){
    $(el).prop('disabled', true);

    let fname = $('input[name="fname"]').val().trim();
    let lname = $('input[name="lname"]').val().trim();
    let sphone = $('input[name="sphone"]').val().trim();
    let semail = $('input[name="s_email"]').val().trim();
    let slocation = $('select[name="shipping_location"]').val();
    let city = $('select[name="city"]').val().trim();
    let barangay = $('input[name="barangay"]').val().trim();
    let szip = $('input[name="s_zip"]').val().trim();
    let saddress = $('input[name="s_address"]').val().trim();
    let payment = $('input[name="payment_option"]:checked').val();

    // Check for empty fields
    if (!fname || !sphone || !semail || !slocation || !city || !barangay || !szip || !saddress) {
        AIZ.plugins.notify('danger', 'All delivery fields are required.');
        $(el).prop('disabled', false);
        return;
    }

    // Check for 10-digit phone number
    if (sphone.length < 11) {
        AIZ.plugins.notify('danger', 'Phone number must be exactly 11 digits.');
        $(el).prop('disabled', false);
        return;
    }

    // Check agreement checkbox
    if (!$('#agree_checkbox').is(":checked")) {
        AIZ.plugins.notify('danger', '{{ translate('You need to agree with our policies') }}');
        $(el).prop('disabled', false);
        return;
    }

    if(!payment){
        AIZ.plugins.notify('danger', '{{ translate('Please select a payment option') }}');
        $(el).prop('disabled', false);
        return;
    }

    // All validations passed, submit the form
    $('#checkout-form').submit();
}


        function toggleManualPaymentData(id){
            if(typeof id != 'undefined'){
                $('#manual_payment_description').parent().removeClass('d-none');
                $('#manual_payment_description').html($('#manual_payment_info_'+id).html());
            }
        }


$(document).on("click", "#coupon-apply", function () {
  var data = new FormData($('#apply-coupon-form')[0]);

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: "POST",
    url: "{{ route('checkout.apply_coupon_code') }}",
    data: data,
    cache: false,
    contentType: false,
    processData: false,

success: function (res) {
  AIZ.plugins.notify(res.response_message.response, res.response_message.message);

  updateNavCart(res.nav_cart_view, res.cart_count);
  $('body').addClass('disablecoupon');

if (res.html) {
  $("#cart_summary").html(res.html);

  // if shipping is missing, inject it after the Weight row
  if (!document.getElementById('shipping-cost')) {
    $("#grandesttotal .d-flex:has(.la-weight-hanging)")
      .after(`
        <div class="d-flex justify-content-between">
          <span><i class="las la-truck mr-2"></i>Shipping Fee</span>
          <span id="shipping-cost" data-subtotal="0" data-threshold="999">₱ 0.00</span>
        </div>
      `);
  }
}



  // run shipping calculation again after DOM is rebuilt
  updateShipping();
},


    error: function () {
      AIZ.plugins.notify('danger', 'Something went wrong while applying the coupon.');
      if (typeof Swal !== 'undefined') {
        Swal.fire({
          title: 'Error',
          text: 'Something went wrong while applying the coupon.',
          icon: 'error'
        });
      }
    }
  });
});




        $(document).on("click", "#coupon-remove",function() {
            var data = new FormData($('#remove-coupon-form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{route('checkout.remove_coupon_code')}}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data, textStatus, jqXHR) {
                    $("#cart_summary").html(data);
                          updateShipping();

                }
            })
        })


        $(document).ready(function() {
    $(".fonepay_payment").click(function() {
        $(".fonepay_openhide").show();

    });
});
                $(document).ready(function() {
    $(".cod_payment").click(function() {
        $(".fonepay_openhide").hide();

    });
});
               $(document).ready(function() {
    $(".esewa_payment").click(function() {
        $(".fonepay_openhide").hide();

    });
});


                $( "#my_number_field" ).blur(function() {
    this.value = parseFloat(this.value).toFixed(2);
});




    </script>

<script>
    // JavaScript to update cart total based on selected option
    document.addEventListener("DOMContentLoaded", function() {
        const selectLocation = document.getElementById("selectLocation");
        const cityName = document.getElementById("city-name");
        const cartTotalElement = document.querySelector(".cart-total .totalprice");
                const shippingvalue = document.querySelector(".shippingvalue");
                                const totalweight = document.querySelector(".realtotalweight");
                                                                const grandtotal = document.getElementById("grandtotal");



                                                                const finaltotalweight = document.querySelector(".finaltotalweight");

                                const subtotal = document.querySelector(".cart-subtotal .fw-600");



                const locationprice = document.getElementById("locationprice");



        const cityCosts = {};
        // Preload costs for all cities
        @foreach($cities as $city)
            cityCosts[{{$city->id}}] = [{{$city->cost}}, '{{$city->name}}'];
        @endforeach

        let originalTotal = cartTotalElement.innerText;
        let additionalCost = 0;

        selectLocation.addEventListener("change", function() {
            const selectedOption = selectLocation.value;

            // Get the cost for the selected city
            const selectedCityCost = cityCosts[selectedOption][0];
            const selectedCityName = cityCosts[selectedOption][1];
            cityName.value = selectedCityName;

var numericValue = parseFloat(subtotal.textContent.replace(/[^0-9.-]+/g,"")); // 500


            // Subtract the previously added additional cost
            const updatedTotal = numericValue;

            // Update additional cost based on the selected city cost
            additionalCost = selectedCityCost;





            console.log(finaltotalweight.innerText,'finaltotalweight');

            if (finaltotalweight.innerText > 2) {
    weightcost = additionalCost + additionalCost/2 * (finaltotalweight.innerText - 2);
} else {
    weightcost = additionalCost;
}





            // Update cart total
            const newTotal = updatedTotal + weightcost;

            // Update the cart total element with the new total
            cartTotalElement.textContent = newTotal; // Ensure two decimal places

                        shippingvalue.textContent = selectedCityCost; // Ensure two decimal places


            // Update original total for future calculations
            originalTotal = newTotal;

    locationprice.value = selectedCityCost;
        locationweight.value = totalweight.innerText;

                grandtotal.value = newTotal;





        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const selectLocation = document.getElementById('selectLocation');
    const codPaymentOption = document.getElementById('codPaymentOption');
    const esewaPaymentOption = document.getElementById('esewaPaymentOption');
    const fonePaymentOption = document.getElementById('fonePaymentOption');


    selectLocation.addEventListener('change', function() {
        const selectedCity = selectLocation.options[selectLocation.selectedIndex].text;

        if (selectedCity === 'Kathmandu' || selectedCity === 'Bhaktapur' || selectedCity === 'Lalitpur' || selectedCity === 'Kirtipur') {
            codPaymentOption.style.display = 'block';
        } else {
            codPaymentOption.style.display = 'none';
        }

        esewaPaymentOption.style.display = 'block';
        fonePaymentOption.style.display = 'block';
    });


});

</script>

<!-- Your checkout form HTML goes here -->

<!-- Shipping calculation script -->
<script>
  const money = new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' });

  function calculateShippingCost(location, weightKg) {
    let cost = 0;
    if ((location || '').toLowerCase() === 'ncr') {
      cost = 150;
      if (weightKg > 1) {
        const extraKg = Math.ceil(weightKg - 1);
        cost += extraKg * 50;
      }
    } else {
      cost = 200;
      if (weightKg > 1) {
        const extraKg = Math.ceil(weightKg - 1);
        if (extraKg <= 2) {
          cost += extraKg * 100;
        } else {
          cost += 2 * 100;
          const remainingKg = extraKg - 2;
          cost += remainingKg * 50;
        }
      }
    }
    return cost;
  }

function updateShipping() {
    const location = document.getElementById('location').value;
    const weightVal = parseFloat(document.getElementById('weight').value);
    const weight = isNaN(weightVal) ? 0 : Math.max(0, weightVal);

    console.log(weight,'wt');

    let shipping = calculateShippingCost(location, weight);

    // get subtotal for free-shipping check
    const shippingEl = document.getElementById('shipping-cost');
    const subtotal = parseFloat(shippingEl.dataset.subtotal || '0');
    const threshold = parseFloat(shippingEl.dataset.threshold || '999');

    console.log(threshold,'threshold')
    console.log(subtotal,'st')

    // If subtotal < 999, add 100
    if (subtotal > threshold) {
        shipping = 0;
    }

    // update shipping cost display
  // update shipping cost display
if (shipping === 0 && subtotal > threshold) {
    shippingEl.textContent = 'FREE';
    shippingEl.classList.add('free-shipping');
} else {
    shippingEl.textContent = '+ ' + money.format(shipping);
    shippingEl.classList.remove('free-shipping');
}


    const baseEl = document.getElementById('grand-total');
    const baseTotal = parseFloat(baseEl.dataset.baseTotal || '0') || 0;
    const deliveryTotal = parseFloat(baseEl.dataset.deliveryTotal || '0') || 0;
const couponTotal = parseFloat(baseEl.dataset.couponTotal || '0') || 0;

const vatable  = parseFloat(baseEl.dataset.vatable       || '0') || 0;
const nonvatable   = parseFloat(baseEl.dataset.nonvat        || '0') || 0;
const first = parseFloat(baseEl.dataset.first         || '0') || 0;

    const grand = baseTotal + shipping - couponTotal;

    // update total
    baseEl.textContent = money.format(grand);

    // backend hidden inputs
    document.getElementById('shipping_cost_input').value = shipping;
    document.getElementById('shipping_location_input').value = location;
    document.getElementById('shipping_weight_input').value = weight;
    document.getElementById('gtotal').value = grand;

    document.getElementById('vatable').value = vatable;
    document.getElementById('nonvatable').value = nonvatable;
    document.getElementById('first').value = first;
}

  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('location').addEventListener('change', updateShipping);
    document.getElementById('weight').addEventListener('input', updateShipping);
    updateShipping(); // initial
  });
</script>

<script>
$(document).ready(function () {
    var savedCity = @json(Auth::user()->city ?? null); // e.g., "Manila"
    var savedLocation = @json(Auth::user()->shipping_location ?? 'NCR'); // e.g., "NCR"

    const NCR = ["Manila","Quezon City","Caloocan","Las Piñas","Makati","Malabon",
        "Mandaluyong","Marikina","Muntinlupa","Navotas","Parañaque","Pasay",
        "Pasig","San Juan","Taguig","Valenzuela","Pateros"];

    const OUTSIDE = {
        "Ilocos Region (Region I)": ["Laoag","Vigan","Candon","Batac","San Fernando (La Union)","Alaminos","Dagupan","Urdaneta"],
        "Cagayan Valley (Region II)": ["Tuguegarao","Ilagan","Cauayan","Santiago"],
        "Central Luzon (Region III)": ["Angeles","Mabalacat","San Fernando (Pampanga)","Tarlac City","Cabanatuan","Gapan","Palayan",
          "San Jose (Nueva Ecija)","Olongapo","Balanga","Malolos","Meycauayan","San Jose del Monte"],
        "CALABARZON (Region IV-A)": ["Antipolo","Bacoor","Cavite City","Dasmariñas","General Trias","Imus","Tagaytay","Trece Martires",
          "Santa Rosa","Biñan","Cabuyao","Calamba","San Pablo","Tanauan","Lipa","Tayabas","Lucena"],
        "MIMAROPA (Region IV-B)": ["Puerto Princesa","Calapan"],
        "Bicol Region (Region V)": ["Naga","Iriga","Legazpi","Ligao","Tabaco","Masbate City","Sorsogon City"],
        "Western Visayas (Region VI)": ["Iloilo City","Passi","Roxas","Bacolod"],
        "Central Visayas (Region VII)": ["Cebu City","Mandaue","Lapu-Lapu","Talisay (Cebu)","Carcar","Naga (Cebu)","Bogo","Danao","Toledo",
          "Tagbilaran","Dumaguete"],
        "Eastern Visayas (Region VIII)": ["Tacloban","Ormoc","Baybay","Catbalogan","Borongan","Calbayog","Maasin"],
        "Zamboanga Peninsula (Region IX)": ["Zamboanga City","Dapitan","Dipolog","Pagadian","Isabela City"],
        "Northern Mindanao (Region X)": ["Cagayan de Oro","El Salvador","Gingoog","Malaybalay","Valencia (Bukidnon)",
          "Oroquieta","Ozamiz","Tangub","Iligan"],
        "Davao Region (Region XI)": ["Davao City","Panabo","Samal","Tagum","Digos","Mati"],
        "SOCCSKSARGEN (Region XII)": ["General Santos","Koronadal","Kidapawan","Tacurong","Cotabato City"],
        "Caraga (Region XIII)": ["Butuan","Cabadbaran","Bayugan","Surigao City","Tandag"],
        "Bangsamoro (BARMM)": ["Marawi","Lamitan"]
    };

    const $location = $("#location");
    const $city = $("#city");

    function populateCities(location, selectedCity) {
        $city.empty(); // remove all existing options

        if(location === 'NCR') {
            $city.append('<optgroup label="Cities Inside Metro Manila (NCR)"></optgroup>');
            const $grp = $city.find('optgroup');
            NCR.forEach(cityName => {
                $grp.append($('<option>', {
                    value: cityName,
                    text: cityName,
                    selected: selectedCity && cityName.toLowerCase() === selectedCity.toLowerCase()
                }));
            });
        } else {
            Object.keys(OUTSIDE).forEach(region => {
                $city.append('<optgroup label="'+region+'"></optgroup>');
                const $grp = $city.find('optgroup').last();
                OUTSIDE[region].forEach(cityName => {
                    $grp.append($('<option>', {
                        value: cityName,
                        text: cityName,
                        selected: selectedCity && cityName.toLowerCase() === selectedCity.toLowerCase()
                    }));
                });
            });
        }

        // Force re-initialize the selectpicker
        if ($.fn.selectpicker) {
            $city.selectpicker('destroy').selectpicker();
        } else if (window.AIZ && AIZ.plugins && AIZ.plugins.bootstrapSelect) {
            AIZ.plugins.bootstrapSelect($city);
        }
    }

    // Set province/location first
    $location.val(savedLocation).selectpicker('refresh');

    // Populate cities with saved city
    populateCities(savedLocation, savedCity);

    // On change of province/location
    $location.on('change', function(){
        populateCities(this.value, null);
    });
});
</script>


<script>
$(function () {
  // re-init just this select with the placeholder option
  $('#location')
    .selectpicker('destroy')
    .selectpicker({
      liveSearch: false,
      liveSearchPlaceholder: 'Search'   // <-- the key bit
    });
    $('#city')
    .selectpicker('destroy')
    .selectpicker({
      liveSearch: true,
      liveSearchPlaceholder: 'Search'   // <-- the key bit
    });
});



</script>

@endsection
