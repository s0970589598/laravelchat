<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>信件範本</title>
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
    <link href="assets/metronic/theme/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet">
    <link href="assets/metronic/theme/assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet">
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
                                <li class="nav-item start active">
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
            <h1 class="title">信件範本</h1>
        </div>
        <div class="portlet light">
            <div class="portlet-title">
                <div class="actions">
                    <form class="form-inline" id="form-search" action="/mailsample" method="GET">
                        <input name="keyword" class="form-control" placeholder="請輸入關鍵字" value="" style="margin-right: 5px;">
                        <input name="page" type="hidden" value="1"/>
                        <button type="submit" class="search-btn" id="btn-search" style="margin-right: 5px;">
                            <i class="fa fa-search"></i>
                            查詢
                        </button>
                        @if($auth_service_role['role'] == 'admin' || $auth_service_role['role'] == 'admin99')
                        <a class="add-btn" href="javascript:volid(0);" data-toggle="modal" data-target="#add-mail">
                            <i class="icon-plus"></i>
                            新增信件範本
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
                                <th>情境</th>
                                <th>主題</th>
                                <th>內容</th>
                                <th class="feature">功能</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($email_sample as $mail): ?>
                            <tr>
                                <td data-typea="{{ $mail->type }}" class="custom-typea">{{ $mail->type }}</td>
                                <td data-subject="{{ $mail->subject }}" class="custom-subject">{{ $mail->subject }}</td>
                                <td data-content="{{ $mail->content }}" class="custom-content">{{ $mail->content }}</td>
                                <td>
                                    @if($auth_service_role['role'] == 'admin' || $auth_service_role['role'] == 'admin99')

                                    <button class="btn edit-btn btn-sm" data-id="{{ $mail->id }}" data-title="{{ $mail->id }}"data-toggle="modal" data-target="#edit-mail"><i class="icon-pencil"></i>編輯</button>
                                    <a href="/mailsample/upstatus/{{$mail->id}}" class="btn delet-btn btn-sm"><i class="icon-trash"></i>刪除</button></a>
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
                    <?php echo $email_sample->links(); ?>

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


              <!-- BEGIN ADD MAIL MODAL -->
              <div id="add-mail" class="modal container fade" tabindex="-1" aria-hidden="true"
              style="display: none; margin-top: -397px;">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                  <h4 class="modal-title">新增信件</h4>
              </div>
              <form action="/mailsample/add" method="post">
                {{ csrf_field() }}
              <div class="modal-body">
                  <div class="row">
                      <label class="control-label col-md-2" style="margin-bottom: 20px;">情境</label>
                      <div class="col-md-10" style="margin-bottom: 20px;">
                          <select class="bs-select form-control bs-select-hidden" id="typea" name="type">
                              <option value="新增帳號">新增帳號</option>
                              <option value="旅客綁定通知信">旅客綁定通知信</option>
                              <option value="忘記密碼">忘記密碼</option>
                              <option value="上線異常通知">上線異常通知</option>
                          </select>
                      </div>
                      <label class="col-md-2 control-label" style="margin-bottom: 20px;">主旨</label>
                      <div class="col-md-10" style="margin-bottom: 20px;">
                          <input type="text" class="form-control" placeholder="請輸入主旨" id="subject" name="subject">
                      </div>
                      <label class="control-label col-md-2">內容</label>
                      <div class="col-md-10">
                        <textarea class="form-control" id="content" name="content" rows="10" ></textarea>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button class="close-btn" data-dismiss="modal">取消</button>
                  <button class="submit-btn">新增</button>
              </div>
            </form>
          </div>
          <!-- END ADD MAIL MODAL -->

          <div id="edit-mail" class="modal container fade" tabindex="-1" aria-hidden="true"
          style="display: none; margin-top: -397px;">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">編輯信件</h4>
          </div>
          <form action="/mailsample/edit" method="post">
            {{ csrf_field() }}
          <div class="modal-body">
              <div class="row">
                  <label class="control-label col-md-2" style="margin-bottom: 20px;">情境</label>
                  <div class="col-md-10" style="margin-bottom: 20px;">
                      <select class="bs-select form-control bs-select-hidden" id="typea" name="type">
                        <option value="新增帳號">新增帳號</option>
                        <option value="旅客綁定通知信">旅客綁定通知信</option>
                        <option value="忘記密碼">忘記密碼</option>
                        <option value="上線異常通知">上線異常通知</option>
                      </select>
                  </div>
                  <label class="col-md-2 control-label" style="margin-bottom: 20px;">主旨</label>
                  <div class="col-md-10" style="margin-bottom: 20px;">
                      <input type="text" class="form-control" placeholder="請輸入主旨" id="subject" name="subject">
                      <input type="hidden" class="form-control" id="id" name="id">

                  </div>
                  <label class="control-label col-md-2">內容</label>
                  <div class="col-md-10">
                      {{-- <div name="summernote" id="summernote_1" style="display: none;"> </div><div class="note-editor panel panel-default"><div class="note-dialog"><div class="note-image-dialog modal" aria-hidden="false"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" aria-hidden="true" tabindex="-1">×</button><h4 class="modal-title">Insert Image</h4></div><div class="modal-body"><div class="form-group row note-group-select-from-files"><label>Select from files</label><input class="note-image-input form-control" type="file" name="files" accept="image/*" multiple="multiple"></div><div class="form-group row"><label>Image URL</label><input class="note-image-url form-control col-md-12" type="text"></div></div><div class="modal-footer"><button href="#" class="btn btn-primary note-image-btn disabled" disabled="">Insert Image</button></div></div></div></div><div class="note-link-dialog modal" aria-hidden="false"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" aria-hidden="true" tabindex="-1">×</button><h4 class="modal-title">Insert Link</h4></div><div class="modal-body"><div class="form-group row"><label>Text to display</label><input class="note-link-text form-control col-md-12" type="text"></div><div class="form-group row"><label>To what URL should this link go?</label><input class="note-link-url form-control col-md-12" type="text" value="http://"></div><div class="checkbox"><label><input type="checkbox" checked=""> Open in new window</label></div></div><div class="modal-footer"><button href="#" class="btn btn-primary note-link-btn disabled" disabled="">Insert Link</button></div></div></div></div><div class="note-help-dialog modal" aria-hidden="false"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"><a class="modal-close pull-right" aria-hidden="true" tabindex="-1">Close</a><div class="title">Keyboard shortcuts</div><div class="note-shortcut-row row"><div class="note-shortcut note-shortcut-col col-sm-6 col-xs-12"><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-title col-xs-offset-6">Action</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + Z</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Undo</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + ⇧ + Z</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Redo</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + ]</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Indent</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + [</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Outdent</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + ENTER</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Insert Horizontal Rule</div></div></div><div class="note-shortcut note-shortcut-col col-sm-6 col-xs-12"><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-title col-xs-offset-6">Text formatting</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + B</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Bold</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + I</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Italic</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + U</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Underline</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + \</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Remove Font Style</div></div></div></div><div class="note-shortcut-row row"><div class="note-shortcut note-shortcut-col col-sm-6 col-xs-12"><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-title col-xs-offset-6">Document Style</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + NUM0</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Normal</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + NUM1</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Header 1</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + NUM2</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Header 2</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + NUM3</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Header 3</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + NUM4</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Header 4</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + NUM5</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Header 5</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + NUM6</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Header 6</div></div></div><div class="note-shortcut note-shortcut-col col-sm-6 col-xs-12"><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-title col-xs-offset-6">Paragraph formatting</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + ⇧ + L</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Align left</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + ⇧ + E</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Align center</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + ⇧ + R</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Align right</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + ⇧ + J</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Justify full</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + ⇧ + NUM7</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Ordered list</div></div><div class="note-shortcut-row row"><div class="note-shortcut-col col-xs-6 note-shortcut-key">⌘ + ⇧ + NUM8</div><div class="note-shortcut-col col-xs-6 note-shortcut-name">Unordered list</div></div></div></div><p class="text-center"><a href="//summernote.org/" target="_blank">Summernote 0.6.16</a> · <a href="//github.com/summernote/summernote" target="_blank">Project</a> · <a href="//github.com/summernote/summernote/issues" target="_blank">Issues</a></p></div></div></div></div></div><div class="note-dropzone"><div class="note-dropzone-message"></div></div><div class="note-toolbar panel-heading"><div class="note-style btn-group"><div class="btn-group" data-name="style"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" tabindex="-1" data-original-title="Style"><i class="fa fa-magic"></i> <span class="caret"></span></button><ul class="dropdown-menu"><li><a data-event="formatBlock" href="#" data-value="p">Normal</a></li><li><a data-event="formatBlock" href="#" data-value="blockquote"><blockquote>Quote</blockquote></a></li><li><a data-event="formatBlock" href="#" data-value="pre">Code</a></li><li><a data-event="formatBlock" href="#" data-value="h1"><h1>Header 1</h1></a></li><li><a data-event="formatBlock" href="#" data-value="h2"><h2>Header 2</h2></a></li><li><a data-event="formatBlock" href="#" data-value="h3"><h3>Header 3</h3></a></li><li><a data-event="formatBlock" href="#" data-value="h4"><h4>Header 4</h4></a></li><li><a data-event="formatBlock" href="#" data-value="h5"><h5>Header 5</h5></a></li><li><a data-event="formatBlock" href="#" data-value="h6"><h6>Header 6</h6></a></li></ul></div></div><div class="note-font btn-group"><button type="button" class="btn btn-default btn-sm" title="" data-event="bold" tabindex="-1" data-name="bold" data-original-title="Bold (⌘+B)"><i class="fa fa-bold"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="italic" tabindex="-1" data-name="italic" data-original-title="Italic (⌘+I)"><i class="fa fa-italic"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="underline" tabindex="-1" data-name="underline" data-original-title="Underline (⌘+U)"><i class="fa fa-underline"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="removeFormat" tabindex="-1" data-name="clear" data-original-title="Remove Font Style (⌘+\)"><i class="fa fa-eraser"></i></button></div><div class="note-fontname btn-group"><div class="btn-group note-fontname" data-name="fontname"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" tabindex="-1" data-original-title="Font Family"><span class="note-current-fontname">sans-serif</span> <span class="caret"></span></button><ul class="dropdown-menu note-check"><li><a data-event="fontName" href="#" data-value="Arial" style="font-family:'Arial'" class=""><i class="fa fa-check"></i> Arial</a></li><li><a data-event="fontName" href="#" data-value="Arial Black" style="font-family:'Arial Black'" class=""><i class="fa fa-check"></i> Arial Black</a></li><li><a data-event="fontName" href="#" data-value="Comic Sans MS" style="font-family:'Comic Sans MS'" class=""><i class="fa fa-check"></i> Comic Sans MS</a></li><li><a data-event="fontName" href="#" data-value="Courier New" style="font-family:'Courier New'" class=""><i class="fa fa-check"></i> Courier New</a></li><li><a data-event="fontName" href="#" data-value="Helvetica Neue" style="font-family:'Helvetica Neue'" class=""><i class="fa fa-check"></i> Helvetica Neue</a></li><li><a data-event="fontName" href="#" data-value="Helvetica" style="font-family:'Helvetica'" class=""><i class="fa fa-check"></i> Helvetica</a></li><li><a data-event="fontName" href="#" data-value="Impact" style="font-family:'Impact'" class=""><i class="fa fa-check"></i> Impact</a></li><li><a data-event="fontName" href="#" data-value="Lucida Grande" style="font-family:'Lucida Grande'" class=""><i class="fa fa-check"></i> Lucida Grande</a></li><li><a data-event="fontName" href="#" data-value="Tahoma" style="font-family:'Tahoma'" class=""><i class="fa fa-check"></i> Tahoma</a></li><li><a data-event="fontName" href="#" data-value="Times New Roman" style="font-family:'Times New Roman'" class=""><i class="fa fa-check"></i> Times New Roman</a></li><li><a data-event="fontName" href="#" data-value="Verdana" style="font-family:'Verdana'" class=""><i class="fa fa-check"></i> Verdana</a></li></ul></div></div><div class="note-fontsize btn-group"><div class="btn-group note-fontsize" data-name="fontsize"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" tabindex="-1" data-original-title="Font Size"><span class="note-current-fontsize">13</span> <span class="caret"></span></button><ul class="dropdown-menu note-check"><li><a data-event="fontSize" href="#" data-value="8" class=""><i class="fa fa-check"></i> 8</a></li><li><a data-event="fontSize" href="#" data-value="9" class=""><i class="fa fa-check"></i> 9</a></li><li><a data-event="fontSize" href="#" data-value="10" class=""><i class="fa fa-check"></i> 10</a></li><li><a data-event="fontSize" href="#" data-value="11" class=""><i class="fa fa-check"></i> 11</a></li><li><a data-event="fontSize" href="#" data-value="12" class=""><i class="fa fa-check"></i> 12</a></li><li><a data-event="fontSize" href="#" data-value="14" class=""><i class="fa fa-check"></i> 14</a></li><li><a data-event="fontSize" href="#" data-value="18" class=""><i class="fa fa-check"></i> 18</a></li><li><a data-event="fontSize" href="#" data-value="24" class=""><i class="fa fa-check"></i> 24</a></li><li><a data-event="fontSize" href="#" data-value="36" class=""><i class="fa fa-check"></i> 36</a></li></ul></div></div><div class="note-color btn-group"><button type="button" class="btn btn-default btn-sm note-recent-color" title="" data-event="color" data-value="{&quot;backColor&quot;:&quot;yellow&quot;}" tabindex="-1" data-name="color" data-original-title="Recent Color"><i class="fa fa-font" style="color:black;background-color:yellow;"></i></button><div class="btn-group" data-name="color"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" tabindex="-1" data-original-title="More Color"> <span class="caret"></span></button><ul class="dropdown-menu"><li><div class="btn-group"><div class="note-palette-title">Background Color</div><div class="note-color-reset" data-event="backColor" data-value="inherit" title="Transparent">Set transparent</div><div class="note-color-palette" data-target-event="backColor"><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#000000;" data-event="backColor" data-value="#000000" title="" data-toggle="button" tabindex="-1" data-original-title="#000000"></button><button type="button" class="note-color-btn" style="background-color:#424242;" data-event="backColor" data-value="#424242" title="" data-toggle="button" tabindex="-1" data-original-title="#424242"></button><button type="button" class="note-color-btn" style="background-color:#636363;" data-event="backColor" data-value="#636363" title="" data-toggle="button" tabindex="-1" data-original-title="#636363"></button><button type="button" class="note-color-btn" style="background-color:#9C9C94;" data-event="backColor" data-value="#9C9C94" title="" data-toggle="button" tabindex="-1" data-original-title="#9C9C94"></button><button type="button" class="note-color-btn" style="background-color:#CEC6CE;" data-event="backColor" data-value="#CEC6CE" title="" data-toggle="button" tabindex="-1" data-original-title="#CEC6CE"></button><button type="button" class="note-color-btn" style="background-color:#EFEFEF;" data-event="backColor" data-value="#EFEFEF" title="" data-toggle="button" tabindex="-1" data-original-title="#EFEFEF"></button><button type="button" class="note-color-btn" style="background-color:#F7F7F7;" data-event="backColor" data-value="#F7F7F7" title="" data-toggle="button" tabindex="-1" data-original-title="#F7F7F7"></button><button type="button" class="note-color-btn" style="background-color:#FFFFFF;" data-event="backColor" data-value="#FFFFFF" title="" data-toggle="button" tabindex="-1" data-original-title="#FFFFFF"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#FF0000;" data-event="backColor" data-value="#FF0000" title="" data-toggle="button" tabindex="-1" data-original-title="#FF0000"></button><button type="button" class="note-color-btn" style="background-color:#FF9C00;" data-event="backColor" data-value="#FF9C00" title="" data-toggle="button" tabindex="-1" data-original-title="#FF9C00"></button><button type="button" class="note-color-btn" style="background-color:#FFFF00;" data-event="backColor" data-value="#FFFF00" title="" data-toggle="button" tabindex="-1" data-original-title="#FFFF00"></button><button type="button" class="note-color-btn" style="background-color:#00FF00;" data-event="backColor" data-value="#00FF00" title="" data-toggle="button" tabindex="-1" data-original-title="#00FF00"></button><button type="button" class="note-color-btn" style="background-color:#00FFFF;" data-event="backColor" data-value="#00FFFF" title="" data-toggle="button" tabindex="-1" data-original-title="#00FFFF"></button><button type="button" class="note-color-btn" style="background-color:#0000FF;" data-event="backColor" data-value="#0000FF" title="" data-toggle="button" tabindex="-1" data-original-title="#0000FF"></button><button type="button" class="note-color-btn" style="background-color:#9C00FF;" data-event="backColor" data-value="#9C00FF" title="" data-toggle="button" tabindex="-1" data-original-title="#9C00FF"></button><button type="button" class="note-color-btn" style="background-color:#FF00FF;" data-event="backColor" data-value="#FF00FF" title="" data-toggle="button" tabindex="-1" data-original-title="#FF00FF"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#F7C6CE;" data-event="backColor" data-value="#F7C6CE" title="" data-toggle="button" tabindex="-1" data-original-title="#F7C6CE"></button><button type="button" class="note-color-btn" style="background-color:#FFE7CE;" data-event="backColor" data-value="#FFE7CE" title="" data-toggle="button" tabindex="-1" data-original-title="#FFE7CE"></button><button type="button" class="note-color-btn" style="background-color:#FFEFC6;" data-event="backColor" data-value="#FFEFC6" title="" data-toggle="button" tabindex="-1" data-original-title="#FFEFC6"></button><button type="button" class="note-color-btn" style="background-color:#D6EFD6;" data-event="backColor" data-value="#D6EFD6" title="" data-toggle="button" tabindex="-1" data-original-title="#D6EFD6"></button><button type="button" class="note-color-btn" style="background-color:#CEDEE7;" data-event="backColor" data-value="#CEDEE7" title="" data-toggle="button" tabindex="-1" data-original-title="#CEDEE7"></button><button type="button" class="note-color-btn" style="background-color:#CEE7F7;" data-event="backColor" data-value="#CEE7F7" title="" data-toggle="button" tabindex="-1" data-original-title="#CEE7F7"></button><button type="button" class="note-color-btn" style="background-color:#D6D6E7;" data-event="backColor" data-value="#D6D6E7" title="" data-toggle="button" tabindex="-1" data-original-title="#D6D6E7"></button><button type="button" class="note-color-btn" style="background-color:#E7D6DE;" data-event="backColor" data-value="#E7D6DE" title="" data-toggle="button" tabindex="-1" data-original-title="#E7D6DE"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#E79C9C;" data-event="backColor" data-value="#E79C9C" title="" data-toggle="button" tabindex="-1" data-original-title="#E79C9C"></button><button type="button" class="note-color-btn" style="background-color:#FFC69C;" data-event="backColor" data-value="#FFC69C" title="" data-toggle="button" tabindex="-1" data-original-title="#FFC69C"></button><button type="button" class="note-color-btn" style="background-color:#FFE79C;" data-event="backColor" data-value="#FFE79C" title="" data-toggle="button" tabindex="-1" data-original-title="#FFE79C"></button><button type="button" class="note-color-btn" style="background-color:#B5D6A5;" data-event="backColor" data-value="#B5D6A5" title="" data-toggle="button" tabindex="-1" data-original-title="#B5D6A5"></button><button type="button" class="note-color-btn" style="background-color:#A5C6CE;" data-event="backColor" data-value="#A5C6CE" title="" data-toggle="button" tabindex="-1" data-original-title="#A5C6CE"></button><button type="button" class="note-color-btn" style="background-color:#9CC6EF;" data-event="backColor" data-value="#9CC6EF" title="" data-toggle="button" tabindex="-1" data-original-title="#9CC6EF"></button><button type="button" class="note-color-btn" style="background-color:#B5A5D6;" data-event="backColor" data-value="#B5A5D6" title="" data-toggle="button" tabindex="-1" data-original-title="#B5A5D6"></button><button type="button" class="note-color-btn" style="background-color:#D6A5BD;" data-event="backColor" data-value="#D6A5BD" title="" data-toggle="button" tabindex="-1" data-original-title="#D6A5BD"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#E76363;" data-event="backColor" data-value="#E76363" title="" data-toggle="button" tabindex="-1" data-original-title="#E76363"></button><button type="button" class="note-color-btn" style="background-color:#F7AD6B;" data-event="backColor" data-value="#F7AD6B" title="" data-toggle="button" tabindex="-1" data-original-title="#F7AD6B"></button><button type="button" class="note-color-btn" style="background-color:#FFD663;" data-event="backColor" data-value="#FFD663" title="" data-toggle="button" tabindex="-1" data-original-title="#FFD663"></button><button type="button" class="note-color-btn" style="background-color:#94BD7B;" data-event="backColor" data-value="#94BD7B" title="" data-toggle="button" tabindex="-1" data-original-title="#94BD7B"></button><button type="button" class="note-color-btn" style="background-color:#73A5AD;" data-event="backColor" data-value="#73A5AD" title="" data-toggle="button" tabindex="-1" data-original-title="#73A5AD"></button><button type="button" class="note-color-btn" style="background-color:#6BADDE;" data-event="backColor" data-value="#6BADDE" title="" data-toggle="button" tabindex="-1" data-original-title="#6BADDE"></button><button type="button" class="note-color-btn" style="background-color:#8C7BC6;" data-event="backColor" data-value="#8C7BC6" title="" data-toggle="button" tabindex="-1" data-original-title="#8C7BC6"></button><button type="button" class="note-color-btn" style="background-color:#C67BA5;" data-event="backColor" data-value="#C67BA5" title="" data-toggle="button" tabindex="-1" data-original-title="#C67BA5"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#CE0000;" data-event="backColor" data-value="#CE0000" title="" data-toggle="button" tabindex="-1" data-original-title="#CE0000"></button><button type="button" class="note-color-btn" style="background-color:#E79439;" data-event="backColor" data-value="#E79439" title="" data-toggle="button" tabindex="-1" data-original-title="#E79439"></button><button type="button" class="note-color-btn" style="background-color:#EFC631;" data-event="backColor" data-value="#EFC631" title="" data-toggle="button" tabindex="-1" data-original-title="#EFC631"></button><button type="button" class="note-color-btn" style="background-color:#6BA54A;" data-event="backColor" data-value="#6BA54A" title="" data-toggle="button" tabindex="-1" data-original-title="#6BA54A"></button><button type="button" class="note-color-btn" style="background-color:#4A7B8C;" data-event="backColor" data-value="#4A7B8C" title="" data-toggle="button" tabindex="-1" data-original-title="#4A7B8C"></button><button type="button" class="note-color-btn" style="background-color:#3984C6;" data-event="backColor" data-value="#3984C6" title="" data-toggle="button" tabindex="-1" data-original-title="#3984C6"></button><button type="button" class="note-color-btn" style="background-color:#634AA5;" data-event="backColor" data-value="#634AA5" title="" data-toggle="button" tabindex="-1" data-original-title="#634AA5"></button><button type="button" class="note-color-btn" style="background-color:#A54A7B;" data-event="backColor" data-value="#A54A7B" title="" data-toggle="button" tabindex="-1" data-original-title="#A54A7B"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#9C0000;" data-event="backColor" data-value="#9C0000" title="" data-toggle="button" tabindex="-1" data-original-title="#9C0000"></button><button type="button" class="note-color-btn" style="background-color:#B56308;" data-event="backColor" data-value="#B56308" title="" data-toggle="button" tabindex="-1" data-original-title="#B56308"></button><button type="button" class="note-color-btn" style="background-color:#BD9400;" data-event="backColor" data-value="#BD9400" title="" data-toggle="button" tabindex="-1" data-original-title="#BD9400"></button><button type="button" class="note-color-btn" style="background-color:#397B21;" data-event="backColor" data-value="#397B21" title="" data-toggle="button" tabindex="-1" data-original-title="#397B21"></button><button type="button" class="note-color-btn" style="background-color:#104A5A;" data-event="backColor" data-value="#104A5A" title="" data-toggle="button" tabindex="-1" data-original-title="#104A5A"></button><button type="button" class="note-color-btn" style="background-color:#085294;" data-event="backColor" data-value="#085294" title="" data-toggle="button" tabindex="-1" data-original-title="#085294"></button><button type="button" class="note-color-btn" style="background-color:#311873;" data-event="backColor" data-value="#311873" title="" data-toggle="button" tabindex="-1" data-original-title="#311873"></button><button type="button" class="note-color-btn" style="background-color:#731842;" data-event="backColor" data-value="#731842" title="" data-toggle="button" tabindex="-1" data-original-title="#731842"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#630000;" data-event="backColor" data-value="#630000" title="" data-toggle="button" tabindex="-1" data-original-title="#630000"></button><button type="button" class="note-color-btn" style="background-color:#7B3900;" data-event="backColor" data-value="#7B3900" title="" data-toggle="button" tabindex="-1" data-original-title="#7B3900"></button><button type="button" class="note-color-btn" style="background-color:#846300;" data-event="backColor" data-value="#846300" title="" data-toggle="button" tabindex="-1" data-original-title="#846300"></button><button type="button" class="note-color-btn" style="background-color:#295218;" data-event="backColor" data-value="#295218" title="" data-toggle="button" tabindex="-1" data-original-title="#295218"></button><button type="button" class="note-color-btn" style="background-color:#083139;" data-event="backColor" data-value="#083139" title="" data-toggle="button" tabindex="-1" data-original-title="#083139"></button><button type="button" class="note-color-btn" style="background-color:#003163;" data-event="backColor" data-value="#003163" title="" data-toggle="button" tabindex="-1" data-original-title="#003163"></button><button type="button" class="note-color-btn" style="background-color:#21104A;" data-event="backColor" data-value="#21104A" title="" data-toggle="button" tabindex="-1" data-original-title="#21104A"></button><button type="button" class="note-color-btn" style="background-color:#4A1031;" data-event="backColor" data-value="#4A1031" title="" data-toggle="button" tabindex="-1" data-original-title="#4A1031"></button></div></div></div><div class="btn-group"><div class="note-palette-title">Foreground Color</div><div class="note-color-reset" data-event="foreColor" data-value="inherit" title="Reset">Reset to default</div><div class="note-color-palette" data-target-event="foreColor"><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#000000;" data-event="foreColor" data-value="#000000" title="" data-toggle="button" tabindex="-1" data-original-title="#000000"></button><button type="button" class="note-color-btn" style="background-color:#424242;" data-event="foreColor" data-value="#424242" title="" data-toggle="button" tabindex="-1" data-original-title="#424242"></button><button type="button" class="note-color-btn" style="background-color:#636363;" data-event="foreColor" data-value="#636363" title="" data-toggle="button" tabindex="-1" data-original-title="#636363"></button><button type="button" class="note-color-btn" style="background-color:#9C9C94;" data-event="foreColor" data-value="#9C9C94" title="" data-toggle="button" tabindex="-1" data-original-title="#9C9C94"></button><button type="button" class="note-color-btn" style="background-color:#CEC6CE;" data-event="foreColor" data-value="#CEC6CE" title="" data-toggle="button" tabindex="-1" data-original-title="#CEC6CE"></button><button type="button" class="note-color-btn" style="background-color:#EFEFEF;" data-event="foreColor" data-value="#EFEFEF" title="" data-toggle="button" tabindex="-1" data-original-title="#EFEFEF"></button><button type="button" class="note-color-btn" style="background-color:#F7F7F7;" data-event="foreColor" data-value="#F7F7F7" title="" data-toggle="button" tabindex="-1" data-original-title="#F7F7F7"></button><button type="button" class="note-color-btn" style="background-color:#FFFFFF;" data-event="foreColor" data-value="#FFFFFF" title="" data-toggle="button" tabindex="-1" data-original-title="#FFFFFF"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#FF0000;" data-event="foreColor" data-value="#FF0000" title="" data-toggle="button" tabindex="-1" data-original-title="#FF0000"></button><button type="button" class="note-color-btn" style="background-color:#FF9C00;" data-event="foreColor" data-value="#FF9C00" title="" data-toggle="button" tabindex="-1" data-original-title="#FF9C00"></button><button type="button" class="note-color-btn" style="background-color:#FFFF00;" data-event="foreColor" data-value="#FFFF00" title="" data-toggle="button" tabindex="-1" data-original-title="#FFFF00"></button><button type="button" class="note-color-btn" style="background-color:#00FF00;" data-event="foreColor" data-value="#00FF00" title="" data-toggle="button" tabindex="-1" data-original-title="#00FF00"></button><button type="button" class="note-color-btn" style="background-color:#00FFFF;" data-event="foreColor" data-value="#00FFFF" title="" data-toggle="button" tabindex="-1" data-original-title="#00FFFF"></button><button type="button" class="note-color-btn" style="background-color:#0000FF;" data-event="foreColor" data-value="#0000FF" title="" data-toggle="button" tabindex="-1" data-original-title="#0000FF"></button><button type="button" class="note-color-btn" style="background-color:#9C00FF;" data-event="foreColor" data-value="#9C00FF" title="" data-toggle="button" tabindex="-1" data-original-title="#9C00FF"></button><button type="button" class="note-color-btn" style="background-color:#FF00FF;" data-event="foreColor" data-value="#FF00FF" title="" data-toggle="button" tabindex="-1" data-original-title="#FF00FF"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#F7C6CE;" data-event="foreColor" data-value="#F7C6CE" title="" data-toggle="button" tabindex="-1" data-original-title="#F7C6CE"></button><button type="button" class="note-color-btn" style="background-color:#FFE7CE;" data-event="foreColor" data-value="#FFE7CE" title="" data-toggle="button" tabindex="-1" data-original-title="#FFE7CE"></button><button type="button" class="note-color-btn" style="background-color:#FFEFC6;" data-event="foreColor" data-value="#FFEFC6" title="" data-toggle="button" tabindex="-1" data-original-title="#FFEFC6"></button><button type="button" class="note-color-btn" style="background-color:#D6EFD6;" data-event="foreColor" data-value="#D6EFD6" title="" data-toggle="button" tabindex="-1" data-original-title="#D6EFD6"></button><button type="button" class="note-color-btn" style="background-color:#CEDEE7;" data-event="foreColor" data-value="#CEDEE7" title="" data-toggle="button" tabindex="-1" data-original-title="#CEDEE7"></button><button type="button" class="note-color-btn" style="background-color:#CEE7F7;" data-event="foreColor" data-value="#CEE7F7" title="" data-toggle="button" tabindex="-1" data-original-title="#CEE7F7"></button><button type="button" class="note-color-btn" style="background-color:#D6D6E7;" data-event="foreColor" data-value="#D6D6E7" title="" data-toggle="button" tabindex="-1" data-original-title="#D6D6E7"></button><button type="button" class="note-color-btn" style="background-color:#E7D6DE;" data-event="foreColor" data-value="#E7D6DE" title="" data-toggle="button" tabindex="-1" data-original-title="#E7D6DE"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#E79C9C;" data-event="foreColor" data-value="#E79C9C" title="" data-toggle="button" tabindex="-1" data-original-title="#E79C9C"></button><button type="button" class="note-color-btn" style="background-color:#FFC69C;" data-event="foreColor" data-value="#FFC69C" title="" data-toggle="button" tabindex="-1" data-original-title="#FFC69C"></button><button type="button" class="note-color-btn" style="background-color:#FFE79C;" data-event="foreColor" data-value="#FFE79C" title="" data-toggle="button" tabindex="-1" data-original-title="#FFE79C"></button><button type="button" class="note-color-btn" style="background-color:#B5D6A5;" data-event="foreColor" data-value="#B5D6A5" title="" data-toggle="button" tabindex="-1" data-original-title="#B5D6A5"></button><button type="button" class="note-color-btn" style="background-color:#A5C6CE;" data-event="foreColor" data-value="#A5C6CE" title="" data-toggle="button" tabindex="-1" data-original-title="#A5C6CE"></button><button type="button" class="note-color-btn" style="background-color:#9CC6EF;" data-event="foreColor" data-value="#9CC6EF" title="" data-toggle="button" tabindex="-1" data-original-title="#9CC6EF"></button><button type="button" class="note-color-btn" style="background-color:#B5A5D6;" data-event="foreColor" data-value="#B5A5D6" title="" data-toggle="button" tabindex="-1" data-original-title="#B5A5D6"></button><button type="button" class="note-color-btn" style="background-color:#D6A5BD;" data-event="foreColor" data-value="#D6A5BD" title="" data-toggle="button" tabindex="-1" data-original-title="#D6A5BD"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#E76363;" data-event="foreColor" data-value="#E76363" title="" data-toggle="button" tabindex="-1" data-original-title="#E76363"></button><button type="button" class="note-color-btn" style="background-color:#F7AD6B;" data-event="foreColor" data-value="#F7AD6B" title="" data-toggle="button" tabindex="-1" data-original-title="#F7AD6B"></button><button type="button" class="note-color-btn" style="background-color:#FFD663;" data-event="foreColor" data-value="#FFD663" title="" data-toggle="button" tabindex="-1" data-original-title="#FFD663"></button><button type="button" class="note-color-btn" style="background-color:#94BD7B;" data-event="foreColor" data-value="#94BD7B" title="" data-toggle="button" tabindex="-1" data-original-title="#94BD7B"></button><button type="button" class="note-color-btn" style="background-color:#73A5AD;" data-event="foreColor" data-value="#73A5AD" title="" data-toggle="button" tabindex="-1" data-original-title="#73A5AD"></button><button type="button" class="note-color-btn" style="background-color:#6BADDE;" data-event="foreColor" data-value="#6BADDE" title="" data-toggle="button" tabindex="-1" data-original-title="#6BADDE"></button><button type="button" class="note-color-btn" style="background-color:#8C7BC6;" data-event="foreColor" data-value="#8C7BC6" title="" data-toggle="button" tabindex="-1" data-original-title="#8C7BC6"></button><button type="button" class="note-color-btn" style="background-color:#C67BA5;" data-event="foreColor" data-value="#C67BA5" title="" data-toggle="button" tabindex="-1" data-original-title="#C67BA5"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#CE0000;" data-event="foreColor" data-value="#CE0000" title="" data-toggle="button" tabindex="-1" data-original-title="#CE0000"></button><button type="button" class="note-color-btn" style="background-color:#E79439;" data-event="foreColor" data-value="#E79439" title="" data-toggle="button" tabindex="-1" data-original-title="#E79439"></button><button type="button" class="note-color-btn" style="background-color:#EFC631;" data-event="foreColor" data-value="#EFC631" title="" data-toggle="button" tabindex="-1" data-original-title="#EFC631"></button><button type="button" class="note-color-btn" style="background-color:#6BA54A;" data-event="foreColor" data-value="#6BA54A" title="" data-toggle="button" tabindex="-1" data-original-title="#6BA54A"></button><button type="button" class="note-color-btn" style="background-color:#4A7B8C;" data-event="foreColor" data-value="#4A7B8C" title="" data-toggle="button" tabindex="-1" data-original-title="#4A7B8C"></button><button type="button" class="note-color-btn" style="background-color:#3984C6;" data-event="foreColor" data-value="#3984C6" title="" data-toggle="button" tabindex="-1" data-original-title="#3984C6"></button><button type="button" class="note-color-btn" style="background-color:#634AA5;" data-event="foreColor" data-value="#634AA5" title="" data-toggle="button" tabindex="-1" data-original-title="#634AA5"></button><button type="button" class="note-color-btn" style="background-color:#A54A7B;" data-event="foreColor" data-value="#A54A7B" title="" data-toggle="button" tabindex="-1" data-original-title="#A54A7B"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#9C0000;" data-event="foreColor" data-value="#9C0000" title="" data-toggle="button" tabindex="-1" data-original-title="#9C0000"></button><button type="button" class="note-color-btn" style="background-color:#B56308;" data-event="foreColor" data-value="#B56308" title="" data-toggle="button" tabindex="-1" data-original-title="#B56308"></button><button type="button" class="note-color-btn" style="background-color:#BD9400;" data-event="foreColor" data-value="#BD9400" title="" data-toggle="button" tabindex="-1" data-original-title="#BD9400"></button><button type="button" class="note-color-btn" style="background-color:#397B21;" data-event="foreColor" data-value="#397B21" title="" data-toggle="button" tabindex="-1" data-original-title="#397B21"></button><button type="button" class="note-color-btn" style="background-color:#104A5A;" data-event="foreColor" data-value="#104A5A" title="" data-toggle="button" tabindex="-1" data-original-title="#104A5A"></button><button type="button" class="note-color-btn" style="background-color:#085294;" data-event="foreColor" data-value="#085294" title="" data-toggle="button" tabindex="-1" data-original-title="#085294"></button><button type="button" class="note-color-btn" style="background-color:#311873;" data-event="foreColor" data-value="#311873" title="" data-toggle="button" tabindex="-1" data-original-title="#311873"></button><button type="button" class="note-color-btn" style="background-color:#731842;" data-event="foreColor" data-value="#731842" title="" data-toggle="button" tabindex="-1" data-original-title="#731842"></button></div><div class="note-color-row"><button type="button" class="note-color-btn" style="background-color:#630000;" data-event="foreColor" data-value="#630000" title="" data-toggle="button" tabindex="-1" data-original-title="#630000"></button><button type="button" class="note-color-btn" style="background-color:#7B3900;" data-event="foreColor" data-value="#7B3900" title="" data-toggle="button" tabindex="-1" data-original-title="#7B3900"></button><button type="button" class="note-color-btn" style="background-color:#846300;" data-event="foreColor" data-value="#846300" title="" data-toggle="button" tabindex="-1" data-original-title="#846300"></button><button type="button" class="note-color-btn" style="background-color:#295218;" data-event="foreColor" data-value="#295218" title="" data-toggle="button" tabindex="-1" data-original-title="#295218"></button><button type="button" class="note-color-btn" style="background-color:#083139;" data-event="foreColor" data-value="#083139" title="" data-toggle="button" tabindex="-1" data-original-title="#083139"></button><button type="button" class="note-color-btn" style="background-color:#003163;" data-event="foreColor" data-value="#003163" title="" data-toggle="button" tabindex="-1" data-original-title="#003163"></button><button type="button" class="note-color-btn" style="background-color:#21104A;" data-event="foreColor" data-value="#21104A" title="" data-toggle="button" tabindex="-1" data-original-title="#21104A"></button><button type="button" class="note-color-btn" style="background-color:#4A1031;" data-event="foreColor" data-value="#4A1031" title="" data-toggle="button" tabindex="-1" data-original-title="#4A1031"></button></div></div></div></li></ul></div></div><div class="note-para btn-group"><button type="button" class="btn btn-default btn-sm" title="" data-event="insertUnorderedList" tabindex="-1" data-name="ul" data-original-title="Unordered list (⌘+⇧+NUM7)"><i class="fa fa-list-ul"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="insertOrderedList" tabindex="-1" data-name="ol" data-original-title="Ordered list (⌘+⇧+NUM8)"><i class="fa fa-list-ol"></i></button><div class="btn-group" data-name="paragraph"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" tabindex="-1" data-original-title="Paragraph"><i class="fa fa-align-left"></i> <span class="caret"></span></button><div class="dropdown-menu"><div class="note-align btn-group"><button type="button" class="btn btn-default btn-sm active" title="" data-event="justifyLeft" tabindex="-1" data-original-title="Align left (⌘+⇧+L)"><i class="fa fa-align-left"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="justifyCenter" tabindex="-1" data-original-title="Align center (⌘+⇧+E)"><i class="fa fa-align-center"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="justifyRight" tabindex="-1" data-original-title="Align right (⌘+⇧+R)"><i class="fa fa-align-right"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="justifyFull" tabindex="-1" data-original-title="Justify full (⌘+⇧+J)"><i class="fa fa-align-justify"></i></button></div><div class="note-list btn-group"><button type="button" class="btn btn-default btn-sm" title="" data-event="indent" tabindex="-1" data-original-title="Indent (⌘+])"><i class="fa fa-indent"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="outdent" tabindex="-1" data-original-title="Outdent (⌘+[)"><i class="fa fa-outdent"></i></button></div></div></div></div><div class="note-height btn-group"><div class="btn-group" data-name="height"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" tabindex="-1" data-original-title="Line Height"><i class="fa fa-text-height"></i> <span class="caret"></span></button><ul class="dropdown-menu note-check"><li><a data-event="lineHeight" href="#" data-value="1" class=""><i class="fa fa-check"></i> 1.0</a></li><li><a data-event="lineHeight" href="#" data-value="1.2" class=""><i class="fa fa-check"></i> 1.2</a></li><li><a data-event="lineHeight" href="#" data-value="1.4" class=""><i class="fa fa-check"></i> 1.4</a></li><li><a data-event="lineHeight" href="#" data-value="1.5" class=""><i class="fa fa-check"></i> 1.5</a></li><li><a data-event="lineHeight" href="#" data-value="1.6" class=""><i class="fa fa-check"></i> 1.6</a></li><li><a data-event="lineHeight" href="#" data-value="1.8" class=""><i class="fa fa-check"></i> 1.8</a></li><li><a data-event="lineHeight" href="#" data-value="2" class=""><i class="fa fa-check"></i> 2.0</a></li><li><a data-event="lineHeight" href="#" data-value="3" class=""><i class="fa fa-check"></i> 3.0</a></li></ul></div></div><div class="note-table btn-group"><div class="btn-group" data-name="table"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" tabindex="-1" data-original-title="Table"><i class="fa fa-table"></i> <span class="caret"></span></button><ul class="dropdown-menu note-table"><div class="note-dimension-picker"><div class="note-dimension-picker-mousecatcher" data-event="insertTable" data-value="1x1" style="width: 10em; height: 10em;"></div><div class="note-dimension-picker-highlighted"></div><div class="note-dimension-picker-unhighlighted"></div></div><div class="note-dimension-display"> 1 x 1 </div></ul></div></div><div class="note-insert btn-group"><button type="button" class="btn btn-default btn-sm" title="" data-event="showLinkDialog" data-hide="true" tabindex="-1" data-name="link" data-original-title="Link (⌘+K)"><i class="fa fa-link"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="showImageDialog" data-hide="true" tabindex="-1" data-name="picture" data-original-title="Picture"><i class="fa fa-picture-o"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="insertHorizontalRule" tabindex="-1" data-name="hr" data-original-title="Insert Horizontal Rule (⌘+ENTER)"><i class="fa fa-minus"></i></button></div><div class="note-view btn-group"><button type="button" class="btn btn-default btn-sm" title="" data-event="fullscreen" tabindex="-1" data-name="fullscreen" data-original-title="Full Screen"><i class="fa fa-arrows-alt"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="codeview" tabindex="-1" data-name="codeview" data-original-title="Code View"><i class="fa fa-code"></i></button></div><div class="note-help btn-group"><button type="button" class="btn btn-default btn-sm" title="" data-event="showHelpDialog" data-hide="true" tabindex="-1" data-name="help" data-original-title="Help"><i class="fa fa-question"></i></button></div></div><div class="note-editing-area"><div class="note-handle"><div class="note-control-selection" style="display: none;"><div class="note-control-selection-bg"></div><div class="note-control-holder note-control-nw"></div><div class="note-control-holder note-control-ne"></div><div class="note-control-holder note-control-sw"></div><div class="note-control-sizing note-control-se"></div><div class="note-control-selection-info"></div></div></div><div class="note-popover"><div class="note-link-popover popover bottom in" style="display: none;"><div class="arrow"></div><div class="popover-content"><a href="http://www.google.com" target="_blank">www.google.com</a>&nbsp;&nbsp;<div class="note-insert btn-group"><button type="button" class="btn btn-default btn-sm" title="" data-event="showLinkDialog" data-hide="true" tabindex="-1" data-original-title="Edit"><i class="fa fa-edit"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="unlink" tabindex="-1" data-original-title="Unlink"><i class="fa fa-unlink"></i></button></div></div></div><div class="note-image-popover popover bottom in" style="display: none;"><div class="arrow"></div><div class="popover-content"><div class="btn-group"><button type="button" class="btn btn-default btn-sm" title="" data-event="resize" data-value="1" tabindex="-1" data-original-title="Resize Full"><span class="note-fontsize-10">100%</span></button><button type="button" class="btn btn-default btn-sm" title="" data-event="resize" data-value="0.5" tabindex="-1" data-original-title="Resize Half"><span class="note-fontsize-10">50%</span></button><button type="button" class="btn btn-default btn-sm" title="" data-event="resize" data-value="0.25" tabindex="-1" data-original-title="Resize Quarter"><span class="note-fontsize-10">25%</span></button></div><div class="btn-group"><button type="button" class="btn btn-default btn-sm" title="" data-event="floatMe" data-value="left" tabindex="-1" data-original-title="Float Left"><i class="fa fa-align-left"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="floatMe" data-value="right" tabindex="-1" data-original-title="Float Right"><i class="fa fa-align-right"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="floatMe" data-value="none" tabindex="-1" data-original-title="Float None"><i class="fa fa-align-justify"></i></button></div><br><div class="btn-group"><button type="button" class="btn btn-default btn-sm" title="" data-event="imageShape" data-value="img-rounded" tabindex="-1" data-original-title="Shape: Rounded"><i class="fa fa-square"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="imageShape" data-value="img-circle" tabindex="-1" data-original-title="Shape: Circle"><i class="fa fa-circle-o"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="imageShape" data-value="img-thumbnail" tabindex="-1" data-original-title="Shape: Thumbnail"><i class="fa fa-picture-o"></i></button><button type="button" class="btn btn-default btn-sm" title="" data-event="imageShape" tabindex="-1" data-original-title="Shape: None"><i class="fa fa-times"></i></button></div><div class="btn-group"><button type="button" class="btn btn-default btn-sm" title="" data-event="removeMedia" data-value="none" tabindex="-1" data-original-title="Remove Image"><i class="fa fa-trash-o"></i></button></div></div></div></div><textarea class="note-codable"></textarea><div class="note-editable panel-body" contenteditable="true" style="height: 300px;"> </div></div><div class="note-statusbar"><div class="note-resizebar"><div class="note-icon-bar"></div><div class="note-icon-bar"></div><div class="note-icon-bar"></div></div></div></div> --}}
                      <textarea class="form-control" id="content" name="content" rows="10" ></textarea>

                </div>
              </div>
          </div>
          <div class="modal-footer">
              <button class="close-btn" data-dismiss="modal">取消</button>
              <button class="submit-btn">儲存</button>
          </div>
        </form>
      </div>


        <!--[if lt IE 9]>
        <script src="assets/metronic/global/plugins/respond.min.js"></script>
        <script src="assets/metronic/global/plugins/excanvas.min.js"></script>
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <!-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
        <script src="assets/metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js"
            type="text/javascript"></script>
        <script src="assets/metronic/theme/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script
            src="assets/metronic/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
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
        <script src="assets/metronic/theme/assets/global/plugins/clockface/js/clockface.js"
            type="text/javascript"></script>
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
        <script src="assets/metronic/theme/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
        <script src="assets/metronic/theme/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
        <script src="assets/metronic/theme/assets/global/plugins/bootstrap-summernote/summernote.min.js"></script>
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
            $(function() {
            $('#edit-mail').on('show.bs.modal', function(e) {
                let btn = $(e.relatedTarget); // e.related here is the element that opened the modal, specifically the row button
                let id = btn.data('id'); // this is how you get the of any `data` attribute of an element
                let subject = btn.closest('td').siblings('.custom-subject').data('subject');
                let content = btn.closest('td').siblings('.custom-content').data('content');
                let typea = btn.closest('td').siblings('.custom-typea').data('typea');

                let modal = $(this); //要修改的modal就是現在開啟的這個modal

                $('.modalTextInput').val('');
                $('.saveEdit').data('id', id); // then pass it to the button inside the modal
                modal.find('.modal-body input#subject').val(subject);//把抓到的資料顯示在input內
                modal.find('.modal-body textarea#content').val(content);
                modal.find('.modal-body input#id').val(id);
                modal.find('#typea').val(typea);

            })

            $('.saveEdit').on('click', function() {
                let id = $(this).data('id'); // the rest is just the same
                saveNote(id);
                $('#edit-mail').modal('toggle'); // this is to close the modal after clicking the modal button
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