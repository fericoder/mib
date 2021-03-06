@extends('shop.layouts.master', ['title' => 'پروفایل کاربری'])

@section('content')



    <section class="account-box">
        <div class="register login">

            @if ($errors->any())
                <div style="background-color: #e47474" class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color: black;font-size: 13px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="headline">تغییر رمزعبور</div>
            <div class="content">
                <form method="POST" action="{{ route('profile.passwordUpdate') }}">
                    @csrf
                    <label for="pwd">رمز عبور قبلی</label>
                    <input name="old_password" id="old_password" type="password" placeholder="رمزعبور فعلی خود را وارد کنید">
                    <label style="margin-top: 20px" for="pwd">رمز عبور جدید</label>
                    <input id="password" name="password" type="password" placeholder="رمزعبور جدید خود را وارد کنید">
                    <label for="pwd">تکرار رمز عبور جدید</label>
                    <input name="password_confirmation" id="password_confirmation" type="password" placeholder="رمزعبور جدید خود را مجددا وارد کنید">
                    <button style="margin-top: 30px; margin-bottom: 20px" type="submit"><i class="fa fa-lock-open"></i>تغییر رمزعبور</button>
                </form>
            </div>
        </div>
    </section>


@stop
