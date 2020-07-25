<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ورود به فروشگاه</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mediaq.css') }}">
</head>
<style>
    .is-invalid{
        border-color: red!important;
    }
    .invalid-feedback{
        color: red!important;
        display: block;
    }
</style>
<body>

<section class="account-box">
    <div class="register-logo">
        <a href="index.html"><img src="assets/images/png.svg" alt=""></a>
    </div>
    <div class="register login">
        <div class="headline">ورود به فروشگاه</div>
        <div class="content">
            <form method="POST" action="{{ route('login') }}">
                @csrf


                <label for="mobiletel">شماره موبایل</label>
                <input id="mobile" type="mobile" class="form-control @error('mobile') is-invalid @enderror" name="mobile" placeholder="شماره موبایل خودرا وارد نمایید" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>

                @error('mobile')
                <span  class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                {{--<label for="mobiletel">آدرس ایمیل</label>--}}
                {{--<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="آدرس ایمیل خودرا وارد نمایید" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

                {{--@error('email')--}}
                {{--<span class="invalid-feedback" role="alert">--}}
                    {{--<strong>{{ $message }}</strong>--}}
                {{--</span>--}}
                {{--@enderror--}}

                <label for="pwd">کلمه عبور</label>

                <input id="password" type="password" placeholder="رمز عبور خودرا وارد نمایید" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                 </span>
                @enderror

                <div class="acc-agree">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="chkbox"><span>مرا به خاطر داشته باش</span></label>
                </div>
                <button type="submit"><i class="fa fa-unlock"></i> ورود به سیستم</button>
            </form>
        </div>
        <div class="foot login-foot">
            <span>کاربر جدید هستید؟</span>
            <a href="/register">ثبت نام در فروشگاه</a>
        </div>
    </div>
</section>

<footer>
    <section class="footer account-footer container">
        <div class="copyright"><p>استفاده از مطالب فروشگاه فقط برای مقاصد غیرتجاری و با ذکر منبع
                بلامانع است. کلیه حقوق این سایت متعلق به شرکت ایده برتر کیوان می‌باشد.</p></div>

        <div class="copyright-en">
            <p>Copyright © 2020</p>
        </div>
    </section>
</footer>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>


