@extends('dashboard.layouts.master', ['title' => 'لیست دسته بندی ها'])

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









    <div class="modal fade bd-example-modal-xl" id="AddCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard-shop-product-category.addCategoryTitle') }}</h5>
                    <button type="button" class="close rounded" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-scroll" style="background-color:#fbfcfd">
                    <form action="{{ route('categories.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-0">
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i
                                                class="fas fa-star required-star mr-1"></i>{{ __('dashboard-shop-product-category.addCategoryItem1') }} :</span></div>
                                <input type="text" class="form-control inputfield" value="{{ old('name') }}" name="name" placeholder="نام محصول مورد نظر">
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">افزودن بعنوان دسته بندی اصلی:</span></div>
                                <select class="form-control inputfield" name="parent_id">
                                    <option selected value="null">افزودن بعنوان دسته بندی اصلی</option>
                                    @foreach($categories as $category)
                                        @unless($category->parent()->get()->first() != null and $category->parent()->get()->first()->parent()->get()->first() != null and
                                        $category->parent()->get()->first()->parent()->get()->first()->parent()->get()->first() != null and
                                        $category->parent()->get()->first()->parent()->get()->first()->parent()->get()->first()->parent()->exists() and
                                        !$category->parent()->get()->first()->parent()->get()->first()->parent()->get()->first()->parent()->get()->first()->parent()->exists())
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endunless
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">توضیحات دسته بندی :</span></div>
                                <input type="text" class="form-control inputfield" value="{{ old('description') }}" name="description" placeholder="مثال: توضیحات مختصری درمورد دسته بندی">
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">اولویت دسته بندی :</span></div>
                                <input type="text" class="form-control inputfield" value="{{ old('priority') }}" name="priority" placeholder="مثال :200 ">
                            </div>
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title">آیکون دسته بندی</h4>
                                    <input type="file" id="input-file-now" name="icon" class="dropify">
                                </div>
                            </div>
                        </div>
                        <!--end form-group-->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger rounded" data-dismiss="modal">انصراف</button>
                    <div class="group">
                        <button type="submit" name="action" value="justSave" class="btn btn-primary rounded">ثبت درخواست</button>
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

                <span class="kt-subheader__desc iranyekan">لیست دسته بندی ها</span>
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
                                                تعداد دسته بندی ها
                                            </h4>

                                        </div>

                                        <span class="kt-widget24__stats kt-font-brand">
                                            {{ \App\Category::all()->count() }}
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
                                لیست دسته بندی ها
                            </h3>

                            <button data-toggle="modal" data-target="#AddCategoryModal" style="margin-right: 20px;" type="button" class="btn btn-sm btn-outline-success">افزودن دسته بندی جدید</button>
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
                        <!--begin: Categoies -->



                        <div class="accordion" id="accordionExample1">
                            @if($parentCategories->count() <= 0)
                                <div >
                                    دسته بندی وجود ندارد !!!!
                                </div>
                            @endif
                            @foreach($parentCategories as $parentCategory)
                                <div class="card border">
                                    <div class="card-header d-flex justify-content-between flex-wrap" id="heading{{ $parentCategory->id }}">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed font-18" data-toggle="collapse" data-target="#collapse{{ $parentCategory->id }}" aria-expanded="false" aria-controls="collapse{{ $parentCategory->id }}"
                                                    style="color:#122272;">
                                                {{ $parentCategory->name }}
                                            </button>
                                        </h5>
                                        <div class="p-3">
                                            <a href="{{ route('categories.edit', $parentCategory->id) }}" id="editCat" title="ویرایش"><i class="far fa-edit text-info mr-1 button font-18"></i>
                                            </a>

                                            @if($parentCategory->deleted_at != null)
                                                <a href="" title="بازگردانی دسته بندی" id="restoreCat" data-name="{{ $parentCategory->name }}" data-id="{{ $parentCategory->id }}"><i
                                                            class="fas fa-undo text-success font-18"></i></a>
                                            @else
                                                <a href="" id="remove" data-name="{{ $parentCategory->name }}" title="حذف" data-id="{{ $parentCategory->id }}"><i class="far fa-trash-alt text-danger font-18"></i></a>
                                            @endif
                                            <a target="_blank" href="{{ route('shop.category', $parentCategory->id ) }}" title="مشاهده محصولات دسته بندی"><i class="fa fa-eye text-success mr-1 button font-18"></i></a>
                                        </div>
                                    </div>
                                    <div id="collapse{{ $parentCategory->id }}" class="collapse" aria-labelledby="heading{{ $parentCategory->id }}">
                                        <div class="card-body p-0 p-lg-2 p-md-2">
                                            @if($parentCategory->children()->exists())
                                                @foreach ($parentCategory->children()->get() as $subCategory)
                                                    <div class="card border">
                                                        <div class="card-header d-flex  justify-content-between  flex-wrap" style="background-color:#dfe5f7" id="heading{{ $subCategory->id }}">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link collapsed font-18" data-toggle="collapse" data-target="#collapse{{ $subCategory->id }}" aria-expanded="false" aria-controls="collapse{{ $subCategory->id }}"
                                                                        style="color:#122272;">
                                                                    {{ $subCategory->name }}
                                                                </button>
                                                            </h5>
                                                            <div class="p-3">
                                                                <a href="{{ route('categories.edit', $subCategory->id) }}" id="editCat" title="ویرایش"><i class="far fa-edit text-info mr-1 button font-18"></i>
                                                                </a>

                                                                @if($subCategory->deleted_at != null)
                                                                    <a href="" title="بازگردانی دسته بندی" id="restoreCat" data-name="{{ $subCategory->name }}" data-id="{{ $subCategory->id }}"><i
                                                                                class="fas fa-undo text-success font-18"></i></a>
                                                                @else
                                                                    <a href="" id="remove" data-name="{{ $subCategory->name }}" title="حذف" data-id="{{ $subCategory->id }}"><i class="far fa-trash-alt text-danger font-18"></i></a>
                                                                @endif
                                                                <a target="_blank" href="{{ route('shop.category', $subCategory->id ) }}" title="مشاهده محصولات دسته بندی"><i class="fa fa-eye text-success mr-1 button font-18"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div id="collapse{{ $subCategory->id }}" class="collapse" aria-labelledby="heading{{ $subCategory->id }}">
                                                            <div class="card-body p-0 p-lg-2 p-md-2">
                                                                @if($subCategory->children()->exists())
                                                                    @foreach ($subCategory->children()->get() as $subSubCategory)
                                                                        <div class="card border">
                                                                            <div class="card-header d-flex  justify-content-between  flex-wrap" style="background-color:#c1cef5" id="headingTwo">
                                                                                <h5 class="mb-0">
                                                                                    <button class="btn btn-link collapsed font-18" data-toggle="collapse" data-target="#collapse{{ $subSubCategory->id }}" aria-expanded="false"
                                                                                            aria-controls="collapse{{ $subSubCategory->id }}" style="color:#122272;">
                                                                                        {{ $subSubCategory->name }}
                                                                                    </button>
                                                                                </h5>
                                                                                <div class="p-3">
                                                                                    <a href="{{ route('categories.edit', $subSubCategory->id) }}" id="editCat" title="ویرایش"><i
                                                                                                class="far fa-edit text-info mr-1 button font-18"></i>
                                                                                    </a>

                                                                                    @if($subSubCategory->deleted_at != null)
                                                                                        <a href="" title="بازگردانی دسته بندی" id="restoreCat" data-name="{{ $subSubCategory->name }}" data-id="{{ $subSubCategory->id }}"><i
                                                                                                    class="fas fa-undo text-success font-18"></i></a>
                                                                                    @else
                                                                                        <a href="" title="حذف" id="remove" data-name="{{ $subSubCategory->name }}" data-id="{{ $subSubCategory->id }}"><i class="far fa-trash-alt text-danger font-18"></i></a>
                                                                                    @endif
                                                                                    <a target="_blank" href="{{ route('shop.category', $subSubCategory->id ) }}" title="مشاهده محصولات دسته بندی"><i class="fa fa-eye text-success mr-1 button font-18"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <div id="collapse{{ $subSubCategory->id }}" class="collapse" aria-labelledby="heading{{ $subSubCategory->id }}">
                                                                                <div class="card-body p-0 p-lg-2 p-md-2">
                                                                                    <div id="collapse{{ $subCategory->id }}" class="collapse" aria-labelledby="heading{{ $subCategory->id }}">
                                                                                        <div class="card-body p-0 p-lg-2 p-md-2">
                                                                                            @if($subSubCategory->children()->exists())
                                                                                                @foreach ($subSubCategory->children()->get() as $subSubSubCategory)
                                                                                                    <div class="card border">
                                                                                                        <div class="card-header d-flex  justify-content-between  flex-wrap" style="background-color:#86A3F7" id="headingTwo">
                                                                                                            <h5 class="mb-0">
                                                                                                                <button class="btn btn-link collapsed font-18" data-toggle="collapse" data-target="#collapse{{ $subSubSubCategory->id }}" aria-expanded="false"
                                                                                                                        aria-controls="collapse{{ $subSubSubCategory->id }}" style="color:#122272;">
                                                                                                                    {{ $subSubSubCategory->name }}
                                                                                                                </button>
                                                                                                            </h5>
                                                                                                            <div class="p-3">
                                                                                                                <a href="{{ route('categories.edit', $subSubSubCategory->id) }}" id="editCat" title="ویرایش"><i
                                                                                                                            class="far fa-edit text-info mr-1 button font-18"></i>
                                                                                                                </a>

                                                                                                                @if($subSubSubCategory->deleted_at != null)
                                                                                                                    <a href="" title="بازگردانی دسته بندی" id="restoreCat" data-name="{{ $subSubSubCategory->name }}" data-id="{{ $subSubSubCategory->id }}"><i
                                                                                                                                class="fas fa-undo text-success font-18"></i></a>
                                                                                                                @else
                                                                                                                    <a href="" title="حذف" id="remove" data-name="{{ $subSubSubCategory->name }}" data-id="{{ $subSubSubCategory->id }}"><i
                                                                                                                                class="far fa-trash-alt text-danger font-18"></i></a>
                                                                                                                @endif
                                                                                                                <a target="_blank" href="{{ route('shop.category', $subSubSubCategory->id ) }}" title="مشاهده محصولات دسته بندی"><i
                                                                                                                            class="fa fa-eye text-success mr-1 button font-18"></i>
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div id="collapse{{ $subSubSubCategory->id }}" class="collapse" aria-labelledby="heading{{ $subSubSubCategory->id }}">
                                                                                                            <div class="card-body p-0 p-lg-2 p-md-2">
                                                                                                                <div id="collapse{{ $subSubSubCategory->id }}" class="collapse" aria-labelledby="heading{{ $subSubSubCategory->id }}">
                                                                                                                    <div class="card-body p-0 p-lg-2 p-md-2">
                                                                                                                        @if($subSubSubCategory->children()->exists())
                                                                                                                            @foreach ($subSubSubCategory->children()->get() as $subSubSubSubCategory)
                                                                                                                                <div class="card border">
                                                                                                                                    <div class="card-header d-flex  justify-content-between  flex-wrap" style="background-color:#122272" id="headingTwo">
                                                                                                                                        <h5 class="mb-0">
                                                                                                                                            <button class="btn btn-link collapsed font-18" data-target="#collapse{{ $subSubSubSubCategory->id }}" aria-expanded="false"
                                                                                                                                                    aria-controls="collapse{{ $subSubSubSubCategory->id }}" style="color:white;">
                                                                                                                                                {{ $subSubSubSubCategory->name }}
                                                                                                                                            </button>
                                                                                                                                        </h5>
                                                                                                                                        <div class="p-3">
                                                                                                                                            <a href="{{ route('categories.edit', $subSubSubSubCategory->id) }}" id="editCat" title="ویرایش"><i
                                                                                                                                                        class="far fa-edit text-info mr-1 button font-18"></i>
                                                                                                                                            </a>

                                                                                                                                            @if($subSubSubSubCategory->deleted_at != null)
                                                                                                                                                <a href="" title="بازگردانی دسته بندی" id="restoreCat" data-name="{{ $subSubSubSubCategory->name }}" data-id="{{ $subSubSubSubCategory->id }}"><i
                                                                                                                                                            class="fas fa-undo text-success font-18"></i></a>
                                                                                                                                            @else
                                                                                                                                                <a href="" title="حذف" id="remove" data-name="{{ $subSubSubSubCategory->name }}" data-id="{{ $subSubSubSubCategory->id }}"><i
                                                                                                                                                            class="far fa-trash-alt text-danger font-18"></i></a>
                                                                                                                                            @endif
                                                                                                                                            <a href="{{ route('shop.category', $subSubSubSubCategory->id ) }}" title="مشاهده محصولات این دسته بندی"><i
                                                                                                                                                        class="fa fa-eye text-success mr-1 button font-18"></i>
                                                                                                                                            </a>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                    <div id="collapse{{ $subSubSubSubCategory->id }}" class="collapse" aria-labelledby="heading{{ $subSubSubSubCategory->id }}">
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            @endforeach
                                                                                                                        @endif
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>




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
                        url: "{{url('/dashboard/categories/delete')}}",
                        data: {id: id},
                        success: function (data) {
                            var url = document.location.origin + "/dashboard/categories";
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

    </script>
    <!--end::Page Scripts -->
    <script src="/assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>

@stop
