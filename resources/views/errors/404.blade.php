@extends('shop.layouts.master', ['title' => isset($brand->name) ? $brand->name : 'جستجو کالا' ])

@section('content')
    <section class="search container">
        <div style="margin-top: 46px;" class="o-page__aside">
            <div class="c-listing-sidebar">

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
        <div style="flex: 0 0 99.8%;" class="o-page__content">
            <article>
                <nav>
                    <ul class="c-breadcrumb">
                        <li><span style="font-size: 16px">
{{--                                 {{ $brand ? "نام برند: $brand->name" : '' }}--}}
                            </span></li>
                    </ul>
                </nav>
                <div class="c-listing">

                    <ul class="c-listing__items">

                            <p style="margin: auto; margin-top: 50px; margin-bottom: 50px">صفحه مورد نظر یافت نشد.</p>




                    </ul>


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

