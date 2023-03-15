<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>媒體庫</title>
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
    <link href="assets/metronic/theme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet">
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
                                <li class="nav-item start active">
                                    <a href="/media" class="nav-link ">
                                        <i class="icon-folder"></i>
                                        <span class="title">媒體庫</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
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
    .clearfix{clear:both;}
    td{
        overflow: hidden;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="page-title">
            <h1 class="title">媒體庫</h1>
        </div>
        <div class="portlet light">
            <div class="portlet-title">
                <div class="actions">
                    <form class="form-inline" id="form-search" method="GET">
                        <select name="manager_question_type" class="form-control"
                            style="margin-right: 5px;">
                            <option value="圖片">圖片</option>
                            <option value="影音">影音</option>
                            <option value="文件">文件</option>
                        </select>
                        @if($auth_service_role['role'] == 'admin' || $auth_service_role['role'] == 'admin99')

                        <a class="add-btn" href="javascript:volid(0);" data-toggle="modal" data-target="#add-media">
                            <i class="icon-plus"></i>
                            新增媒體範本
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
                                <th>分類</th>
                                <th>標題</th>
                                <th>檔案</th>
                                <th class="feature">功能</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($media as $m): ?>
                            <tr>
                                <td data-type="{{ $m->type }}" class="custom-type">{{ $m->type }}</td>
                                <td data-title="{{ $m->title }}" class="custom-title">{{ $m->title }}</td>
                                <td data-file="{{ $m->file }}" class="custom-file"><img src="/file/{{ $m->file}}" alt="" height ="100" width="100"></td>
                                <td>
                                    @if($auth_service_role['role'] == 'admin' || $auth_service_role['role'] == 'admin99')
                                    <button class="btn edit-btn btn-sm" data-id="{{ $m->id }}" data-title="{{ $m->id }}"data-toggle="modal" data-target="#edit-media"><i class="icon-pencil"></i>編輯</button>
                                    <a href="/media/upstatus/{{$m->id}}" class="delet-btn"><i class="icon-trash"></i>刪除</button></a>
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
                    <?php echo $media->links(); ?>

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

        <!-- BEGIN ADD MEDIA MODAL -->
        <div id="add-media" class="modal container fade" tabindex="-1" aria-hidden="true"
        style="display: none; margin-top: -156px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">新增媒體</h4>
        </div>
        <form action="/media/add" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">
            <div class="row">
                <label class="control-label col-md-2" style="margin-bottom: 20px;">分類</label>
                <div class="col-md-10" style="margin-bottom: 20px;">
                    <select class="bs-select form-control bs-select-hidden"  name="type">
                        <option value="圖片">圖片</option>
                        <option value="影音">影音</option>
                        <option value="文件">文件</option>
                    </select>
                </div>
                <label class="col-md-2 control-label" style="margin-bottom: 20px;">標題</label>
                <div class="col-md-10" style="margin-bottom: 20px;">
                    <input type="text" class="form-control" placeholder="請輸入標題" id="title" name="title">
                </div>
                <label class="col-md-2 control-label" style="margin-bottom: 20px;">檔案</label>
                <div class="col-md-10" style="margin-bottom: 20px;">
                    <div class="fileinput fileinput-exists" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                            <img src=""></div>
                        <div>
                            <span class="btn btn-file">
                                <span class="fileinput-new"><i class="fa fa-plus"></i>
                                    上傳檔案</span>
                                <span class="fileinput-exists">更換</span>
                                <input type="hidden" value="" name=""><input type="file"  id="fileadd" name="file" accept=".jpg,.jpeg,.gif,.png,.pdf,.mov,.mp4"> </span>
                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput" style="padding: 4px 8px;border-radius: 3px !important;">移除</a>
                        </div>
                    </div>
                    <div class="clearfix margin-top-10">
                        <span class="label label-success">提醒</span>檔案支援格式jpg、jpeg、gif、png、pdf、mov、mp4，大小限制2MB。</div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="close-btn" data-dismiss="modal">取消</button>
            <button class="submit-btn" >新增</button>
        </div>
    </form>
    </div>
    <!-- END ADD MEDIA MODAL -->
    <!-- BEGIN EDIT MEDIA MODAL -->
    <div id="edit-media" class="modal container fade" tabindex="-1" aria-hidden="true"
        style="display: none; margin-top: -156px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">編輯媒體</h4>
        </div>
        <form action="/media/edit" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div class="modal-body">
            <div class="row">
                <label class="control-label col-md-2" style="margin-bottom: 20px;">分類</label>
                <div class="col-md-10" style="margin-bottom: 20px;">
                    <select class="bs-select form-control bs-select-hidden" name="type">
                        <option value="全部">全部</option>
                        <option value="圖片">圖片</option>
                        <option value="文件">文件</option>
                        <option value="影音">影音</option>
                    </select>
                </div>
                <label class="col-md-2 control-label" style="margin-bottom: 20px;">標題</label>
                <div class="col-md-10" style="margin-bottom: 20px;">
                    <input type="text" class="form-control" placeholder="請輸入標題" id="title" name="title">
                    <input type="hidden" class="form-control" id="id" name="id">
                </div>
                <label class="col-md-2 control-label" style="margin-bottom: 20px;">檔案</label>
                <div class="col-md-10" style="margin-bottom: 20px;">
                    <div class="fileinput fileinput-exists" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                            <img id="fileimg" src=""></div>
                        <div>
                            <span class="btn btn-file">
                                <span class="fileinput-new"><i class="fa fa-plus"></i>
                                    上傳檔案</span>
                                <span class="fileinput-exists">更換</span>
                                <input type="hidden" value="" name=""><input type="file" name="file" id="fileedit" accept=".jpg,.jpeg,.gif,.png,.pdf,.mov,.mp4"> </span>
                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput" style="padding: 4px 8px;border-radius: 3px !important;">移除</a>
                        </div>
                    </div>
                    <div class="clearfix margin-top-10">
                        <span class="label label-success">提醒</span>檔案支援格式jpg、jpeg、gif、png、pdf、mov、mp4，大小限制2MB。</div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="close-btn" data-dismiss="modal">取消</button>
            <button class="submit-btn" >儲存</button>
        </div>
        </form>
    </div>
    <!-- END EDIT MEDIA MODAL -->
        <!--[if lt IE 9]>
        <script src="assets/metronic/global/plugins/respond.min.js"></script>
        <script src="assets/metronic/global/plugins/excanvas.min.js"></script>
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <!-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
        <script src="assets/metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js"
            type="text/javascript"></script>
        <script src="assets/metronic/theme/assets/global/plugins/js.cookie.min.js"
            type="text/javascript"></script>
        <script
            src="assets/metronic/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
            type="text/javascript"></script>
        <script src="assets/metronic/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
            type="text/javascript"></script>
        <script src="assets/metronic/theme/assets/global/plugins/jquery.blockui.min.js"
            type="text/javascript"></script>
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
        <script
            src="assets/metronic/theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
        <script
            src="assets/metronic/theme/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
            type="text/javascript"></script>
        <script
            src="assets/metronic/theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"
            type="text/javascript"></script>
        <script src="assets/metronic/theme/assets/global/plugins/clockface/js/clockface.js"
            type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/metronic/theme/assets/pages/scripts/components-date-time-pickers.min.js"
            type="text/javascript"></script>
        {{-- <script
            src="assets/metronic/theme/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
        <script
            src="assets/metronic/theme/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
        <script src="assets/metronic/theme/assets/pages/scripts/ui-extended-modals.min.js"></script> --}}
        <script src="assets/metronic/theme/assets/global/plugins/select2/js/select2.full.min.js"></script>
        <script src="assets/metronic/theme/assets/pages/scripts/components-select2.min.js"></script>
        <script src="assets/metronic/theme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/metronic/theme_rtl/assets/layouts/layout4/scripts/layout.min.js"
            type="text/javascript"></script>
        <script src="assets/metronic/theme_rtl/assets/layouts/layout4/scripts/demo.min.js"
            type="text/javascript"></script>
        <!-- <script src="assets/metronic/layouts/layout4/scripts/quick-sidebar.min.js" type="text/javascript"></script> -->
        <!-- <script type="text/javascript" src="assets/js/lib/fancybox/jquery.fancybox.pack.js"></script> -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script type="text/javascript"
            src="assets/metronic/theme/assets/global/plugins/jquery.twbsPagination.min.js"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <script src="js/all.js"></script>


        <script src="js/session.js" type="text/javascript"></script>

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                    startTimer();
                });
            var uploadField = document.getElementById("fileedit");
            var uploadFieldadd = document.getElementById("fileadd");

            uploadField.onchange = function() {
                if(this.files[0].size > 2097152){
                alert("File is too big!");
                this.value = "";
                };
            };
            uploadFieldadd.onchange = function() {
                if(this.files[0].size > 2097152){
                alert("File is too big!");
                this.value = "";
                };
            };
            // function VerifyUploadSizeIsOK()
            // {
            //    /* Attached file size check. Will Bontrager Software LLC, https://www.willmaster.com */
            //    var UploadFieldID = "file-upload";
            //    var MaxSizeInBytes = 2048;
            //    var fld = document.getElementById(UploadFieldID);
            //    if( fld.files && fld.files.length == 1 && fld.files[0].size > MaxSizeInBytes )
            //    {
            //       alert("The file size must be no more than " + parseInt(MaxSizeInBytes/1024/1024) + "MB");
            //       return false;
            //    }
            //    return true;
            // } // function VerifyUploadSizeIsOK()

        $(function() {
            $('#edit-media').on('show.bs.modal', function(e) {
                let btn = $(e.relatedTarget); // e.related here is the element that opened the modal, specifically the row button
                let id = btn.data('id'); // this is how you get the of any `data` attribute of an element
                let type = btn.closest('td').siblings('.custom-type').data('type');
                let title = btn.closest('td').siblings('.custom-title').data('title');
                let file = btn.closest('td').siblings('.custom-file').data('file');
                let modal = $(this); //要修改的modal就是現在開啟的這個modal
                $('.modalTextInput').val('');
                $('.saveEdit').data('id', id); // then pass it to the button inside the modal
                modal.find('.modal-body input#type').val(type);//把抓到的資料顯示在input內
                modal.find('.modal-body input#title').val(title);
                modal.find('.modal-body input#id').val(id);
                $('#fileimg').attr('src', '/file/' + file);

            $('.saveEdit').on('click', function() {
                let id = $(this).data('id'); // the rest is just the same
                saveNote(id);
                $('#edit-media').modal('toggle'); // this is to close the modal after clicking the modal button
            })
        })

     });


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