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
                        <form method="post" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
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
                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">عنوان محصول :</span></div>
                                                        <input type="text" class="form-control inputfield" name="title"  value="{{ old('title', $product->title) }}">
                                                        <input name="type" type="hidden" value="product">
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">خلاصه توضیحات محصول :</span></div>
                                                        <textarea class="form-control" id="shortDescription" name="shortDescription">{{ old('shortDescription', $product->shortDescription) }}</textarea>
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">توضیحات کامل محصول :</span></div>
                                                        <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i> کشور سازنده : </span></div>
                                                        <select class="selectpicker1 selectpicker-specification" data-live-search="true" name="country_id" title="موردی انتخاب نشده">
                                                            <option disabled selected value> -- کلیک نمایید -- </option>
                                                            @foreach (\App\Country::all() as $country)
                                                                <option {{ old('country_id', $product->country_id) == $country->id  ? 'selected': '' }} value="{{ $country->id }}">{{ $country->nicename }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light inputfield min-width-140" id="basic-addon7">دسته بندی محصول :</span></div>
                                                        <select class="form-control inputfield selectPhysical" name="productCat_id" data-productid="{{ $product->id }}">
                                                            <option style="font-family: BYekan!important;" value="{{ $product->category->id }}">{{ $product->category->name }}
                                                            </option>
                                                            @foreach($categories as $category)
                                                                <option style="font-family: BYekan!important;" data-id="{{ $category->id }}" value="{{ $category->id }}">
                                                                    @if($category->parent()->exists()) {{ $category->parent()->get()->first()->name }} >
                                                                    @endif {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>



                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light inputfield min-width-140" id="basic-addon7">برند محصول :</span></div>
                                                        <select class="form-control inputfield" name="brand_id" id="">
                                                            <option style="font-family: BYekan!important;" value="null">فاقد برند
                                                            </option>
                                                            @foreach($brands as $brand)
                                                                <option {{ $brand->id == $product->brand_id ? 'selected' : ''}} value="{{ $brand->id }}">{{ $brand->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>


                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">قیمت محصول :</span></div>
                                                        <input type="text" class="form-control inputfield" name="price"  Lang="en" value="{{ old('price', $product->price) }}">
                                                        <div class="input-group-append"><span class="input-group-text bg-light text-dark font-weight-bold iranyekan" id="basic-addon8"> تومان</span></div>

                                                    </div>
                                                    <div style="display: none" class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"> قیمت بعد از تخفیف :</span></div>
                                                        <input type="text" class="form-control inputfield" name="off_price" Lang="en" value="{{ old('off_price', $product->off_price) }}">
                                                        <div class="input-group-append"><span class="input-group-text bg-light text-dark font-weight-bold iranyekan" id="basic-addon8"> تومان</span></div>
                                                    </div>
                                                    <div style="display: none" class="form-group row">
                                                        <label style="text-align: center" for="example-email-input" class="col-sm-2 col-form-label text-center">
                                                            <button type="button" class="btn btn-outline-pink btn-sm mt-2" data-toggle="collapse" data-target="#timing-product">اختصاص بازه زمانی</button>
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <div id="timing-product" class="collapse mt-2">
                                                                <div class="input-group mt-3">
                                                                    <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">{{ __('dashboard-shop-voucher.addModalItem6') }}:</span></div>
                                                                    <input type="hidden" class="start-alt-field-product col h-50px" name="off_price_started_at" />
                                                                    <input class="start-field-example-product col h-50px" name="" value="{{ $product->off_price_started_at }}" />

                                                                </div>
                                                                <div class="input-group mt-3">
                                                                    <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">{{ __('dashboard-shop-voucher.addModalItem7') }}:</span></div>
                                                                    <input type="hidden" class="expire-alt-field-product col h-50px" name="off_price_expired_at" />
                                                                    <input class="expire-field-example-product col h-50px" name="" value="{{ $product->off_price_expired_at }}" />
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    {{-- <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">موجودی در انبار :</span></div>
                                                        <input type="text" class="form-control inputfield" name="amount"  value="{{ old('amount', $product->amount) }}">
                                                        <div class="input-group-append"><span class="input-group-text bg-light text-dark font-weight-bold iranyekan" id="basic-addon8">عدد</span></div>

                                                    </div> --}}
                                                    {{-- <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">حداقل موجودی در انبار :</span></div>
                                                        <input type="text" class="form-control inputfield" name="min_amount" value="{{ old('min_amount', $product->min_amount) }}">
                                                        <div class="input-group-append"><span class="input-group-text bg-light text-dark font-weight-bold iranyekan" id="basic-addon8">عدد</span></div>

                                                    </div> --}}
                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">واحد شمارش:</span></div>
                                                        <input type="text" class="form-control inputfield" name="measure"  value="{{ old('measure', $product->measure) }}">
                                                        <div class="input-group-append"><span class="input-group-text bg-light text-dark font-weight-bold iranyekan" id="basic-addon8"></span></div>

                                                    </div>
                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">وزن محصول :</span></div>
                                                        <input type="text" class="form-control inputfield" name="weight" value="{{ old('weight', $product->weight) }}">
                                                        <div class="input-group-append"><span class="input-group-text bg-light text-dark font-weight-bold iranyekan" id="basic-addon8">گرم</span></div>

                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">لینک آپارات:</span></div>
                                                        <input value="{{ old('aparat', $product->aparat) }}" type="text" class="form-control inputfield" name="aparat" >
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">کاتالوگ:</span></div>
                                                        <input value="{{ old('catalog', $product->catalog) }}" type="file" class="form-control inputfield" name="catalog" >
                                                    </div>


                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">نمایش قیمت فقط برای کاربران:</span></div>
                                                        <label style="margin: 10px;" class="kt-checkbox"><input {{ $product->userPrice == 'on' ? 'checked' : '' }} name="userPrice" type="checkbox"> <span></span></label>
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">شگفت انگیز:</span></div>
                                                        <label style="margin: 10px;" class="kt-checkbox"><input {{ $product->shegeftangiz == 'on' ? 'checked' : '' }} name="shegeftangiz" type="checkbox"> <span></span></label>
                                                    </div>

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">عدم وجود خصوصیت:</span></div>
                                                        <label style="margin: 10px;" class="kt-checkbox"><input  name="no_specification_status" id="nospec" {{ $product->no_specification_status == 'enable' ? 'checked' : '' }} type="checkbox"> <span></span></label>
                                                    </div>


                                                    {{--<div class="input-group color-dot mt-3">--}}
                                                    {{--<div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">رنگ محصول :</span></div>--}}

                                                    {{--<select class="selectpicker selectpicker-color" multiple data-live-search="true" name="color[]" title="موردی انتخاب نشده است">--}}
                                                    {{--@foreach($colors as $color)--}}
                                                    {{--<option style="background:linear-gradient(#{{ $color->code }} , #{{ $color->code }})bottom right/ 15% 2px;background-repeat:no-repeat;"  @if($product->colors->count() != 0) @foreach($product->colors as $selectedColor) {{ $color->id == $selectedColor->id ? 'selected' : ''}}--}}
                                                    {{--@endforeach--}}
                                                    {{--@endif value="{{ $color->id }}">{{ $color->name }}</option>--}}
                                                    {{--@endforeach--}}
                                                    {{--</select>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="custom-control custom-switch switch-blue mr-5 py-3">--}}
                                                    {{--<input type="checkbox" class="custom-control-input" id="color_amount" name="color_amount" {{ $product->color_amount_status == "enable" ? 'checked' : '' }}>--}}
                                                    {{--<label class="custom-control-label iranyekan font-15" for="color_amount">اختصاص موجودی به رنگ ها</label>--}}
                                                    {{--<h6 class="text-danger my-1">با اختصاص موجودی به رنگ ها موجودی اصلی کالا محاسبه نخواهد شد. </h6>--}}

                                                    {{--</div>--}}

                                                    <div class="section p-3">
                                                        @foreach($product->groups as $groupItem)

                                                            <div class="items">
                                                                <a class="mr-2 font-15" href="{{ route('products.group.edit', ['product_id' => $product->id, 'group_id' => $groupItem->id]) }}" style="font-size: 20px"  title="ویرایش خصوصیت" data-name="" data-id=""><i class="p-2 far fa-edit text-warning font-18 pl-2" style="font-size: 20px"></i></a>
                                                                <h4 class="text-center">شماره {{ $loop->index + 1 }}
                                                                </h4>
                                                                <div class="input-group mt-3 specification-dot">
                                                                    <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">خصوصیات انتخابی :</span></div>
                                                                    @php
                                                                        $itemsArray = [];
                                                                    @endphp
                                                                    @foreach ($items->whereIn('id', $groupItem->specification_items) as $selectedItem)
                                                                        @php
                                                                            $itemsArray[] = $selectedItem->name;
                                                                        @endphp
                                                                    @endforeach
                                                                    <input type="text" value="{{ implode(', ' ,$itemsArray) }}" disabled class="form-control inputfield min-width-140">
                                                                </div>

                                                                <div class="mt-3 specification-dot input-group">
                                                                    <div class="input-group-prepend w-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>
                                                            شناسه محصول:</span>
                                                                    </div>
                                                                    <input value="{{ $groupItem->p_id }}" disabled type="text" class="form-control inputfield min-width-140" name="group[{{ $groupItem->id }}][p_id]" placeholder="مثال : 30">

                                                                </div>
                                                                <div class="mt-3 specification-dot input-group  ">
                                                                    <div class="input-group-prepend w-180"><span class="input-group-text bg-light" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>
                                                          موجودی:</span>
                                                                    </div>
                                                                    <input value="{{ $groupItem->amount }}" disabled type="text" class="form-control inputfield" name="group[{{ $groupItem->id }}][amount]" placeholder="مثال : 1000">

                                                                </div>
                                                                <div class="mt-3 specification-dot input-group">
                                                                    <div class="input-group-prepend w-180"><span class="input-group-text bg-light" id="basic-addon7"><i class="fas fa-star required-star mr-1"></i>
                                                          حداقل موجودی:</span>
                                                                    </div>
                                                                    <input value="{{ $groupItem->min_amount }}" disabled type="text" class="form-control inputfield" name="group[{{ $groupItem->id }}][min_amount]" placeholder="مثال : 1000">

                                                                </div>

                                                            </div>
                                                        @endforeach


                                                    </div>
                                                    @if($product->no_specification_status == 'disable')
                                                        <div class="input-group-append mt-3 ">
                                                            <button type="button" class="addSection border-0 bg-white"><span class="h-50px input-group-text bg-light text-danger font-weight-bold iranyekan" id="basic-addon8"><i class="fa fa-plus mr-2"></i>
                                                    افزودن مورد جدید
                                                </span></button>
                                                        </div>
                                                    @endif
                                                    {{--<div class="custom-control custom-switch switch-blue mr-5 py-3">--}}
                                                    {{--<input type="checkbox" class="custom-control-input" id="specification_amount" name="specification_amount" {{ $product->specification_amount_status == "enable" ? 'checked' : '' }}>--}}
                                                    {{--<label class="custom-control-label iranyekan font-15" for="specification_amount">اختصاص موجودی به خصوصیت ها</label>--}}
                                                    {{--<h6 class="text-danger my-1">با اختصاص موجودی به خصوصیت ها موجودی اصلی کالا محاسبه نخواهد شد. </h6>--}}
                                                    {{--</div>--}}

                                                    {{--@if($product->specification_amount_status == "enable")--}}
                                                    {{--@foreach ($product->specifications as $selectedSpecification)--}}
                                                    {{--@foreach ($selectedSpecification->items as $item)--}}
                                                    {{--<div class="input-group mt-3">--}}
                                                    {{--<div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">موجودی خصوصیت {{ $item->name }} :</span></div>--}}
                                                    {{--<input type="text" class="form-control inputfield"  name="specification_amount_number[{{ $item->id }}]"  value="{{ $item->productSpecificationItems->where('product_id', $product->id)->first()->amount}}">--}}
                                                    {{--</div>--}}
                                                    {{--@endforeach--}}
                                                    {{--@endforeach--}}
                                                    {{--@endif--}}

                                                    <div class="input-group mt-3">
                                                        <div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"> برچسب ها :</span></div>
                                                        <input value="{{ $tags }}" type="text" id="input-tags" name="tags" class="form-control" />
                                                    </div>
                                                    <p class="text-danger mb-2 mt-2 text-bold">برای ثبت برچسب از دکمه Enter استفاده نمایید</p>


                                                    {{--@forelse( $product->facilities as $facility)--}}
                                                    {{--<div  class="input-group mt-3">--}}
                                                    {{--<div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"> امکانات محصول :</span></div>--}}
                                                    {{--<input type="text" class="form-control inputfield" name="facility[{{ $facility->id }}]" value="{{ $facility->name }}">--}}
                                                    {{--</div>--}}
                                                    {{--@empty--}}
                                                    {{--@endforelse--}}
                                                    {{--<div class="facility">--}}
                                                    {{--<div class="input-group mt-3">--}}
                                                    {{--<div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7"> امکانات محصول :</span></div>--}}
                                                    {{--<input type="text" class="form-control inputfield" name="facility[]" value="">--}}
                                                    {{--<div class="input-group-append"><a class="addFacility icon-hover"><span class="h-50px input-group-text bg-light text-dark font-weight-bold iranyekan" id="basic-addon8"><i class="fa fa-plus mr-2"></i> افزودن--}}
                                                    {{--امکانات--}}
                                                    {{--</span></a></div>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}


                                                    {{--<div class="input-group mt-3 bg-white">--}}
                                                    {{--<div class="input-group-prepend min-width-180"><span class="input-group-text bg-light min-width-140" id="basic-addon7">امکانات ویژه محصول :</span></div>--}}
                                                    {{--<div class="custom-control custom-switch switch-blue mr-5 py-3">--}}
                                                    {{--<input type="checkbox" class="custom-control-input" id="supportProductUpdate{{ $product->id }}" name="support" @if($product->support == 'on') checked @endif>--}}
                                                    {{--<label class="custom-control-label iranyekan font-15" for="supportProductUpdate{{ $product->id }}">پشتیبانی</label>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="custom-control custom-switch switch-blue mr-5 py-3">--}}
                                                    {{--<input type="checkbox" class="custom-control-input" id="money_backProductUpdate{{ $product->id }}" name="money_back" @if($product->money_back == 'on') checked @endif>--}}
                                                    {{--<label class="custom-control-label iranyekan font-15" for="money_backProductUpdate{{ $product->id }}">بازگشت وجه--}}
                                                    {{--</label>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="custom-control custom-switch switch-blue mr-5 py-3">--}}
                                                    {{--<input type="checkbox" class="custom-control-input" id="fast_sendingProductUpdate{{ $product->id }}" name="fast_sending" @if($product->fast_sending == 'on') checked @endif>--}}
                                                    {{--<label class="custom-control-label iranyekan font-15" for="fast_sendingProductUpdate{{ $product->id }}">ارسال سریع--}}
                                                    {{--</label>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="custom-control custom-switch switch-blue mr-5 py-3">--}}
                                                    {{--<input type="checkbox" class="custom-control-input" id="secure_paymentProductUpdate{{ $product->id }}" name="secure_payment" @if($product->secure_payment == 'on') checked @endif>--}}
                                                    {{--<label class="custom-control-label iranyekan font-15" for="secure_paymentProductUpdate{{ $product->id }}">پرداخت امن--}}
                                                    {{--</label>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="custom-control custom-switch switch-blue mr-5 py-3">--}}
                                                    {{--<input type="checkbox" class="custom-control-input" id="discount_statusProductUpdate{{ $product->id }}" name="discount_status" @if($product->discount_status == 'enable') checked @endif>--}}
                                                    {{--<label class="custom-control-label iranyekan font-15" for="discount_statusProductUpdate{{ $product->id }}">قابلیت اعمال شدن کد تخفیف--}}
                                                    {{--</label>--}}
                                                    {{--</div>--}}

                                                    {{--</div>--}}

                                                    <div class="card mt-3">
                                                        <div class="card-body">
                                                            <h4 class="mt-0 header-title">تصویر محصول</h4>
                                                            <p class="text-danger my-1">حداقل ابعاد : 300px × 300px</p>
                                                            <p class="text-danger">حداکثر ابعاد : 1000px × 1000px</p>
                                                            <a class="mr-2 font-15" href="" id="icon-delete" title="حذف خصوصیت" data-name="{{ $product->name }}" data-id="{{ $product->id }}"><i class="far fa-trash-alt text-danger font-18 pl-2"></i>حذف</a>
                                                            <input type="file" id="input-file-now" name="image" class="dropify" data-default-file="{{ $product->image['original'] }}">
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
    <!--end::Page Scripts -->
    <script src="/assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>

@stop