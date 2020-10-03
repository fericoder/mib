@extends('shop.layouts.master', ['title' => $blog->title ])
@section('headerScripts')

    <link rel="stylesheet" href="{{ asset('assets/css/pages/blog.css') }}">
@stop

@section('content')
    <div class="c-product">
    <section class="p-tabs bip0">
        <ul class="c-box-tabs bicbox">
            <li class="c-box-tabs__tab is-active"><a id="desc" href="#"><i class="fa fa-glasses"></i> <span></span></a></li>
        </ul>
        <div class="c-box--tabs p-tabs__content">
            <div id="desc" class="c-content-expert is-active">

                <article>
                    <h2 class="c-params__headline"> {{ $blog->title }}<span>  </span></h2>
                    <section class="c-content-expert__summary">
                        <div class="c-mask">
                            <div class="c-mask__text c-mask__text--product-summary unsetst">
                                <p>
                                    {!! $blog->body !!}
                                </p>

                            </div>
                            <img class="mar100" src="{{ $blog->image }}" alt="">
                        </div>

                                </div>

                       </section>
                  </article>
            </div>

                </div>
            </section>

    <div class="jump-to-up"> <i class="fa fa-chevron-up"></i> <span> بازگشت به بالا </span></div>

@stop

@section('footerScripts')


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script type="text/javascript" src="/assets/js/simple-lightbox.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@stop
