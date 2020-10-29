@extends('shop.layouts.master', ['title' => 'فرصت های شغلی' ])
@section('headerScripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@stop

@section('content')
    <div class="c-product container">
        <section class="profile-page container">

            <div class="o-page__content">

                <div class="profile-navbar">
                    <span class="title">فرصت های شغلی</span>
                    <button class="c-profile-navbar__btn-location js-add-address-btn"><i class="fa fa-map-marked"></i></button>
                </div>

                <div class="user-main">
                    <div class="modal-content register login account-box">
                        <div class="content">
                            <form style="width: 30%!important;" enctype="multipart/form-data" method="POST" action="">
@csrf
                                <label for="pwd">نام  <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="fName"  type="text" >

                                <label style="margin-top: 10px" for="pwd">نام خانوادگی <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="lName"  type="text" >

                                <label style="margin-top: 10px" for="pwd">  نام پدر <span style="color: red;    font-size: 15px;">*</span> </label>
                                <input name="fatherName"  type="text" value="">

                                <label style="margin-top: 10px" for="pwd">شماره شناسنامه <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="sh-shenasname"  type="text" >


                                <label style="margin-top: 10px" for="pwd">شماره ملی  <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="sh-meli"  type="text" >


                                <label style="margin-top: 10px" for="pwd">محل صدور  <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="issue"  type="text" >


                                <label style="margin-top: 10px" for="pwd">محل تولد  <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="birthCity"  type="text" >


                                <label style="margin-top: 10px" for="pwd">تاریخ تولد  <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="birthdate"  type="text" >

                                <label style="margin-top: 10px" for="pwd">وضعیت تاهل <span style="color: red;    font-size: 15px;">*</span></label>
                                <select required="" style="padding: 10px;font-size: 13px;" name="tahol">
                                    <option disabled="" selected="" value=""> -- کلیک کنید -- </option>
                                    <option value="مجرد ">مجرد </option>
                                    <option value="متاهل">متاهل</option>
                                </select>


                                <label style="margin-top: 10px" for="pwd">تعداد افراد تحت تکلف  <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="takallof"  type="text" >


                                <label style="margin-top: 10px" for="pwd">نشانی محل سکونت  <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="address"  type="text" >


                                <label style="margin-top: 10px" for="pwd">تلفن تماس همراه  <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="mobile"  type="text" >

                                <label style="margin-top: 10px" for="pwd">تلفن تماس ثابت  <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="phone"  type="text" >


                                <label style="margin-top: 10px" for="pwd">تلفن تماس اضطراری  <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="phone-zaroori"  type="text" >

                                <label style="margin-top: 10px" for="pwd">آدرس ایمیل <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="email"  type="email" >


                                <label style="margin-top: 10px" for="pwd">میزان آشنایی با زبان خارجی <span style="color: red;    font-size: 15px;">*</span></label>
                                <select required="" style="padding: 10px;font-size: 13px;" name="language">
                                    <option disabled="" selected="" value=""> -- کلیک کنید -- </option>
                                    <option value="ضعیف">ضعیف</option>
                                    <option value="متوسط">متوسط</option>
                                    <option value="خوب">خوب</option>
                                    <option value="عالی">عالی</option>
                                </select>

                                <label style="margin-top: 10px" for="pwd">نحوه آشنایی با مجموعه <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="ashnaei"  type="text" >

                                <label style="margin-top: 10px" for="pwd">آیا حاضر هستید مدتی به عنوان آزمایشی کار کنید  <span style="color: red;    font-size: 15px;">*</span></label>
                                <select required="" style="padding: 10px;font-size: 13px;" name="azmayeshi">
                                    <option disabled="" selected="" value=""> -- کلیک کنید -- </option>
                                    <option value="بله">بله</option>
                                    <option value="خیر">خیر</option>
                                </select>

                                <label style="margin-top: 10px" for="pwd">مدت زمان همکاری آزمایشی (ماه)<span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="azmayeshiMonths"  type="number" >


                                <label style="margin-top: 10px" for="pwd">حقوق دریافتی مورد انتظار <span style="color: red;    font-size: 15px;">*</span></label>
                                <input name="hoghoogh"  type="text" >


                                <p>لطفا سوابق تحصیلی، سوابق کاری و سوابق دوره های آموزشی در فایل رزومه خود ارسال کنید</p>


                                <div class="" >
                                    <br>
                                    <label style="margin-top: 10px;color: #656565; margin: 5px 0; letter-spacing: -.6px; font-size: 1.071rem;line-height: 1.467;font-weight: 400;" for="pwd">فایل رزومه  <span style="color: red;    font-size: 15px;">*</span></label>
                                    <input style="margin: 15px;margin-bottom: 30px;" name="javazPic" type="file">
                                </div>


                                <button style="margin-top: 30px; margin-bottom: 20px" type="submit"><i class="fa fa-lock-open"></i>بروزرسانی اطلاعات</button>
                            </form>
                        </div>
                    </div>
                </div>



            </div>
        </section>

    </div>

    <div class="jump-to-up"><i class="fa fa-chevron-up"></i> <span> بازگشت به بالا </span></div>

@stop

@section('footerScripts')


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script type="text/javascript" src="/assets/js/simple-lightbox.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        }
    </script>

@stop
