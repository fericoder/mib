@extends('shop.layouts.master', ['title' => $product->title ])
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
</style>
@section('content')
    <article class="c-product">
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


                            @if ($product->brand)
                                <li> <span>برند : </span> <a href="{{ route('shop.brand', $product->brand->id) }}" class="btn-link-spoiler">{{ $product->brand ?  $product->brand->name : '' }}</a></li>
                            @endif


                        </ul>
                    </div>


                    <div class="c-product__params">
                        <ul data-title="توضیحات محصول">
                            <div style="margin-top: 20px;width: 600px" class="quantity mt-3">
                                <p>{{ \Illuminate\Support\Str::limit($product->description, 300) }}</p>
                            </div>
                        </ul>
                    </div>




                </div>
                <div  class="c-product__summary">
                    <div class="c-product__delivery">
                        <div class="delivery-warehouse"> <i class="fa fa-truck"></i><span class="c-product__delivery-warehouse--no-lead-time">آماده ارسال</span></div>
                    </div>

                    @auth
                        <form action="{{ route('user-cart.add', ['shop'=> 'keyvan', 'userID'=> \Auth::user()->id]) }}" method="post">
                            @csrf

                            <div class="all">
                            <div class="all-items">
                            <div class="mb-1 all-selects">
                                @foreach($specifications->sortByDesc('order') as $specification)
                                    @if($specification->items->count() > 0)
                                        <div class="row py-1">
                                            <label style="font-size: 16px; margin: 10px; margin-bottom: 10px" class="py-1 mt-2">
                                                {{ $specification->name }} :
                                            </label>
                                        </div>
                                        <div class="row">
                                            <select class="js-example-basic-single select-{{ $loop->index }} item selectpicker selectItem" name="specification[]">
                                                @foreach($specification->items->where('status', 'enable')->intersect($items) as $item)
                                                            <option style="font-size: 10px" data-id="{{ $item->id }}" data-product="{{ $product->id }}" value="{{ $item->id }}">{{ $item->name }} <span>+ ( {{ $item->price }} تومان )</span></option>

                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                @endforeach
                            </div>


                        </div>
                    </div>
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <div style="margin-top: 20px;">
                                    <div style="text-align: center;margin-top: 30px;font-size: 20px" class="c-price original">{{ $product->status == 'enable' ? number_format($product->price) . 'تومان' : 'ناموجود' }}</div>
                                    <button style="margin: 65px;;  text-align: center" data-col="true" class="text-white btn bg-blue-omid iranyekan mt-5 rounded btn-add-to-cart"><i class="mdi mdi-cart mr-1"></i> اضافه به سبد خرید</button>
                            </div>
                        </form>
                    @endauth


                @guest
                        <a href="{{ route('register') }}">
                            <button type="button" class="btn btn-primary iranyekan rounded"><i class="mdi mdi-cart mr-1"></i> برای خرید ابتدا ثبت نام کنید </button>
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
        <section class="c-product__gallery">
            <div class="c-product__special-deal hidden">
                <div class="c-counter--special-deal"></div>
            </div>
            <div class="c-product__status-bar c-product__status-bar--out-of-stock hidden">ناموجود</div>
            <div class="c-gallery">
                <div class="c-gallery__item">

                    <div class="c-gallery__img"> <img src="{{ asset($product->image['original']) }}" class="xzoom" alt=""></div>
                </div>
                <ul style="display: none" class="c-gallery__items">
                    <li><img src="{{ asset('assets/images/119350700.jpg') }}" alt=""></li>
                    <li><img src="{{ asset('assets/images/119350696.jpg') }}" alt=""></li>
                    <li><img src="{{ asset('assets/images/119350706.jpg') }}" alt=""></li>
                    <li><img src="{{ asset('assets/images/119350704.jpg') }}" alt=""></li>
                </ul>
            </div>
        </section>
    </article>




    <section class="product-wrapper container">
        <div class="headline">
            <h3>محصولات مرتبط</h3></div>
        <div id="pslider" class="swiper-container swiper-container-horizontal swiper-container-rtl">
            <div class="product-box swiper-wrapper" style="transform: translate3d(277.6px, 0px, 0px); transition-duration: 0ms;height: 50vh;">
                @foreach ($categories->where('id', $product->category->id)->first()->products->take(10) as $product)
                    <div class="product-item swiper-slide swiper-slide-prev" style="height: 380px;width: 267.6px; margin-left: 10px;">
                        <a href="#"><img src="{{ asset($product->image['original']) }}" alt=""></a>
                        <a class="title" href="#">{{ $product->title }}</a>
                        <span class="price">{{ number_format($product->price) }} تومان</span>
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
            {{--<li class="c-box-tabs__tab"><a id="params" href="#"><i class="fa fa-tasks"></i> <span>مشخصات</span></a></li>--}}
            {{--<li class="c-box-tabs__tab"><a id="comments" href="#"><i class="fa fa-comments"></i> <span>نظرات کاربران</span></a></li>--}}
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
                            </div>
                        </div>
                    </section>

                </article>
            </div>
            <div id="params">
                <article>
                    <h2 class="c-params__headline"> مشخصات فنی <span>{{ $product->title }}</span></h2>
                    <section>
                        <h3 class="c-params__title">مشخصات کلی</h3>
                        <ul class="c-params__list">

                            {{--<li>--}}
                                {{--<div class="c-params__list-key"> <span class="block">ابعاد</span></div>--}}
                                {{--<div class="c-params__list-value"> <span class="block">9.5 × 75.5 × 153.9 میلی‌متر</span></div>--}}
                            {{--</li>--}}

                        </ul>
                    </section>
                </article>
            </div>
            <div id="comments">
                <div class="c-comments__summary">
                    <div class="c-comments__summary-note"> <span>شما هم می‌توانید در مورد این کالا نظر بدهید.</span>
                        <p>برای ثبت نظر، لازم است ابتدا وارد حساب کاربری خود شوید. اگر این محصول را قبلا از دیجی‌کالا خریده باشید، نظر شما به عنوان مالک محصول ثبت خواهد شد.</p> <a href="#" class="btn-add-comment is-disabled"><span>افزودن نظر جدید</span></a></div>
                </div>
                <div class="c-comments__filter">
                    <h4 class="c-faq__filter-title">نظرات کاربران</h4>

                </div>
                <div class="product-comment-list">
                    <ul class="c-comments__list">

    {{--<li>--}}
        {{--<section>--}}
            {{--<div class="aside">--}}
                {{--<div class="c-message-light c-message-light--purchased">خریدار این محصول</div>--}}
                {{--<div class="c-comments__user-shopping">--}}
    {{--<li>رنگ خریداری شده : قرمز</li>--}}
    {{--<li>خریداری شده از: دیجی کالا</li>--}}
    {{--</div>--}}
    {{--<div class="c-message-light c-message-light--opinion-noidea"> در مورد خرید این محصول مطمئن نیستم</div>--}}
    {{--</div>--}}
    {{--<div class="article">--}}
        {{--<div class="header"> <span>اصلاارزش نداردنخیر</span> <span>توسط جواد بیک پور در تاریخ ۱۱ آبان ۱۳۹۷</span></div>--}}
        {{--<div class="c-comments__evaluation">--}}
            {{--<div class="c-comments__evaluation-positive"> <span>نقاط قوت</span>--}}
                {{--<ul>--}}
                    {{--<li>رم و حافظه داخلی بالا</li>--}}
                {{--</ul>--}}
            {{--</div>--}}
            {{--<div class="c-comments__evaluation-negative"> <span>نقاط ضعف</span>--}}
                {{--<ul>--}}
                    {{--<li>باطری ضعیف</li>--}}
                    {{--<li>دوربین ضعیف در شب</li>--}}
                    {{--<li>قیمت بالا</li>--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<p>نخریداصلاخوب نیست</p>--}}
        {{--<div class="footer">--}}
            {{--<div class="c-comments__likes"> <span>آیا این نظر برایتان مفید بود؟</span>--}}
                {{--<button class="btn-like"> ۲۲ بله </button>--}}
                {{--<button class="btn-like"> ۴ خیر </button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}
    {{--</li>--}}
    </ul>
    <div class="c-pager">
        <ul class="c-pager__items">
            <li><a class="c-pager__item is-active" href="#">1</a></li>
            <li><a class="c-pager__item" href="#">2</a></li>
            <li><a class="c-pager__item" href="#">3</a></li>
            <li><a class="c-pager__item" href="#">4</a></li>
            <li><a class="c-pager__item" href="#">&gt;&gt;</a></li>
        </ul>
    </div>
    </div>
    </div>
    <div id="questions">
        <div class="c-faq__headline">پرسش و پاسخ <span>پرسش خود را در مورد محصول مطرح نمایید</span></div>
        <form action="#" class="c-form-faq">
            <textarea name="qa[body]" title="متن سوال" class="c-ui-textarea__field disabled" disabled=""></textarea>
            <div class="form-row">
                <button class="btn-tertiary">ثبت پرسش</button>
                <div class="agreement">
                    <input id="agree" type="checkbox">
                    <label for="agree"> اولین پاسخی که به پرسش من داده شد، از طریق ایمیل به من اطلاع دهید.
                        <br> با انتخاب دکمه “ثبت پرسش”، موافقت خود را با قوانین انتشار محتوا در دیجی کالا اعلام می کنم. </label>
                </div>
            </div>
        </form>
        <div class="c-comments__filter">
            <h4 class="c-faq__filter-title">نظرات کاربران</h4>
            <ul class="c-faq__filter-items" data-title="مرتب‌سازی بر اساس:">
                <li><a class="is-active" href="#">پرسش ها و پاسخ ها ( ۱ پرسش )</a></li>
                <li><a href="#">بیشترین پاسخ به پرسش های شما</a></li>
                <li><a href="#">جدیدترین پرسش ها</a></li>
                <li><a href="#">پرسش های شما</a></li>
            </ul>
        </div>
        <div id="product-questions-list">
            <ul class="c-faq__list">
                <li class="is-question">
                    <div class="section">
                        <div class="c-faq__header c-faq__header--question header">
                            <p class="h5"> پرسش <span>محمدامین Kor</span></p>
                        </div>
                        <p>سلام این گوشی الفون مدلp8 دوسیم کارته ظرفیت64 ایا رجستری شدس؟اگه نه میشه خودمون رجستریش کنیم؟</p>
                        <div class="footer"> <em>۸ شهریور ۱۳۹۷</em> <a href="#" class="btn-link-spoiler js-add-answer-btn">به این پرسش پاسخ دهید (۱ پاسخ) </a></div>
                    </div>
                </li>
                <li class="is-answer">
                    <div class="section">
                        <div class="header">
                            <p class="h5">پاسخ</p>
                        </div>
                        <div class="c-faq__answer-row">
                            <div class="c-faq__answer-col c-faq__answer-col--form"> <span class="h3">به این سوال پاسخ دهید</span>
                                <form action="#">
                                    <textarea></textarea>
                                    <div class="form-row">
                                        <button class="btn-default">ثبت پاسخ</button>
                                        <div class="agreement">
                                            <input id="agree" type="checkbox">
                                            <label for="agree">با انتخاب دکمه "ثبت پاسخ"، موافقت خود را با قوانین انتشار محتوا در دیجی‌کالا اعلام می‌کنم.</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="c-faq__answer-col c-faq__answer-col--rules"> <span class="h4">چگونه یک پاسخ مناسب بنویسیم ؟</span>
                                <ul class="c-faq__rules-list">
                                    <li> <span class="h5">قبلا از این محصول استفاده کرده‌اید؟</span>
                                        <p>همیشه بهتر است، به سوالاتی پاسخ بدهید که سوال شخصی شما پیش از این بوده و با تجربه یا تحقیق پاسخ آن را بدست آورده اید.</p>
                                    </li>
                                    <li> <span class="h5">خوانندگان خود را آموزش دهید</span>
                                        <p>اگر سوال پرسیده شده مربوط به تخصص یا تجربه شماست، بدون تعصب، پاسخ مرتبط را به شیوه ای که خواننده بتواند از آن استفاده کند، ارائه دهید.</p>
                                    </li>
                                    <li> <span class="h5">خودتان باشید، آموزنده باشید</span>
                                        <p>نظرات و انتقادات خودتان را بازگو کنید اما به یاد داشته باشید که نظراتتان باید منطقی باشد.</p>
                                    </li>
                                    <li> <span class="h5">مختصرگو باشید</span>
                                        <p>خلاق باشید اما موضوع نقد را فراموش نکنید، یک عنوان جذاب همیشه خوانندگان را جذب می کند.</p>
                                    </li>
                                    <li> <span class="h5">خوانا بنویسید</span>
                                        <p>یک ویرایش صحیح و کنترل املای صحیح کلمات اعتبار بیشتری به نقد و بررسی نوشته شده توسط شما می دهد. همچنین برای بالا رفتن خوانایی، فاصله بین پاراگراف ها و بالت گذاری را رعایت کنید.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="is-answer">
                    <div class="section">
                        <div class="header">
                            <p class="h5">پاسخ <span>حسن شفیعی</span></p>
                        </div>
                        <p>سلام گوشی نو هستش برادر میتونی بعد خرید مالکیت بزنی هیچ مشکلی نداره.. دسته دوم نیس که بگی رجیستر هس یا نه. شما از یه فروشگاه معتبر دیجی کالا خرید میکنی.</p>
                        <div class="footer"> <em>۲۱ مهر ۱۳۹۷</em>
                            <div class="c-faq__likes"> <span>آیا این پاسخ برایتان مفید بود ؟</span>
                                <button class="btn-like"> بله ۲۳ </button>
                                <button class="btn-like"> خیر ۵ </button>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    </div>
    </section>







    <div class="jump-to-up"> <i class="fa fa-chevron-up"></i> <span> بازگشت به بالا </span></div>

@stop

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
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


            $(document).on("select2:select", 'select', function(e) {
            e.preventDefault();
            var item_id = e.params.data.id;
          var product_id = $("option:selected").data('product');
          $.ajax({
              type: "post",
              url: window.location.origin +'/product/get-items',
              data: {
                item_id: item_id,
                product_id: product_id,
                  "_token": $('#csrf-token')[0].content //pass the CSRF_TOKEN()
              },
              success: function(data) {
                $( ".all-selects" ).empty();
                data.specifications.forEach(myFunction);
                  function myFunction(specification, index) {
                      var a = '<div class="row py-1"><label style="font-size: 16px; margin: 10px; margin-bottom: 10px" class="py-1 mt-2">'+specification.name+' :</label></div><div class="row"><select class="js-example-basic-single select-'+index+' test'+index+' item selectpicker selectItem" name="specification[]"> </div></div>';
                      $(".all-selects").append(a);

                      specification.items.forEach(test);
                      function test(value, inx) {
                        if(data.itemIds.includes(value.id.toString())){
                        var a = '<option style="font-size: 10px" data-id="'+value.id+'" data-product="{{  $product->id  }}" value="'+value.id+'">'+value.name+'<span></span></option></select>';
                        $(".test"+index).append(a).select2();
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

                      var a = '<div class="row py-1"><label style="font-size: 16px; margin: 10px; margin-bottom: 10px" class="py-1 mt-2">'+specification.name+' :</label></div><div class="row"><select class="js-example-basic-single select-'+index+' test'+index+' item selectpicker selectItem" name="specification[]"> </div></div>';
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
