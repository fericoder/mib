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
            <div class="o-headline o-headline--profile"><span>آخرین سفارش‌ها </span></div>
            <div class="c-table-orders">
                <div class="c-table-orders__head--highlighted">
                    <div>#</div>
                    <div>شماره سفارش</div>
                    <div>تاریخ</div>
                    <div>مبلغ کل</div>
                    <div>عملیات پرداخت</div>
                    <div>جزییات</div>
                </div>
                <div class="c-table-orders__body">

                    @foreach ($user->purchases as $order)
                        <div class="table-row">
                            <div>{{ $loop->iteration }}</div>
                            <div>{{ $order->id }}</div>
                            <div>{{ jdate($order->created_at) }}</div>
                            <div>{{ number_format($order->price) }} تومان</div>
                            <div><span class="c-table-orders__payment-status--ok">پرداخت موفق</span></div>
                            <div><a href="#"><i class="fa fa-chevron-left"></i></a></div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </section>



@stop
