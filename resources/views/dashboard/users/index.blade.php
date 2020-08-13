@extends('dashboard.layouts.master', ['title' => 'لیست مشتریان'])

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




    <div class="modal fade bd-example-modal-xl " id="AddCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">افزودن مشتری جدید </h5>
                    <button type="button" class="close rounded" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-scroll" style="background-color:#fbfcfd">
                    <form action="{{ route('users.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-0 col-12">

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">نام :</span></div>
                                <input type="text" class="form-control inputfield" name="fName" value="{{ old('fName') }}">
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">نام خانوادگی :</span></div>
                                <input type="text" class="form-control inputfield" name="lName" value="{{ old('lName') }}">
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">موبایل :</span></div>
                                <input type="text" class="form-control inputfield" name="mobile" value="{{ old('mobile') }}">
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">وضعیت :</span></div>
                                <select class="form-control" name="status" id="">
                                    <option value="enable">تایید شده</option>
                                    <option value="disable">تایید نشده</option>
                                </select>
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">ایمیل :</span></div>
                                <input type="text" class="form-control inputfield" name="email" value="{{ old('email') }}">
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">کد CRM :</span></div>
                                <input type="text" class="form-control inputfield" name="crm_id" value="{{ old('crm_id') }}">
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">شماره نظام پزشکی :</span></div>
                                <input type="text" class="form-control inputfield" name="pezeshkiNo" value="{{ old('pezeshkiNo') }}">
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">معرف :</span></div>
                                <input type="text" class="form-control inputfield" name="moarref" value="{{ old('moarref') }}">
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">شغل :</span></div>
                                <input type="text" class="form-control inputfield" name="job" value="{{ old('job') }}">
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">رمز عبور :</span></div>
                                <input type="password" class="form-control inputfield" name="password" value="">
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">تصویر کارت ملی :</span></div>
                                <input type="file" id="input-file-now" name="meliPic" class="dropify form-control">
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">تصویر گواهی نظام پزشکی :</span></div>
                                <input type="file" id="input-file-now" name="nezamPic" class="dropify form-control">
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">تصویر جواز :</span></div>
                                <input type="file" id="input-file-now" name="javazPic" class="dropify form-control">
                            </div>




                        </div>



                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger rounded" data-dismiss="modal">انصراف
                    </button>
                    <div class="group">
                        <button type="submit" name="action" value="justSave" class="btn btn-primary rounded">ثبت درخواست
                        </button>
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

                <span class="kt-subheader__desc iranyekan">لیست مشتریان</span>
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
                                لیست مشتریان
                            </h3>
                            <button data-toggle="modal" data-target="#AddCustomerModal" style="margin-right: 20px;" type="button" class="btn btn-sm btn-outline-success">افزودن مشتری جدید</button>

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
                                <th title="Field #1" data-field="1">شناسه CRM</th>
                                <th title="Field #1" data-field="1">نام</th>
                                <th title="Field #2" data-field="2">نام خانوادگی</th>
                                <th title="Field #5" data-field="5">شماره موبایل</th>
                                <th title="Field #5" data-field="5">وضعیت</th>
                                <th title="Field #5" data-field="5"> تاریخ عضویت</th>
                                <th title="Field #6" data-field="6">ویرایش|سفارشات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td style="font-family: BYekan" >{{ $user->id }}</td>
                                    <td style="font-family: BYekan" >{{ $user->crm_id }}</td>
                                    <td style="font-family: BYekan" >{{ $user->fName }}</td>
                                    <td style="font-family: BYekan" >{{ $user->lName }}</td>
                                    <td style="font-family: BYekan" >{{ $user->mobile }}</td>
                                    <td style="font-family: BYekan" >{{ $user->status == 'enable' ? 'تایید شده' : 'تایید نشده' }}</td>
                                    <td style="font-family: BYekan!important; direction: ltr" >{{ jdate($user->created_at) }}</td>
                                    <td>
                                        <a style="margin: 5px;" href="{{ route('users.edit', $user->id ) }}"  title="ویرایش" ><i class="far fa-edit text-info mr-1 button font-15"></i></a>
                                        <a style="margin: 5px;" href="{{ route('users.purchases', $user->id ) }}"  title="مشاهده" ><i class="far fa-eye text-info mr-1 button font-15"></i></a>
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


    <!--begin::Page Scripts -->
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
                        url: "{{url('/dashboard/users/delete')}}",
                        data: {id: id},
                        success: function (data) {
                            var url = document.location.origin + "/dashboard/users";
                            location.href = url;
                        }
                    });
                });
        });



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