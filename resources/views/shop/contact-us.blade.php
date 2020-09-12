@extends('shop.layouts.master', ['title' => 'درباره ما' ])
@section('headerScripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .p-tabs {
        margin-top: 85px;
        position: relative;
        padding-top: 115px;
        line-height: 20px;
    }
    .c-content-expert__summary:after {
        width: 0px;
    }
    .p-tabs{
        width: 100%;
    }
    .flex{
           display: flex;
          width: 100%;
         justify-content: space-between;
    }
    .c-content-expert{
        display: flex;
    width: 100%;
    justify-content: space-around;
    padding: 80px;
    flex-wrap: wrap;
    }
    .border-bottom {
        border-bottom: 1px solid #dee2e6!important;
        padding: 25px 0;
    }
    .flex-rev{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .font-20{
        font-size: 15px;
    }
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
</style>
@stop

@section('content')
    <div class="c-product">
    <section style="padding-top: 30px;" class="p-tabs">
        <h2 class="c-params__headline" style="margin-right: 40px">راه های ارتباطی با شرکت ایده برتر کیوان</h2>

            <div id="desc" class="c-content-expert is-active">
                <div class="flex-rev">
                    <div class="border-bottom"><i class="fa fa-phone" style="font-size:48px;color:#f05562"></i></div>
                    <div class="d-flex justify-content-center p-4 font-20" style="padding: 20px 0;">
                        {{ $shop->phone }}
                      </div>
                </div>
                <div class="flex-rev">
                    <div class="border-bottom"><i class="fa fa-address-card" style="font-size:48px; color:#03bfd6"></i></div>
                    <div class="d-flex justify-content-center p-4 font-20" style="padding: 20px 0;">
                        {{ $shop->address }}
                      </div>
                </div>
                <div class="flex-rev">
                    <div class="border-bottom"><i class="fa fa-envelope" style="font-size:48px;color:#f05562"></i></div>
                    <div class="d-flex justify-content-center p-4 font-20" style="padding: 20px 0;">
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
