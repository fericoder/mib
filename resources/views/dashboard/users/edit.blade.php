@extends('dashboard.layouts.master', ['title' => 'ویرایش مشتری'])

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

                <span class="kt-subheader__desc iranyekan">ویرایش مشتری</span>
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
                                ویرایش مشتری
                            </h3>

                        </div>


                    </div>

                    <div class="kt-portlet__body">
                        <!--begin: Datatable -->
                        <form method="post" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="mt-0 header-title">ویرایش مشتری</h3>
                                            <p class="text-muted mb-3">در این بخش میتوانید مشتری خود را ویرایش نمایید.</p><br>
                                            <div class="row">

                                                <div class="form-group mb-0 col-12">

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">نام :</span></div>
                                                        <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName', $user->fName) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">نام خانوادگی :</span></div>
                                                        <input type="text" class="form-control inputfield" name="lName" value="{{ old('lName', $user->lName) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">موبایل :</span></div>
                                                        <input type="text" class="form-control inputfield" name="mobile" value="{{ old('mobile', $user->mobile) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">وضعیت :</span></div>
                                                        <select class="form-control" name="status" id="">
                                                            <option {{ $user->status == 'enable' ? 'selected' : '' }} value="enable">تایید شده</option>
                                                            <option {{ $user->status == 'disable' ? 'selected' : '' }} value="disable">تایید نشده</option>
                                                        </select>
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">ایمیل :</span></div>
                                                        <input type="text" class="form-control inputfield" name="email" value="{{ old('email', $user->email) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">کد CRM :</span></div>
                                                        <input type="text" class="form-control inputfield" name="crm_id" value="{{ old('crm_id', $user->crm_id) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">شماره نظام پزشکی :</span></div>
                                                        <input type="text" class="form-control inputfield" name="pezeshkiNo" value="{{ old('pezeshkiNo', $user->pezeshkiNo) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">معرف :</span></div>
                                                        <input type="text" class="form-control inputfield" name="moarref" value="{{ old('moarref', $user->moarref) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">شغل :</span></div>
                                                        <input type="text" class="form-control inputfield" name="job" value="{{ old('job', $user->job) }}">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">تصویر کارت ملی :</span></div>
                                                        <a target="_blank" href="{{ $user->meliPic }}"><input style="width: 400px" disabled type="text" class="form-control inputfield" name="name" value="جهت مشاهده کلیک نمایید"></a>
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">تصویر گواهی نظام پزشکی :</span></div>
                                                        <a target="_blank" href="{{ $user->nezamPic }}"><input style="width: 400px" disabled type="text" class="form-control inputfield" name="name" value="جهت مشاهده کلیک نمایید"></a>
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">
                                                                تصویر جواز :</span></div>
                                                        <a target="_blank" href="{{ $user->javazPic }}"><input style="width: 400px" disabled type="text" class="form-control inputfield" name="name" value="جهت مشاهده کلیک نمایید"></a>
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


                            <div class="text-right mb-3">
                                <button data-toggle="modal" data-target="#AddWalletModal" type="submit" class="btn btn-success px-5 py-2  iranyekan rounded ">ثبت تغییرات</button><br>
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