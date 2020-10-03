<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slicknav/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mediaq.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="/assets/plugins/global/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">


    <style>
        .sweet-alert{
            font-family: IRANSans!important;
        }
        .float{
            position:fixed;
            width:60px;
            height:60px;
            bottom:40px;
            right:40px;
            background-color:#25d366;
            color:#FFF;
            border-radius:50px;
            text-align:center;
            font-size:30px;
            box-shadow: 2px 2px 3px #999;
            z-index:100;
        }

        .my-float{
            margin-top:16px;
        }


        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 1% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;


        .account-box + footer{
            top: 600px!important;
        }

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
    @yield('headerScripts')
    <style>
        #ex4 .p1[data-count]:after{
            position:absolute;
            top:5%;
            content: attr(data-count);
            padding:.3em;
            font-size: 13px;
            border-radius:50%;
            line-height:1em;
            color: white;
            background:#ef394eed;
            text-align:center;
            min-width: 1em;
            font-family: byekan;
          }
          .cart i {
            position: absolute;
            top: -9px;
            font-size: .8em!important;
            left: 10px;
        }
    </style>
</head>

<body>
<header>
    <section class="top-head container">
        <div class="right-head">
            <div class="logo">
                <a href="/"><img src="{{ asset('assets/images/logo.png') }}" ></a>
            </div>
            <form action="{{ route('shop.search') }}">
                <button><i class="fa fa-search"></i></button>
                    <input type="text" name="keyword" value="{{ isset($keyword) ? $keyword : '' }}" placeholder="نام محصول مورد نظر را بنویسید…">
                    <input type="hidden" name="category"  value="{{ isset($category) ? $category->id : '' }}">
            </form>
        </div>
        <div class="left-head">
            @auth()
            <div class="login-box">
                <div class="log-reg" id="logreg">
                    <i class="fa fa-user"></i>
                    <a href="{{ \Auth::user()->type == 'admin' ? '/dashboard/index' : '/profile' }}">{{ \Auth::user()->fName . ' ' . \Auth::user()->lName }} |  مشاهده پنل کاربری</a>
                </div>
            </div>
            <div class="devider"></div>
                <div class="login-box">
                    <div class="log-reg" id="logreg">
                        <a href="{{ route('logout') }}">خروج</a>
                    </div>
                </div>
                <div class="devider"></div>

            @endauth

            @guest()

                <div class="login-box">
                    <div class="log-reg" id="logreg">
                        <i class="fa fa-user"></i>
                        <a href="{{ route('login') }}">ورود</a>
                    </div>
                </div>
                <div class="devider"></div>


                    <div class="login-box">
                        <div class="log-reg" id="logreg">
                            <i class="fa fa-user"></i>
                            <a href="{{ route('register') }}">عضویت</a>
                        </div>
                    </div>
                    <div class="devider"></div>


                @endguest

                @auth()
                <a href="{{ route('user-cart') }}" class="cart">
                <div id="ex4">
                    <span class="p1 fa-stack fa-2x has-badge" data-count="{{ \Auth::user()->cart()->get()->count()  != 0 ?  \Auth::user()->cart()->get()->first()->cartProduct()->count() : 0 }}">
                      <i class="p3 fa fa-shopping-cart fa-stack-1x xfa-inverse" data-count="4b"></i>
                    </span>
                  </div>
                        </a>

            @endauth
        </div>


    </section>

    <nav class="top-nav container">
        <ul class="dropdown" id="mynavmenu">
            <li class="main-category"><i class="fa fa-bars"></i><a href="#">دسته بندی کالاها</a>
                <ul class="dropdown2">

                    @foreach (\App\Category::all()->where('parent_id', null) as $category)
                        <li>
                            <a href="{{ route('shop.category', $category->id) }}">{{ $category->name }}</a>
                            <ul style="    height: 300px;" class="megamenu">
                                @foreach (\App\Category::all()->where('parent_id', $category->id) as $subCategory)
                                    <li style="margin-right: 20px">
                                        <a style="width: 150px" href="{{ route('shop.category', $subCategory->id) }}">{{ $subCategory->name }}</a>
                                    @foreach (\App\Category::all()->where('parent_id', $subCategory->id) as $subSubCategory)
                                            <ul >
                                                <li style="margin-right: 20px">
                                                    <a style="width: 150px" href="{{ route('shop.category', $subSubCategory->id) }}">{{ $subSubCategory->name }}</a>
                                                </li>
                                            </ul>
                                        @endforeach
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </li>

            <li><a href="{{ route('shop.faq') }}">سوالات متداول </a></li>
            <li><a href="{{ route('shop.pages', 3) }}">راهنمای خرید </a></li>
            <li><a href="{{ route('shop.blogs') }}">مقالات </a></li>
            <li><a href="{{ route('shop.news') }}">اخبار </a></li>


        </ul>

    </nav>

