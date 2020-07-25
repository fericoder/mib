@extends('dashboard.layouts.master', ['title' => 'صفحه اصلی'])
@section('content')
    <style>
        .kt-timeline-v2__item-time {
            font-size: 12px !important;
            padding-top: 5px !important;
            font-family: BYekan !important;
        }
    </style>








    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">

                <h3 class="kt-subheader__title">داشبورد </h3>

                <span class="kt-subheader__separator kt-subheader__separator--v"></span>

                <span class="kt-subheader__desc iranyekan">صفحه اصلی</span>
            </div>

        </div>
    </div>
    <!-- end:: Content Head -->
    <!-- begin:: Content -->
    <div style="" class="kt-container  kt-grid__item kt-grid__item--fluid">



        <div class="kt-portlet">
            <div class="kt-portlet__body  kt-portlet__body--fit">
                <div class="row row-no-padding row-col-separator-lg">

                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::Total Profit-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        تعداد کالاهای موجود
                                    </h4>
                                </div>

                                <span class="kt-widget24__stats kt-font-brand">
                                            {{ \App\Product::all()->count() }} محصول
                                        </span>
                            </div>

                            <div class="progress progress--sm">
                                <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end::Total Profit-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::New Feedbacks-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        سفارشات امروز
                                    </h4>
                                </div>

                                <span class="kt-widget24__stats kt-font-warning">
                                        ۰ سفارش
					                      </span>
                            </div>

                            <div class="progress progress--sm">
                                <div class="progress-bar kt-bg-warning" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>


                        </div>
                        <!--end::New Feedbacks-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::New Orders-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        سفارشات این ماه
                                    </h4>

                                </div>

                                <span  class="kt-widget24__stats kt-font-danger">
۰ سفارش
                                </span>
                            </div>

                            <div class="progress progress--sm">
                                <div class="progress-bar kt-bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                        </div>
                        <!--end::New Orders-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::New Users-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        حجم مالی فروش سال
                                    </h4>
                                </div>

                                <span  class="kt-widget24__stats kt-font-success">
۰ تومان
                                        </span>
                            </div>

                            <div class="progress progress--sm">
                                <div class="progress-bar kt-bg-success" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                        </div>
                        <!--end::New Users-->
                    </div>

                </div>
            </div>
        </div>






    </div>
    <!-- end:: Content -->
    </div>
    </div>

@stop
