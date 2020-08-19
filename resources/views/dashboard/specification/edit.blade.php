@extends('dashboard.layouts.master', ['title' => 'ویرایش خصوصیت'])

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

                <span class="kt-subheader__desc iranyekan">ویرایش خصوصیت</span>
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
                                ویرایش خصوصیت
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <!--begin: Datatable -->
                        <form action="{{ route('specifications.update', ['specification' => $specification, 'id' => $specification->id, 'shop' => $shop->english_name]) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="form-group mb-0">
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>نام خصوصیت:</span></div>
                                    <input type="text" class="form-control inputfield" name="name" value="{{ old('name', $specification->name) }}">
                                </div>
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>نام خصوصیت:</span></div>
                                    <input type="text" class="form-control inputfield" name="name_site" value="{{ old('name_site', $specification->name_site) }}">
                                </div>
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light inputfield min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>نحوه نمایش خصوصیت :</span>
                                    </div>
                                    <select class="form-control inputfield" name="type" id="">
                                        <option {{ $specification->type == 'checkbox' ? 'selected' : '' }} style="font-family: iranyekan!important;" value="checkbox">
                                            چند انتخابی
                                        </option>
                                        <option {{ $specification->type == 'radio' ? 'selected' : '' }} style="font-family: iranyekan!important;" value="radio">
                                            تک انتخابی
                                        </option>
                                    </select>
                                </div>
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i
                                                    class="fas fa-star required-star mr-1"></i>اولویت نمایش:</span></div>
                                    <input value="{{ $specification->order == null ? 0 : $specification->order }}" type="text" class="form-control inputfield" name="order"  Lang="en">
                                    <div class="input-group-append">

                                    </div>
                                </div>
                                <p class="text-danger mb-2 mt-2 text-bold">عدد بزرگتر به معنای اولویت بالاتر میباشد</p>
                            </div>
                            <!--end form-group-->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary rounded">ثبت درخواست</button>
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
