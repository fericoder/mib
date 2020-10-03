@extends('shop.layouts.master', ['title' => 'پروفایل کاربری'])

@section('content')
    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content register login account-box">
            <span class="close">&times;</span>
            <div class="content">
                <form style="width: 30%!important;" method="POST" action="{{ route('profile.addressesStore') }}">
                    @csrf
                    <label for="pwd">نام دریافت کننده  <span style="color: red;    font-size: 15px;">*</span></label>
                    <input name="fullName" type="text" placeholder="نام دریافت کننده را وارد کنید">

                    <label style="margin-top: 10px" for="pwd">کد پستی <span style="color: red;    font-size: 15px;">*</span></label>
                    <input name="zip_code" type="text" placeholder="کد پستی را وارد کنید">

                    <label style="margin-top: 10px" for="pwd">  استان<span style="color: red;    font-size: 15px;">*</span> </label>
                    <input name="province" type="text" placeholder="استان را وارد کنید">

                    <label style="margin-top: 10px" for="pwd">شهر<span style="color: red;    font-size: 15px;">*</span></label>
                    <input name="city" type="text" placeholder="شهر را وارد کنید">


                    <label style="margin-top: 10px" for="pwd">آدرس<span style="color: red;    font-size: 15px;">*</span></label>
                    <input name="address" type="text" placeholder="آدرس را وارد کنید">

                    <label style="margin-top: 10px" for="pwd">شماره تماس<span style="color: red;    font-size: 15px;">*</span></label>
                    <input name="tel" type="text" placeholder="شماره تماس را وارد کنید">


                    <button style="margin-top: 30px; margin-bottom: 20px" type="submit"><i class="fa fa-lock-open"></i>ثبت آدرس جدید</button>
                </form>
            </div>
        </div>

    </div>



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

            @if ($errors->any())
                <div style="background-color: #e47474" class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color: black;font-size: 13px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="profile-navbar">
                <span class="title">آدرس ها</span>
                <button class="c-profile-navbar__btn-location js-add-address-btn"><i class="fa fa-map-marked"></i></button>
            </div>

            <div class="user-main">
                <div class="address-btn" id="addnewaddr">
                    <button id="myBtn" class="c-profile-address-add">افزودن آدرس جدید</button>
                </div>

                <div class="address-section">
                    @foreach ($addresses as $address)
                        <div class="profile-address-card">
                            <div class="c-profile-address-card__desc">
                                <h4>{{ $address->fullName }}</h4>
                                <p class="c-checkout-address__text">استان: {{ $address->province }}</p>
                                <p class="c-checkout-address__text">شهر: {{ $address->city }}</p>
                                <p class="c-checkout-address__text">آدرس: {{ $address->address }}</p><br>
                            </div>
                            <div class="c-profile-address-card__data">
                                <ul class="c-profile-address-card__methods">
                                    <li class="c-profile-address-card__method c-profile-address-card__method--post">کد پستی : {{ $address->zip_code }}</li>
                                    <li class="c-profile-address-card__method c-profile-address-card__method--mobile">تلفن : {{ $address->tel }}</li>
                                </ul>
                                <div class="c-profile-address-card__actions">
                                    <a href="{{ route('profile.addressesDelete', ['id' => $address->id] ) }}"><button class="btn-note">حذف</button></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>



        </div>
    </section>



@stop
