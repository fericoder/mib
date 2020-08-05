@extends('dashboard.layouts.master', ['title' => 'تصاویر محصول'])

@section('headerScripts')

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

                <span class="kt-subheader__desc iranyekan">تصاویر محصول</span>
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
                                تصاویر مربوط به {{ $product->title }}
                            </h3>
                            <button id="openDz" class="btn btn-success text-white d-inline-block text-right ml-3 font-weight-bold rounded"> افزودن تصویر به گالری</button>
                            <script>
                                $( "#openDz" ).click(function() {
                                    document.getElementsByClassName("dropzone")[0].click();
                                });

                            </script>

                        </div>
                    </div>

                    <div class="kt-portlet__body">
                        <!--begin: Datatable -->
                        <link rel="stylesheet" href="/assets/plugins/dropzone/dropzone.min.css">
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                        <script src="/assets/plugins/dropzone/dropzone.js"></script>

                        <form method="post" action="{{ url('/dashboard/image/upload/store/' . collect(request()->segments())->last() )}}" enctype="multipart/form-data"
                              class="dropzone" id="dropzone">
                            <div class="dz-message" data-dz-message><span>جهت افزودن تصویر به گالری، اینجا کلیک کنید</span></div>
                            @csrf
                        </form>


                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- end:: Content -->

@stop


@section('footerScripts')


        <script type="text/javascript">
            $("#dropzone").dropzone({

                maxFilesize: 30,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time+file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.PNG,.JPG, .mp4, .mkv, .avi",
                addRemoveLinks: true,
                timeout: 50000,
                maxFiles: 4,
                removedfile: function(file)
                {
                    var name = file.name;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: '{{ url("/dashboard/image/delete") }}',
                        data: {filename: name},
                        success: function (data){
                            console.log("File has been successfully removed!!");
                        },
                        error: function(e) {
                            console.log(e);
                        }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },

                init: function () {

                            @foreach($galleries as $gallery)
                    var mockFile = {name: "{{ url("$gallery->filename") }}", size: 12345, type: 'image/jpeg'};
                    this.options.addedfile.call(this, mockFile);
                    this.options.thumbnail.call(this, mockFile, "{{ url("$gallery->filename") }}");
                    mockFile.previewElement.classList.add('dz-success');
                    mockFile.previewElement.classList.add('dz-complete');
                    @endforeach


                }
            });



    </script>




@stop
