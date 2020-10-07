@extends('layouts.admin')

@section('content')


    <!-- begin:: Content -->
    <div class="kt-content kt-grid__item kt-grid__item--fluid">

        <!--Begin::Dashboard 4-->

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-6">

                <!--begin:: Widgets/Sale Reports-->
                <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Users / Companies List
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#users_list" role="tab">
                                        Users
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#company_list" role="tab">
                                        Companies
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <!--Begin::Tab Content-->
                        <div class="tab-content">

                            <!--begin::tab 1 content-->
                            <div class="tab-pane active" id="users_list">

                                <!--begin::Widget 11-->
                                <div class="kt-widget11">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td style="width:1%">#</td>
                                                <td style="width:40%">Application</td>
                                                <td style="width:14%">Sales</td>
                                                <td style="width:15%">Change</td>
                                                <td style="width:15%">Status</td>
                                                <td style="width:15%" class="kt-align-right">Total</td>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($users as $user)
                                                <tr>
                                                    <td>
                                                        {{$user->id}}
                                                    </td>
                                                    <td>
                                                        <a href="#" class="kt-widget11__title">{{$user->name}}</a>
                                                        <span class="kt-widget11__sub">{{$user->user_type}}</span>
                                                    </td>
                                                    <td>
                                                        @if ($user->profile)
                                                            {{$user->profile->gender}}
                                                        @endif
                                                        </td>
                                                    <td>{{$user->created_at}}</td>
                                                    <td><span class="kt-badge kt-badge--inline kt-badge--brand">new</span></td>
                                                    <td class="kt-align-right kt-font-brand kt-font-bold">$34,740</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="kt-widget11__action kt-align-right">
                                        <button type="button" class="btn btn-label-brand btn-bold btn-sm">Import Report</button>
                                    </div>
                                </div>

                                <!--end::Widget 11-->
                            </div>

                            <!--end::tab 1 content-->

                            <!--begin::tab 2 content-->
                            <div class="tab-pane" id="company_list">

                                <!--begin::Widget 11-->
                                <div class="kt-widget11">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td style="width:1%">#</td>
                                                <td style="width:40%">Application</td>
                                                <td style="width:14%">Sales</td>
                                                <td style="width:15%">Change</td>
                                                <td style="width:15%">Status</td>
                                                <td style="width:15%" class="kt-align-right">Total</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($companies as $company)
                                                <tr>
                                                    <td>
                                                        <label class="kt-checkbox kt-checkbox--single">
                                                            <input type="checkbox"><span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="kt-widget11__title">{{$company->name}}</span>
                                                        <span class="kt-widget11__sub">CRM System</span>
                                                    </td>
                                                    <td>@if ($user->profile)
                                                            {{$user->profile->address_1}}
                                                        @endif</td>
                                                    <td>$63</td>
                                                    <td><span class="kt-badge kt-badge--inline kt-badge--danger">pending</span></td>
                                                    <td class="kt-align-right kt-font-brand  kt-font-bold">$23,740</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="kt-widget11__action kt-align-right">
                                        <button type="button" class="btn btn-label-success btn-bold btn-sm">Generate Report</button>
                                    </div>
                                </div>

                                <!--end::Widget 11-->
                            </div>

                            <!--end::tab 2 content-->

                            <!--begin::tab 3 content-->
                            <div class="tab-pane" id="kt_widget11_tab3_content">
                            </div>

                            <!--end::tab 3 content-->
                        </div>

                        <!--End::Tab Content-->
                    </div>
                </div>

                <!--end:: Widgets/Sale Reports-->
            </div>
            <div class="col-xl-6">

                <!--Begin::Portlet-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Recent Activities
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">

                                    <!--begin::Nav-->
                                    <ul class="kt-nav">
                                        <li class="kt-nav__head">
                                            Export Options
                                            <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                                        </li>
                                        <li class="kt-nav__separator"></li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-drop"></i>
                                                <span class="kt-nav__link-text">Activity</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                                <span class="kt-nav__link-text">FAQ</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-link"></i>
                                                <span class="kt-nav__link-text">Settings</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                                <span class="kt-nav__link-text">Support</span>
                                                <span class="kt-nav__link-badge">
																				<span class="kt-badge kt-badge--success">5</span>
																			</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__separator"></li>
                                        <li class="kt-nav__foot">
                                            <a class="btn btn-label-danger btn-bold btn-sm" href="#">Upgrade plan</a>
                                            <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                        </li>
                                    </ul>

                                    <!--end::Nav-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <!--Begin::Timeline 3 -->
                        <div class="kt-timeline-v2">
                            <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">
                                <div class="kt-timeline-v2__item">
                                    <span class="kt-timeline-v2__item-time">10:00</span>
                                    <div class="kt-timeline-v2__item-cricle">
                                        <i class="fa fa-genderless kt-font-danger"></i>
                                    </div>
                                    <div class="kt-timeline-v2__item-text  kt-padding-top-5">
                                        Lorem ipsum dolor sit amit,consectetur eiusmdd tempor<br>
                                        incididunt ut labore et dolore magna
                                    </div>
                                </div>
                                <div class="kt-timeline-v2__item">
                                    <span class="kt-timeline-v2__item-time">12:45</span>
                                    <div class="kt-timeline-v2__item-cricle">
                                        <i class="fa fa-genderless kt-font-success"></i>
                                    </div>
                                    <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                                        AEOL Meeting With
                                    </div>
                                    <div class="kt-list-pics kt-list-pics--sm kt-padding-l-20">
                                        <a href="#"><img src="./assets/media/users/100_4.jpg" title=""></a>
                                        <a href="#"><img src="./assets/media/users/100_13.jpg" title=""></a>
                                        <a href="#"><img src="./assets/media/users/100_11.jpg" title=""></a>
                                        <a href="#"><img src="./assets/media/users/100_14.jpg" title=""></a>
                                    </div>
                                </div>
                                <div class="kt-timeline-v2__item">
                                    <span class="kt-timeline-v2__item-time">14:00</span>
                                    <div class="kt-timeline-v2__item-cricle">
                                        <i class="fa fa-genderless kt-font-brand"></i>
                                    </div>
                                    <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                        Make Deposit <a href="#" class="kt-link kt-link--brand kt-font-bolder">USD 700</a> To ESL.
                                    </div>
                                </div>
                                <div class="kt-timeline-v2__item">
                                    <span class="kt-timeline-v2__item-time">16:00</span>
                                    <div class="kt-timeline-v2__item-cricle">
                                        <i class="fa fa-genderless kt-font-warning"></i>
                                    </div>
                                    <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                        Lorem ipsum dolor sit amit,consectetur eiusmdd tempor<br>
                                        incididunt ut labore et dolore magna elit enim at minim<br>
                                        veniam quis nostrud
                                    </div>
                                </div>
                                <div class="kt-timeline-v2__item">
                                    <span class="kt-timeline-v2__item-time">17:00</span>
                                    <div class="kt-timeline-v2__item-cricle">
                                        <i class="fa fa-genderless kt-font-info"></i>
                                    </div>
                                    <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                        Placed a new order in <a href="#" class="kt-link kt-link--brand kt-font-bolder">SIGNATURE MOBILE</a> marketplace.
                                    </div>
                                </div>
                                <div class="kt-timeline-v2__item">
                                    <span class="kt-timeline-v2__item-time">16:00</span>
                                    <div class="kt-timeline-v2__item-cricle">
                                        <i class="fa fa-genderless kt-font-brand"></i>
                                    </div>
                                    <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                        Lorem ipsum dolor sit amit,consectetur eiusmdd tempor<br>
                                        incididunt ut labore et dolore magna elit enim at minim<br>
                                        veniam quis nostrud
                                    </div>
                                </div>
                                <div class="kt-timeline-v2__item">
                                    <span class="kt-timeline-v2__item-time">17:00</span>
                                    <div class="kt-timeline-v2__item-cricle">
                                        <i class="fa fa-genderless kt-font-danger"></i>
                                    </div>
                                    <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                        Received a new feedback on <a href="#" class="kt-link kt-link--brand kt-font-bolder">FinancePro App</a> product.
                                    </div>
                                </div>
                                <div class="kt-timeline-v2__item">
                                    <span class="kt-timeline-v2__item-time">15:30</span>
                                    <div class="kt-timeline-v2__item-cricle">
                                        <i class="fa fa-genderless kt-font-danger"></i>
                                    </div>
                                    <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                        New notification message has been received on <a href="#" class="kt-link kt-link--brand kt-font-bolder">LoopFin Pro</a> product.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--End::Timeline 3 -->
                    </div>
                </div>

                <!--End::Portlet-->
            </div>
        </div>

        <!--End::Section-->

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12">
                <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
                    <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Exclusive Datatable Plugin
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-md dropdown-menu-fit">

                                    <!--begin::Nav-->
                                    <ul class="kt-nav">
                                        <li class="kt-nav__head">
                                            Export Options
                                            <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                                        </li>
                                        <li class="kt-nav__separator"></li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-drop"></i>
                                                <span class="kt-nav__link-text">Activity</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                                <span class="kt-nav__link-text">FAQ</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-link"></i>
                                                <span class="kt-nav__link-text">Settings</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                                <span class="kt-nav__link-text">Support</span>
                                                <span class="kt-nav__link-badge">
																				<span class="kt-badge kt-badge--success">5</span>
																			</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__separator"></li>
                                        <li class="kt-nav__foot">
                                            <a class="btn btn-label-danger btn-bold btn-sm" href="#">Upgrade plan</a>
                                            <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                        </li>
                                    </ul>

                                    <!--end::Nav-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit">

                        <!--begin: Datatable -->
                        <div class="kt-datatable" id="kt_datatable_latest_orders"></div>

                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
        </div>

        <!--End::Section-->

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-6">

                <!--begin:: Widgets/Application Sales-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Application Sales
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_widget11_tab1_content" role="tab">
                                        Last Month
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_widget11_tab2_content" role="tab">
                                        All Time
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_widget11_tab1_content">

                                <!--begin::Widget 11-->
                                <div class="kt-widget11">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td style=" width: 1%;"></td>
                                                <td style=" width: 20%;">Application</td>
                                                <td style=" width: 10%;">Sales</td>
                                                <td style=" width: 20%;">Change</td>
                                                <td style=" width: 10%;">Status</td>
                                                <td style=" width: 10%;" class="kt-align-right">Total</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox--single">
                                                        <input type="checkbox"><span></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <span class="kt-widget11__title">Vertex 2.0</span>
                                                    <span class="kt-widget11__sub">Vertex To By Again</span>
                                                </td>
                                                <td>19,200</td>
                                                <td>
                                                    <div class="kt-widget11__chart" style="height:50px; width: 100px">
                                                        <iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                                                        <canvas id="kt_chart_sales_by_apps_1_1" style="display: block; width: 100px; height: 50px;" width="100" height="50"></canvas>
                                                    </div>
                                                </td>
                                                <td><span class="kt-badge kt-badge--danger kt-badge--inline">in process</span></td>
                                                <td class="kt-align-right kt-font-brand kt-font-bold">$14,740</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox--single"><input type="checkbox"><span></span></label>
                                                </td>
                                                <td>
                                                    <span class="kt-widget11__title">Metronic</span>
                                                    <span class="kt-widget11__sub">Powerful Admin Theme</span>
                                                </td>
                                                <td>24,310</td>
                                                <td>
                                                    <div class="kt-widget11__chart" style="height:50px; width: 100px">
                                                        <canvas id="kt_chart_sales_by_apps_1_2" style="display: block; width: 100px; height: 50px;" width="100" height="50"></canvas>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="kt-badge kt-badge--success kt-badge--inline">pending</span>
                                                </td>
                                                <td class="kt-align-right kt-font-brand kt-font-bold">$16,010</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox--single"><input type="checkbox"><span></span></label>
                                                </td>
                                                <td>
                                                    <span class="kt-widget11__title">Apex</span>
                                                    <span class="kt-widget11__sub">The Best Selling App</span>
                                                </td>
                                                <td>9,076</td>
                                                <td>
                                                    <div class="kt-widget11__chart" style="height:50px; width: 100px">
                                                        <canvas id="kt_chart_sales_by_apps_1_3" style="display: block; width: 100px; height: 50px;" width="100" height="50"></canvas>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="kt-badge kt-badge--brand kt-badge--inline">new</span>
                                                </td>
                                                <td class="kt-align-right kt-font-brand kt-font-bold">$37,200</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox--single"><input type="checkbox"><span></span></label>
                                                </td>
                                                <td>
                                                    <span class="kt-widget11__title">Cascades</span>
                                                    <span class="kt-widget11__sub">Design Tool</span>
                                                </td>
                                                <td>11,094</td>
                                                <td>
                                                    <div class="kt-widget11__chart" style="height:50px; width: 100px">
                                                        <canvas id="kt_chart_sales_by_apps_1_4" style="display: block; width: 100px; height: 50px;" width="100" height="50"></canvas>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="kt-badge kt-badge--warning kt-badge--inline">new</span>
                                                </td>
                                                <td class="kt-align-right kt-font-brand kt-font-bold">$8,520</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="kt-widget11__action kt-align-right">
                                        <button type="button" class="btn btn-label-success btn-sm btn-bold">View All Records</button>
                                    </div>
                                </div>

                                <!--end::Widget 11-->
                            </div>
                            <div class="tab-pane" id="kt_widget11_tab2_content">

                                <!--begin::Widget 11-->
                                <div class="kt-widget11">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td style=" width: 1%;"></td>
                                                <td style=" width: 20%;">Application</td>
                                                <td style=" width: 10%;">Sales</td>
                                                <td style=" width: 20%;">Change</td>
                                                <td style=" width: 10%;">Status</td>
                                                <td style=" width: 10%;" class="kt-align-right">Total</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox--single">
                                                        <input type="checkbox"><span></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <span class="kt-widget11__title">Loop</span>
                                                    <span class="kt-widget11__sub">CRM System</span>
                                                </td>
                                                <td>19,200</td>
                                                <td>
                                                    <div class="kt-widget11__chart" style="height:50px; width: 100px">
                                                        <canvas id="kt_chart_sales_by_apps_2_1" style="display: block; width: 0px; height: 0px;" height="0" width="0"></canvas>
                                                    </div>
                                                </td>
                                                <td><span class="kt-badge kt-badge--danger kt-badge--inline">in process</span></td>
                                                <td class="kt-align-right kt-font-brand">$34,740</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox--single"><input type="checkbox"><span></span></label>
                                                </td>
                                                <td>
                                                    <span class="kt-widget11__title">Selto</span>
                                                    <span class="kt-widget11__sub">Powerful Website Builder</span>
                                                </td>
                                                <td>24,310</td>
                                                <td>
                                                    <div class="kt-widget11__chart" style="height:50px; width: 100px">
                                                        <canvas id="kt_chart_sales_by_apps_2_2" style="display: block; width: 0px; height: 0px;" height="0" width="0"></canvas>
                                                    </div>
                                                </td>
                                                <td><span class="kt-badge kt-badge--success kt-badge--inline">new</span></td>
                                                <td class="kt-align-right kt-font-brand">$46,010</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox--single"><input type="checkbox"><span></span></label>
                                                </td>
                                                <td>
                                                    <span class="kt-widget11__title">Jippo</span>
                                                    <span class="kt-widget11__sub">The Best Selling App</span>
                                                </td>
                                                <td>9,076</td>
                                                <td>
                                                    <div class="kt-widget11__chart" style="height:50px; width: 100px">
                                                        <canvas id="kt_chart_sales_by_apps_2_3" style="display: block; width: 0px; height: 0px;" height="0" width="0"></canvas>
                                                    </div>
                                                </td>
                                                <td><span class="kt-badge kt-badge--brand kt-badge--inline">approved</span></td>
                                                <td class="kt-align-right kt-font-brand">$67,800</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox--single"><input type="checkbox"><span></span></label>
                                                </td>
                                                <td>
                                                    <span class="kt-widget11__title">Verto</span>
                                                    <span class="kt-widget11__sub">Web Development Tool</span>
                                                </td>
                                                <td>11,094</td>
                                                <td>
                                                    <div class="kt-widget11__chart" style="height:50px; width: 100px">
                                                        <canvas id="kt_chart_sales_by_apps_2_4" style="display: block; width: 0px; height: 0px;" height="0" width="0"></canvas>
                                                    </div>
                                                </td>
                                                <td><span class="kt-badge kt-badge--danger kt-badge--inline">pending</span></td>
                                                <td class="kt-align-right kt-font-brand">$18,520</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="kt-widget11__action kt-align-right">
                                        <button type="button" class="btn btn-outline-brand btn-bold">View All Records</button>
                                    </div>
                                </div>

                                <!--end::Widget 11-->
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Application Sales-->
            </div>
            <div class="col-xl-6">

                <!--begin:: Widgets/Latest Updates-->
                <div class="kt-portlet kt-portlet--height-fluid ">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Latest Updates
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">
                                Today
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">

                                <!--begin::Nav-->
                                <ul class="kt-nav">
                                    <li class="kt-nav__head">
                                        Export Options
                                        <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                                    </li>
                                    <li class="kt-nav__separator"></li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-drop"></i>
                                            <span class="kt-nav__link-text">Activity</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                            <span class="kt-nav__link-text">FAQ</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-link"></i>
                                            <span class="kt-nav__link-text">Settings</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                            <span class="kt-nav__link-text">Support</span>
                                            <span class="kt-nav__link-badge">
																			<span class="kt-badge kt-badge--success">5</span>
																		</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__separator"></li>
                                    <li class="kt-nav__foot">
                                        <a class="btn btn-label-danger btn-bold btn-sm" href="#">Upgrade plan</a>
                                        <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                    </li>
                                </ul>

                                <!--end::Nav-->
                            </div>
                        </div>
                    </div>

                    <!--full height portlet body-->
                    <div class="kt-portlet__body kt-portlet__body--fluid kt-portlet__body--fit">
                        <div class="kt-widget4 kt-widget4--sticky">
                            <div class="kt-widget4__items kt-portlet__space-x kt-margin-t-15">
                                <div class="kt-widget4__item">
																<span class="kt-widget4__icon">
																	<i class="flaticon2-graphic  kt-font-brand"></i>
																</span>
                                    <a href="#" class="kt-widget4__title">
                                        Metronic Admin Theme
                                    </a>
                                    <span class="kt-widget4__number kt-font-brand">+500</span>
                                </div>
                                <div class="kt-widget4__item">
																<span class="kt-widget4__icon">
																	<i class="flaticon2-analytics-2  kt-font-success"></i>
																</span>
                                    <a href="#" class="kt-widget4__title">
                                        Green Maker Team
                                    </a>
                                    <span class="kt-widget4__number kt-font-success">-64</span>
                                </div>
                                <div class="kt-widget4__item">
																<span class="kt-widget4__icon">
																	<i class="flaticon2-drop  kt-font-danger"></i>
																</span>
                                    <a href="#" class="kt-widget4__title">
                                        Make Apex Great Again
                                    </a>
                                    <span class="kt-widget4__number kt-font-danger">+1080</span>
                                </div>
                                <div class="kt-widget4__item">
																<span class="kt-widget4__icon">
																	<i class="flaticon2-pie-chart-4 kt-font-warning"></i>
																</span>
                                    <a href="#" class="kt-widget4__title">
                                        A Programming Language
                                    </a>
                                    <span class="kt-widget4__number kt-font-warning">+19</span>
                                </div>
                            </div>
                            <div class="kt-widget4__chart kt-margin-t-15">
                                <canvas id="kt_chart_latest_updates" style="height: 150px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Latest Updates-->
            </div>
        </div>

        <!--End::Section-->

        <!--End::Dashboard 4-->
    </div>

    <!-- end:: Content -->

    @if(Auth::user()->user_type == "admin")
        You are logged into Administration!
    @endif
@endsection
