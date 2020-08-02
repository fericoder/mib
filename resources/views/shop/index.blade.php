@extends('shop.layouts.master', ['title' => 'صفحه اصلی فروشگاه' ])

@section('content')
    <article class="main-article">
        <!--<div class="main-slider">
            <a class="slide-item" href="#" target="_blank" style="background-image: url(assets/images/slider/slide9.jpg)"> </a>
        </div>-->
        <div style="max-height: 450px!important;" id="mainslider" class="main-slider swiper-container">
            <div class="swiper-wrapper">
                <a href="#" target="_blank" class="slide-item swiper-slide" style="background-image: url(assets/images/slider/slide6.jpg)"> </a>
                <a href="#" target="_blank" class="slide-item swiper-slide" style="background-image: url(assets/images/slider/slide7.jpg)"> </a>
            </div>
            <div id="mslider-nbtn" class="swiper-button-next"></div>
            <div id="mslider-pbtn" class="swiper-button-prev"></div>
            <div class="swiper-pagination mainslider-btn"></div>
        </div>
        <aside class="c-adplacement">
            <a href="#"><img src="assets/images/slider/slide8.jpg" alt=""></a>
            <a href="#" ><img src="assets/images/slider/slide9.jpg" alt=""></a>
        </aside>
    </article>
    <div class="clear"></div>




    <section style="display: none" class="image-row container">
        <a href="#"><img src="assets/images/slider/slide11.jpg" alt=""></a>
        <a href="#"><img src="assets/images/slider/slide22.jpg" alt=""></a>
        <a href="#"><img src="assets/images/slider/slide33.jpg" alt=""></a>
        <a href="#"><img src="assets/images/slider/slide44.jpg" alt=""></a>
    </section>


    <section class="product-wrapper container">
        <div class="headline">
            <h3>محصولات شگفت انگیز </h3></div>
        <div id="vpslider" class="swiper-container">
            <div class="product-box swiper-wrapper">

                @foreach (\App\Product::orderBy('viewCount', 'desc')->limit(15)->get() as $product)
                    <div class="product-item swiper-slide">
                        <a href="{{ route('shop.product', $product->id) }}"><img  src="{{ asset($product->image['original']) }}" alt=""></a>
                        <a class="title" href="{{ route('shop.product', $product->id) }}"> {{ $product->title }} </a>
                        <span class="price">{{ $product->price }} تومان</span>
                    </div>
                @endforeach

            </div>
            <div id="vpslider-nbtn" class="slider-nbtn swiper-button-next"></div>
            <div id="vpslider-pbtn" class="slider-pbtn swiper-button-prev"></div>
        </div>
    </section>


    <section class="product-wrapper container">
        <div class="headline">
            <h3>محصولات پربازدید </h3></div>
        <div id="vpslider" class="swiper-container">
            <div class="product-box swiper-wrapper">

                @foreach (\App\Product::orderBy('viewCount', 'desc')->limit(15)->get() as $product)
                    <div class="product-item swiper-slide">
                        <a href="{{ route('shop.product', $product->id) }}"><img  src="{{ asset($product->image['original']) }}" alt=""></a>
                        <a class="title" href="{{ route('shop.product', $product->id) }}"> {{ $product->title }} </a>
                        <span class="price">{{ $product->price }} تومان</span>
                    </div>
                @endforeach

            </div>
            <div id="vpslider-nbtn" class="slider-nbtn swiper-button-next"></div>
            <div id="vpslider-pbtn" class="slider-pbtn swiper-button-prev"></div>
        </div>
    </section>

    <section class="product-wrapper container">
        <div class="headline two-headline">
            <h3> جدیدترین کالاها</h3> </div>
        <div id="newpslider" class="swiper-container">
            <div class="product-box swiper-wrapper">
                @foreach (\App\Product::orderBy('id', 'desc')->limit(15)->get() as $product)
                    <div class="product-item swiper-slide">
                        <a href="{{ route('shop.product', $product->id) }}"><img  src="{{ asset($product->image['original']) }}" alt=""></a>
                        <a class="title" href="{{ route('shop.product', $product->id) }}"> {{ $product->title }} </a>
                        <span class="price">{{ $product->price }} تومان</span>
                    </div>
                @endforeach
            </div>
            <div id="newpslider-nbtn" class="slider-nbtn swiper-button-next"></div>
            <div id="newpslider-pbtn" class="slider-pbtn swiper-button-prev"></div>
        </div>
    </section>
    <section class="product-wrapper container">
        <div class="headline">
            <h3>محصولات پرفروش</h3></div>
        <div id="mostpslider" class="swiper-container">
            <div class="product-box swiper-wrapper">
                @foreach (\App\Product::orderBy('buyCount', 'desc')->limit(15)->get() as $product)
                    <div class="product-item swiper-slide">
                        <a href="{{ route('shop.product', $product->id) }}"><img  src="{{ asset($product->image['original']) }}" alt=""></a>
                        <a class="title" href="{{ route('shop.product', $product->id) }}"> {{ $product->title }} </a>
                        <span class="price">{{ $product->price }} تومان</span>
                    </div>
                @endforeach

            </div>
            <div id="mostpslider-nbtn" class="slider-nbtn swiper-button-next"></div>
            <div id="mostpslider-pbtn" class="slider-pbtn swiper-button-prev"></div>
        </div>
    </section>

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
    <div class="jump-to-up"> <i class="fa fa-chevron-up"></i> <span> بازگشت به بالا </span></div>
@stop
