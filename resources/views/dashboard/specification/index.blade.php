@extends('dashboard.layouts.master', ['title' => 'لیست خصوصیت ها'])

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
                    <h5 class="modal-title" id="exampleModalLabel">افزودن خصوصیت جدید </h5>
                    <button type="button" class="close rounded" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-scroll" style="background-color:#fbfcfd">
                    <form action="{{ route('specifications.store', ['continue' => 1, 'shop' => $shop->english_name]) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-0">
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"> <i class="fas fa-star required-star mr-1"></i>نام خصوصیت :</span></div>
                                <input type="text" class="form-control inputfield" value="{{ old('name') }}" name="name" placeholder="مثال: سایز">
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light inputfield min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>نحوه نمایش خصوصیت :</span>
                                </div>
                                <select class="form-control inputfield" name="type" id="">
                                    <option style="font-family: iranyekan!important;" value="checkbox">
                                        چند انتخابی
                                    </option>
                                    <option style="font-family: iranyekan!important;" value="radio" selected="selected">
                                        تک انتخابی
                                    </option>
                                </select>
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

                <span class="kt-subheader__desc iranyekan">لیست خصوصیت ها</span>
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


                <div class="kt-portlet">
                    <div class="kt-portlet__body  kt-portlet__body--fit">
                        <div class="row row-no-padding row-col-separator-lg">

                            <div class="col-md-12 col-lg-6 col-xl-3">
                                <!--begin::Total Profit-->
                                <div class="kt-widget24">
                                    <div class="kt-widget24__details">
                                        <div class="kt-widget24__info">
                                            <h4 class="kt-widget24__title">
                                                تعداد خصوصیت ها
                                            </h4>

                                        </div>

                                        <span class="kt-widget24__stats kt-font-brand">
                                            {{ \App\Specification::all()->count() }}

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
                                                کل موجودی انبار
                                            </h4>

                                        </div>

                                        <span class="kt-widget24__stats kt-font-warning">
                                            0
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
                                                کالاهای ناموجود
                                            </h4>

                                        </div>

                                        <span style="font-size: 15px!important; direction: ltr" class="kt-widget24__stats kt-font-danger">
                                            0
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
                                                کالاهای درحال ارسال
                                            </h4>

                                        </div>

                                        <span style="font-size: 15px!important;direction: ltr" class="kt-widget24__stats kt-font-success">
                                            0
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



                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                لیست خصوصیت ها
                            </h3>

                            <button data-toggle="modal" data-target="#AddBrandModal" style="margin-right: 20px;" type="button" class="btn btn-sm btn-outline-success">افزودن خصوصیت جدید</button>
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
                                <th title="Field #2" data-field="2">نام</th>
                                <th title="Field #5" data-field="5">نحوه نمایش</th>
                                <th title="Field #5" data-field="5">تغییرات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($specifications as $specification)
                                <tr role="row" class="odd icon-hover hover-color">
                                    <td>{{ $specification->id }}</td>
                                    <td>{{ $specification->name }}</td>
                                    <td>{{ $specification->type == 'radio' ? 'تک انتخابی'  : 'چند انتخابی'}}</td>
                                    <td>
                                        <a href="{{ route('specification-item.main', ['id' => $specification->id]) }}" title="گزینه ها"><i class="fa fa-tasks text-success mr-1 button font-17"></i>
                                        <a href="{{ route('specifications.edit', $specification->id) }}" ><i class="far fa-edit text-info mr-1 button font-15"></i></a>
                                        <a href="" id="remove" title="حذف" data-name="{{ $specification->name }}" data-id="{{ $specification->id }}"><i class="far fa-trash-alt text-danger font-15"></i></a>
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
        $(document).on('click', '#remove', function (e) {
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
                        url: "{{url('/dashboard/specifications/delete')}}",
                        data: {id: id},
                        success: function (data) {
                            var url = document.location.origin + "/dashboard/specifications";
                            location.href = url;
                        }
                    });
                });
        });


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


        $(window).resize(function() {
            if ($(window).width() < 1300) {
                $("body").addClass('enlarge-menu');

            } else {
                $("body").removeClass('enlarge-menu');

            }
        }).resize();
        $(window).resize(function() {
            if ($(window).width() < 1070) {
                $(".icon-show").removeClass('d-none');

            } else {
                $(".icon-show").addClass('d-none');

            }
        }).resize();
        $( document ).ready(function() {
            $( ".dropify-clear" ).remove();
        });
        $(document).on('click', '#removeBrand', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var name = $(this).data('name');
            swal(` ${'حذف دسته بندی:'} ${name} | ${'آیا اطمینان دارید؟'}`, {
                dangerMode: true,
                icon: "warning",
                buttons: ["انصراف", "حذف"],
            })
                .then(function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "post",
                            url: "/admin-panel/shop/brand/delete",
                            data: {
                                id: id,
                                "_token": $('#csrf-token')[0].content //pass the CSRF_TOKEN()
                            },

                            success: function(data) {
                                swal('عملیات با موفقیت انجام شد', {
                                    icon: "success",
                                    buttons: ['ادامه'],
                                })
                                setTimeout(function(){
                                    var url = "/admin-panel/shop/brand";
                                    location.href = url;
                                }, 1000);
                            }
                        });
                    } else {
                        toastr.warning('لغو شد.', '', []);
                    }
                });
        });

        $(document).on('click', '#restoreBrand', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var name = $(this).data('name');
            swal(` ${'بازگردانی خصوصیت:'} ${name} | ${'آیا اطمینان دارید؟'}`, {
                dangerMode: true,
                icon: "warning",
                buttons: ["انصراف", "حذف"],
            })
                .then(function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "post",
                            url: "/admin-panel/shop/brand/restore",
                            data: {
                                id: id,
                                "_token": $('#csrf-token')[0].content //pass the CSRF_TOKEN()
                            },
                            success: function(data) {
                                swal('عملیات با موفقیت انجام شد', {
                                    icon: "success",
                                    buttons: ['ادامه'],
                                })
                                setTimeout(function(){
                                    var url = "/admin-panel/shop/brand";
                                    location.href = url;
                                }, 1000);
                            }
                        });
                    } else {
                        toastr.warning('لغو شد.', '', []);
                    }
                });
        });


        $(document).on('click', '#icon-delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var name = $(this).data('name');
            swal(` ${'حذف عکس  خصوصیت:'} ${name} | ${'آیا اطمینان دارید؟'}`, {
                dangerMode: true,
                icon: "warning",
                buttons: ["انصراف", "حذف"],
            })
                .then(function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "post",
                            url: "/admin-panel/shop/brand/icon/delete",
                            data: {
                                id: id,
                                "_token": $('#csrf-token')[0].content //pass the CSRF_TOKEN()
                            },
                            success: function(data) {
                                $( ".dropify-preview" ).addClass('d-none');
                            }
                        });
                    } else {
                        toastr.warning('لغو شد.', '', []);
                    }
                });
        });

        $(document).ready(function(){
            $('#datatable_filter').parent().remove();
            $('#datatable_wrapper').children(':first').find('.col-sm-12').removeClass('col-sm-12 col-md-6');

        });
        $(document).ready(function(){
            $('input#myInputTextField').on("focus", function(){
                if ($(this).hasClass("searchActive")){
                    $(this).removeClass("searchActive");
                }
                else{
                    $('input#myInputTextField').addClass('searchActive');
                }
            });
        });
        oTable = $('#datatable').DataTable({
            "language": {
                "infoFiltered": "(فیلتر شده از مجموع _MAX_ رکورد)"
            }
        } );


    </script>
    <!--end::Page Scripts -->
    <script src="/assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>

@stop