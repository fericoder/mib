@extends('shop.layouts.master', ['title' => $product->title ])

@section('headerScripts')
    <link href='/assets/css/simplelightbox.min.css' rel='stylesheet' type='text/css'>


    <style>
        .select2-container{
            width: 300px!important;
            direction: rtl;
            text-align: right;
        }
        .select2-selection__rendered{
            font-size: 14px;
        }
        .select2-results__option{
            font-size: 14px;
        }
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .sl-next{
            direction: ltr!important;
        }
        .sl-prev{
            direction: ltr!important;
        }
    </style>

@stop
@section('content')



    <div id="myModal" class="modal" style="z-index: 1000000;">
        <!-- Modal content -->
        <div style="margin-top: 100px" class="modal-content register login account-box">
            <span class="close">&times;</span>
            <div class="content">
                <form style="width: 30%!important;" method="POST" action="/comment">
                    @csrf

                    <label style="margin-top: 10px" for="pwd">متن نظر:<span style="color: red;    font-size: 15px;">*</span></label>
                    <textarea style="margin: 10px; font-size: 15px" class="form-control" name="comment" id="" cols="50" rows="5"></textarea>
                    <input type="hidden" name="parent_id" value="0">
                    <input type="hidden" name="commentable_id" value="{{ $product->id }}">
                    <input type="hidden" name="commentable_type" value="{{ get_class($product) }}">


                    <button style="margin-top: 30px; margin-bottom: 20px" type="submit"><i class="fa fa-lock-open"></i>ثبت نظر</button>
                </form>
            </div>
        </div>

    </div>


    <div class="c-product">
        <section class="c-product__info">
            <div class="c-product__headline">
                <h1 class="c-product__title"> <span class="fa-title"> {{ $product->title }} </span> </h1>
            </div>
            <div class="c-product__attributes">
                <div class="c-product__right">
                    <div class="c-product__directory">
                        <ul>
                            <li>
                                <span>دسته بندی : </span>
                                @if($product->category->parent != null)
                                    @if ($product->category->parent->parent)
                                        <a href="{{ route('shop.category', $product->category->parent->parent->id) }}" class="btn-link-spoiler">{{ $product->category->parent->parent->name }}</a>
                                        <span style="font-size: 14px;">></span>
                                    @endif

                                    @if ($product->category->parent)
                                        <a href="{{ route('shop.category', $product->category->parent->id) }}" class="btn-link-spoiler">{{ $product->category->parent->name }}</a>
                                        <span style="font-size: 14px;">></span>
                                    @endif
                                    <a href="{{ route('shop.category', $product->category->id) }}" class="btn-link-spoiler">{{ $product->category->name }}</a>
                            </li>
                            @endif

                            @if ($product->brand)
                                <li> <span>برند : </span> <a href="{{ route('shop.brand', $product->brand->id) }}" class="btn-link-spoiler">{{ $product->brand ?  $product->brand->name : '' }}</a></li>
                            @endif

                            @if ($product->country_id)
                                <li style="margin-top: 10px"> <span>کشور سازنده : </span> <a href="" class="btn-link-spoiler">{{ $product->country->nicename }}</a></li>
                            @endif


                        </ul>
                    </div>


                    <div class="c-product__params">
                        <ul data-title="توضیحات محصول">
                            <div style="margin-top: 20px;" class="quantity mt-3">
                                <p style="max-width: 450px;"> {{ $product->shortDescription }}</p>

                                @if ($product->catalog)
                                    <a target="_blank" href="{{ asset($product->catalog) }}"><img style="width: 200px; margin: 30px" src="/assets/images/catalog.png" alt=""></a>
                                @endif

                            </div>
                        </ul>
                    </div>




                </div>
                <div  class="c-product__summary">
                    <div class="c-product__delivery">
                        <div class="delivery-warehouse"> <i class="fa fa-truck"></i><span class="c-product__delivery-warehouse--no-lead-time">آماده ارسال</span></div>
                    </div>


                    @auth
                        <form action="{{ route('user-cart.add', ['userID'=> \Auth::user()->id]) }}" method="post">
                            @endauth
                            @csrf

                            @if($product->no_specification_status == 'disable')
                            <div class="all">
                                <div class="all-items">
                                    <div class="mb-1 all-selects">
                                        @foreach($specifications->sortByDesc('order') as $specification)
                                            @if($specification->items->count() > 0)
                                                <div class="row py-1">
                                                    <label style="font-size: 16px; margin: 10px; margin-bottom: 10px" class="py-1 mt-2">
                                                        {{ $specification->name_site != null ?  $specification->name_site  : $specification->name}} :
                                                    </label>
                                                </div>
                                                <div class="row">
                                                    <select class="js-example-basic-single select-{{ $loop->index }} item selectpicker selectItem" name="specification[]">
                                                        @foreach($specification->items->where('status', 'enable')->intersect($items) as $item)
                                                            <option style="font-size: 10px" data-id="{{ $item->id }}" data-product="{{ $product->id }}" value="{{ $item->id }}">{{ $item->name }}</option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif

                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <div style="margin-top: 20px;">
                                @if ($product->userPrice === 'on')
                                    @auth()
                                        @if (\Auth::user()->status === 'enable')
                                            <div style="text-align: center;margin-top: 30px;font-size: 20px" class="c-price original">{{ $product->status == 'enable' ? number_format($product->price) . ' تومان ' : 'ناموجود' }}</div>
                                        @else
                                            <div style="text-align: center;margin-top: 30px;font-size: 15px; margin-bottom: 30px;" class="c-price original">حساب کاربری شما تایید نشده است</div>
                                        @endif
                                    @endauth
                                @else
                                    <div style="text-align: center;margin-top: 30px;font-size: 20px" class="c-price original">{{ $product->status == 'enable' ? number_format($product->price) . ' تومان ' : 'ناموجود' }}</div>
                                @endif
                                @auth()
                                    @if (\Auth::user()->status === 'enable')
                                        <button style="margin: 65px;    width: 180px;;  text-align: center" data-col="true" class="text-white btn bg-blue-omid iranyekan mt-5 rounded btn-add-to-cart"><i class="mdi mdi-cart mr-1"></i> اضافه به سبد خرید</button>
                                    @endif
                                @endauth
                            </div>
                        </form>


                        @guest
                            <a href="{{ route('register') }}">
                                <button style="margin: 65px; width: 189px" type="button" class="btn btn-primary iranyekan rounded"><i class="mdi mdi-cart mr-1"></i> ابتدا ثبت نام کنید </button>
                            </a>
                        @endguest
                </div>
            </div>
            <aside style=";" class="c-product__feature">
                <a class="i-item" href="#"> <img src="{{ asset('assets/images/icon/i1.svg') }}" alt=""> <span>امکان تحویل اکسپرس</span> </a>
                <a class="i-item" href="#"> <img src="{{ asset('assets/images/icon/i2.svg') }}" alt=""> <span>پشتیبانی ۲۴ ساعته</span> </a>
                {{-- <a class="i-item" href="#"> <img src="{{ asset('assets/images/icon/i3.svg') }}" alt=""> <span>امکان پرداخت در محل</span> </a> --}}
                <a class="i-item" href="#"> <img src="{{ asset('assets/images/icon/i4.svg') }}" alt=""> <span>۷ روز ضمانت بازگشت کالا</span> </a>
                <a class="i-item" href="#"> <img src="{{ asset('assets/images/icon/i5.svg') }}" alt=""> <span>ضمانت اصل بودن کالا</span> </a>
            </aside>
        </section>

        <div class="col-lg-6"><img src="{{ asset($product->image['400,400'] ? $product->image['400,400'] : '/images/no-image.png') }}" alt="" class="col-8 d-block img-thumbnail" style="max-height: 37em;    max-width: 33em;    margin: 10px;    margin-top: 60px;">
            <div class="gallery mt-4 mr-4">
                @foreach ($galleries as $gallery)
                    <a href="/{{ $gallery->filename }}"><img width="100px" class="img-thumbnail" src="/{{ $gallery->filename }}" alt="" title="" /></a>
                @endforeach
            </div>
        </div>

        {{--<section class="c-product__gallery">--}}
        {{--<div class="c-product__special-deal hidden">--}}
        {{--<div class="c-counter--special-deal"></div>--}}
        {{--</div>--}}
        {{--<div class="c-product__status-bar c-product__status-bar--out-of-stock hidden">ناموجود</div>--}}
        {{--<div class="c-gallery">--}}
        {{--<div class="c-gallery__item">--}}
        {{--<div class="c-gallery__img"> <img src="{{ asset($product->image['original']) }}"  alt=""></div>--}}
        {{--</div>--}}
        {{--<ul style="" class="c-gallery__items">--}}
        {{--@foreach ($galleries as $gallery)--}}
        {{--<li><img src="{{ asset( $gallery->filename) }}" alt=""></li>--}}
        {{--@endforeach--}}
        {{--</ul>--}}
        {{--</div>--}}
        {{--</section>--}}
    </div>




    <section class="product-wrapper container">
        <div class="headline">
            <h3>محصولات مرتبط</h3></div>
        <div id="pslider" class="swiper-container swiper-container-horizontal swiper-container-rtl">
            <div class="product-box swiper-wrapper" style="transform: translate3d(277.6px, 0px, 0px); transition-duration: 0ms;height: 50vh;">
                @foreach ($categories->where('id', $product->category->id)->first()->products->take(10) as $Relatedproduct)
                    <div class="product-item swiper-slide swiper-slide-prev" style="height: 380px;width: 267.6px; margin-left: 10px;">
                        <a href="{{ route('shop.product', $Relatedproduct->id) }}"><img src="{{ asset($Relatedproduct->image['original']) }}" alt=""></a>
                        <a class="title" href="{{ route('shop.product', $Relatedproduct->id) }}">{{ $Relatedproduct->title }}</a>
                        <span class="price">
                            @auth()
                                @if (\Auth::user()->status === 'enable')
                                    {{ number_format($Relatedproduct->price) }} تومان
                                @endif
                            @endauth
                        </span>
                    </div>
                @endforeach
            </div>
            <div id="pslider-nbtn" class="slider-nbtn swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"></div>
            <div id="pslider-pbtn" class="slider-pbtn swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="false"></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
    </section>








    <section class="p-tabs">
        <ul class="c-box-tabs">
            <li class="c-box-tabs__tab is-active"><a id="desc" href="#"><i class="fa fa-glasses"></i> <span>توضیحات محصول</span></a></li>
            <li class="c-box-tabs__tab"><a id="comments" href="#"> <span>نظرات کاربران</span></a></li>
            @if(isset($product->aparat))
                <li class="c-box-tabs__tab"><a id="video" href="#"> <span>ویدیو محصول</span></a></li>

             @endif
        </ul>
        <div class="c-box--tabs p-tabs__content">
            <div id="desc" class="c-content-expert is-active">
                <article>
                    <h2 class="c-params__headline"> نقد و بررسی اجمالی <span> {{ $product->title }} </span></h2>
                    <section class="c-content-expert__summary">
                        <div class="c-mask">
                            <div class="c-mask__text c-mask__text--product-summary" style="max-height: 250px;height: unset;">
                                <p>
                                    {{ $product->description }}
                                </p>

                                <div style="margin-top: 100px; margin-right: 250px">
                                    @if ($product->aparat)
                                        <a target="_blank" href="{{ $product->aparat  }}"><button class="button">مشاهده ویدیو</button></a>
                                    @endif


                                </div>

                            </div>
                        </div>
                    </section>

                </article>
            </div>

            <div id="comments">
                <div class="c-comments__summary">
                    <div class="c-comments__summary-note"> <span>شما هم می‌توانید در مورد این کالا نظر بدهید.</span>
                        @auth()
                            <a id="myBtn" style="margin: 30px; top: 30px"  class="btn-add-comment is-disabled">
                                <span>افزودن نظر جدید</span>
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="c-comments__filter">
                    <h4 class="c-faq__filter-title">نظرات کاربران</h4>
                </div>
                <div class="product-comment-list">
                    <ul class="c-comments__list">

                        @foreach ($product->comments->where('approved', '1')->where('parent_id', '0') as $comment)
                            <li>
                                <section>
                                    <div class="article">
                                        <div class="header">
                                            <span style="    font-size: 17px; font-family: BYekan; direction: ltr">توسط
                                                {{ $comment->user->fName . ' ' . $comment->user->lName }}
                                                در تاریخ
                                                {{ jdate($comment->created_at)->format('Y/m/d h:i:s') }}
                                            </span>
                                        </div>

                                        <p>
                                            {{ $comment->comment }}
                                        </p>
                                    </div>
                                </section>
                            </li>
                        @endforeach


                    </ul>

            </div>
            </div>



            @if(isset($product->aparat))
                <div id="video">
                    <div class="c-comments__summary">
                        <div style=" margin: auto" class="c-comments__summary-note">
                            {!! $product->aparat !!}
                        </div>
                    </div>
                </div>
            @endif


                </div>
            </section>







    <div class="jump-to-up"> <i class="fa fa-chevron-up"></i> <span> بازگشت به بالا </span></div>


