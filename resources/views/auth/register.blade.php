@extends('shop.layouts.master', ['title' => 'ورود به فروشگاه' ])
@section('headerScripts')
    <style>
        .is-invalid{
            border-color: red!important;
        }
        .invalid-feedback{
            color: red!important;
            display: block;
        }
        /* The Modal (background) */

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
    </style>

@stop

@section('content')

<section class="account-box">
    <div class="register-logo">
        <a href="/"><img src="/assets/images/logo.png" alt=""></a>
    </div>
    <div class="register login">
        <div class="headline">عصویت در فروشگاه</div>
        <div class="content">
            <form method="POST" action="{{ route('register') }}">
                @csrf



                <label for="mobtel">نام</label>
                <input id="fName" type="text" class="form-control @error('fName') is-invalid @enderror" name="fName" placeholder="نام خودرا وارد نمایید" value="{{ old('fName') }}" required autocomplete="fName">
                @error('fName')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


                <label for="mobtel">نام خانوادگی</label>
                <input id="lName" type="text" class="form-control @error('lName') is-invalid @enderror" name="lName" placeholder="نام خانوادگی خودرا وارد نمایید" value="{{ old('lName') }}" required autocomplete="lName">
                @error('lName')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


                <label for="mobtel">شماره موبایل</label>
                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" placeholder="شماره موبایل خودرا وارد نمایید" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>
                @error('mobile')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror



                <label for="mobtel">آدرس ایمیل</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="آدرس ایمیل خودرا وارد نمایید" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


                <label for="mobtel">شماره نظام پزشکی</label>
                <input id="pezeshkiNo" type="text" class="form-control @error('pezeshkiNo') is-invalid @enderror" name="pezeshkiNo" placeholder="شماره نظام پزشکی خودرا وارد نمایید" value="{{ old('pezeshkiNo') }}" required autocomplete="pezeshkiNo">
                @error('pezeshkiNo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <label for="mobtel">کد معرف (درصورت وجود)</label>
                <input id="moarref" type="text" class="form-control @error('moarref') is-invalid @enderror" name="moarref" placeholder="کد معرف خودرا درصورت وجود وارد نمایید" value="{{ old('moarref') }}" autocomplete="moarref">
                @error('moarred')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <label for="pwd">کلمه عبور</label>
                <input id="password" type="password" placeholder="رمز عبور خودرا وارد نمایید" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                 </span>
                @enderror

                <label for="pwd">تکرار کلمه عبور</label>
                <input id="password" type="password" placeholder="رمز عبور خودرا وارد نمایید" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password">


                <button type="submit"><i class="fa fa-unlock"></i> عضویت در فروشگاه</button>
            </form>
        </div>
        <div class="foot login-foot">
            <span>عضو هستید؟</span>
            <a href="/login">ورود به فروشگاه</a>
        </div>
    </div>
</section>

@stop
