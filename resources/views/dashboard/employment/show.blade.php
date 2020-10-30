@extends('dashboard.layouts.master', ['title' => 'مشاهده روزمه'])

@section('headerScripts')
    <link href="/assets/plugins/custom/datatables/datatables.bundle.rtl.css" rel="stylesheet" type="text/css"/>

    <style>
        a, span {
            font-family: byekan !important;
        }
        .dataTables_info{
            font-family: BYekan;
        }
        select{
            font-family: BYekan;
        }
        td{
            vertical-align: middle!important;
        }

        td, th{
            vertical-align: middle!important;
            font-family: iranyekan;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow, .select2-container--default .select2-selection--multiple .select2-selection__arrow{
            font-family: "LineAwesome"!important;
        }
    </style>
@stop


@section('content')








    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container ">
            <div class="kt-subheader__main">

                <h3 class="kt-subheader__title">داشبورد مدیریت </h3>

                <span class="kt-subheader__separator kt-subheader__separator--v"></span>

                <span class="kt-subheader__desc iranyekan">مشاهده روزمه</span>
            </div>

        </div>
    </div>
    <!-- end:: Content Head -->
    <!-- begin:: Content -->
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
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
                                مشاهده روزمه
                            </h3>

                        </div>


                    </div>

                    <div class="kt-portlet__body">
                        <!--begin: Datatable -->
                        <form method="post" action="" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="mt-0 header-title">مشاهده روزمه</h3>
                                            <div class="row">

                                                <div class="form-group mb-0 col-12">

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">نام :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->fName) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">نام خانوادگی :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->lName) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">نام پدر :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->fatherName) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">شماره شناسنامه :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->shshenasname) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">شماره ملی :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->shmeli) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">محل صدور :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->issue) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">محل تولد :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->birthCity) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">تاریخ تولد :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->birthdate) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">وضعیت تاهل :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->tahol) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">تعداد افراد تحت تکلف :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->takallof) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">نشانی محل سکونت :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->address) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">تلفن تماس همراه :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->mobile) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">تلفن تماس ثابت :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->phone) }}">
                                                    </div>
                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">تلفن تماس اضطراری :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->phonezaroori) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">آدرس ایمیل :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->email) }}">
                                                    </div>
                                                    
                                                    
                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">میزان آشنایی با زبان خارجی :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->language) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">نحوه آشنایی با مجموعه :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->ashnaei) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">مدت زمان همکاری آزمایشی (ماه) :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->azmayeshiMonths) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">حقوق دریافتی مورد انتظار :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $employment->hoghoogh) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">فایل رزومه :</span></div>
                                                        <a target="_blank" href="{{ asset($employment->rezume) }}"><input style="width: 400px" disabled type="text" class="form-control inputfield" name="name" value="جهت مشاهده کلیک نمایید"></a>
                                                    </div>



                                                </div>


                                            </div>

                                        </div>


                                        <!--end card-body-->
                                    </div>
                                    <!--end card-->
                                </div>
                                <!--end col-->

                                <!--end col-->
                            </div>


                            <div class="text-right mb-3 mt-3">
                                <a href="{{ route('employment.index') }}" class="btn btn-warning px-5 py-2  iranyekan rounded ">بازگشت</a>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- end:: Content -->

@stop


@section('footerScripts')
    <script src="/assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>

    <script>


        //datatables


    </script>

    <!--begin::Page Scripts -->
    <script>
        var DatatablesExtensionButtons = {
            init: function () {
                var t;
                t = $("#m_table_2").DataTable({
                        "searching": true,
                        scrollY:"50vh",scrollX:!0,scrollCollapse:!0,
                        responsive: !0,

                        buttons: ["print", "copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
                    }
                ),
                    $("#export_print").on("click", function (e) {
                            e.preventDefault(), t.button(0).trigger()
                        }
                    ),
                    $("#export_copy").on("click", function (e) {
                            e.preventDefault(), t.button(1).trigger()
                        }
                    ),
                    $("#export_excel").on("click", function (e) {
                            e.preventDefault(), t.button(2).trigger()
                        }
                    ),
                    $("#export_csv").on("click", function (e) {
                            e.preventDefault(), t.button(3).trigger()
                        }
                    ),
                    $("#export_pdf").on("click", function (e) {
                            e.preventDefault(), t.button(4).trigger()
                        }
                    )



            }
        };
        jQuery(document).ready(function () {
                DatatablesExtensionButtons.init()
            }
        );

        $("#show").click(function () {
            $("#edu").toggle('slow');
        });

    </script>
    <!--end::Page Scripts -->
    <script src="/assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>

@stop