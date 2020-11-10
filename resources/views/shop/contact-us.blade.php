@extends('shop.layouts.master', ['title' => 'درباره ما' ])
@section('headerScripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('/assets/css/pages/contact.css') }}">

@stop

@section('content')
    <div class="container">
    <section  class="p-tabs pt10">
        <h2 class="c-params__headline marr40" >راه های ارتباطی با شرکت ایده برتر کیوان</h2>

            <div id="desc" class="c-content-expert is-active">
                <div class="flex-rev">
                    <div class="border-bottom"><i class="fa fa-phone bbb" ></i></div>
                    <div class="d-flex justify-content-center p-4 font-20" >
                        {{ $shop->phone }}
                      </div>
                </div>
                <div class="flex-rev">
                    <div class="border-bottom"><i class="fa fa-address-card addresscard" ></i></div>
                    <div class="d-flex justify-content-center p-4 font-20 divphone" >
                        {{ $shop->address }}
                      </div>
                </div>
                <div class="flex-rev">
                    <div class="border-bottom"><i class="fa fa-envelope emailI" ></i></div>
                    <div class="d-flex justify-content-center p-4 font-20 divphone" >
                        {{ $shop->email }}
                      </div>
                </div>
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
