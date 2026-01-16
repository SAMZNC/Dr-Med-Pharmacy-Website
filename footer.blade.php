<footer class="ps-footer ps-footer--1"
    style="
        background: url('{{ static_asset('assets/img/footer-bg2.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 50px 0 20px 0;
    ">

    <div class="">
        <div class="ps-footer__middle container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="row">

                        <!-- Contact Info -->
                        <div class="col-12 col-md-3">
                            <div class="ps-footer--block">
                                <h5 class="ps-block__title">CONTACT INFO</h5>
                                <p><strong>ADDRESS:</strong><br>{!! $about->open_hours !!}</p>
                                <p><strong>PHONE:</strong><br>{{ $about->phone_number }}</p>
                                <p>
                                    <strong>EMAIL:</strong><br>
                                    <a href="mailto:info@drmedpharmacy.com.ph">info@drmedpharmacy.com.ph</a>
                                </p>

                                {{-- Social icons (replace # with real links if available in settings) --}}
                                <div class="social-icons mt-4">
                                    <a href="#" aria-label="Facebook" rel="nofollow noopener" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" aria-label="Instagram" rel="nofollow noopener" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </div>

                            </div>
                        </div>

                        <!-- Products -->
                        <div class="col-6 col-md-3">
                            <div class="ps-footer--block">
                                <h5 class="ps-block__title">SHOP BY CATEGORY</h5>
                                <ul class="ps-block__list">
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{ route('products.category', $category->slug) }}">
                                                {{ $category->getTranslation('name') }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Company -->
                        <div class="col-6 col-md-3">
                            <div class="ps-footer--block">
                                <h5 class="ps-block__title">COMPANY</h5>
                                <ul class="ps-block__list">
                                    @foreach ($pages as $page)
                                        <li>
                                            <a href="{{ route('page', $page->slug) }}">
                                                {{ $page->title }}
                                            </a>
                                        </li>

                                        @if ($loop->first)
                                            <li>
                                                <a href="{{ route('contact.index') }}">Contact Us</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('faqlist') }}">FAQs</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Subscribe Newsletter -->
                        <div class="col-12 col-md-3">
                            <div class="ps-footer--block">
                                <h5 class="ps-block__title">SUBSCRIBE NEWSLETTER</h5>

                                <form class="subscribe-form mt-3" method="post" action="{{ route('subscribers.store') }}">
                                    @csrf
                                    <input type="email" name="email" class="form-control mb-2" placeholder="Email address" required>

                                    <!-- Checkbox agreement -->
                                    <div class="mb-2 d-flex align-items-start footer-subs-agree">
                                        <input type="checkbox" id="agreeCheckboxSubs" required class="footer-agree-checkbox">
                                        <label for="agreeCheckboxSubs" class="footer-agree-label">
                                            By subscribing, you agree to receive promotional emails from Dr. Med Pharmacy.
                                            You may unsubscribe anytime.
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-danger btn-block footer-subscribe-btn">
                                        SUBSCRIBE
                                    </button>
                                </form>

                                <label class="footer-label mt-3 mb-2">
                                    Payment Partners:
                                </label>

                                <div class="grid-3 footer-logo-grid">
                                    <div><img loading="lazy" alt="BDO" src="{{ static_asset('assets/img/bdo-logo.png') }}"/></div>
                                    <div><img loading="lazy" alt="BPI" src="{{ static_asset('assets/img/bpi-logo.png') }}"/></div>
                                    <div><img loading="lazy" alt="GCash" src="{{ static_asset('assets/img/g-cash-logo.png') }}"/></div>
                                    <div><img loading="lazy" alt="GrabPay" src="{{ static_asset('assets/img/grab-pay-logo.png') }}"/></div>
                                    <div><img loading="lazy" alt="Maya" src="{{ static_asset('assets/img/maya-logo.png') }}"/></div>
                                    <div><img loading="lazy" alt="Mastercard" src="{{ static_asset('assets/img/master-card-logo.png') }}"/></div>
                                    <div><img loading="lazy" alt="ShopeePay" src="{{ static_asset('assets/img/s-pay-logo.png') }}"/></div>
                                    <div><img loading="lazy" alt="UnionBank" src="{{ static_asset('assets/img/union-bank-logo.png') }}"/></div>
                                    <div><img loading="lazy" alt="VISA" src="{{ static_asset('assets/img/visa-logo.png') }}"/></div>
                                </div>

                                <label class="footer-label mt-3 mb-2">
                                    Logistic Partners:
                                </label>

                                <div class="grid-3 footer-logo-grid">
                                    <div><img loading="lazy" alt="Flash Express" src="{{ static_asset('assets/img/flash-logo.png') }}"/></div>
                                    <div><img loading="lazy" alt="J&amp;T Express" src="{{ static_asset('assets/img/jt-logo.png') }}"/></div>
                                    <div><img loading="lazy" alt="LBC" src="{{ static_asset('assets/img/lbc-logo.png') }}"/></div>
                                    <div><img loading="lazy" alt="Lalamove" src="{{ static_asset('assets/img/lalamove-logo.png') }}"/></div>
                                    <div><img loading="lazy" alt="Grab" src="{{ static_asset('assets/img/grab-logo.png') }}"/></div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="ps-footer--bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <p style="color:#777">
                            Owned and Operated by Zienac Pharmaceutical Trading (ZIENAC)<br />
                            FDA Licenses: CDRR-NCR-DI/E/W-109225 | CDRR-NCR-DS-992085<br /><br/>
                            Copyright © 2025 Dr. Med Pharmacy. All Rights Reserved.<br />
                            Dr. Med Pharmacy® is a registered trademark.<br />
                            Compliant with the Data Privacy Act of 2012 and FDA Philippines regulations.
                        </p>
                    </div>

                    <div class="col-12 col-md-3 offset-md-3">
                        <div class="payment-icons">
                            <p class="mb-2" style="display:block;color:#777;text-align:center;font-size:13px">Coming Soon On</p>
                            <div class="row h-auto d-flex justify-content-between">
                                <img loading="lazy" alt="Google Play" style="margin-right:20px" src="{{ static_asset('assets/img/google-play-white.png') }}">
                                <img loading="lazy" alt="App Store" src="{{ static_asset('assets/img/app-store-white.png') }}" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</footer>

{{-- Footer small CSS (kept here to avoid touching your main CSS files) --}}
<style>
.footer-subscribe-btn{
    font-size:14px;
    border-radius:999px;
    background:#C10007;
    border:none;
}
.footer-label{
    color:#a8a8a8 !important;
    font-size:13px !important;
}
.footer-subs-agree{
    gap:10px;
}
.footer-agree-checkbox{
    width:18px;
    height:18px;
    margin-top:3px;
    flex:0 0 auto;
}
.footer-agree-label{
    color:#a8a8a8;
    font-size:13px;
    line-height:1.35;
    margin:0;
}
.footer-logo-grid img{
    max-width:100%;
    height:auto;
    display:block;
}

/* Mobile: prevent oversized checkbox / spacing issues */
@media (max-width: 576px){
    .footer-agree-checkbox{
        width:16px;
        height:16px;
        margin-top:2px;
    }
}
</style>
