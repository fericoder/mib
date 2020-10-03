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

                            <select required style="padding: 10px;font-size: 13px;" name="job" id="job">
                                <option disabled selected value> -- کلیک کنید -- </option>
                                <option {{ $user->job == 'دندان پزشک' ? 'selected' : '' }} value="دندان پزشک">دندان پزشک</option>
                                <option {{ $user->job == 'مرکز درمانی' ? 'selected' : '' }} value="مرکز درمانی">مرکز درمانی</option>
                            </select>

                            <div class="" style="display: none;" id="dandanpezesht">
                                <br>
                                <label style="margin-top: 10px;color: #656565; margin: 5px 0; letter-spacing: -.6px; font-size: 1.071rem;line-height: 1.467;font-weight: 400;" for="pwd">تصویر کارت ملی<span style="color: red;    font-size: 15px;">*</span></label>
                                <input style="margin: 15px;margin-bottom: 30px;" name="meliPic" type="file" >
                                <br><br>
                                <label style="margin-top: 10px;color: #656565; margin: 5px 0; letter-spacing: -.6px; font-size: 1.071rem;line-height: 1.467;font-weight: 400;" for="pwd">کارت نظام پزشکی <span style="color: red;    font-size: 15px;">*</span></label>
                                <input style="margin: 15px;margin-bottom: 30px;" name="nezamPic" type="file" >
                            </div>

                            <div class="" style="display: none" id="markazdarmani">
                                <br>
                                <label style="margin-top: 10px;color: #656565; margin: 5px 0; letter-spacing: -.6px; font-size: 1.071rem;line-height: 1.467;font-weight: 400;" for="pwd">عکس جواز کسب  <span style="color: red;    font-size: 15px;">*</span></label>
                                <input style="margin: 15px;margin-bottom: 30px;" name="javazPic" type="file" >
                            </div>


                            <button style="margin-top: 30px; margin-bottom: 20px" type="submit"><i class="fa fa-lock-open"></i>بروزرسانی اطلاعات</button>
                        </form>
                    </div>
                </div>
            </div>



        </div>
    </section>



@stop

@section('footerScripts')
    <script>
        $('#job').change(function() {
            if ($(this).val() === 'دندان پزشک') {
                $('#dandanpezesht').show();
            }
            if ($(this).val() != 'دندان پزشک') {
                $('#dandanpezesht').hide();
            }

            if ($(this).val() === 'مرکز درمانی') {
                $('#markazdarmani').show();
            }
            if ($(this).val() != 'مرکز درمانی') {
                $('#markazdarmani').hide();
            }
        });
    </script>

@stop
