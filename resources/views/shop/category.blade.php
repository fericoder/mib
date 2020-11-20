@extends('shop.layouts.master', ['title' => isset($category->name) ? $category->name : 'نتایج جستجو' ])
    @if(isset($keyword))
        <style>
         .page__contentflex{
              flex: 0 0 99.8%!important;
         }
        </style>
@endif
@section('content')
    <section class="search container">
        @if (!isset($keyword))
            <div class="o-page__aside">
                <div class="c-listing-sidebar">
                    <div style="margin-top: 45px" class="c-box">

                        <form style="display: none" id="searchForm" action="{{ route('shop.search') }}">
                            <input type="text" name="keyword" value="{{ isset($keyword) ? $keyword : '' }}" placeholder="نام محصول مورد نظر را بنویسید…">
                            <input type="hidden" name="category"  value="{{ isset($category) ? $category->id : '' }}">
                            <input type="hidden" name="sortBy" id="sortBy" value="created_at">
                        </form>


                        <div class="c-box__header">زیر دسته ها:</div>
                        <div class="c-box__content">
                            <ul style="font-size: 13px">
                                @foreach (\App\Category::all()->where('parent_id', $category->id) as $subSubCategory)
                                    <ul>
                                        <li style="margin-top: 15px" class="limarri" >
                                            <a class="amegma" href="{{ route('shop.category', $subSubCategory->id) }}">- {{ $subSubCategory->name }}</a>
                                        </li>
                                    </ul>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="o-page__content page__contentflex">
            <article>
                <nav>
                    <ul class="c-breadcrumb">
                        <li><span class="brandName" >
                                 {{ $category ? "نام دسته بندی: $category->name" : '' }}
                            </span></li>
                    </ul>

                </nav>
                <div class="c-listing">
                    <div class="c-listing__header">
                        <ul class="c-listing__sort" data-label="مرتب‌سازی بر اساس :">
                            <li><span>مرتب سازی بر اساس :</span></li>
                            <li><a {{ \Request::get('sortBy') == 'created_at' ? "class=is-active" : ''  }} {{ \Request::get('sortBy') == null ? 'class=is-active' : '' }} onclick="newest()" >جدیدترین</a></li>
                            <li><a {{ \Request::get('sortBy') == 'viewCount' ? "class=is-active" : ''  }} onclick="highestView()" >پربازدیدترین</a></li>
                            <li><a {{ \Request::get('sortBy') == 'buyCount' ? "class=is-active" : ''  }} onclick="highestSell()" >پرفروش ترین</a></li>
                            {{--<li><a onclick="cheapest()" >ارزان ترین</a></li>--}}
                            {{--<li><a onclick="expensive()" >گران ترین</a></li>--}}
                        </ul>
                        <p style="margin-left: 20px">تعداد نتایج: {{ $total }}</p>
                    </div>
                    <ul class="c-listing__items">

                        @if ($productsPaginate->count() === 0)
                            <p class="notFound" >محصولی یافت نشد.</p>
                        @endif

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
                                    <div class="c-product-box__tags dnoneprod">
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
