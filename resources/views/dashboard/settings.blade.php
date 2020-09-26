@extends('dashboard.layouts.master', ['title' => 'تنظیمات فروشگاه'])
@section('content')
    <style>
        .kt-timeline-v2__item-time {
            font-size: 12px !important;
            padding-top: 5px !important;
            font-family: BYekan !important;
        }
        .kt-checkbox{
            margin-right: 20px;
        }
    </style>








    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">

                <h3 class="kt-subheader__title">داشبورد </h3>

                <span class="kt-subheader__separator kt-subheader__separator--v"></span>

                <span class="kt-subheader__desc iranyekan">تنظیمات فروشگاه</span>
            </div>

        </div>
    </div>
    <!-- end:: Content Head -->
    <!-- begin:: Content -->
    <div style="" class="kt-container  kt-grid__item kt-grid__item--fluid">





        <div class="row">
            <div class="col-xl-12">



                @if ($errors->any())
                    <div style="background-color: #e47474" class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif



                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                تنظیمات سیستم
                            </h3>

                        </div>
                    </div>

                    <div class="kt-portlet__body">
                        <!--begin: Datatable -->
                        <form method="post" action="{{ route('settings.updatee', ['id' => 1]) }}‌" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="mt-0 header-title">تنظیمات صفحه اصلی</h3>
                                            <div class="row ">
                                                <div class="col-lg-12 ">

                                                    <div class="form-group mt-5 row">
                                                        <div class="col-9">
                                                            <div class="kt-checkbox-inline">
                                                                <label class="kt-checkbox"><input {{ $shop->shegeft == 'on' ? 'checked' : '' }} name="shegeft" type="checkbox"> محصولات شگفت انگیز<span></span></label>
                                                                <label class="kt-checkbox"><input {{ $shop->porbazdid == 'on' ? 'checked' : '' }} name="porbazdid" type="checkbox"> محصولات پربازدید<span></span></label>
                                                                <label class="kt-checkbox"><input {{ $shop->jadidtarin == 'on' ? 'checked' : '' }} name="jadidtarin" type="checkbox"> جدیدترین کالاها<span></span></label>
                                                                <label class="kt-checkbox"><input {{ $shop->porforoosh == 'on' ? 'checked' : '' }} name="porforoosh" type="checkbox"> محصولات پرفروش<span></span></label>
                                                                <label class="kt-checkbox"><input {{ $shop->brands == 'on' ? 'checked' : '' }} name="brands" type="checkbox"> برندها<span></span></label>
                                                            </div>
                                                        </div>
                                                    </div>





                                                    {{--<div class="form-group row">--}}
                                                        {{--<label style="text-align: center" for="example-email-input" class="col-sm-2 col-form-label text-center">نام خانوادگی</label>--}}
                                                        {{--<div class="col-sm-10">--}}
                                                            {{--<input class="form-control" type="text" name="lastName" disabled value="{{ old('lastName', \Auth::user()->lastName) }}">--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}



                                                </div>

                                            </div>

                                        </div>

                                        <!--end card-body-->
                                    </div>
                                    <!--end card-->
                                </div>


                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="mt-0 header-title">تنظیمات خرید</h3>
                                            <div class="row ">
                                                <div class="col-lg-12 ">

                                                    <div class="form-group mt-5 row">
                                                        <div class="col-9">
                                                            <div class="kt-checkbox-inline">
                                                                <label class="kt-checkbox"><input {{ $shop->pardakhtDarMahal == 'on' ? 'checked' : '' }} name="pardakhtDarMahal" type="checkbox"> پرداخت در محل<span></span></label>
                                                                <label class="kt-checkbox"><input {{ $shop->pardakhtBaDargah == 'on' ? 'checked' : '' }} name="pardakhtBaDargah" type="checkbox"> پرداخت با درگاه بانک<span></span></label>
                                                            </div>
                                                        </div>

                                                        <div class="input-group mt-3">
                                                            <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>توضیحات تکمیل سفارش :</span></div>
                                                            <textarea class="form-control" id="checkOutDescription" name="checkOutDescription">{{ old('checkOutDescription', $shop->checkOutDescription) }}</textarea>
                                                        </div>


                                                    </div>





                                                    {{--<div class="form-group row">--}}
                                                    {{--<label style="text-align: center" for="example-email-input" class="col-sm-2 col-form-label text-center">نام خانوادگی</label>--}}
                                                    {{--<div class="col-sm-10">--}}
                                                    {{--<input class="form-control" type="text" name="lastName" disabled value="{{ old('lastName', \Auth::user()->lastName) }}">--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}



                                                </div>

                                            </div>

                                        </div>

                                        <!--end card-body-->
                                    </div>
                                    <!--end card-->
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="mt-0 header-title">تنظیمات تماس با ما</h3>
                                            <div class="row ">
                                                <div class="col-lg-12 ">
                                                    <div class="form-group mt-5 row">
                                                        <div class="input-group mt-3">
                                                            <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">شماره تماس :</span></div>
                                                            <input type="text" class="form-control inputfield" name="phone" value="{{ old('phone', $shop->phone) }}">

                                                        </div>
                                                        <div class="input-group mt-3">
                                                            <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">ایمیل :</span></div>
                                                            <input type="text" class="form-control inputfield" name="email" value="{{ old('email', $shop->email) }}">                                                        </div>
                                                        <div class="input-group mt-3">
                                                            <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">آدرس :</span></div>
                                                            <textarea class="form-control" name="address">{{ old('address', $shop->address) }}</textarea>
                                                        </div>


                                                    </div>





                                                    {{--<div class="form-group row">--}}
                                                    {{--<label style="text-align: center" for="example-email-input" class="col-sm-2 col-form-label text-center">نام خانوادگی</label>--}}
                                                    {{--<div class="col-sm-10">--}}
                                                    {{--<input class="form-control" type="text" name="lastName" disabled value="{{ old('lastName', \Auth::user()->lastName) }}">--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}



                                                </div>

                                            </div>

                                        </div>

                                        <!--end card-body-->
                                    </div>
                                    <!--end card-->
                                </div>

                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="mt-0 header-title">شبکه های اجتماعی</h3>
                                            <div class="row ">
                                                <div class="col-lg-12 ">
                                                    <div class="form-group mt-5 row">
                                                        <div class="input-group mt-3">
                                                            <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">تلگرام :</span></div>
                                                            <input type="text" class="form-control inputfield" name="telegram" value="{{ old('telegram', $shop->telegram) }}">

                                                        </div>
                                                        <div class="input-group mt-3">
                                                            <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">اینستاگرام :</span></div>
                                                            <input type="text" class="form-control inputfield" name="instagram" value="{{ old('instagram', $shop->instagram) }}">
                                                        </div>

                                                        <div class="input-group mt-3">
                                                            <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">توییتر :</span></div>
                                                            <input type="text" class="form-control inputfield" name="twitter" value="{{ old('twitter', $shop->twitter) }}">
                                                        </div>

                                                        <div class="input-group mt-3">
                                                            <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">یوتیوب :</span></div>
                                                            <input type="text" class="form-control inputfield" name="youtube" value="{{ old('youtube', $shop->youtube) }}">
                                                        </div>

                                                        <div class="input-group mt-3">
                                                            <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">واتساپ :</span></div>
                                                            <input type="text" class="form-control inputfield" name="whatsapp" value="{{ old('whatsapp', $shop->whatsapp) }}">
                                                        </div>


                                                    </div>


                                                </div>

                                            </div>

                                        </div>

                                        <!--end card-body-->
                                    </div>
                                    <!--end card-->
                                </div>





                            </div>

                            <div class="text-right mb-3">
                                <button  type="submit" class="btn btn-success px-5 py-2  iranyekan rounded ">ثبت تغییرات</button><br>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>





    </div>
    <!-- end:: Content -->
    </div>
    </div>

@stop
@section('footerScripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <!--end::Page Scripts -->
    <script type="text/javascript">
        CKEDITOR.replace('body', {
            language: 'fa',
            uiColor: '#F3F6F7',
        });

    </script>
@stop
