@extends('dashboard.layouts.master', ['title' => 'ویرایش محصول'])

@section('headerScripts')
    <link href="/assets/plugins/custom/datatables/datatables.bundle.rtl.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/jquery.tagsinput.min.css') }}" rel="stylesheet">

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
        #input-tags_tagsinput {
            width: 82.9% !important;
            height: 37px !important;
            min-height: 37px !important;
            font-size: 13px;
            border: 1px solid #374afb57!important;
            border-radius: 3px;
            height: calc(2.3rem + 2px);
            color: #2f5275;
        }

        #input-tags_addTag {
            float: right !important;
        }
        #input-tags_tag{
            border: none;
            width: 200px!important;
        }
        i.fa-trash-alt{
            cursor: pointer;
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

                <span class="kt-subheader__desc iranyekan">ویرایش محصول</span>
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
                                                تعداد محصولات
                                            </h4>

                                        </div>

                                        <span class="kt-widget24__stats kt-font-brand">
                                            0
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
                                ویرایش محصول
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
                        <form method="post" action="{{ route('products.group.update', ['product_id' => $product->id, 'group_id' => $group->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="mt-0 header-title">ویرایش  {{ $product->title }} </h3>
                                            <p class="text-muted mb-3">در این بخش میتوانید محصول  فروشگاه  را ویرایش کنید.</p><br>
                                            <div class="row">
                                                <div class="form-group mb-0 col-12">

                                                    <div class="section p-3">
                                                        <div class="items">
                                                            @if($product->groups->count() > 1)
                                                            <a class="mr-2 font-15" id="remove" style="font-size: 20px"  title="حذف" data-name="" data-id="{{ $group->id }}"><i class="p-2 far fa-trash-alt text-danger font-18 pl-2" style="font-size: 20px"></i></a>
                                                            @endif
                                                        <div class="input-group mt-3 specification-dot">
                                                            <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">خصوصیات انتخابی :</span></div>
                                                        <select class="selectpicker1 selectpicker-specification" multiple data-live-search="true" name="group[items][]" title="موردی انتخاب نشده">
                                                            @foreach($specifications as $specification)
                                                            <optgroup label="{{ $specification->name }}">
                                                                @foreach($specification->items as $item)
                                                                <option @if($product->groups->count() != 0)
                                                                    @foreach ($group->specification_items as $selectedItem)
                                                                     {{ $item->id == $selectedItem ? 'selected' : ''}}
                                                                    @endforeach
                                                                     value="{{ $item->id }}">{{ $item->name }}</option>

                                                                    @endif

                                                                @endforeach
                                                        </optgroup>
                                                        @endforeach

                                                        </select>


                                                    </div>

                                                    <div class="mt-3 specification-dot input-group">
                                                        <div class="input-group-prepend w-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>
                                                            شناسه محصول:</span>
                                                         </div>
                                                          <input value="{{ $group->p_id }}" type="text" class="form-control inputfield min-width-140" name="group[p_id]" placeholder="مثال : 30">

                                                    </div>
                                                    <div class="mt-3 specification-dot input-group  ">
                                                        <div class="input-group-prepend w-180"><span class="input-group-text bg-light" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>
                                                          موجودی:</span>
                                                         </div>
                                                          <input value="{{ $group->amount }}" type="text" class="form-control inputfield" name="group[amount]" placeholder="مثال : 1000">

                                                    </div>
                                                    <div class="mt-3 specification-dot input-group">
                                                        <div class="input-group-prepend w-180"><span class="input-group-text bg-light" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>
                                                          حداقل موجودی:</span>
                                                         </div>
                                                          <input value="{{ $group->min_amount }}" type="text" class="form-control inputfield" name="group[min_amount]" placeholder="مثال : 1000">

                                                    </div>

                                            </div>
                                        </div>

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
    <script src="{{ asset('/js/jquery.tagsinput.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                     $('#input-tags').tagsInput();
                    $('#input-tags_tag').val("");
                    $(".dropify-clear").remove();
                    $("#tagsinput").tagsInput();
                });

        </script>
        <script>
            $(window).ready(function(){
                setInterval(function(){
                  $('.tagsinput').addClass("tags-modify")
                }, 1000);

              });
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


    <script>
        $(document).ready(function() {
            var counter = {{ $product->groups->count() }};
            $('.selectpicker1').select2({
                width: '50%',
                closeOnSelect: false
            });
            $(".addSection").click(function() {
                counter += 1;
                $("div.section").append('<div class="items mt-4"><a class="mr-2 item-delete font-15" style="font-size: 20px" title="حذف حصوصیت" data-name="" data-id=""><i class="p-2 far fa-trash-alt text-danger font-18 pl-2" style="font-size: 20px"></i></a><h4 class="text-center">شماره '+counter+'</h4><div class="input-group mt-3 specification-dot"><div class="input-group-prepend w-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">خصوصیات انتخابی :</span></div><select class="selectpicker selectpicker-specification" multiple data-live-search="true" name="group[new-'+counter+'][items][]" title="موردی انتخاب نشده">@foreach($specifications as $specification)<optgroup label="{{ $specification->name }}">@foreach($specification->items as $item)<option class="" value="{{ $item->id }}">{{ $item->name }}</option>@endforeach</optgroup>@endforeach</select></div><div class="mt-3 specification-dot input-group"><div class="input-group-prepend w-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i> شناسه محصول:</span></div><input value="{{ old('group[counter][p_id]') }}" type="text" class="form-control inputfield" name="group[new-'+counter+'][p_id]" placeholder="مثال : 30"></div><div class="mt-3 specification-dot input-group"><div class="input-group-prepend w-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>موجودی:</span></div><input value="{{ old('group[counter][amount]') }}" type="text" class="form-control inputfield" name="group[new-'+counter+'][amount]" placeholder="مثال : 1000"></div><div class="mt-3 specification-dot input-group"><div class="input-group-prepend w-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>حداقل موجودی:</span></div><input value="{{ old('group[counter][min_amount]') }}" type="text" class="form-control inputfield" name="group[new-'+counter+'][min_amount]" placeholder="مثال : 1000"></div></div>');
                $('.selectpicker').select2({
                    width: '50%',
                    closeOnSelect: false
                });
                $(".item-delete").on('click', '.far', function() {
                    $(this).closest('.items').remove();
                  });
            });
        });
        $(".item-delete").on('click', '.far', function() {
            $(this).closest('.items').remove();
          });
    </script>
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
                        url: "{{url('/dashboard/products/group/delete')}}",
                        data: {id: id},
                        success: function (data) {
                            var url = document.location.origin + "/dashboard/products";
                            location.href = url;
                        }
                    });
                });
        });
    </script>
    <!--end::Page Scripts -->
    <script src="/assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>

@stop
