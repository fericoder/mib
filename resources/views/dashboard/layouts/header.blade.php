<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="/">
            <img style="width: 90px;padding: 10px;" alt="Logo" src="/assets/logo.png"/>
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">

        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                    class="flaticon-more-1"></i></button>
    </div>
</div>
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <!-- begin:: Header -->
            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on">
                <div class="kt-header__top">
                    <div class="kt-container ">
                        <!-- begin:: Brand -->
                        <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
                            <div class="kt-header__brand-logo">
                                <a href="/">
                                    <img style="width: 120px;padding: 10px;" alt="Logo" src="/assets/logo.png"
                                         class="kt-header__brand-logo-default"/>
                                    <img style="width: 50px;padding: 1px;" alt="Logo" src="/assets/logo.png"
                                         class="kt-header__brand-logo-sticky"/>
                                </a>
                            </div>
                            <div style="color: #fff" class="kt-header__brand-nav iranyekan">
                                <span>داشبورد مدیریت فروشگاه ایده برتر کیوان</span>
                            </div>
                        </div>
                        <!-- end:: Brand -->
                        <!-- begin:: Header Topbar -->
                        <div class="kt-header__topbar">
                            <!--begin: Search -->
                            <div class="kt-header__topbar-item kt-header__topbar-item--search dropdown kt-hidden-desktop"
                                 id="kt_quick_search_toggle">
                                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px">
			<span class="kt-header__topbar-icon">
				<!--<i class="flaticon2-search-1"></i>-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                     height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--info">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
              fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
              fill="#000000" fill-rule="nonzero"/>
    </g>
