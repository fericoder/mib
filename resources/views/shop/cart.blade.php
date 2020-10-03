@extends('shop.layouts.master', ['title' => 'سبد خرید' ])

@section('headerScripts')
    <link rel="stylesheet" href="{{ asset('css/style-quantity.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/pages/cart.css') }}">

@stop


@section('content')

    <section class="main-cart container">
        <div class="o-page__content {{ $cart == null ? 'flex-1' : '' }}">
            <div class="o-headline">
                <div id="main-cart"><span class="c-checkout-text c-checkout__tab--active">سبد خرید</span></div>
            </div>
            <div class="c-checkout">

                <ul class="c-checkout__items">
                    <li class="c-checkout__item">
                        @if($cart)

                        @foreach ($cart->cartProduct as $cartProduct)
                        <div class="c-checkout__row">
                                <div class="c-checkout__col--thumb">
                                    <a href="{{ route('shop.product', $cartProduct->product->id ) }}"><img src="{{ asset($cartProduct->product->image['original']) }}" alt=""></a>
                                </div>
                                <div class="c-checkout__col--desc">
                                    <a href="{{ route('shop.product', $cartProduct->product->id ) }}">{{ $cartProduct->product->title }}</a>
                                    @if($cartProduct->group)
                                    @foreach(App\Http\Controllers\ShopController::getItemsGroup($cartProduct->group->specification_items) as $item)
                                    <p style="margin-top:5px;color:gray">{{ $item }}</p>

                                    @endforeach
                                    @endif
                                    <div class="c-checkout__variant c-checkout__variant--color"></div>
                                    <div class="c-checkout__col--information">
                                        <div class="c-checkout__col c-checkout__col--counter">
                                            <div class="c-cart-item__quantity-row">
                                                <div class="quantity buttons_added">
                                                    <form action="{{ route('checkout.index') }}" method="POST" id="checkout">
                                                        @csrf
                                                    <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="{{ $cartProduct->group_id != null ? $cartProduct->group->amount : '' }}" name="{{ $cartProduct->id }}" value="{{ $cartProduct->quantity }}" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">
                                                </div>
                                                <div class="c-quantity-selector" style="border:0">
                                                    <button id="removeProduct" data-cart="{{ \Auth::user()->cart()->get()->first()->id }}" data-id="{{ $cartProduct->product->id }}" data-cartp="{{ $cartProduct->id }}" type="button" class="c-quantity-selector__remove"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-checkout__col c-checkout__col--price">
                                            <div class="c-checkout__price"> {{ number_format($cartProduct->product->price) }} تومان</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                        @else
                        <div class="c-checkout__row" style="font-size: 30px;
                        display: flex;
                        justify-content: center;
                        padding: 100px;
                        color: #EF394E;">
                            محصولی در سبد خرید شما وجود ندارد

                            <div class="c-checkout__col--desc">

                            </div>

                        </div>
                        @endif



                    </li><!--cart-item-->
                </ul>
                <div class="c-checkout__to-shipping-sticky">
                    @if($cart)
                    <a href="javascript:$('#checkout').submit();" class="c-checkout__to-shipping-link">ادامه فرایند خرید</a>
                </form>

                    @else
                    <a href="{{ route('shop.index') }}" class="c-checkout__to-shipping-link btn-cart">صفحه اصلی</a>
                    @endif

                    {{-- <div class="c-checkout__to-shipping-price-report">
                        <p>مبلغ قابل پرداخت</p>
                        @if($cart)
                        <div class="c-checkout__to-shipping-price-report--price">{{ number_format($cartProduct->cart->total_price) }} <span>تومان</span></div>
                       @else
                        <div class="c-checkout__to-shipping-price-report--price"> 0 <span>تومان</span></div>
                        @endif

                    </div> --}}
                </div>
            </div>
        </div>
        @if($cart)

        {{-- <aside class="o-page__aside">
            <div class="c-checkout-aside">
                <div class="c-checkout-summary">
                    <ul class="c-checkout-summary__summary">

                        <!--incredible-->
                        <li class="has-devider">
                            <span>قیمت کالاها</span>
                            <span> {{ number_format($cartProduct->cart->total_price) }} تومان </span>

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
                            <span> {{ number_format($cartProduct->cart->total_price) }} تومان </span>
                                </li>

                    </ul>
                    <div class="c-checkout-summary__main">
                        <div class="c-checkout-summary__content">
                            <div><span> کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش مراحل بعدی را تکمیل کنید.</span></div>
                        </div>
                    </div>
                </div>

            </div>
        </aside> --}}
        @endif

    </section>
    @stop

    @section('footerScripts')
    <script>
        $(document).on('click', '#removeProduct', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var cart = $(this).data('cart');
            var cartProductId = $(this).data('cartp');
              swal({
                    title: "آیا مطمئن هستید؟",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "بله",
                    cancelButtonText: "خیر",
                    showCancelButton: true,
                },
                    function () {
                        $.ajax({
                            type: "POST",
                            url: "user-cart/remove",
                            data: {
                                id: id,
                                cart: cart,
                                cartProductId: cartProductId,
                                "_token": $('#csrf-token')[0].content //pass the CSRF_TOKEN()
                            },
                            success: function (data) {
                                var url = document.location.origin + "/user-cart";
                                location.href = url;
                            }
                        });
                    });
            });

    </script>
    <script src="{{ asset('js/script-quantity.js') }}"></script>
    @endsection




