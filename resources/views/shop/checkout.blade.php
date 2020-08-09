@extends('shop.layouts.master', ['title' => 'ثبت سفارش' ])

@section('content')

    <main class="main-cart container">
        <div class="o-page__content">
            <div id="shipping-data">
                <form action="{{ route('checkout.store') }}" method="post" id="purchase">
                    @csrf
                <div class="o-headline o-headline--checkout"><span>انتخاب آدرس تحویل سفارش</span></div>
                @forelse (auth()->user()->addresses as $address)
                  <div class="d-flex" style="align-items: center;">
                    <input type="radio" class="option-input radio m-2" value="{{ $address->id }}" name="address" {{  $loop->first == true ? 'checked' : '' }} />
                <div id="address-section" class="w-100">
                    <div id="user-default-address-container" class="c-checkout-contact is-completed">
                        <div class="c-checkout-contact__content">
                            <ul class="c-checkout-contact__items">
                                <li class="c-checkout-contact__item c-checkout-contact__item--username"> <span>گیرنده : {{ $address->fullName }}</span>
                                    {{-- <button class="c-checkout-contact__btn-edit">اصلاح این آدرس</button> --}}
                                </li>
                                <li class="c-checkout-contact__item c-checkout-contact__item--location">
                                    <div class="c-checkout-contact__item c-checkout-contact__item--mobile"> <span>شماره تماس : {{ $address->tel }}</span></div>
                                    <div class="c-checkout-contact__item--message"><span>کد پستی : {{ $address->zip_code }}</span></div>
                                    <br> <span class="full-address">{{ $address->province }}</span>
                                    <br> <span class="full-address">{{ $address->city }}</span>
                                    <br> <span class="full-address">{{ $address->address }}</span>
                                  </li>
                            </ul>
                            {{-- <div class="c-checkout-contact__badge"></div> --}}
                        </div>
                        {{-- <button id="change-sh-address" class="c-checkout-contact__location">تغییر آدرس ارسال</button> --}}
                    </div>
                </div>
              </div>
              @empty
              <div class="c-checkout__actions">
                <a href="{{ route('profile.addressesShow') }}"><button class="btn-link-spoiler" type="button">« افزودن آدرس </button></a>
            </div>
                @endforelse





                <div class="o-headline o-headline--checkout"><span>انتخاب روش پرداخت</span></div>
                <div id="address-section">
                    <div id="user-default-address-container" class="c-checkout-contact is-completed">
                        <div class="c-checkout-contact__content">
                            <ul class="c-checkout-contact__items">

                                @if ($shop->pardakhtBaDargah)
                                    <div style="margin-bottom: 20px" class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="exampleRadios1" value="online_payment" checked>
                                        <label style="font-size: 18px;" class="form-check-label" for="exampleRadios1">
                                            درگاه بانک پاسارگاد
                                        </label>
                                    </div>
                                @endif

                                    @if ($shop->pardakhtDarMahal)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" id="exampleRadios2" value="cash_payment">
                                            <label style="font-size: 18px" class="form-check-label" for="exampleRadios2">
                                                پرداخت در محل
                                            </label>
                                        </div>
                                    @endif



                            </ul>
                            <div class="c-checkout-contact__badge"></div>
                        </div>
                    </div>
                </div>






                    <div>
                        <div class="o-headline o-headline--checkout"> <span>مرسوله </span></div>
                        <div class="c-checkout-pack">
                            <div class="c-checkout-pack__row">
                              @foreach ($cart->cartProduct as $cartProduct)
                                <div class="c-product-box c-product-box--compact">
                                    <a href="#" class="c-product-box__img"><img src="{{ $cartProduct->product->image['250,250'] }}" alt="" style="width:150px;height:100px"></a>
                                    <div class="c-product-box__title">{{ $cartProduct->product->title }}</div>
                                </div>
                              @endforeach
                            </div>
                            {{--<div class="c-checkout-pack__row">--}}
                                {{--<div class="c-checkout-time-table">--}}
                                    {{--<div class="c-checkout-time-table__title-bar"> بازه تحویل سفارش: ۲ روز کاری</div>--}}
                                    {{--<ul class="c-checkout-time-table__subtitle-bar">--}}
                                        {{--<li>شیوه ارسال: پست پیشتاز (بین ۱ تا ۴ روز کاری)</li>--}}
                                        {{--<li>هزینه ارسال به عهده سفارش دهنده میباشد. </li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                <div class="c-checkout-shipment__invoice-type">
                    @if ($shop->checkOutDescription)
                        <p class="c-checkout-shipment__invoice-type-info">
                            {!! $shop->checkOutDescription !!}
                        </p>
                    @endif
                </div>
                <div class="c-checkout__to-shipping-sticky">
                    <a href="javascript:$('#purchase').submit();" class="c-checkout__to-shipping-link">ثبت نهایی سفارش</a>
                    <div class="c-checkout__to-shipping-price-report">
                        <p>مبلغ قابل پرداخت</p>
                        <div class="c-checkout__to-shipping-price-report--price">۱۹۶,۷۰۰ <span>تومان</span></div>
                    </div>
                </div>
            </form>
            </div>
            <div class="c-checkout__actions">
                <button class="btn-link-spoiler">« بازگشت به سبد خرید </button>
            </div>
        </div>
        <aside class="o-page__aside">
            <div class="c-checkout-aside">
                <div class="c-checkout-summary">
                    <ul class="c-checkout-summary__summary">
                        <li>
                            <span>قیمت کالاها ({{ $cart->cartProduct->count() }})</span>
                            <span> {{ $cart->total_price }} تومان </span>
                        </li>
                        <!--incredible-->
                        <li class="c-checkout-summary__discount">
                            <span> تخفیف کالاها </span>
                            <span class="discount-price">0 تومان</span>
                        </li>
                        <!--incredible-->
                        <li class="has-devider">
                            <span>جمع</span>
                            <span> {{ $cart->total_price }}تومان </span>
                        </li>
                        <li>
                            <span>هزینه ارسال</span>
                            <span></span>
                        </li>
                        <li>
                            <span style="font-size: 1.1em;padding-right: 10px;">ارسال عادی</span>
                            <span style="font-size: 1.1em;padding-right: 10px;">رایگان</span>
                        </li>
                        <li class="has-devider">
                            <span> مبلغ قابل پرداخت </span>
                            <span> {{ $cart->total_price }} تومان </span>
                        </li>

                    </ul>
                </div>

            </div>
        </aside>
    </main>
    {{-- <div class="modal-checkout container" id="address-modal">
        <div class="container">
            <div class="c-form-checkout__headline">افزودن آدرس جدید</div>
            <form>
                <div class="group-input">
                    <div class="flname"> <span>نام و نام خانوادگی تحویل گیرنده</span>
                        <input type="text" placeholder="نام تحویل گیرنده را وارد کنید">
                    </div>
                    <div class="mob"> <span>شماره موبایل</span>
                        <input type="text" placeholder="09xxxxxxxx">
                    </div>
                </div>
                <div class="group-input">
                    <div class="flname"> <span>استان</span>
                        <select name="provinces">
                            <option value="1">آذربایجان غربی</option>
                            <option value="1">آذربایجان غربی</option>
                            <option value="1">آذربایجان غربی</option>
                            <option value="1">آذربایجان غربی</option>
                        </select>
                    </div>
                    <div class="mob"> <span>شهر</span>
                        <select name="city">
                            <option value="1">ماکو</option>
                            <option value="1">ماکو</option>
                            <option value="1">ماکو</option>
                            <option value="1">ماکو</option>
                            <option value="1">ماکو</option>
                        </select>
                    </div>
                </div>
                <div class="textarea-area"> <span>آدرس پستی</span>
                    <br>
                    <textarea name="" id="textarea"></textarea>
                </div>
                <div class="textarea-area"> <span>کد پستی</span>
                    <br>
                    <input type="text">
                </div>
                <div class="foot">
                    <button class="btn-checked">ثبت و ارسال به این آدرس</button> <a class="btn-link-spoiler" href="#">انصراف و بازگشت</a></div>
            </form>
        </div>
        <button class="close-modal"><i class="fa fa-plus"></i></button>
    </div> --}}


@stop
