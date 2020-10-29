@extends('dashboard.layouts.master', ['title' => 'موجودی انبار'])
@section('headerScripts')
    <style>
        .kt-timeline-v2__item-time {
            font-size: 12px !important;
            padding-top: 5px !important;
            font-family: BYekan !important;
        }
    </style>

    <link href="/assets/plugins/custom/datatables/datatables.bundle.rtl.css" rel="stylesheet" type="text/css"/>

@stop
@section('content')







    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">

                <h3 class="kt-subheader__title">داشبورد </h3>

                <span class="kt-subheader__separator kt-subheader__separator--v"></span>

                <span class="kt-subheader__desc iranyekan">موجودی انبار</span>
            </div>

        </div>
    </div>
    <!-- end:: Content Head -->
    <!-- begin:: Content -->
    <div style="" class="kt-container  kt-grid__item kt-grid__item--fluid">




        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        گزارش موجودی انبار
                    </h3>
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
                        <th title="Field #1" data-field="1">شناسه محصول</th>
                        <th title="Field #5" data-field="5">نام</th>
                        <th title="Field #5" data-field="5">شناسه گروه</th>
                        <th title="Field #5" data-field="5">شناسه CRM</th>
                        <th title="Field #5" data-field="5">موجودی </th>
                        <th title="Field #5" data-field="5">دسته</th>
                        <th title="Field #5" data-field="5">تغییرات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($items as $item)
                        @php
                            $product = \App\Product::where('id', $item->product_id)->first();
                            if($product == null){
                            continue;
                            }
                        @endphp
                        <tr>
                            <td style="font-family: BYekan" >{{ $product->id }}</td>
                            <td style="font-family: BYekan" >{{ $product->title }}</td>
                            <td  >{{ $item->id }}</td>
                            <td >{{ $item->p_id }}</td>
                            <td >{{ $item->amount }}</td>
                            <td style="font-family: BYekan" >{{ $product->category ? $product->category->name : '' }}</td>
                            {{--                                    <td style="font-family: BYekan">{{ $product->off_price != null ?  number_format($product->off_price) : '-' }}</td>--}}
                            {{-- <td @if($product->amount <= $product->min_amount and $product->type == 'product' and $product->amount != null) class="text-danger amount-warning" @endif >{{ $product->amount != null ? $product->amount : '-' }}
                            </td> --}}
                            <td>
                                <a style="margin: 5px;" href="{{ route('products.edit', $product->id ) }}"  title="ویرایش" ><i class="far fa-edit text-info mr-1 button font-15"></i></a>
                                <a style="margin: 5px;" href="" id="remove" title="حذف" data-name="{{ $product->name }}" data-id="{{ $product->id }}"><i class="far fa-trash-alt text-danger font-15"></i></a>
                                <a style="margin: 5px;" href="{{ route('shop.product', $product->id ) }}" target="_blank"><i class="fa fa-eye text-success mr-1 button font-15"></i></a>
                                <a href="{{ route('galleries.index', $product->id ) }}" title="گالری"><i class="fa fa-image mr-1 button font-15 text-warning"></i></a>
                            </td>

                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>
        </div>




    </div>
    <!-- end:: Content -->
    </div>
    </div>

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
                        url: "{{url('/dashboard/products/delete')}}",
                        data: {id: id},
                        success: function (data) {
                            var url = document.location.origin + "/dashboard/products";
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