@stop

@section('footerScripts')


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script type="text/javascript" src="/assets/js/simple-lightbox.min.js"></script>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}

    <script>
        $(document).ready(function() {

            $(".js-example-basic-single").val(null).trigger("change");
            $('.js-example-basic-single').select2({
                placeholder: {
                    text: 'لطفا یک مورد انتخاب کنید'
                },
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var $gallery = $('.gallery a').simpleLightbox();
        });

        $(document).ready(function() {

            var previous = [];
            $(document).on("select2:select", 'select', function(e) {
                previous.push(this.value);
                e.preventDefault();
                var item_id = e.params.data.id;
                var select = $("select");
                var valArray = [];
                select.each(function(index){
                    valArray.push($(this).val());
                });
                var product_id = $("option:selected").data('product');
                $.ajax({
                    type: "post",
                    url: window.location.origin +'/product/get-items',
                    data: {
                        item_id: valArray,
                        product_id: product_id,
                        "_token": $('#csrf-token')[0].content //pass the CSRF_TOKEN()
                    },
                    success: function(data) {
                        $( ".all-selects" ).empty();
                        data.specifications.forEach(myFunction);
                        function myFunction(specification, index) {
                            if(specification.name_site == null){
                                var specificationName = specification.name;
                            }
                            else{
                                var specificationName = specification.name_site;
                            }
                            var a = '<div class="row py-1"><label style="font-size: 16px; margin: 10px; margin-bottom: 10px" class="py-1 mt-2">'+specificationName+' :</label></div><div class="row"><select class="js-example-basic-single select-'+index+' test'+index+' item selectpicker selectItem" name="specification[]"> </div></div>';
                            $(".all-selects").append(a);
                            specification.items.forEach(test);
                            function test(value, inx) {
                                if(data.itemIds.includes(value.id.toString())){
                                    var a = '<option style="font-size: 10px" data-id="'+value.id+'" data-product="{{  $product->id  }}" value="'+value.id+'">'+value.name+'<span></span></option></select>';
                                    $(".test"+index).append(a).select2().val(previous);
                                    $('.js-example-basic-single').select2({
                                        placeholder: {
                                            text: 'لطفا یک مورد انتخاب کنید'
                                        },
                                        allowClear: true
                                    });

                                }

                            }

                        }

                    }
                });

            });
            previous = [];
        });


    </script>
    <script>
        $(document).ready(function() {


            $(document).on("select2:unselecting", 'select', function(e) {

                e.preventDefault();
                var product_id = {{ $product->id }};
                $.ajax({
                    type: "post",
                    url: window.location.origin +'/product/get-items',
                    data: {
                        item_id: null,
                        product_id: product_id,
                        "_token": $('#csrf-token')[0].content //pass the CSRF_TOKEN()
                    },
                    success: function(data) {
                        $( ".all-selects" ).empty();
                        data.specifications.forEach(specificationArray);
                        function specificationArray(specification, index) {
                            if(specification.name_site == null){
                                var specificationName = specification.name;
                            }
                            else{
                                var specificationName = specification.name_site;
                            }
                            var a = '<div class="row py-1"><label style="font-size: 16px; margin: 10px; margin-bottom: 10px" class="py-1 mt-2">'+specificationName+' :</label></div><div class="row"><select class="js-example-basic-single select-'+index+' test'+index+' item selectpicker selectItem" name="specification[]"> </div></div>';
                            $(".all-selects").append(a);

                            specification.items.forEach(wsw);
                            function wsw(value, inx) {
                                if(data.itemIds.includes(value.id.toString())){
                                    var a = '<option style="font-size: 10px" data-id="'+value.id+'" data-product="{{  $product->id  }}" value="'+value.id+'">'+value.name+'<span></span></option></select>';
                                    $(".test"+index).append(a).select2({
                                        placeholder: {
                                            text: 'لطفا یک مورد انتخاب کنید'
                                        }
                                    });
                                    $('.js-example-basic-single').select2({
                                        placeholder: {
                                            text: 'لطفا یک مورد انتخاب کنید'
                                        }
                                    });
                                    $(".js-example-basic-single").val(null).trigger("change");

                                }
                            }
                        }

                    }

                });
            });
        });



    </script>
@stop
