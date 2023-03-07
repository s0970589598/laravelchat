<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>滿意度調查</title>
        <meta name="robots" content="noindex , nofollow">
		<!-- <base href="https://app.starcharger.com.tw/" /> -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="/css/style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="/assets/metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.css" rel="stylesheet" type="text/css" />
        <link href="/assets/metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/metronic/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="/assets/metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="/assets/metronic/theme/assets/global/plugins/bootstrap-datepaginator/bootstrap-datepaginator.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/metronic/theme/assets/global/plugins/morris/morris.css" rel="sfatylesheet" type="text/css" />
        <link href="/assets/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/assets/metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/assets/metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/metronic/theme/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="/assets/metronic/theme_rtl/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/metronic/theme_rtl/assets/layouts/layout4/css/themes/light.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="/assets/metronic/theme_rtl/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="/assets/images/fav-icon.png" />
        <link href="/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
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
                        <img src="/assets/images/logo.png" alt="logo" class="logo-default" height="32px">
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
                            <a href="/dashboard" class="nav-link">
                                <i class="icon-graph"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item ">
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
                            <li class="nav-item start active">
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
                                <li class="nav-item start">
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
                                <li class="nav-item start ">
                                    <a href="/salutatory" class="nav-link ">
                                        <i class="fa fa-hand-paper-o"></i>
                                        <span class="title">歡迎詞設定</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item ">
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
                    .clearfix {
                        clear: both;
                    }

                    td {
                        overflow: hidden;
                    }
                </style>
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title">
                            <h1 class="title">滿意度調查</h1>
                            <div class="time"></div>
                        </div>
                        <div class="portlet-title">
                            <div class="row widget-row">
                                <div class="col-md-4">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <a class="widget-thumb-click" href="#">
                                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered" style="padding-bottom: 20px;">
                                            <h4 class="widget-thumb-heading">滿意度調查發出數</h4>
                                            <div class="widget-thumb-wrap">
                                                <div class="widget-thumb-body">
                                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                                        data-value="7,644">10<small class="unit">份</small></span>
                                                </div>
                                                <i class="widget-thumb-icon bg-orange icon-user"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- END WIDGET THUMB -->
                                </div>
                                <div class="col-md-4">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <a class="widget-thumb-click" href="#">
                                        <div
                                            class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered" style="padding-bottom: 20px;">
                                            <h4 class="widget-thumb-heading">在線客服人數</h4>
                                            <div class="widget-thumb-wrap">
                                                <div class="widget-thumb-body">
                                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                                        data-value="7,644">02<small class="unit">份</small></span>
                                                </div>
                                                <i class="widget-thumb-icon bg-green-jungle icon-earphones-alt"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- END WIDGET THUMB -->
                                </div>
                                <div class="col-md-4">
                                    <!-- BEGIN WIDGET THUMB -->
                                    <a class="widget-thumb-click" href="#">
                                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered" style="padding-bottom: 20px;">
                                            <h4 class="widget-thumb-heading">滿意度調查平均分數</h4>
                                            <div class="widget-thumb-wrap">
                                                <div class="widget-thumb-body">
                                                    <span class="widget-thumb-body-stat" data-counter="counterup"
                                                        data-value="7,644">4.2<small class="unit">分</small></span>
                                                </div>
                                                <i class="widget-thumb-icon bg-red icon-link"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- END WIDGET THUMB -->
                                </div>
                            </div>
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="actions">
                                        <div class="form-group">
                                            <form class="form-inline">
                                                <div class="input-group input-large date-picker input-daterange"
                                                    data-date="10/11/2012" data-date-format="mm/dd/yyyy"
                                                    style="margin-right: 5px;">
                                                    <input type="text" class="form-control" name="from"
                                                        placeholder="請選擇開始時間">
                                                    <span class="input-group-addon"> to </span>
                                                    <input type="text" class="form-control" name="to"
                                                        placeholder="請選擇結束時間">
                                                </div>
                                                <select name="manager_group_sn" class="form-control" style="margin-right: 5px;">
                                                    <option value="0">請選擇服務中心</option>
                                                    <option value="1">Ａ旅遊服務中心</option>
                                                    <option value="2">Ｂ旅遊服務中心</option>
                                                    <option value="3">Ｃ旅遊服務中心</option>
                                                    <option value="4">Ｄ旅遊服務中心</option>
                                                    <option value="5">Ｅ旅遊服務中心</option>
                                                </select>
                                                <select name="manager_group_sn" class="form-control" style="margin-right: 5px;">
                                                    <option value="0">請選擇滿意度評分</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                                <button type="submit" class="search-btn" id="btn-search"
                                                    style="margin-right: 5px;">
                                                    <i class="fa fa-search"></i>
                                                    查詢
                                                </button>
                                                <a class="add-btn" href="javascript:volid(0);">
                                                    <i class="fa fa-download"></i>
                                                    匯出
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="portlet-body">
                                        <div class="table-scrollable">
                                            <table class="table table-striped table-bordered table-hover" id="table_member">
                                                <thead>
                                                    <tr>
                                                        <th>旅服中心</th>
                                                        <th>填寫日期</th>
                                                        <th>評分</th>
                                                        <th>未成單率</th>
                                                        <th>平均回覆時間</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>基隆火車站旅遊服務中心</td>
                                                        <td>2022-10-1 10:23:49</td>
                                                        <td>5</td>
                                                        <td>1%</td>
                                                        <td>1 小時</td>
                                                    </tr>
                                                    <tr>
                                                        <td>基隆火車站旅遊服務中心</td>
                                                        <td>2022-10-1 10:23:49</td>
                                                        <td>5</td>
                                                        <td>1%</td>
                                                        <td>1 小時</td>
                                                    </tr>
                                                    <tr>
                                                        <td>基隆火車站旅遊服務中心</td>
                                                        <td>2022-10-1 10:23:49</td>
                                                        <td>5</td>
                                                        <td>1%</td>
                                                        <td>1 小時</td>
                                                    </tr>
                                                    <tr>
                                                        <td>基隆火車站旅遊服務中心</td>
                                                        <td>2022-10-1 10:23:49</td>
                                                        <td>5</td>
                                                        <td>1%</td>
                                                        <td>1 小時</td>
                                                    </tr>
                                                    <tr>
                                                        <td>基隆火車站旅遊服務中心</td>
                                                        <td>2022-10-1 10:23:49</td>
                                                        <td>5</td>
                                                        <td>1%</td>
                                                        <td>1 小時</td>
                                                    </tr>
                                                    <tr>
                                                        <td>基隆火車站旅遊服務中心</td>
                                                        <td>2022-10-1 10:23:49</td>
                                                        <td>5</td>
                                                        <td>1%</td>
                                                        <td>1 小時</td>
                                                    </tr>
                                                    <tr>
                                                        <td>基隆火車站旅遊服務中心</td>
                                                        <td>2022-10-1 10:23:49</td>
                                                        <td>5</td>
                                                        <td>1%</td>
                                                        <td>1 小時</td>
                                                    </tr>
                                                    <tr>
                                                        <td>基隆火車站旅遊服務中心</td>
                                                        <td>2022-10-1 10:23:49</td>
                                                        <td>5</td>
                                                        <td>1%</td>
                                                        <td>1 小時</td>
                                                    </tr>
                                                    <tr>
                                                        <td>基隆火車站旅遊服務中心</td>
                                                        <td>2022-10-1 10:23:49</td>
                                                        <td>5</td>
                                                        <td>1%</td>
                                                        <td>1 小時</td>
                                                    </tr>
                                                    <tr>
                                                        <td>基隆火車站旅遊服務中心</td>
                                                        <td>2022-10-1 10:23:49</td>
                                                        <td>5</td>
                                                        <td>1%</td>
                                                        <td>1 小時</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="pull-left">
                                            <div class="pagination-panel">
                                                顯示第 1 到 10 筆
                                                <select name="limit" id="select_limit" class="pagination-panel-input form-control input-sm input-inline" style="width: 72px;">
                                                    <option value="administrator/manager/table/1?limit=10&amp;">
                                                        10
                                                    </option>
                                                    <option value="administrator/manager/table/1?limit=30&amp;">
                                                        30
                                                    </option>
                                                    <option value="administrator/manager/table/1?limit=50&amp;">
                                                        50
                                                    </option>
                                                    <option value="administrator/manager/table/1?limit=100&amp;">
                                                        100
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- pagination -->
                                        <div class="pull-right">
                                            <ul id="pagination" class="pagination-sm pagination"></ul>
                                        </div>
                                        <!-- /pagination -->
                                        <div style="clear:both;"></div>
                                        <!-- /.portlet -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                    </div>
                    <!-- /.portlet -->
                </div>
                <!-- END CONTAINER -->
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">新增信件範本</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="/msgsample/add" method="post">
                    {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="type" class="col-form-label">Type:</label>
                        <select name="type">
                            <option value="交通問題">交通問題</option>
                            <option value="設備問題">設備問題</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject" class="col-form-label">Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject">
                    </div>
                    <div class="form-group">
                        <label for="reply" class="col-form-label">Reply:</label>
                        <textarea class="form-control" id="reply" name="reply"></textarea>
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
                <form action="/msgsample/edit" method="post">
                    {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="type" class="col-form-label">Type:</label>
                        <select name="type">
                            <option value="交通問題">交通問題</option>
                            <option value="設備問題">設備問題</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject" class="col-form-label">Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject">
                        <input type="hidden" class="form-control" id="id" name="id">
                    </div>
                    <div class="form-group">
                        <label for="reply" class="col-form-label">Reply:</label>
                        <textarea class="form-control" id="reply" name="reply"></textarea>
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
       <!-- BEGIN CORE PLUGINS -->
    <!-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="/assets/metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- <script src="assets/js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script> -->
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="/assets/metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/assets/metronic/theme/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="/assets/metronic/theme_rtl/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme_rtl/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
    <!-- <script src="assets/metronic/layouts/layout4/scripts/quick-sidebar.min.js" type="text/javascript"></script> -->
    <!-- <script type="text/javascript" src="assets/js/lib/fancybox/jquery.fancybox.pack.js"></script> -->
    <!-- END THEME LAYOUT SCRIPTS -->
    <script type="text/javascript" src="/assets/metronic/theme/assets/global/plugins/jquery.twbsPagination.min.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script>
        $(function() {
            $('#editModal').on('show.bs.modal', function(e) {
                let btn = $(e.relatedTarget); // e.related here is the element that opened the modal, specifically the row button
                let id = btn.data('id'); // this is how you get the of any `data` attribute of an element
                let type = btn.closest('td').siblings('.custom-type').data('type');
                let subject = btn.closest('td').siblings('.custom-subject').data('subject');
                let reply = btn.closest('td').siblings('.custom-reply').data('reply');
                let modal = $(this); //要修改的modal就是現在開啟的這個modal

                $('.modalTextInput').val('');
                $('.saveEdit').data('id', id); // then pass it to the button inside the modal
                modal.find('.modal-body select#type').val(type);//把抓到的資料顯示在input內
                modal.find('.modal-body input#subject').val(subject);
                modal.find('.modal-body textarea#reply').val(reply);
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
        var root = am5.Root.new("chartdiv");


        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX",
            pinchZoomX:true
        }));

        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
            behavior: "none"
        }));
        cursor.lineY.set("visible", false);


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