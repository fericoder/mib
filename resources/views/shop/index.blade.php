@extends('shop.layouts.master', ['title' => 'صفحه اصلی فروشگاه' ])

@section('content')
    <article class="main-article container">
        <!--<div class="main-slider">
            <a class="slide-item" href="#" target="_blank" style="background-image: url(assets/images/slider/slide9.jpg)"> </a>
        </div>-->
        <div id="mainslider" class="main-slider swiper-container mainsliderrr">
            <div class="swiper-wrapper">
                @foreach (\App\Banner::where('location', 'slider')->get() as $banner)
                    <a href="{{ $banner->url }}" target="_blank" class="slide-item swiper-slide" style="background-image: url( &quot; {{ asset($banner->slide_path) }} &quot; )"> </a>
                @endforeach
            </div>
            <div id="mslider-nbtn" class="swiper-button-next"></div>
            <div id="mslider-pbtn" class="swiper-button-prev"></div>
            <div class="swiper-pagination mainslider-btn"></div>
        </div>
        <aside class="c-adplacement">
            <a href="{{ \App\Banner::where('id', 4)->first()->url }}"><img src="{{ \App\Banner::where('id', 4)->first()->slide_path }}" alt=""></a>
            <a href="{{ \App\Banner::where('id', 5)->first()->url }}"><img src="{{ \App\Banner::where('id', 5)->first()->slide_path }}" alt=""></a>
        </aside>
    </article>
    <div class="clear"></div>



    <section style="/*! display: none; */" class="image-row container">
        <a href="#"><img src="https://mibdental.com/wp-content/uploads/2020/01/shortcut.png" alt=""></a>
        <a href="#"><img src="https://mibdental.com/wp-content/uploads/2020/01/shortcut.png" alt=""></a>
        <a href="#"><img src="https://mibdental.com/wp-content/uploads/2020/01/shortcut.png" alt=""></a>
        <a href="#"><img src="https://mibdental.com/wp-content/uploads/2020/01/shortcut.png" alt=""></a>
    </section>



    @if ($shop->shegeft)
        <section class="product-wrapper container">
            <div class="headline">
                <h3>محصولات شگفت انگیز </h3></div>
            <div id="vpslider" class="swiper-container">
                <div class="product-box swiper-wrapper">

                    @foreach (\App\Product::where('shegeftangiz', 'on')->limit(15)->get() as $product)
                        <div class="product-item swiper-slide">
                            <a href="{{ route('shop.product', $product->id) }}"><img  src="{{ asset($product->image['original']) }}" alt=""></a>
                            <a class="title" href="{{ route('shop.product', $product->id) }}"> {{ $product->title }} </a>
                            <span class="price">
                                @auth()
                                    @if (\Auth::user()->status === 'enable')
                                        {{ $product->price }} تومان
                                    @endif
                                @endauth
                            </span>
                        </div>
                    @endforeach

                </div>
                <div id="vpslider-nbtn" class="slider-nbtn swiper-button-next"></div>
                <div id="vpslider-pbtn" class="slider-pbtn swiper-button-prev"></div>
            </div>
        </section>
    @endif


    @if ($shop->porbazdid)
        <section class="product-wrapper container">
            <div class="headline">
                <h3>محصولات پربازدید </h3>
            </div>
            <div id="viewCount" class="swiper-container">
                <div class="product-box swiper-wrapper">

                    @foreach (\App\Product::orderBy('viewCount', 'desc')->limit(15)->get() as $product)
                        <div class="product-item swiper-slide">
                            <a href="{{ route('shop.product', $product->id) }}"><img  src="{{ asset($product->image['original']) }}" alt=""></a>
                            <a class="title" href="{{ route('shop.product', $product->id) }}"> {{ $product->title }} </a>
                            <span class="price">
                                @auth()
                                    @if (\Auth::user()->status === 'enable')
                                        {{ $product->price }} تومان
                                    @endif
                                @endauth
                            </span>
                        </div>
                    @endforeach

                </div>
                <div id="viewCount-nbtn" class="slider-nbtn swiper-button-next"></div>
                <div id="viewCount-pbtn" class="slider-pbtn swiper-button-prev"></div>
            </div>
        </section>
    @endif


    @if ($shop->jadidtarin)
        <section class="product-wrapper container">
            <div class="headline two-headline">
                <h3> جدیدترین کالاها</h3> </div>
            <div id="newpslider" class="swiper-container">
                <div class="product-box swiper-wrapper">
                    @foreach (\App\Product::orderBy('id', 'desc')->limit(15)->get() as $product)
                        <div class="product-item swiper-slide">
                            <a href="{{ route('shop.product', $product->id) }}"><img  src="{{ asset($product->image['original']) }}" alt=""></a>
                            <a class="title" href="{{ route('shop.product', $product->id) }}"> {{ $product->title }} </a>
                            <span class="price">
                                @auth()
                                    @if (\Auth::user()->status === 'enable')
                                        {{ $product->price }} تومان
                                    @endif
                                @endauth
                            </span>
                        </div>
                    @endforeach
                </div>
                <div id="newpslider-nbtn" class="slider-nbtn swiper-button-next"></div>
                <div id="newpslider-pbtn" class="slider-pbtn swiper-button-prev"></div>
            </div>
        </section>
    @endif

    @if ($shop->porforoosh)
        <section class="product-wrapper container">
            <div class="headline">
                <h3>محصولات پرفروش</h3></div>
            <div id="mostpslider" class="swiper-container">
                <div class="product-box swiper-wrapper">
                    @foreach (\App\Product::orderBy('buyCount', 'desc')->limit(15)->get() as $product)
                        <div class="product-item swiper-slide">
                            <a href="{{ route('shop.product', $product->id) }}"><img  src="{{ asset($product->image['original']) }}" alt=""></a>
                            <a class="title" href="{{ route('shop.product', $product->id) }}"> {{ $product->title }} </a>
                            <span class="price">
                                @auth()
                                    @if (\Auth::user()->status === 'enable')
                                        {{ $product->price }} تومان
                                    @endif
                                @endauth
                            </span>
                        </div>
                    @endforeach

                </div>
                <div id="mostpslider-nbtn" class="slider-nbtn swiper-button-next"></div>
                <div id="mostpslider-pbtn" class="slider-pbtn swiper-button-prev"></div>
            </div>
        </section>
    @endif

    @if ($shop->brands)
        <section class="product-wrapper container">
            <div class="headline">
                <h3>برندها</h3></div>
            <div id="brandslider" class="swiper-container">
                <div class="product-box swiper-wrapper">

                    @foreach (\App\Brand::take(10)->get() as $brand)
                        <div class="product-item swiper-slide">
                            <a href="{{ route('shop.brand', $brand->id) }}"><img src="{{ asset($brand->icon['original']) }}" alt=""></a>
                        </div>

                    @endforeach


                </div>
                <div id="brandslider-nbtn" class="slider-nbtn swiper-button-next"></div>
                <div id="brandslider-pbtn" class="slider-pbtn swiper-button-prev"></div>
            </div>
        </section>
    @endif


        <section class="product-wrapper container">
            <div class="headline">
                <a href="{{ route('shop.blogs') }}"> <h3>آخرین مقالات</h3></a>
            </div>
            <div id="blogslider" class="swiper-container">
                <div class="product-box swiper-wrapper">

                    @foreach (\App\Blog::where('type', 'article')->take(10)->get() as $blog)
                        <div class="product-item swiper-slide">
                            <a href="{{ route('shop.blog', $blog->id) }}"><img src="{{ asset($blog->image) }}" alt=""></a>
                            <a class="title" href="{{ route('shop.blog', $blog->id) }}"> {{ $blog->title }} </a>
                        </div>

                    @endforeach


                </div>
                <div id="blogslider-nbtn" class="slider-nbtn swiper-button-next"></div>
                <div id="blogslider-pbtn" class="slider-pbtn swiper-button-prev"></div>
            </div>
        </section>

    <section class="product-wrapper container">
        <div class="headline">
            <a href="{{ route('shop.news') }}"> <h3>آخرین اخبار</h3></a>
        </div>
        <div id="newslider" class="swiper-container">
            <div class="product-box swiper-wrapper">

                @foreach (\App\Blog::where('type', 'news')->take(10)->get() as $blog)
                    <div class="product-item swiper-slide">
                        <a href="{{ route('shop.news', $blog->id) }}"><img src="{{ asset($blog->image) }}" alt=""></a>
                        <a class="title" href="{{ route('shop.news', $blog->id) }}"> {{ $blog->title }} </a>
                    </div>

                @endforeach


            </div>
            <div id="newslider-nbtn" class="slider-nbtn swiper-button-next"></div>
            <div id="newslider-pbtn" class="slider-pbtn swiper-button-prev"></div>
        </div>
    </section>




    <div class="jump-to-up"> <i class="fa fa-chevron-up"></i> <span> بازگشت به بالا </span></div>
@stop
