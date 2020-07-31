@extends('shop.layouts.master', ['title' => 'پروفایل کاربری'])

@section('content')

    <style>
        .account-box + footer{
            top: 550px!important;
        }
    </style>
    <section class="account-box">
        <div class="register login">
            <div class="headline">تغییر رمزعبور</div>
            <div class="content">
                <form action="#">
                    <label for="pwd">رمز عبور قبلی</label>
                    <input id="pwd" type="text" placeholder="رمزعبور جدید خود را وارد کنید">
                    <label for="pwd">رمز عبور جدید</label>
                    <input id="pwd" type="text" placeholder="رمزعبور جدید خود را وارد کنید">
                    <label for="pwd">تکرار رمز عبور جدید</label>
                    <input id="pwd" type="text" placeholder="رمزعبور جدید خود را مجددا وارد کنید">
                    <button type="submit"><i class="fa fa-lock-open"></i>تغییر رمزعبور</button>
                </form>
            </div>
        </div>
    </section>


@stop
