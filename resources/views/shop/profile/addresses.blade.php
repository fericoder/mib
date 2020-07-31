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

            <div class="profile-navbar">
                <span class="title">آدرس ها</span>
                <button class="c-profile-navbar__btn-location js-add-address-btn"><i class="fa fa-map-marked"></i></button>
            </div>

            <div class="user-main">
                <div class="address-btn" id="addnewaddr">
                    <button class="c-profile-address-add">افزودن آدرس جدید</button>
                </div>
                <div class="address-section">
                    <div class="profile-address-card">
                        <div class="c-profile-address-card__desc">
                            <h4>حسن شفعی</h4>
                            <p class="c-checkout-address__text">استان آذربایجان غربی، ‌شهر ماکو، شهرک ولیعصر - سایت ب - نت پارادیس</p>
                        </div>
                        <div class="c-profile-address-card__data">
                            <ul class="c-profile-address-card__methods">
                                <li class="c-profile-address-card__method c-profile-address-card__method--post">کد پستی : ۲۸۲۳۵۴۷۲</li>
                                <li class="c-profile-address-card__method c-profile-address-card__method--mobile">تلفن همراه : ۰۸۸۱۲۳۴۷</li>
                            </ul>
                            <div class="c-profile-address-card__actions">
                                <button class="btn-note">حذف</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </section>



@stop
