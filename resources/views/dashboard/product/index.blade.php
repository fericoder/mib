@extends('dashboard.layouts.master', ['title' => 'لیست محصولات'])

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




    <div class="modal fade bd-example-modal-xl " id="AddProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">افزودن محصول جدید </h5>
                    <button type="button" class="close rounded" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-scroll" style="background-color:#fbfcfd">
                    <form action="{{ route('products.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-0">
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i
                                                class="fas fa-star required-star mr-1"></i>عنوان محصول :</span></div>
                                <input type="text" class="form-control inputfield rounded" name="title" value="{{ old('title') }}" placeholder="">
                                <input name="type" type="hidden" value="product">
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>
                                                    توضیحات محصول :</span>
                                </div>
                                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light inputfield min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>
                                                   دسته بندی محصول :</span>
                                </div>
                                <select class="form-control inputfield selectPhysical" name="productCat_id">
                                    <option style="font-family: iranyekan!important;" value="">انتخاب دسته بندی
                                    </option>
                                    @foreach($categories as $category)
                                        <option style="font-family: iranyekan!important;" data-id="{{ $category->id }}" value="{{ $category->id }}">
                                            @if($category->parent()->exists()) {{ $category->parent()->get()->first()->name }} >
                                            @endif {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="border border-info input-group mt-3 pb-3 rounded d-none physicalFeatures">
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light inputfield min-width-140" id="basic-addon7">برند محصول :</span>
                                </div>
                                <select class="form-control inputfield" name="brand_id" id="">
                                    <option style="font-family: iranyekan!important;" value="null">فاقد برند
                                    </option>
                                    @foreach($brands as $brand)
                                        <option style="font-family: iranyekan!important;" value="{{ $brand->id }}">
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i
                                                class="fas fa-star required-star mr-1"></i>قیمت محصول:</span></div>
                                <input value="{{ old('price') }}" type="text" class="form-control inputfield" name="price" placeholder="مثال: 30000" Lang="en">
                                <div class="input-group-append"><span class="input-group-text bg-light text-dark font-weight-bold iranyekan" id="basic-addon8"> تومان</span>
                                </div>
                            </div>
                            <div style="display: none" class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">قیمت بعد از تخفیف :</span></div>
                                <input value="{{ old('off_price') }}" type="text" class="form-control inputfield" name="off_price" placeholder="مثال: 30000" Lang="en">
                                <div class="input-group-append"><span class="input-group-text bg-light text-dark font-weight-bold iranyekan" id="basic-addon8"> تومان</span>
                                </div>
                            </div>
                            <div style="display: none" class="form-group row">
                                <label style="text-align: center" for="example-email-input" class="col-sm-2 col-form-label text-center">
                                    <button type="button" class="btn btn-outline-pink btn-sm mt-2" data-toggle="collapse" data-target="#timing-product">اختصاص بازه زمانی</button>
                                </label>
                                <div class="col-sm-10">
                                    <div id="timing-product" class="collapse mt-2">
                                        <div class="input-group mt-3">
                                            <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">تاریخ شروع:</span></div>
                                            <input type="hidden" class="start-alt-field-product col h-50px" name="off_price_started_at" />
                                            <input class="start-field-example-product col h-50px" name="" />

                                        </div>
                                        <div class="input-group mt-3">
                                            <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">تاریخ انقضا:</span></div>
                                            <input type="hidden" class="expire-alt-field-product col h-50px" name="off_price_expired_at" />
                                            <input class="expire-field-example-product col h-50px" name="" />
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>
                                                    موجودی در انبار :</span>
                                </div>
                                <input value="{{ old('amount') }}" type="text" class="form-control inputfield" name="amount" placeholder="مثال: 3">
                                <div class="input-group-append"><span class="input-group-text bg-light text-dark font-weight-bold iranyekan" id="basic-addon8">عدد</span></div>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>
                                                    حداقل موجودی انبار:</span>
                                </div>
                                <input value="{{ old('min_amount') }}" type="text" class="form-control inputfield" name="min_amount" placeholder="مثال: 3">
                                <div class="input-group-append"><span class="input-group-text bg-light text-dark font-weight-bold iranyekan" id="basic-addon8">عدد</span></div>
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>
                                                    واحد شمارش کالا:</span>
                                </div>
                                <input value="{{ old('measure') }}" type="text" class="form-control inputfield" name="measure" placeholder="مثال : عدد">
                            </div>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">وزن محصول:</span></div>
                                <input value="{{ old('weight') }}" type="text" class="form-control inputfield" name="weight" placeholder="مثال: 30">
                                <div class="input-group-append"><span class="input-group-text bg-light text-dark font-weight-bold iranyekan" id="basic-addon8">گرم</span></div>
                            </div>
                            {{--<div class="input-group color-dot mt-3">--}}
                                {{--<div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">رنگ ها :</span></div>--}}
                                {{--<select class="selectpicker selectpicker-color"  multiple data-live-search="true" name="color[]" title="موردی انتخاب نشده">--}}
                                    {{--@foreach($colors as $color)--}}
                                        {{--<option class="" style="background:linear-gradient(#{{ $color->code }} , #{{ $color->code }})bottom right/ 15% 2px;background-repeat:no-repeat;" value="{{ $color->id }}">{{ $color->name }}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                                {{--<div class="custom-control custom-switch switch-blue mr-5 py-3">--}}
                                    {{--<input type="checkbox" class="custom-control-input" id="color_amount" name="color_amount">--}}
                                    {{--<label class="custom-control-label iranyekan font-15" for="color_amount">اختصاص موجودی به رنگ ها</label>--}}
                                    {{--<h6 class="text-danger my-1">با اختصاص موجودی به رنگ ها موجودی اصلی کالا محاسبه نخواهد شد. </h6>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="input-group mt-3 specification-dot">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">خصوصیات انتخابی :</span></div>
                                <select class="selectpicker selectpicker-specification" multiple data-live-search="true" name="specifications[]" title="موردی انتخاب نشده">
                                    @foreach($specifications as $specification)
                                        <option class="" value="{{ $specification->id }}">{{ $specification->name }}</option>
                                    @endforeach
                                </select>
                                {{--<div class="custom-control custom-switch switch-blue mr-5 py-3">--}}
                                    {{--<input type="checkbox" class="custom-control-input" id="specification_amount" name="specification_amount">--}}
                                    {{--<label class="custom-control-label iranyekan font-15" for="specification_amount">اختصاص موجودی به خصوصیت ها</label>--}}
                                    {{--<h6 class="text-danger my-1">با اختصاص موجودی به خصوصیت ها موجودی اصلی کالا محاسبه نخواهد شد. </h6>--}}
                                {{--</div>--}}
                            </div>
                            <div style="display: none" class="facility">
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"> امکانات :</span></div>
                                    <input value="{{ old('facility[]') }}" type="text" class="form-control inputfield" name="facility[]" placeholder="مثال: ضد آب ">
                                    <div class="input-group-append">
                                        <a href="#" class="addFacility"><span class="h-50px input-group-text bg-light text-dark font-weight-bold iranyekan" id="basic-addon8"><i class="fa fa-plus mr-2"></i>
                                                           افزودن امکانات
                                                        </span></a>
                                    </div>
                                </div>
                            </div>
                            <div style="display: none" class="input-group mt-3">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"> برچسب های محصول :</span></div>
                                <input value="{{ old('tags') }}" type="text" id="input-tags" name="tags" class="form-control" />
                                <label class="text-muted m-2">برای ثبت هر برچسب از Enter استفاده نمایید</label>
                            </div>
                            <div style="display: none;" class="input-group mt-3 bg-white col-lg-12">
                                <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">امکانات ویژه محصول :</span></div>
                                <div class="custom-control custom-switch switch-blue mr-5 py-3">
                                    <input type="checkbox" class="custom-control-input" id="supportProduct" name="support">
                                    <label class="custom-control-label iranyekan font-15" for="supportProduct">پشتیبانی</label>
                                </div>
                                <div class="custom-control custom-switch switch-blue mr-5 py-3">
                                    <input type="checkbox" class="custom-control-input" id="money_backProduct" name="money_back">
                                    <label class="custom-control-label iranyekan font-15" for="money_backProduct">بازگشت وجه</label>
                                </div>
                                <div class="custom-control custom-switch switch-blue mr-5 py-3">
                                    <input type="checkbox" class="custom-control-input" id="fast_sendingProduct" name="fast_sending">
                                    <label class="custom-control-label iranyekan font-15" for="fast_sendingProduct">ارسال سریع</label>
                                </div>
                                <div class="custom-control custom-switch switch-blue mr-5 py-3">
                                    <input type="checkbox" class="custom-control-input" id="secure_paymentProduct" name="secure_payment">
                                    <label class="custom-control-label iranyekan font-15" for="secure_paymentProduct">پرداخت امن}}</label>
                                </div>
                                <div class="custom-control custom-switch switch-blue mr-5 py-3">
                                    <input type="checkbox" class="custom-control-input" id="discount_statusProduct" name="discount_status" checked>
                                    <label class="custom-control-label iranyekan font-15" for="discount_statusProduct">قابلیت اعمال شدن کد تخفیف</label>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title"><i class="fas fa-star required-star mr-1"></i>تصویر اصلی محصول</h4>
                                    <p class="text-danger my-1">حداقل ابعاد : 300px × 300px</p>
                                    <p class="text-danger">حداکثر ابعاد : 1000px × 1000px</p>
                                    <input type="file" id="input-file-now" name="image" class="dropify">
                                </div>
                            </div>
                        </div>
                        <!--end form-group-->
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

                <span class="kt-subheader__desc iranyekan">لیست محصولات</span>
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
                                            {{ \App\Product::all()->count() }}

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
                                            {{ \App\Product::all()->count() }}

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
                                لیست محصولات
                            </h3>

                            <button data-toggle="modal" data-target="#AddProductModal" style="margin-right: 20px;" type="button" class="btn btn-sm btn-outline-success">افزودن محصول جدید</button>
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
                                <th title="Field #5" data-field="5">نام</th>
                                <th title="Field #5" data-field="5">دسته</th>
                                {{--<th title="Field #5" data-field="5">وضعیت</th>--}}
                                <th title="Field #5" data-field="5"> قیمت</th>
                                {{--<th title="Field #5" data-field="5"> پس از تخفیف</th>--}}
                                <th title="Field #6" data-field="6">موجودی</th>
                                <th title="Field #6" data-field="6">تغییرات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($products as $product)
                                <tr>
                                    <td style="font-family: BYekan" >{{ $product->id }}</td>
                                    <td style="font-family: BYekan" ><img src="{{ asset($product->image['80,80'] ? $product->image['80,80'] : '/images/no-image.png') }}" class="img-fluid" alt="Responsive image"></td>
                                    <td style="font-family: BYekan" >{{ $product->title }}</td>
                                    <td style="font-family: BYekan" >{{ $product->category ? $product->category->name : '' }}</td>
                                    <td style="font-family: BYekan">{{ number_format($product->price) }}</td>
{{--                                    <td style="font-family: BYekan">{{ $product->off_price != null ?  number_format($product->off_price) : '-' }}</td>--}}
                                    <td @if($product->amount <= $product->min_amount and $product->type == 'product' and $product->amount != null) class="text-danger amount-warning" @endif >{{ $product->amount != null ? $product->amount : '-' }}
                                    <td>
                                        <a style="margin: 5px;" href="{{ route('products.edit', $product->id ) }}"  title="ویرایش" ><i class="far fa-edit text-info mr-1 button font-15"></i></a>
                                        <a style="margin: 5px;" href="" id="remove" title="حذف" data-name="{{ $product->name }}" data-id="{{ $product->id }}"><i class="far fa-trash-alt text-danger font-15"></i></a>
                                        <a style="margin: 5px;" href="{{ route('shop.product', $product->id ) }}" target="_blank"><i class="fa fa-eye text-success mr-1 button font-15"></i></a>
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

    <script type="text/javascript">
        $(document).on('change', '.selectpicker-specification', function(e) {
            $('.specification-amount-values').remove();
            $('#specification_amount').prop('checked', false); // Unchecks it
        });
    </script>

    <script type="text/javascript">
        $(document).on('change', '#specification_amount', function(e) {
            if (!$('#specification_amount').is(':checked')) {
                $('.specification-amount-values').remove();
            }
            else{
                e.preventDefault();
                selected_specificationIds = $('.selectpicker-specification option:selected').toArray().map(item => item.value);
                $.ajax({
                    type: "post",
                    url: window.location.origin +'/dashboard/product-list/getSpecificationItems',
                    data: {
                        selected_specificationIds: selected_specificationIds,
                        "_token": $('#csrf-token')[0].content //pass the CSRF_TOKEN()
                    },
                    success: function(data) {
                        data.forEach(myFunction);
                        function myFunction(key, value) {
                            key.forEach(mysw);
                            function mysw(key, value) {
                                var a = '<div class="form-group mb-0 col-12 specification-amount-values">' +
                                    '<div class="input-group mt-3">' +
                                    '<div class="input-group-prepend min-width-180">'+
                                    '<span class="input-group-text bg-light min-width-140" id="basic-addon7">'+
                                    '<i class="fas fa-star required-star mr-1">'+
                                    '</i>'+
                                    key.name+':'+
                                    '</span>'+
                                    '</div>' +
                                    '<input type="number" class="form-control inputfield" name="specification_amount_number['+key.id+']">' +
                                    '</div>' +
                                    '</div>';
                                $(".specification-dot").append(a);
                            }
                        }
                    }
                });


            }
        });
    </script>
    <!--end::Page Scripts -->
    <script src="/assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>

@stop