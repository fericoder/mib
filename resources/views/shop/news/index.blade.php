@extends('shop.layouts.master', ['title' => 'اخبار' ])
@section('headerScripts')

    <style>
        .p-tabs {
            {{--  margin-top: 85px;  --}}
 position: relative;
            padding-top: 115px;
            line-height: 20px;
        }

        .p-tabs {
            margin-top: 0px;
            width: 100%;
        }

        .c-box-tabs {
            border: 0;
        }

        nav{
            text-align: center;
        }
        .pagination>li>a, .pagination>li>span{
            float: revert!important;
        }
    </style>





    <style>


        .cards {
            display: -webkit-flex;
            display: flex;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-top: 15px;
            padding: 1.5%;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .card {
            position: relative;
            margin-bottom: 20px;
            padding-bottom: 30px;
            background: #fefff9;
            color: #363636;
            text-decoration: none;
            -moz-box-shadow: rgba(0, 0, 0, 0.19) 0 0 8px 0;
            -webkit-box-shadow: rgba(0, 0, 0, 0.19) 0 0 8px 0;
            box-shadow: rgba(0, 0, 0, 0.19) 0 0 8px 0;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            border-radius: 4px;
        }

        @media (max-width: 700px) {
            .card {
                width: 100%;
            }
        }

        @media (min-width: 700px) {
            .card {
                max-width: 330px;
                min-width: 330px;
                margin-right: 20px;
                margin-bottom: 20px;
            }

            .card:nth-child(even) {
                margin-right: 0;
            }
        }

        @media (min-width: 980px) {
            .card:nth-child(even) {
                margin-right: 20px;
            }

            .card:nth-child(3n) {
                margin-right: 20px;
            }
        }

        .card span {
            display: block;
        }

        .card .card-summary {
            padding: 5% 5% 3% 5%;
        }

        .card .card-header {
            position: relative;
            height: 200px;
            overflow: hidden;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-color: rgba(255, 255, 255, 0.15);
            background-blend-mode: overlay;
            -moz-border-radius: 4px 4px 0 0;
            -webkit-border-radius: 4px;
            border-radius: 4px 4px 0 0;
        }

        .card .card-header:hover, .card .card-header:focus {
            background-color: rgba(255, 255, 255, 0);
        }

        .card .card-title {
            background: rgba(157, 187, 63, 0.85);
            padding: 3.5% 0 2.5% 0;
            color: white;
            text-transform: uppercase;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .card .card-title h3 {
            line-height: 1.2;
            padding: 0 3.5%;
            margin: 0;
        }

        .card .card-meta {
            max-height: 0;
            overflow: hidden;
            color: #666;
            text-transform: uppercase;
            position: absolute;
            bottom: 5%;
            padding: 0 5%;
            -moz-transition-property: max-height;
            -o-transition-property: max-height;
            -webkit-transition-property: max-height;
            transition-property: max-height;
            -moz-transition-duration: 0.4s;
            -o-transition-duration: 0.4s;
            -webkit-transition-duration: 0.4s;
            transition-duration: 0.4s;
            -moz-transition-timing-function: ease-in-out;
            -o-transition-timing-function: ease-in-out;
            -webkit-transition-timing-function: ease-in-out;
            transition-timing-function: ease-in-out;
        }

        .card:hover, .card:focus {
            background: white;
            -moz-box-shadow: rgba(0, 0, 0, 0.45) 0px 0px 20px 0px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.45) 0px 0px 20px 0px;
            box-shadow: rgba(0, 0, 0, 0.45) 0px 0px 20px 0px;
        }

        .card:hover .card-title, .card:focus .card-title {
            background: rgba(157, 187, 63, 0.95);
        }

        .card:hover .card-meta, .card:focus .card-meta {
            max-height: 1em;
        }


    </style>
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

                        <h2 class="c-params__headline"> اخبار<span>  </span></h2>
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