</header>
@include('dashboard.layouts.errors')

@yield('content')
<footer style="    position: inherit!important;">
    <section class="footer container">
        <div class="icon">
            <div class="icon-item">
                <a href="#"> <img src="{{ asset('assets/images/icon/1.svg') }}" alt=""> <span>7 روز ضمانت بازگشت</span> </a>
            </div>
            <div class="icon-item">
                <a href="#"> <img src="{{ asset('assets/images/icon/4.svg') }}" alt=""> <span>تحویل اکسپرس</span> </a>
            </div>
            <div class="icon-item">
                <a href="#"> <img src="{{ asset('assets/images/icon/3.svg') }}" alt=""> <span>پشتیبانی ۲۴ ساعته</span> </a>
            </div>
            <div class="icon-item">
                <a href="#"> <img src="{{ asset('assets/images/icon/5.svg') }}" alt=""> <span>ضمانت اصل بودن کالا</span> </a>
            </div>
        </div>
        <div class="footer-content">
            <div class="shop-help">
                <h3 class="head">لینک های کاربردی</h3>
                <ul>
                    <li><a href="{{ route('shop.pages', 4) }}">شرایط و قوانین</a></li>
                    <li><a href="{{ route('shop.aboutUs') }}">درباره ما</a></li>
                    <li><a href="{{ route('shop.contactUs') }}">تماس باما</a></li>
                </ul>
            </div>
            <div class="customer-service">
                <h3 class="head">خدمات مشتریان</h3>
                <ul>
                    <li><a href="{{ route('shop.faq') }}">پاسخ به پرسش های متداول</a></li>
                    <li><a href="{{ route('shop.pages', 8) }}">رویه های بازگرداندن کالا</a></li>
                    <li><a href="{{ route('shop.pages', 7) }}">حریم خصوصی</a></li>
                </ul>
            </div>

            <div class="cert">
                <h3 class="head">مجوزهای فروشگاه</h3>
                <div class="image"> <img src="{{ asset('assets/images/cert/enamad.png') }}" alt=""> <img src="{{ asset('assets/images/cert/samandehi.png') }}" alt=""></div>
            </div>
        </div>
        <div class="footer-contact">
            <div class="contact"> <span>هفت روز هفته, ۲۴ ساعت شبانه روز پاسخگوی شما هستیم,</span> <span>شماره تماس : 02127679</span> <span>آدرس ایمیل : info@mibdental.com</span>

                <span>شبکه های اجتماعی: </span>
                @if (\App\Shop::first()->instagram)
                    <a target="_blank" href="https://instagram.com/{{ \App\Shop::first()->instagram }}"><i style="font-size: 25px; margin: 10px" class="fa fa-instagram"></i></a>
                @endif

                @if (\App\Shop::first()->telegram)
                    <a target="_blank" href="https://t.me/{{ \App\Shop::first()->telegram }}"><i style="font-size: 25px; margin: 10px" class="fa fa-telegram"></i></a>
                @endif

                @if (\App\Shop::first()->twitter)
                    <a target="_blank" href="https://twitter.com/{{ \App\Shop::first()->twitter }}"><i style="font-size: 25px; margin: 10px" class="fa fa-twitter"></i></a>
                @endif

                @if (\App\Shop::first()->youtube)
                    <a target="_blank" href="https://youtube.com/{{ \App\Shop::first()->youtube }}"><i style="font-size: 25px; margin: 10px" class="fa fa-youtube"></i></a>
                @endif


            </div>
        </div>
        <div class="copyright">
            <p>استفاده از مطالب فروشگاه اینترنتی  فقط برای مقاصد غیرتجاری و با ذکر منبع بلامانع است. کلیه حقوق این سایت متعلق به شرکت ایده برتر کیوان می‌باشد.</p>
        </div>
    </section>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    @if (\App\Shop::first()->whatsapp)
        <a href="whatsapp://send?phone={{ \App\Shop::first()->whatsapp }}" class="float" target="_blank">
            <i class="fa fa-whatsapp my-float"></i>
        </a>
    @endif



</footer>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/js/swiper.min.js') }}"></script>
<script src="{{ asset('assets/vendor/slicknav/jquery.slicknav.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('assets/vendor/persianumber.min.js') }}"></script>
<script src="{{ asset('assets/vendor/elevatezoom.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="/assets/plugins/global/sweetalert/sweetalert.min.js" type="text/javascript"></script>
@include('sweet::alert')



<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>



@yield('footerScripts')

</body>

</html>
