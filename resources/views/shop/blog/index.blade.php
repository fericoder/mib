@extends('shop.layouts.master', ['title' => 'مقالات' ])
@section('headerScripts')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/blog.css') }}">
@stop

@section('content')
    <div class="c-product">
        <section style="padding-top: 0px;" class="p-tabs">
            <ul class="c-box-tabs" style="display: block;  text-align: center;  font-size: 15px;">
                <li class="c-box-tabs__tab is-active"><a id="desc" href="#"><i class="fa fa-glasses"></i> <span></span></a>
                </li>
            </ul>
            <div class="c-box--tabs p-tabs__content">
                <div id="desc" class="c-content-expert is-active">

                        <h2 class="c-params__headline"> مقالات<span>  </span></h2>
                        <section class="">
                            <div class="c-mask">
                                <div class="c-mask__text c-mask__text--product-summary" style="height: unset;">
                                    <div class="container">
                                        <div class="cards">
                                            @foreach ($blogs as $blog)
                                                <a class="card" href="{{ route('shop.blog',$blog->id ) }}">
                                                    <span class="card-header" style="background-image: url( &quot; {{ $blog->image }} &quot; );"></span>
                                                    <span class="card-summary">{{ $blog->title }}</span>
                                                    <span style="font-size: 16px; margin-bottom: 30px" class="card-summary">{{ $blog->description }}</span>
                                                    <span  class="card-meta">مشاهده ادامه</span>
                                                </a>
                                            @endforeach

                                        </div>
                                        </div>

                                </div>
                                {{ $blogs->links() }}


                            </div>
                            </div>
                </div>
        </section>

    </div>

    </div>
    </section>

    <div class="jump-to-up"><i class="fa fa-chevron-up"></i> <span> بازگشت به بالا </span></div>

@stop

@section('footerScripts')


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script type="text/javascript" src="/assets/js/simple-lightbox.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@stop
