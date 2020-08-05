@extends('shop.layouts.master', ['title' => 'پروفایل کاربری'])

@section('content')
    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }


        .alert-danger {
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
        }

        .alert-danger hr {
            border-top-color: #e4b9c0;
        }

        .alert-danger .alert-link {
            color: #843534;
        }
        .user-main>div{
            flex: 1 0 50%!important;
        }

    </style>


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
                            <li style="color: black;font-size: 13px;padding: 10px">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="profile-navbar">
                <span class="title">ویرایش پروفایل</span>
                <button class="c-profile-navbar__btn-location js-add-address-btn"><i class="fa fa-map-marked"></i></button>
            </div>

            <div class="user-main">
                <div class="modal-content register login account-box">
                    <div class="content">
                        <form style="width: 30%!important;" enctype="multipart/form-data" method="POST" action="{{ route('profile.informationUpdate') }}">
                            @csrf

                            <label for="pwd">نام  <span style="color: red;    font-size: 15px;">*</span></label>
                            <input name="fName" disabled type="text" value="{{ $user->fName }}">

                            <label style="margin-top: 10px" for="pwd">نام خانوادگی <span style="color: red;    font-size: 15px;">*</span></label>
                            <input name="lName" disabled type="text" value="{{ $user->lName }}">

                            <label style="margin-top: 10px" for="pwd">  شماره موبایل<span style="color: red;    font-size: 15px;">*</span> </label>
                            <input name="province" disabled type="text" value="{{ $user->mobile }}">

                            <label style="margin-top: 10px" for="pwd">ایمیل<span style="color: red;    font-size: 15px;">*</span></label>
                            <input name="province" disabled type="text" value="{{ $user->email }}">

                            <label style="margin-top: 10px" for="pwd">شغل<span style="color: red;    font-size: 15px;">*</span></label>
                            <input name="job" required type="text" value="{{ $user->job }}" placeholder="مثال: دندانپزشک/ مراکز درمانی ">

                            <label style="margin-top: 10px" for="pwd">تصویر کارت ملی<span style="color: red;    font-size: 15px;">*</span></label>
                            <input name="meliPic" type="file" >

                            <label style="margin-top: 10px" for="pwd">کارت نظام پزشکی <span style="color: red;    font-size: 15px;">*</span></label>
                            <input name="nezamPic" type="file" >

                            <label style="margin-top: 10px" for="pwd">عکس جواز کسب  </label>
                            <input name="javazPic" type="file" >


                            <button style="margin-top: 30px; margin-bottom: 20px" type="submit"><i class="fa fa-lock-open"></i>بروزرسانی اطلاعات</button>
                        </form>
                    </div>
                </div>
            </div>



        </div>
    </section>



@stop
