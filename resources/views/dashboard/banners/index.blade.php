@extends('dashboard.layouts.master', ['title' => 'مدیریت بنر ها'])

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




    <div class="modal fade bd-example-modal-xl " id="AddBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">افزودن بنر جدید </h5>
                    <button type="button" class="close rounded" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-scroll" style="background-color:#fbfcfd">
                    <form action="{{ route('banner.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group mb-0">

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"> <i class="fas fa-star required-star mr-1"></i>عنوان :</span></div>
                                <input type="text" class="form-control inputfield" value="{{ old('title' ) }}" name="title" >
                            </div>



                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"> لینک :</span></div>
                                <input type="text" class="form-control inputfield" value="{{ old('url' ) }}" name="url" >
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"> مکان :</span></div>
                                <select class="form-control inputfield" name="location" id="">
                                    <option style="font-family: iranyekan!important;" value="slider">اسلایدر</option>
                                    <option style="font-family: iranyekan!important;" value="other">کنار اسلایدر</option>
                                </select>
                            </div>




                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i> تصویر :</span></div>
                                <div class="col-lg-6">
                                    <input  type="file" name="image" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="customFile">انتخاب فایل</label>
                                </div>
                            </div>





                        </div>
                        <!--end form-group-->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger rounded" data-dismiss="modal">انصراف</button>
                    <div class="group">
                        <button type="submit" class="btn btn-primary rounded">ثبت درخواست</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>






    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container ">
            <div class="kt-subheader__main">

                <h3 class="kt-subheader__title">داشبورد مدیریت </h3>

                <span class="kt-subheader__separator kt-subheader__separator--v"></span>

                <span class="kt-subheader__desc iranyekan">مدیریت بنر ها</span>
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
                                لیست بنر ها
                            </h3>
                            <button data-toggle="modal" data-target="#AddBrandModal" style="margin-right: 20px;" type="button" class="btn btn-sm btn-outline-success">افزودن بنر ها جدید</button>
                        </div>

                        <div style="" class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-toolbar-wrapper">
                                <div class="dropdown dropdown-inline">
                                    <button style="" type="button" class="btn btn-brand btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-plus"></i> ابزار ها و خروجی ها
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="kt-nav">
                                            <li class="kt-nav__section kt-nav__section--first">
                                                <span class="kt-nav__section-text">انواع خروجی ها</span>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link" id="export_print">
                                                    <i class="kt-nav__link-icon la la-print"></i>
                                                    <span class="kt-nav__link-text">چاپ</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link" id="export_copy">
                                                    <i class="kt-nav__link-icon la la-copy"></i>
                                                    <span class="kt-nav__link-text">کپی</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link" id="export_excel">
                                                    <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                    <span class="kt-nav__link-text">اکسل</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link" id="export_csv">
                                                    <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                    <span class="kt-nav__link-text">CSV</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link" id="export_pdf">
                                                    <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                    <span class="kt-nav__link-text">PDF</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet__body">
                        <!--begin: Datatable -->
                        <table style="font-family: iranyekan; width: 100%" class="table table-striped table-bordered table-hover table-checkable display nowrap" id="m_table_2">
                            <thead style="font-family: BYekan">
                            <tr>
                                <th title="Field #1" data-field="1">شناسه</th>
                                <th title="Field #2" data-field="2">تصویر</th>
                                <th title="Field #2" data-field="2">عنوان</th>
                                <th title="Field #5" data-field="5">ویرایش</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($banners as $banner)
                                <tr role="row" class="odd icon-hover hover-color">
                                    <td>{{ $banner->id }}</td>
                                    <td style="font-family: BYekan" ><img style="max-width: 300px" src="{{ asset($banner->slide_path ? $banner->slide_path : '/images/no-image.png') }}" class="img-fluid" alt="Responsive image"></td>
                                    <td>{{ $banner->title }}</td>
                                    <td>
                                        <a href="{{ route('banner.edit', $banner->id) }}" ><i class="far fa-edit text-info mr-1 button font-15"></i></a>
                                        <a href="" id="removeBanner" title="حذف" data-name="{{ $banner->title }}" data-id="{{ $banner->id }}"><i class="far fa-trash-alt text-danger font-15"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
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





        $(document).on('click', '#removeBanner', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                    title: "آیا مطمئن هستید؟",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "بله",
                    cancelButtonText: "خیر",
                    showCancelButton: true,
                },
                function () {
                    $.ajax({
                        type: "POST",
                        url: "{{url('/dashboard/banner/delete')}}",
                        data: {id: id},
                        success: function (data) {
                            var url = document.location.origin + "/dashboard/banner";
                            location.href = url;
                        }
                    });
                });
        });



    </script>
    <!--end::Page Scripts -->
    <script src="/assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>


    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <!--end::Page Scripts -->
    <script type="text/javascript">
        CKEDITOR.replace('body', {
            language: 'fa',
            uiColor: '#F3F6F7',
        });

    </script>

@stop
