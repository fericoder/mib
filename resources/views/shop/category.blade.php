@extends('shop.layouts.master', ['title' => isset($category->name) ? $category->name : 'جستجو کالا' ])

@section('content')
    <section class="search container">
        <div style="margin-top: 46px;" class="o-page__aside">
            <div class="c-listing-sidebar">
                <div class="c-box">
                    <div class="c-box__header">جستجو :</div>
                    <div class="c-box__content">
                        <form id="searchForm" action="{{ route('shop.search') }}">
                            <input type="text" name="keyword" value="{{ isset($keyword) ? $keyword : '' }}" placeholder="نام محصول مورد نظر را بنویسید…">
                            <input type="hidden" name="category"  value="{{ isset($category) ? $category->id : '' }}">
                            <input type="hidden" name="sortBy" id="sortBy" value="created_at">
                        </form>
                    </div>
                </div>
                {{--<div class="c-box">--}}
                    {{--<div class="c-filter c-filter--switcher">--}}
                        {{--<span>فقط کالاهای موجود</span>--}}
                        {{--<div class="scroll">--}}
                            {{--<span id="circle">--}}
                                {{--<input id="circle_input" type="checkbox">--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

            </div>
        </div>
        <div class="o-page__content">
            <article>
                <nav>
                    <ul class="c-breadcrumb">
                        <li><span style="font-size: 16px">
                                 {{ $category ? "نام دسته بندی: $category->name" : '' }}
                            </span></li>
                    </ul>
                </nav>
                <div class="c-listing">
                    <div class="c-listing__header">
                        <ul class="c-listing__sort" data-label="مرتب‌سازی بر اساس :">
                            <li><span>مرتب سازی بر اساس :</span></li>
                            <li><a {{ \Request::get('sortBy') == 'created_at' ? "class=is-active" : ''  }} onclick="newest()" >جدیدترین</a></li>
                            <li><a {{ \Request::get('sortBy') == 'viewCount' ? "class=is-active" : ''  }} onclick="highestView()" >پربازدیدترین</a></li>
                            <li><a {{ \Request::get('sortBy') == 'buyCount' ? "class=is-active" : ''  }} onclick="highestSell()" >پرفروش ترین</a></li>
                            {{--<li><a onclick="cheapest()" >ارزان ترین</a></li>--}}
                            {{--<li><a onclick="expensive()" >گران ترین</a></li>--}}
                        </ul>
                    </div>
                    <ul class="c-listing__items">
                        @foreach ($productsPaginate as $product)
                            <li>
                                <div class="c-product-box c-promotion-box ">
                                    <a href="{{ route('shop.product', $product->id) }}" class="c-product-box__img c-promotion-box__image"><img src="{{ asset($product->image['original']) }}" alt=""></a>
                                    <div class="c-product-box__content">
                                        <a href="{{ route('shop.product', $product->id) }}" class="title">{{ $product->title }}</a>
                                        <span class="price">
                                            @auth()
                                                @if (\Auth::user()->status === 'enable')
                                                    {{ $product->status == 'enable' ? number_format($product->price) . 'تومان' : 'ناموجود' }}
                                                @endif
                                            @endauth
                                                </span>
                                    </div>
                                    <div style="display: none" class="c-product-box__tags">
                                        <span class="c-tag c-tag--rate">۳.۹</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                    <div class="c-pager d-flex">
                            {!! $productsPaginate->render() !!}
                    </div>
                </div>
            </article>
        </div>
    </section>
    <div class="jump-to-up"> <i class="fa fa-chevron-up"></i> <span> بازگشت به بالا </span></div>



    <script>

        function highestView(){
            $('#sortBy').val('viewCount');
            document.getElementById('searchForm').submit();
        }

        function newest(){
            $('#sortBy').val('created_at');
            document.getElementById('searchForm').submit();
        }

        function highestSell(){
            $('#sortBy').val('buyCount');
            document.getElementById('searchForm').submit();
        }

        // function cheapest(){
        //     $('#sortBy').val('price');
        //     document.getElementById('searchForm').submit();
        // }
        //
        // function expensive(){
        //     $('#sortBy').val('expensive');
        //     document.getElementById('searchForm').submit();
        // }



    </script>
@stop
@section('footerScripts')
    <script>
        $(window).on("load", function() {
            $('.pagination').addClass("d-flex");

           });


    </script>
@endsection
