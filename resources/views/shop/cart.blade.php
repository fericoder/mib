@extends('shop.layouts.master', ['title' => 'سبد خرید' ])

@section('content')


    <section class="main-cart container">
        <div class="o-page__content">
            <div class="o-headline">
                <div id="main-cart"><span class="c-checkout-text c-checkout__tab--active">سبد خرید</span></div>
            </div>
            <div class="c-checkout">

                <ul class="c-checkout__items">
                    <li class="c-checkout__item">

                        @foreach ($products as $product)
                            <div class="c-checkout__row">
                                <div class="c-checkout__col--thumb">
                                    <a href="{{ route('shop.product', $product->id ) }}"><img src="{{ asset($product->image['original']) }}" alt=""></a>
                                </div>
                                <div class="c-checkout__col--desc">
                                    <a href="{{ route('shop.product', $product->id ) }}">{{ $product->title }}</a>
                                    <div class="c-checkout__variant c-checkout__variant--color"></div>
                                    <div class="c-checkout__col--information">
                                        <div class="c-checkout__col c-checkout__col--counter">
                                            <div class="c-cart-item__quantity-row">
                                                <div class="c-quantity-selector">
                                                    <button type="button" class="c-quantity-selector__add"><i class="fa fa-plus"></i></button>
                                                    <div class="c-quantity-selector__number">۱</div>
                                                    <button type="button" class="c-quantity-selector__remove"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-checkout__col c-checkout__col--price">
                                            <div class="c-checkout__price"> {{ number_format($product->price) }} تومان</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach



                    </li><!--cart-item-->
                </ul>
                <div class="c-checkout__to-shipping-sticky">
                    <a href="{{ route('checkout.index') }}" class="c-checkout__to-shipping-link">ادامه فرایند خرید</a>
                    <div class="c-checkout__to-shipping-price-report">
                        <p>مبلغ قابل پرداخت</p>
                        <div class="c-checkout__to-shipping-price-report--price">{{ number_format($products->sum('price')) }} <span>تومان</span></div>

                    </div>
                </div>
            </div>
        </div>
        <aside class="o-page__aside">
            <div class="c-checkout-aside">
                <div class="c-checkout-summary">
                    <ul class="c-checkout-summary__summary">

                        <!--incredible-->
                        <li class="has-devider">
                            <span>قیمت کالاها</span>
                            <span> {{ number_format($products->sum('price')) }} تومان </span>
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
                            <span> {{ number_format($products->sum('price')) }} تومان </span>
                        </li>

                    </ul>
                    <div class="c-checkout-summary__main">
                        <div class="c-checkout-summary__content">
                            <div><span> کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش مراحل بعدی را تکمیل کنید.</span></div>
                        </div>
                    </div>
                </div>

            </div>
        </aside>
    </section>


@stop
