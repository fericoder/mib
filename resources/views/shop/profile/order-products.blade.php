@extends('shop.layouts.master', ['title' => 'پروفایل کاربری'])

@section('content')
    <section class="profile-page container">
        <div class="o-page__aside">
            <div class="c-profile-aside">
                <div class="c-profile-box">
                    <div class="c-profile-box__username">{{ $user->fName . ' ' . $user->lName }}</div>
                    <div class="c-profile-box__tabs">
                        <a href="{{ route('profile.passwordShow') }}" class="c-profile-box__tab c-profile-box__tab--access">تغییر رمز</a>
                        <a href="/logout" class="c-profile-box__tab c-profile-box__tab--sign-out">خروج از حساب</a>
                    </div>
                </div>
                <div class="c-profile-menu">
                    <div class="c-profile-menu__header">حساب کاربری شما</div>
                    <ul class="c-profile-menu__items">
                        <li><a href="{{ route('profile.index') }}" class="c-profile-menu__url c-profile-menu__url--dashboard ">صفحه اصلی پروفایل</a></li>
                        <li><a href="{{ route('profile.informationShow') }}" class="c-profile-menu__url c-profile-menu__url--dashboard ">ویرایش پروفایل</a></li>
                        <li><a href="{{ route('profile.orders') }}" class="c-profile-menu__url c-profile-menu__url--orders">لیست سفارش ها</a></li>
                        <li><a href="{{ route('profile.addressesShow') }}" class="c-profile-menu__url c-profile-menu__url--address">آدرس ها</a></li>
                        <li><a href="{{ route('profile.passwordShow') }}" class="c-profile-menu__url c-profile-menu__url--personal">تغییر رمز </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="o-page__content">
            <div class="o-headline o-headline--profile"><span>مشاهده محصولات سفارش </span></div>
            <div class="c-table-orders">
                <div class="c-table-orders__head--highlighted">
                    <div>شناسه محصول</div>
                    <div>نام</div>
                    <div>قیمت</div>
                    <div>تعداد</div>
                    <div>کد CRM محصول</div>

                </div>
                <div class="c-table-orders__body">

                        @foreach ($purchase->cart()->withTrashed()->where('status' , 1)->get()->first()->cartProduct as $product)
                        <div class="table-row">
                            <div><a target="_blank" href="{{ route('shop.product',$product->product->id ) }}">{{ $product->product->id }}</a></div>
                            <div>{{ $product->product->title }}</div>
                            <div>{{ number_format($product->total_price) }} تومان</div>
                            <div><span class="c-table-orders__payment-status--ok">{{ $product->quantity }}</span></div>
                            <div>-</div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </section>



@stop
