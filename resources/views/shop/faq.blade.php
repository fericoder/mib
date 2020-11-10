@extends('shop.layouts.master', ['title' => 'سوالات متداول' ])
@section('headerScripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('/assets/css/pages/faq.css') }}">

@stop

@section('content')
    <div class=" container">
    <section  class="p-tabs pt30">
        <h2 class="c-params__headline mr40" >سوالات متداول</h2>
        @foreach($faqs as $faq)
            <div id="desc" class="c-content-expert is-active">
                <button class="collapsible card tar" >{{ $faq->question }}</button>
                <div class="content">
                  <p class="pp15" >{{ $faq->answer }}</p>
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
