<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>對話管理</title>
        <meta name="robots" content="noindex , nofollow">
		<!-- <base href="https://app.starcharger.com.tw/" /> -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="css/style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/metronic/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="assets/metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/metronic/theme/assets/global/plugins/bootstrap-datepaginator/bootstrap-datepaginator.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/metronic/theme/assets/global/plugins/morris/morris.css" rel="sfatylesheet" type="text/css" />
        <link href="assets/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/metronic/theme/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="assets/metronic/theme_rtl/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/metronic/theme_rtl/assets/layouts/layout4/css/themes/light.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="assets/metronic/theme_rtl/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="assets/images/fav-icon.png" />
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.5/sweetalert2.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.5/sweetalert2.min.js?1"  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <style>
            /*.page-header .page-header-top .page-logo .logo-default {
                margin: 10px 0 0;
            }
            .page-header .page-header-top{
                height: 60px;
            }
            .page-header .page-header-top .page-logo{
                height: 60px;
            }
            .page-header .page-header-top .top-menu{
                margin-top: 6px;
            }*/
            .form-body h4{
                margin-bottom: 32px;
                color: #999;
            }
            .btn_file_upload{
                float: left;
            }
            .page-content-wrapper .page-content{padding-top: 0px;}
        </style>
    </head>
    <!-- END HEAD -->
    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="#">
                        <img src="assets/images/logo.png" alt="logo" class="logo-default" height="32px">
                    </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="separator hide"> </li>
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile">{{ Auth::user()->email }}</span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                    <img alt="" class="img-circle" src="assets/images/user-default.png"/>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="">
                                            <i class="icon-user"></i> 個人資料修改
                                        </a>
                                    </li>
                                    <li>
                                          <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                <i class="icon-key"></i> {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <li class="dropdown dropdown-extended quick-sidebar-toggler">
                                <span class="sr-only">Toggle Quick Sidebar</span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        <i class="icon-logout"></i>
                                    </x-dropdown-link>
                                </form>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item start ">
                            <a href="/dashboard" class="nav-link active">
                                <i class="icon-graph"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="/dialoguelist" class="nav-link nav-toggle">
                                <i class="icon-bubble"></i>
                                <span class="title">對話管理</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                        <a href="javascript:volid(0);" class="nav-link nav-toggle">
                            <i class="icon-list"></i>
                            <span class="title">管理統計資料</span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu" style="display: block;">
                            <li class="nav-item start ">
                                <a href="/satisfaction" class="nav-link ">
                                    <i class="icon-pencil"></i>
                                    <span class="title">管理統計</span>
                                </a>
                            </li>
                            <li class="nav-item start ">
                                <a href="/satisfaction/manage" class="nav-link ">
                                    <i class="icon-pencil"></i>
                                    <span class="title">滿意度調查</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                        <li class="nav-item ">
                            <a href="javascript:volid(0);" class="nav-link nav-toggle">
                                <i class="icon-list"></i>
                                <span class="title">腳本編輯器</span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu" style="display: block;">
                                <li class="nav-item start ">
                                    <a href="/mailsample" class="nav-link ">
                                        <i class="icon-envelope"></i>
                                        <span class="title">信件範本</span>
                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="/msgsample" class="nav-link ">
                                        <i class="icon-bubbles"></i>
                                        <span class="title">訊息範本</span>
                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="/media" class="nav-link ">
                                        <i class="icon-folder"></i>
                                        <span class="title">媒體庫</span>
                                    </a>
                                </li>
                                <li class="nav-item start">
                                    <a href="/salutatory" class="nav-link ">
                                        <i class="fa fa-hand-paper-o"></i>
                                        <span class="title">歡迎詞設定</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/faq" class="nav-link nav-toggle">
                                <i class="icon-drawer"></i>
                                <span class="title">知識庫FAQ</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="/account" class="nav-link nav-toggle">
                                <i class="icon-user"></i>
                                <span class="title">帳號管理</span>
                            </a>
                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">

<style>
    .clearfix{clear:both;}
    td{
        overflow: hidden;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <h1 class="title">對話管理</h1>
        </div>
        <div class="portlet light">
            <div class="portlet-title">
                <div class="actions">
                    <form class="form-inline" id="form-search" method="GET">
                        <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy" style="margin-right: 5px;">
                            <input type="text" class="form-control" name="from" placeholder="請選擇開始時間">
                            <span class="input-group-addon"> to </span>
                            <input type="text" class="form-control" name="to" placeholder="請選擇結束時間">
                        </div>
                        <select name="manager_group_sn" class="form-control" style="margin-right: 5px;">
                            <option value="">請選擇服務中心</option>
                            @foreach($motc_station as $motc)
                            <option value="{{$motc->sn}}">{{$motc->station_name}}</option>
                            @endforeach
                        </select>
                        <select name="manager_group_sn" class="form-control" style="margin-right: 5px;">
                            <option value="0">請選擇狀態</option>
                            <option value="1">待客服</option>
                            <option value="2">客服中</option>
                            <option value="3">已完成</option>
                            <option value="4">逾期未回覆</option>
                            <option value="5">智能客服</option>
                            <option value="6">客服轉介</option>
                        </select>
                        <input name="question_keyword" class="form-control" placeholder="請搜尋關鍵字"
                            value="" style="margin-right: 5px;">
                        <input name="page" type="hidden" value="1" />
                        <button type="submit" class="search-btn" id="btn-search"
                            style="margin-right: 5px;">
                            <i class="fa fa-search"></i>
                            查詢
                        </button>
                        <a class="add-btn"  onclick="exportCSV()">
                            匯出
                        </a>

                    </form>
                </div>
            </div>
<div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover" id="table_member">
                        <thead>
                            <tr>
                                <th>訊息來源</th>
                                <th>旅客名稱</th>
                                <th>節錄對話</th>
                                <th>狀態</th>
                                <th class="feature">指派</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rooms as $room): ?>
                            <tr>
                                <td>
                                    <?php
                                        $service = App\Models\MotcStation::where('sn',$room->service)->first();
                                        echo $service_name = isset($service['station_name']) ? $service['station_name']: '';
                                    ?>
                                </td>
                                <td>
                                    <div class="customer">
                                        <img class="contact-pic" src="assets/images/user-default.png">
                                        <div class="contact">
                                            <div class="contact-name">{{ $room->name }}</div>
                                            <div class="item-label">
                                            <?php
                                                Illuminate\Support\Carbon::setLocale('zh-tw');
                                                echo Illuminate\Support\Carbon::create($room->updated_at)->diffForHumans();
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if(isset($room->messages))
                                    <div class="dialogue-content">
                                        <div class="time">
                                            {{isset($room->messages->last()->updated_at) ? $room->messages->last()->updated_at : ''}}
                                        </div>
                                        <p calss="content">
                                        @if(isset($room->messages->last()->type))
                                            @if($room->messages->last()->type === 'msgtem')
                                                訊息
                                            @elseif($room->messages->last()->type === 'media')
                                                檔案
                                            @elseif($room->messages->last()->type === 'stickers')
                                                貼圖
                                            @else
                                                {{ ($room->messages->count() > 0) ? $room->messages->last()->user->name : '' }} <br/>
                                                {{ ($room->messages->count() > 0) ? Str::limit($room->messages->last()->message, 15) : '' }}
                                            @endif
                                        @endif

                                    </p>
                                    </div>
                                    @endif

                                </td>
                                <td>
                                    @if($room->status == 1)
                                    <span class="label label-sm label-robot"> 智能客服 </span>
                                    @elseif($room->status == 2)
                                    <span class="label label-sm label-warning"> 待客服 </span>
                                    @elseif($room->status == 3)
                                    <span class="label label-sm label-info"> 客服中 </span>
                                    @elseif($room->status == 4)
                                    <span class="label label-sm label-danger"> 逾期未回覆 </span>
                                    @elseif($room->status == 5)
                                    <span class="label label-sm label-default"> 客服轉介 </span>
                                    @elseif($room->status == 6)
                                    <span class="label label-sm label-success"> 已完成 </span>
                                    @elseif($room->status == 7)
                                    <span class="label label-sm label-primary"> 待聯絡 </span>
                                    @endif

                                </td>
                                <td>
                                    <div class="assign">
                                        <a href="#" class="reply-btn" onclick="location.href='{{ route('dialogue.show', $room->id) }}'">
                                            <i class="icon-bubble"></i> 回覆
                                        </a>
                                        @if($auth_service_role['role'] == 'admin' || $auth_service_role['role'] == 'admin99')

                                        <select name="manager_group_sn" class="form-control"
                                            style="margin-right: 5px;" id="assign" onchange="assignroom(this,`{{$room->id}}`)">
                                            <option value="">請選擇指派人員</option>
                                            @foreach ($customer_list as $customer)
                                                <option value="{{$customer->user_id}}">{{$customer->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if(isset($room->users))
                                        @foreach($room->users as $user)
                                            {{-- @if(! preg_match("/\motc.go/i", $user->email)) --}}
                                            <span class="label label-info" style="margin-right: 5px;display:inline-block;margin-top:10px;re">{{$user->name}}</span>
                                            {{-- @endif --}}
                                        @endforeach
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div style="clear:both;"></div>
                <div class="pull-left">
                    <div class="pagination-panel">
                        顯示第 1 到 10 筆
                        <select name="limit" id="select_limit" class="pagination-panel-input form-control input-sm input-inline" style="width: 72px;">
                            <option value="administrator/manager/table/1?limit=10&">
                                10
                            </option>
                            <option value="administrator/manager/table/1?limit=30&">
                                30
                            </option>
                            <option value="administrator/manager/table/1?limit=50&">
                                50
                            </option>
                            <option value="administrator/manager/table/1?limit=100&">
                                100
                            </option>
                        </select>
                    </div>
                </div>
                <!-- pagination -->
                <div class="pull-right">
                    <ul id="pagination" class="pagination-sm pagination"></ul>
                    <?php

                            echo $rooms->links();
                    ?>
                </div>
                <!-- /pagination -->
                <div style="clear:both;"></div>
                </div>
            </div>
            <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> Copyright © 2023 FANINSIGHTS.IO ALL RIGHTS RESERVED.</div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!-- Modal -->
        <div class="modal fade modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">新增FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="/faq/add" method="post">
                    {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="question" class="col-form-label">Question:</label>
                        <input type="text" class="form-control" id="question" name="question">
                    </div>
                    <div class="form-group">
                        <label for="answer" class="col-form-label">Answer:</label>
                        <textarea class="form-control" id="answer" name="answer"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>

            </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/faq/edit" method="post">
                    {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="question" class="col-form-label">Question:</label>
                        <input type="text" class="form-control" id="question" name="question">
                        <input type="hidden" class="form-control" id="id" name="id">
                    </div>
                    <div class="form-group">
                        <label for="answer" class="col-form-label">Answer:</label>
                        <textarea class="form-control" id="answer" name="answer"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
              </div>
            </div>
        </div>

        <!--[if lt IE 9]>
            <script src="assets/metronic/global/plugins/respond.min.js"></script>
            <script src="assets/metronic/global/plugins/excanvas.min.js"></script>
        <![endif]-->
        <!--[if lt IE 9]>
        <script src="assets/metronic/global/plugins/respond.min.js"></script>
        <script src="assets/metronic/global/plugins/excanvas.min.js"></script>
    <![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <!-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="assets/metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- <script src="assets/js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script> -->
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="assets/metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="assets/metronic/theme/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="assets/metronic/theme_rtl/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme_rtl/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
    <!-- <script src="assets/metronic/layouts/layout4/scripts/quick-sidebar.min.js" type="text/javascript"></script> -->
    <!-- <script type="text/javascript" src="assets/js/lib/fancybox/jquery.fancybox.pack.js"></script> -->
    <!-- END THEME LAYOUT SCRIPTS -->
    <script type="text/javascript" src="assets/metronic/theme/assets/global/plugins/jquery.twbsPagination.min.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>


    <script>
        function exportCSV() {
            window.location.href = '/export-dialogue-csv'; // 導出路徑
        }

        function assignroom(selectObj,roomId){
            var selectedText = selectObj.options[selectObj.selectedIndex].text;
            console.log(Swal);
            if (!confirm('確定要指派' + selectedText + '嗎？')) {
                return; // 如果使用者取消，則不進行後續動作
            }
            $.ajax({
                url: "/api/rooms/asign",
                data: JSON.stringify({
                    "custom_id":selectObj.value,
                    "room_id":roomId
                }),
                dataType: 'json',
                contentType: 'application/json;charset=UTF-8',
                method: 'POST',
                processData: false, // important
                contentType: false, // important
                cache: false,
                success: function(data)
                {
                    // redirect
                     // 顯示成功通知
                    Swal.fire({
                        icon: 'success',
                        title: '指派成功',
                        text: '已成功指派' + selectedText
                    }).then(function() {
                        window.location.replace('/dialoguelist');
                    });
                },
                error: function(data)
                {
                    // intergrate Swal to display error
                    // Swal.close();
                    // if (data.status == 419) {
                    //     window.location.reload();
                    // } else {
                    //     Swal.fire({
                    //         icon: 'info',
                    //         title: 'Error',
                    //         html: data.responseJSON.message,
                    //     });
                    // }
                }
            });
        }

        $(function() {
            $('#editModal').on('show.bs.modal', function(e) {
                let btn = $(e.relatedTarget); // e.related here is the element that opened the modal, specifically the row button
                let id = btn.data('id'); // this is how you get the of any `data` attribute of an element
                let question = btn.closest('td').siblings('.custom-question').data('question');
                let answer = btn.closest('td').siblings('.custom-answer').data('answer');
                let modal = $(this); //要修改的modal就是現在開啟的這個modal

                $('.modalTextInput').val('');
                $('.saveEdit').data('id', id); // then pass it to the button inside the modal
                modal.find('.modal-body input#question').val(question);//把抓到的資料顯示在input內
                modal.find('.modal-body textarea#answer').val(answer);
                modal.find('.modal-body input#id').val(id);
            })

            $('.saveEdit').on('click', function() {
                let id = $(this).data('id'); // the rest is just the same
                saveNote(id);
                $('#editModal').modal('toggle'); // this is to close the modal after clicking the modal button
            })
        })

        function saveNote(id) {
        let text = $('.modalTextInput').val();
        $('.recentNote').data('note', text);
        console.log($('.recentNote').data('note'));
        console.log(text + ' --> ' + id);
        }

        am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element



        // Generate random data
        var date = new Date();
        date.setHours(0, 0, 0, 0);
        var value = 100;

        function generateData() {
            value = Math.round((Math.random() * 10 - 5) + value);
            am5.time.add(date, "day", 1);
            return {
                date: date.getTime(),
                value: value
            };
        }

        function generateDatas(count) {
            var data = [];
            for (var i = 0; i < count; ++i) {
                data.push(generateData());
            }
            return data;
        }

        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
            maxDeviation: 0.2,
            baseInterval: {
                timeUnit: "day",
                count: 1
            },
            renderer: am5xy.AxisRendererX.new(root, {}),
            tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, {})
        }));


        // Add series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.LineSeries.new(root, {
            name: "Series",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "value",
            valueXField: "date",
            tooltip: am5.Tooltip.new(root, {
                labelText: "{valueY}"
            })
        }));


        // Add scrollbar
        // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
        chart.set("scrollbarX", am5.Scrollbar.new(root, {
            orientation: "horizontal"
        }));


        // Set data
        var data = generateDatas(1200);
        series.data.setAll(data);


        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);

        }); // end am5.ready()
        </script>
    </body>
</html>