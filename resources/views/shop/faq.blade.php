@extends('shop.layouts.master', ['title' => 'سوالات متداول' ])
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
    padding: 10px;
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
        .collapsible {
          background-color: #777;
          color: white;
          cursor: pointer;
          padding: 18px;
          width: 100%;
          border: none;
          text-align: left;
          outline: none;
          font-size: 15px;
        }

        .active, .collapsible:hover {
          background-color: #555;
          color: white
        }

        .collapsible:after {
          content: '\002B';
          color: white;
          font-weight: bold;
          float: right;
          margin-left: 5px;
        }

        .active:after {
          content: "\2212";
        }

        .content {
          padding: 0 18px;
          max-height: 0;
          overflow: hidden;
          transition: max-height 0.2s ease-out;
          background-color: #f1f1f1;
        }
        .card{
            background-color: #fff;
    border-radius: 5px;
    -webkit-box-shadow: 0 2px 4px 0 rgba(0,0,0,.1);
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.1);
    border: 1px solid #e4e4e4;
    color: #555
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
    <section class="p-tabs">
        <ul class="c-box-tabs"  style="display: block;
        text-align: center;
        font-size: 15px;">
            <li class="c-box-tabs__tab is-active"><a id="desc" href="#"><i class="fa fa-glasses"></i> <span>پرسش های متداول </span></a></li>
        </ul>
        <h2 class="c-params__headline" style="margin-right: 40px">سوالات متداول</h2>
        @foreach($faqs as $faq)
            <div id="desc" class="c-content-expert is-active">
                <button class="collapsible card" style="text-align: right">{{ $faq->question }}</button>
                <div class="content">
                  <p style="padding: 15px">{{ $faq->answer }}</p>
                </div>
             </div>
             @endforeach

                </div>
            </section>

    <div class="jump-to-up"> <i class="fa fa-chevron-up"></i> <span> بازگشت به بالا </span></div>

@stop

@section('footerScripts')


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script type="text/javascript" src="/assets/js/simple-lightbox.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
          coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight){
              content.style.maxHeight = null;
            } else {
              content.style.maxHeight = content.scrollHeight + "px";
            }
          });
        }
        </script>

@stop