</svg>			</span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
                                    <div class="kt-quick-search kt-quick-search--dropdown kt-quick-search--result-compact"
                                         id="kt_quick_search_dropdown">
                                        <form method="get" class="kt-quick-search__form">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="flaticon2-search-1"></i></span></div>
                                                <input type="text" class="form-control kt-quick-search__input"
                                                       placeholder="Search...">
                                                <div class="input-group-append"><span class="input-group-text"><i
                                                                class="la la-close kt-quick-search__close"></i></span>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true"
                                             data-height="325" data-mobile-height="200">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Search -->

                            <!--begin: Quick panel -->

                            <!--end: Quick panel -->




                            <!--begin: Quick actions -->

                            <!--end: Quick actions -->


                            <!--begin: Language bar -->

                            <!--end: Language bar -->

                            <!--begin: User bar -->
                            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px" aria-expanded="false">
                                    <span class="kt-header__topbar-username iranyekan"> {{ \Auth::user()->fName . ' ' . \Auth::user()->lName }}</span>
                                    <img class="" alt="Pic" src="{{ \Auth::user()->avatar }}">
                                </div>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                    <!--begin: Head -->
                                    <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                                         style="background-image: url(/assets/media/misc/bg-1.jpg)">
                                        <div class="kt-user-card__avatar">
                                            <img  alt="Pic" src="{{ \Auth::user()->avatar }}"/>
                                        </div>
                                        <div class="kt-user-card__name iranyekan">
                                            {{ \Auth::user()->fName . ' ' . \Auth::user()->lName }}
                                        </div>
                                    </div>
                                    <!--end: Head -->

                                    <!--begin: Navigation -->
                                    <div class="kt-notification">
                                        <a href="/profile"
                                           class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <i class="flaticon2-calendar-3 kt-font-success"></i>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title kt-font-bold">
                                                    پروفایل کاربری
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    ویرایش رمز عبور و اطلاعات کاربری
                                                </div>
                                            </div>
                                        </a>

                                        <div class="kt-notification__custom kt-space-between">
                                            <a href="/logout"
                                               class="btn btn-label btn-label-brand btn-sm btn-bold">خروج از سیستم</a>
                                        </div>
                                    </div>
                                    <!--end: Navigation -->
                                </div>
                            </div>
                            <!--end: User bar -->
                        </div>
                        <!-- end:: Header Topbar -->
                    </div>
                </div>
                <div class="kt-header__bottom">
                    <div class="kt-container ">
                        <!-- begin: Header Menu -->
                        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i
                                    class="la la-close"></i></button>
                        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
                                <ul class="kt-menu__nav ">

                                    <li style="" class="kt-menu__item "
                                        data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="/" class="kt-menu__link">
                                            <span class="kt-menu__link-text">فروشگاه</span>
                                            <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    </li>

                                    <li style="" class="kt-menu__item {{ request()->is('dashboard/index') ? 'kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here' : '' }} "
                                        data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="{{ route('dashboard.index') }}" class="kt-menu__link">
                                            <span class="kt-menu__link-text">داشبورد</span>
                                            <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    </li>

                                    <li class="kt-menu__item {{ request()->is('*products*') ? 'kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here' : '' }} "
                                        data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="{{ route('products.index') }}" class="kt-menu__link">
                                            <span class="kt-menu__link-text"> محصولات</span>
                                            <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    </li>

                                    <li class="kt-menu__item {{ request()->is('*categories*') ? 'kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here' : '' }} "
                                        data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="{{ route('categories.index') }}" class="kt-menu__link">
                                            <span class="kt-menu__link-text">  دسته بندی ها</span>
                                            <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    </li>

                                    <li class="kt-menu__item {{ request()->is('*specification*') ? 'kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here' : '' }} "
                                        data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="{{ route('specifications.index') }}" class="kt-menu__link">
                                            <span class="kt-menu__link-text">  خصوصیات</span>
                                            <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    </li>



                                    <li class="kt-menu__item {{ request()->is('*brands*') ? 'kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here' : '' }} "
                                        data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="{{ route('brands.index') }}" class="kt-menu__link">
                                            <span class="kt-menu__link-text"> برند ها</span>
                                            <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    </li>



                                    <li  class="kt-menu__item {{ request()->is('*comments*') ? 'kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here' : '' }} "
                                        data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="{{ route('comments.index') }}" class="kt-menu__link">
                                            <span class="kt-menu__link-text">نظرات</span>
                                            <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    </li>


                                    <li class="kt-menu__item {{ request()->is('*purchases*') ? 'kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here' : '' }} "
                                        data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="{{ route('purchases.index') }}" class="kt-menu__link">
                                            <span class="kt-menu__link-text"> سفارشات</span>
                                            <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    </li>

                                    <li class="kt-menu__item {{ request()->is('*users*') ? 'kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here' : '' }} "
                                        data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="{{ route('users.index') }}" class="kt-menu__link">
                                            <span class="kt-menu__link-text"> مشتریان</span>
                                            <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    </li>

                                    <li class="kt-menu__item {{ request()->is('*users*') ? 'kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here' : '' }} "
                                        data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="{{ route('faqs.index') }}" class="kt-menu__link">
                                            <span class="kt-menu__link-text">سوالات متداول</span>
                                            <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    </li>


                                    <li class="kt-menu__item {{ request()->is('*settings*') ? 'kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here' : '' }} "
                                        data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="{{ route('settings.index') }}" class="kt-menu__link">
                                            <span class="kt-menu__link-text"> مدیریت سیستم</span>
                                            <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    </li>


                                </ul>
                            </div>
                            <div class="kt-header-toolbar">
                                <div class="kt-quick-search kt-quick-search--inline kt-quick-search--result-compact"
                                     {{--id="kt_quick_search_inline">--}}
                                     id="">
                                    <form method="get" class="kt-quick-search__form">
                                        <div class="input-group">
                                            <div style="width: 50px!important;" class="input-group-prepend"><span class="input-group-text"><i
                                                            class="flaticon2-search-1"></i></span></div>
                                            <input  type="text" class="form-control kt-quick-search__input"
                                                   placeholder="جستجو محصول ...">
                                            <div class="input-group-append"><span class="input-group-text"><i
                                                            class="la la-close kt-quick-search__close"
                                                            style="display: none;"></i></span></div>
                                        </div>
                                    </form>
                                    <div id="kt_quick_search_toggle" data-toggle="dropdown"
                                         data-offset="0px,10px"></div>
                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
                                        <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true"
                                             data-height="300" data-mobile-height="200">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end: Header Menu -->
                    </div>
                </div>
            </div>
            <!-- end:: Header -->


            <!-- begin::Quick Panel -->
            <div id="kt_quick_panel" class="kt-quick-panel">
                <a href="#" class="kt-quick-panel__close" id="kt_quick_panel_close_btn"><i class="flaticon2-delete"></i></a>

                <div class="kt-quick-panel__nav">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_tab_notifications" role="tab">اعلان ها</a>
                        </li>
                        <li style="display: none" class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_logs" role="tab">Audit Logs</a>
                        </li>
                        <li style="display: none" class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_settings" role="tab">Settings</a>
                        </li>
                    </ul>
                </div>

                <div class="kt-quick-panel__content">
                    <div class="tab-content">
                        <div class="tab-pane fade show kt-scroll active" id="kt_quick_panel_tab_notifications" role="tabpanel">
                            <div class="kt-notification">



                                {{--@foreach(Auth::user()->notifications->where('read_at', null) as $notification)--}}

                                    {{--<a href="{{ $notification['data']['url'] }}" class="kt-notification__item">--}}
                                        {{--<div class="kt-notification__item-details">--}}
                                            {{--<div class="kt-notification__item-title">--}}
                                                {{--تسک جدید برای شما اضافه شد:--}}
                                                {{--<br>--}}
                                              {{--<b>  {{ $notification['data']['title'] }} </b>--}}
                                            {{--</div><br><br>--}}
                                            {{--<div style="font-family: BYekan!important" class="kt-notification__item-time">--}}
                                                {{--{{ jdate($notification->created_at)->ago() }}--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                {{--@endforeach--}}






                            </div>
                        </div>
                        <div style="display: none" class="tab-pane fade kt-scroll" id="kt_quick_panel_tab_logs" role="tabpanel">
                            <div class="kt-notification-v2">
                                <a href="#" class="kt-notification-v2__item">
                                    <div class="kt-notification-v2__item-icon">
                                        <i class="flaticon-bell kt-font-brand"></i>
                                    </div>
                                    <div class="kt-notification-v2__itek-wrapper">
                                        <div class="kt-notification-v2__item-title">
                                            5 new user generated report
                                        </div>
                                        <div class="kt-notification-v2__item-desc">
                                            Reports based on sales
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="kt-notification-v2__item">
                                    <div class="kt-notification-v2__item-icon">
                                        <i class="flaticon2-box kt-font-danger"></i>
                                    </div>
                                    <div class="kt-notification-v2__itek-wrapper">
                                        <div class="kt-notification-v2__item-title">
                                            2 new items submited
                                        </div>
                                        <div class="kt-notification-v2__item-desc">
                                            by Grog John
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="kt-notification-v2__item">
                                    <div class="kt-notification-v2__item-icon">
                                        <i class="flaticon-psd kt-font-brand"></i>
                                    </div>
                                    <div class="kt-notification-v2__itek-wrapper">
                                        <div class="kt-notification-v2__item-title">
                                            79 PSD files generated
                                        </div>
                                        <div class="kt-notification-v2__item-desc">
                                            Reports based on sales
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="kt-notification-v2__item">
                                    <div class="kt-notification-v2__item-icon">
                                        <i class="flaticon2-supermarket kt-font-warning"></i>
                                    </div>
                                    <div class="kt-notification-v2__itek-wrapper">
                                        <div class="kt-notification-v2__item-title">
                                            $2900 worth producucts sold
                                        </div>
                                        <div class="kt-notification-v2__item-desc">
                                            Total 234 items
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="kt-notification-v2__item">
                                    <div class="kt-notification-v2__item-icon">
                                        <i class="flaticon-paper-plane-1 kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification-v2__itek-wrapper">
                                        <div class="kt-notification-v2__item-title">
                                            4.5h-avarage response time
                                        </div>
                                        <div class="kt-notification-v2__item-desc">
                                            Fostest is Barry
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="kt-notification-v2__item">
                                    <div class="kt-notification-v2__item-icon">
                                        <i class="flaticon2-information kt-font-danger"></i>
                                    </div>
                                    <div class="kt-notification-v2__itek-wrapper">
                                        <div class="kt-notification-v2__item-title">
                                            Database server is down
                                        </div>
                                        <div class="kt-notification-v2__item-desc">
                                            10 mins ago
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="kt-notification-v2__item">
                                    <div class="kt-notification-v2__item-icon">
                                        <i class="flaticon2-mail-1 kt-font-brand"></i>
                                    </div>
                                    <div class="kt-notification-v2__itek-wrapper">
                                        <div class="kt-notification-v2__item-title">
                                            System report has been generated
                                        </div>
                                        <div class="kt-notification-v2__item-desc">
                                            Fostest is Barry
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="kt-notification-v2__item">
                                    <div class="kt-notification-v2__item-icon">
                                        <i class="flaticon2-hangouts-logo kt-font-warning"></i>
                                    </div>
                                    <div class="kt-notification-v2__itek-wrapper">
                                        <div class="kt-notification-v2__item-title">
                                            4.5h-avarage response time
                                        </div>
                                        <div class="kt-notification-v2__item-desc">
                                            Fostest is Barry
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div style="display: none" class="tab-pane kt-quick-panel__content-padding-x fade kt-scroll" id="kt_quick_panel_tab_settings" role="tabpanel">
                            <form class="kt-form">
                                <div class="kt-heading kt-heading--sm kt-heading--space-sm">Customer Care</div>

                                <div class="form-group form-group-xs row">
                                    <label class="col-8 col-form-label">Enable Notifications:</label>
                                    <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--success kt-switch--sm">
								<label>
									<input type="checkbox" checked="checked" name="quick_panel_notifications_1">
									<span></span>
                            </label>
                            </span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-8 col-form-label">Enable Case Tracking:</label>
                                    <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--success kt-switch--sm">
								<label>
									<input type="checkbox"  name="quick_panel_notifications_2">
									<span></span>
                            </label>
                            </span>
                                    </div>
                                </div>
                                <div class="form-group form-group-last form-group-xs row">
                                    <label class="col-8 col-form-label">Support Portal:</label>
                                    <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--success kt-switch--sm">
								<label>
									<input type="checkbox" checked="checked" name="quick_panel_notifications_2">
									<span></span>
                            </label>
                            </span>
                                    </div>
                                </div>

                                <div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>

                                <div class="kt-heading kt-heading--sm kt-heading--space-sm">Reports</div>

                                <div class="form-group form-group-xs row">
                                    <label class="col-8 col-form-label">Generate Reports:</label>
                                    <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--sm kt-switch--danger">
								<label>
									<input type="checkbox" checked="checked" name="quick_panel_notifications_3">
									<span></span>
                            </label>
                            </span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-8 col-form-label">Enable Report Export:</label>
                                    <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--sm kt-switch--danger">
								<label>
									<input type="checkbox"  name="quick_panel_notifications_3">
									<span></span>
                            </label>
                            </span>
                                    </div>
                                </div>
                                <div class="form-group form-group-last form-group-xs row">
                                    <label class="col-8 col-form-label">Allow Data Collection:</label>
                                    <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--sm kt-switch--danger">
								<label>
									<input type="checkbox" checked="checked" name="quick_panel_notifications_4">
									<span></span>
                            </label>
                            </span>
                                    </div>
                                </div>

                                <div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>

                                <div class="kt-heading kt-heading--sm kt-heading--space-sm">Memebers</div>

                                <div class="form-group form-group-xs row">
                                    <label class="col-8 col-form-label">Enable Member singup:</label>
                                    <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--sm kt-switch--brand">
								<label>
									<input type="checkbox" checked="checked" name="quick_panel_notifications_5">
									<span></span>
                            </label>
                            </span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-8 col-form-label">Allow User Feedbacks:</label>
                                    <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--sm kt-switch--brand">
								<label>
									<input type="checkbox"  name="quick_panel_notifications_5">
									<span></span>
                            </label>
                            </span>
                                    </div>
                                </div>
                                <div class="form-group form-group-last form-group-xs row">
                                    <label class="col-8 col-form-label">Enable Customer Portal:</label>
                                    <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--sm kt-switch--brand">
								<label>
									<input type="checkbox" checked="checked" name="quick_panel_notifications_6">
									<span></span>
                            </label>
                            </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end::Quick Panel -->
