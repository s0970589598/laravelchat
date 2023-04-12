<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
    <meta charset="utf-8" />
    <title>帳號管理</title>
    <meta name="robots" content="noindex , nofollow">
    <!-- <base href="https://app.starcharger.com.tw/" /> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <link href="assets/metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <link href="assets/metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.css" rel="stylesheet"
        type="text/css" />
    <link href="assets/metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="assets/metronic/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet"
        type="text/css" />
    <link href="assets/metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.css" rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="assets/metronic/theme/assets/global/plugins/bootstrap-datepaginator/bootstrap-datepaginator.min.css"
        rel="stylesheet" type="text/css" />
    <link href="assets/metronic/theme/assets/global/plugins/morris/morris.css" rel="sfatylesheet" type="text/css" />
    <link href="assets/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"
        rel="stylesheet" type="text/css" />
    <link href="assets/metronic/theme/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css"
        rel="stylesheet">
    <link href="assets/metronic/theme/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet">
    <link href="assets/metronic/theme/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet">
    <link href="assets/metronic/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet">
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="assets/metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components"
        type="text/css" />
    <link href="assets/metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/metronic/theme/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"
        type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="assets/metronic/theme_rtl/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/metronic/theme_rtl/assets/layouts/layout4/css/themes/light.min.css" rel="stylesheet"
        type="text/css" id="style_color" />
    <link href="assets/metronic/theme_rtl/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="assets/images/fav-icon.png" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
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
        .form-body h4 {
            margin-bottom: 32px;
            color: #999;
        }

        .btn_file_upload {
            float: left;
        }

        .page-content-wrapper .page-content {
            padding-top: 0px;
        }

        .bg-red-500 {
            background: #D0522C;
            display: block;
            text-align: center;
            padding: 6px 4px;
            color: white;
            font-size: 12px;
        }

        .bg-green-500 {
            background: #21ab68;
            display: block;
            text-align: center;
            padding: 6px 4px;
            color: white;
            font-size: 12px;
        }
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
                                <a href="/dashboard" class="dropdown-toggle" >
                                    <span class="username username-hide-on-mobile">{{ Auth::user()->email }}</span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                    <img alt="" class="img-circle" src="assets/images/user-default.png"/>
                                </a>

                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <li class="dropdown dropdown-extended quick-sidebar-toggler">
                                <span class="sr-only">Toggle Quick Sidebar</span>
                                <form method="POST" id="logout-form" action="{{ route('logout') }}">
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
                                <span class="title">客服摘要對話</span>
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
                                <li class="nav-item start">
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
                        <li class="nav-item active">
                            <a href="/account" class="nav-link nav-toggle">
                                <i class="icon-user"></i>
                                <span class="title">帳號管理</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="/motc" class="nav-link nav-toggle">
                                <i class="fa fa-building-o"></i>
                            <span class="title">旅服中心管理</span>
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
            <h1 class="title">帳號管理</h1>
        </div>
        <div class="portlet light">
            <div class="portlet-title">
                <div class="actions">
                    <form class="form-inline" id="form-search" action="/account" method="GET">
                        <input name="user_name_keyword" class="form-control" placeholder="請輸入姓名或帳號" value="" style="margin-right: 5px;">
                        <input name="page" type="hidden" value="1"/>
                        <button type="submit" class="search-btn" id="btn-search" style="margin-right: 5px;">
                            <i class="fa fa-search"></i>
                            查詢
                        </button>
                        <select name="manager_group_sn" class="form-control" style="margin-right: 5px;">
                            <option value="">請選擇所屬中心單位</option>
                            @foreach($motc_station as $motc)
                            <option value="{{$motc->station_name}}">{{$motc->station_name}}</option>
                            @endforeach
                        </select>
                        @if($auth_service_role['role'] == 'admin' || $auth_service_role['role'] == 'admin99')
                        <a class="add-btn" data-target="#add-account" data-toggle="modal">
                            <i class="icon-plus"></i>
                            新增人員
                        </a>
                        @endif
                    </form>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover" id="table_member">
                        <thead>
                            <tr>
                                <th>帳號</th>
                                <th>姓名</th>
                                <th>權限</th>
                                <th>所屬旅服中心</th>
                                <th>最後上線時間</th>
                                <th>上線狀態</th>
                                <th class="feature">功能</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($users as $user)
                            <tr>
                                <td data-email="{{ $user->email }}" class="custom-email">{{  $user->email }}</td>
                                <td data-username="{{ $user->name }}" class="custom-username">{{ $user->name }}</td>
                                <td data-role="{{ $user->role }}" class="custom-role">{{ Config::get('motcrole.'.$user->role) }}</td>
                                <td data-service="{{ $user->service }}" class="custom-service">
                                    @if(!empty($user->service))
                                        @foreach(json_decode($user->service) as $s)
                                        <span class="tag" style="display: inline-block;margin-top: 6px;">{{$s}}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if(! is_null($user->last_seen))
                                    {{Carbon\Carbon::parse($user->last_seen)->diffForHumans()}}
                                    @endif
                                </td>
                                <td>
                                    <span class="bg-{{$user->last_seen >= now()->subMinutes(30) ? 'green':'red'}}-500 text-white py-1 px-3 rounded-full text-lg">
                                        {{($user->last_seen >= now()->subMinutes(30)) ? 'Online' : 'Offline'}}
                                    </span>
                                </td>
                                <td style="white-space: nowrap;">
                                    @if($auth_service_role['role'] == 'admin' || $auth_service_role['role'] == 'admin99')
                                        <button class="btn edit-btn btn-sm" data-id="{{ $user->user_id }}" data-title="{{ $user->user_id }}" data-toggle="modal" data-target="#editModal" style="margin-right: 0;"><i class="icon-pencil"></i>編輯</button>
                                        <a href="/account/upstatus/{{$user->user_id}}" class="btn delet-btn btn-sm"><i class="icon-trash"></i>刪除</button></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <div style="clear:both;"></div>
                <div class="pull-left">
                    <div class="pagination-panel">
                        顯示第 1 到 10 筆
                        <form class="form-inline" id="form-search" method="GET" action="/account">
                            <select name="limit" id="select_limit" class="pagination-panel-input form-control input-sm input-inline" style="width: 72px;" onchange="this.form.submit()">
                                <option value="10">
                                    10
                                </option>
                                <option value="30">
                                    30
                                </option>
                                <option value="50">
                                    50
                                </option>
                                <option value="100">
                                    100
                                </option>
                            </select>
                        </form>
                    </div>
                </div>
                <!-- pagination -->
                <div class="pull-right">
                    <ul id="pagination" class="pagination-sm pagination"></ul>
                    <?php echo $users->links(); ?>

                </div>
                <!-- /pagination -->
                <div style="clear:both;"></div>
                    <!-- /.portlet -->
                </div>
            </div>
            <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> Copyright © 2023 交通部觀光局 ALL RIGHTS RESERVED.</div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->

        <!-- BEGIN ADD ACCOUNT MODAL -->
        <div id="add-account" class="modal container fade" tabindex="-1" aria-hidden="true"
        style="display: none; margin-top: -397px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">新增帳號</h4>
        </div>
        <form action="/account/add" method="post">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="row">
                    <label class="col-md-3 control-label" style="margin-bottom: 20px;">姓名</label>
                    <div class="col-md-9" style="margin-bottom: 20px;">
                        <input type="text" class="form-control" placeholder="請輸入姓名" name="name" id="name">
                    </div>
                    <label class="col-md-3 control-label" style="margin-bottom: 20px;">Email</label>
                    <div class="col-md-9" style="margin-bottom: 20px;">
                        <input type="email" class="form-control" placeholder="請輸入Email" name="email" id="email">
                    </div>
                    <label class="control-label col-md-3" style="margin-bottom: 20px;">所屬旅服中心</label>
                    <div class="col-md-9" style="margin-bottom: 20px;">
                        <select class="form-control select2-multiple select2-hidden-accessible" multiple="" tabindex="-1"
                            aria-hidden="true" name="service[]">
                            <optgroup label="旅遊服務中心">
                                @foreach($motc_station as $motc)
                                <option value="{{$motc->station_name}}">{{$motc->station_name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <label class="control-label col-md-3" style="margin-bottom: 20px;">權限</label>
                    <div class="col-md-9" style="margin-bottom: 20px;">
                        <select class="bs-select form-control bs-select-hidden" name="role">
                            <option value="customer">客服人員</option>
                            <option value="admin">站長</option>
                            <option value="admin99">超級管理員</option>
                            </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="close-btn" data-dismiss="modal">取消</button>
                <button class="submit-btn">新增</button>
            </div>
        </form>
    </div>
    <!-- END ADD ACCOUNT MODAL -->

    <!-- BEGIN EDIT ACCOUNT MODAL -->
    <div id="editModal" class="modal container fade" tabindex="-1" aria-hidden="true"
        style="display: none; margin-top: -397px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">編輯帳號</h4>
        </div>
        <form action="/account/edit" method="post">
            {{ csrf_field() }}
        <div class="modal-body">
            <div class="row">
                {{-- <label class="col-md-3 control-label" style="margin-bottom: 20px;">姓名</label>
                <div class="col-md-9" style="margin-bottom: 20px;">
                    <input type="text" class="form-control" placeholder="請輸入姓名" id="username" name="name">
                </div> --}}
                <label class="col-md-3 control-label" style="margin-bottom: 20px;">Email</label>
                <div class="col-md-9" style="margin-bottom: 20px;">
                    <input type="email" class="form-control" placeholder="請輸入Email" id="email" name="email">
                    <input type="hidden" class="form-control" id="id" name="id">
                </div>
                <label class="control-label col-md-3" style="margin-bottom: 20px;">所屬旅服中心</label>
                <div class="col-md-9" style="margin-bottom: 20px;">
                    <select class="form-control select2-multiple select2-hidden-accessible" multiple="" tabindex="-1"
                        aria-hidden="true" name="service[]" id="serviceedit">

                        <optgroup label="旅遊服務中心">
                            @foreach($motc_station as $motc)
                            <option value="{{$motc->station_name}}">{{$motc->station_name}}</option>
                            @endforeach
                        </optgroup>

                        {{-- <optgroup label="基隆市">
                            <option value="基隆火車站旅遊服務中心">基隆火車站旅遊服務中心</option>
                        </optgroup>
                        <optgroup label="台北市">
                            <option value="臺北火車站旅遊服務中心">臺北火車站旅遊服務中心</option>
                            <option value="桃園捷運A1台北車站旅遊服務中心">桃園捷運A1台北車站旅遊服務中心</option>
                            <option value="捷運西門站旅遊服務中心">捷運西門站旅遊服務中心</option>
                            <option value="捷運臺北101/世貿站旅遊服務中心">捷運臺北101/世貿站旅遊服務中心</option>
                        </optgroup> --}}
                    </select>
                </div>
                <label class="control-label col-md-3" style="margin-bottom: 20px;">權限</label>
                <div class="col-md-9" style="margin-bottom: 20px;">
                    <select class="bs-select form-control bs-select-hidden" name="role" id ="roleedit">
                        <option id="roleOption" value="customer">客服人員</option>
                        <option id="roleOption" value="admin">站長</option>
                        <option id="roleOption" value="admin99">超級管理員</option>
                </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="close-btn" data-dismiss="modal">取消</button>
            <button class="submit-btn">儲存</button>
        </div>
        </form>
    </div>
    <!-- END EDIT ACCOUNT MODAL -->


        {{-- <div class="modal container fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/account/edit" method="post">
                    {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email" class="col-form-label">email:</label>
                        <input type="text" class="form-control" id="email" name="email">
                        <input type="hidden" class="form-control" id="id" name="id">
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-form-label">role:</label>
                        <select name="role">
                            <option value="admin">管理者</option>
                            <option value="customer">客服</option>
                            <option value="user">一般</option>
                            <option value="admin99">最高管理者</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service" class="col-form-label">中心:</label>
                        <div class="file-loading">
                            <input class="typeahead" type="text" id="service" value="Amsterdam,Washington" data-role="tagsinput" name="service"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
              </div>
            </div>
        </div> --}}

        <!--[if lt IE 9]>
            <script src="assets/metronic/global/plugins/respond.min.js"></script>
            <script src="assets/metronic/global/plugins/excanvas.min.js"></script>
        <![endif]-->
         <!-- BEGIN CORE PLUGINS -->
    <!-- BEGIN CORE PLUGINS -->
    <!-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="assets/metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js"
        type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
        type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/uniform/jquery.uniform.min.js"
        type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript"></script>
    <!-- <script src="assets/js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script> -->
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/moment.min.js"
        type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"
        type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
        type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
        type="text/javascript"></script>
    <script
        src="assets/metronic/theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"
        type="text/javascript"></script>
    <script src="assets/metronic/theme/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="assets/metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="assets/metronic/theme/assets/pages/scripts/components-date-time-pickers.min.js"
        type="text/javascript"></script>

    {{-- bug modal js--}}
    {{-- <script src="assets/metronic/theme/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
    <script src="assets/metronic/theme/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
    <script src="assets/metronic/theme/assets/pages/scripts/ui-extended-modals.min.js"></script> --}}

    <script src="assets/metronic/theme/assets/global/plugins/select2/js/select2.full.min.js"></script>
    <script src="assets/metronic/theme/assets/pages/scripts/components-select2.min.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="assets/metronic/theme_rtl/assets/layouts/layout4/scripts/layout.min.js"
        type="text/javascript"></script>
    <script src="assets/metronic/theme_rtl/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
    <!-- <script src="assets/metronic/layouts/layout4/scripts/quick-sidebar.min.js" type="text/javascript"></script> -->
    <!-- <script type="text/javascript" src="assets/js/lib/fancybox/jquery.fancybox.pack.js"></script> -->
    <!-- END THEME LAYOUT SCRIPTS -->
    <script type="text/javascript"
        src="assets/metronic/theme/assets/global/plugins/jquery.twbsPagination.min.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="js/all.js"></script>
    <script src="js/session.js?202304121404" type="text/javascript"></script>

    <script>
            document.addEventListener('DOMContentLoaded', function() {
                startTimer();
            });

        // 非同型陣列
        $(function() {
            const arr4 = [{ admin: "站長", admin99: "超級管理員",customer: "客服" }]
            //console.log(arr4[0].admin)

            $('#editModal').on('show.bs.modal', function(e) {
                let btn = $(e.relatedTarget); // e.related here is the element that opened the modal, specifically the row button
                let id = btn.data('id'); // this is how you get the of any `data` attribute of an element
                let email = btn.closest('td').siblings('.custom-email').data('email');
                let role = btn.closest('td').siblings('.custom-role').data('role');
                let service = btn.closest('td').siblings('.custom-service').data('service');
                let username = btn.closest('td').siblings('.custom-username').data('username');
                let modal = $(this); //要修改的modal就是現在開啟的這個modal

                modal.find('.modal-body input#email').val(email);//把抓到的資料顯示在input內
                modal.find('#roleedit').val(role);
                modal.find('#username').val(username);
                var serviceStrAry = String(service).split(',');
                $('#serviceedit').select2('val',serviceStrAry);
                modal.find('.modal-body input#id').val(id);
            })
        })
    </script>
    </body>
</html>