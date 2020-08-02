
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>عضویت در فروشگاه</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mediaq.css') }}">

</head>
<body>
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

<section class="account-box">
    <div class="register-logo">
        <a href="/"><img src="assets/images/png.svg" alt=""></a>
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

<footer style="    position: inherit!important;">
    <section class="footer account-footer container">
        <div class="copyright"><p>استفاده از مطالب فروشگاه اینترنتی دیجی‌کالا فقط برای مقاصد غیرتجاری و با ذکر منبع
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


