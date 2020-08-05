@extends('shop.layouts.master', ['title' => isset($brand->name) ? $brand->name : 'جستجو کالا' ])

@section('content')
    <section class="search container">
        <div style="margin-top: 46px;" class="o-page__aside">
            <div class="c-listing-sidebar">
                <div class="c-box">
                    <div class="c-box__header">جستجو :</div>
                    <div class="c-box__content">
                        <form action="{{ route('shop.search') }}">
                            <input type="text" name="keyword" value="{{ isset($keyword) ? $keyword : '' }}" placeholder="نام محصول مورد نظر را بنویسید…">
                            <input type="hidden" name="category"  value="{{ isset($category) ? $category->id : '' }}">
                        </form>
                    </div>
                </div>
                <div class="c-box">
                    <div class="c-filter c-filter--switcher">
                        <span>فقط کالاهای موجود</span>
                        <div class="scroll">
                            <span id="circle">
                                <input id="circle_input" type="checkbox">
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="o-page__content">
            <article>
                <nav>
                    <ul class="c-breadcrumb">
                        <li><span style="font-size: 16px">
                                 {{ $brand ? "نام برند: $brand->name" : '' }}
                            </span></li>
                    </ul>
                </nav>
                <div class="c-listing">
                    <div class="c-listing__header">
                        <ul class="c-listing__sort" data-label="مرتب‌سازی بر اساس :">
                            <li><span>مرتب سازی بر اساس :</span></li>
                            <li><a href="#" class="is-active">پربازدیدترین</a></li>
                            <li><a href="#">جدیدترین</a></li>
                            <li><a href="#">پرفروش ترین</a></li>
                            <li><a href="#">ارزان ترین</a></li>
                            <li><a href="#">گران ترین</a></li>
                        </ul>
                    </div>
                    <ul class="c-listing__items">
                        @foreach ($products as $product)
                            <li>
                                <div class="c-product-box c-promotion-box ">
                                    <a href="{{ route('shop.product', $product->id) }}" class="c-product-box__img c-promotion-box__image"><img src="{{ asset($product->image['original']) }}" alt=""></a>
                                    <div class="c-product-box__content">
                                        <a href="{{ route('shop.product', $product->id) }}" class="title">{{ $product->title }}</a>
                                        <span class="price">{{ $product->status == 'enable' ? number_format($product->price) . 'تومان' : 'ناموجود' }}</span>
                                    </div>
                                    <div style="display: none" class="c-product-box__tags">
                                        <span class="c-tag c-tag--rate">۳.۹</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                    <div class="c-pager">
                        <ul class="c-pager__items">
                            <li><a class="c-pager__item is-active" href="#">1</a></li>
                            <li><a class="c-pager__item" href="#">2</a></li>
                            <li><a class="c-pager__item" href="#">3</a></li>
                            <li><a class="c-pager__item" href="#">4</a></li>
                            <li><a class="c-pager__item" href="#">>></a></li>
                        </ul>
                    </div>
                </div>
            </article>
        </div>
    </section>
    <div class="jump-to-up"> <i class="fa fa-chevron-up"></i> <span> بازگشت به بالا </span></div>
@stop
