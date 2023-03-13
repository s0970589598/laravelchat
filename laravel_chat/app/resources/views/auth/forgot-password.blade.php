<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>忘記密碼</title>
    <meta name="robots" content="noindex , nofollow">
    <!-- <base href="https://app.starcharger.com.tw/" /> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <link href="/assets/metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <link href="/assets/metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.css" rel="stylesheet"
        type="text/css" />
    <link href="/assets/metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="/assets/metronic/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet"
        type="text/css" />
    <link href="/assets/metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.css" rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/assets/metronic/theme/assets/global/plugins/bootstrap-datepaginator/bootstrap-datepaginator.min.css"
        rel="stylesheet" type="text/css" />
    <link href="/assets/metronic/theme/assets/global/plugins/morris/morris.css" rel="sfatylesheet" type="text/css" />
    <link href="/assets/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"
        rel="stylesheet" type="text/css" />
    <link href="/assets/metronic/theme/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css"
        rel="stylesheet">
    <link href="/assets/metronic/theme/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet">
    <link href="/assets/metronic/theme/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet">
    <link href="/assets/metronic/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet">
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/assets/metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components"
        type="text/css" />
    <link href="/assets/metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/metronic/theme/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"
        type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/assets/metronic/theme/assets/pages/css/login.min.css" rel="stylesheet">
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="assets/images/fav-icon.png" />
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
<body>
    <div class="logo">
        <a href="index.html">
            <img src="/assets/images/logo.png" alt="images">
        </a>
    </div>
    <div class="user-content">
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <h3 class="form-title">忘記密碼</h3>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <p>請於下方輸入您的Email，系統將會寄送「重新設定密碼」連結到您的信箱。</p>
            <div class="form-group">
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="請輸入原有註冊的Email帳號" name="email">
            </div>
            <div class="form-actions">
                <button type="submit" class="submit-btn">確認送出</button>
                <button onclick="location.href='/dialoguelist'" type="button" id="back-btn" class="close-btn">取消</button>
            </div>
        </form>
        <!-- END FORGOT PASSWORD FORM -->
    </div>
    <!--[if lt IE 9]>
            <script src="assets/metronic/global/plugins/respond.min.js"></script>
            <script src="assets/metronic/global/plugins/excanvas.min.js"></script>
        <![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <!-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="/assets/metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js"
        type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
        type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/uniform/jquery.uniform.min.js"
        type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript"></script>
    <!-- <script src="assets/js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script> -->
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/moment.min.js"
        type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"
        type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
        type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
        type="text/javascript"></script>
    <script
        src="/assets/metronic/theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"
        type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="/assets/metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/assets/metronic/theme/assets/pages/scripts/components-date-time-pickers.min.js"
        type="text/javascript"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
    <script src="/assets/metronic/theme/assets/pages/scripts/ui-extended-modals.min.js"></script>
    <script src="/assets/metronic/theme/assets/global/plugins/select2/js/select2.full.min.js"></script>
    <script src="/assets/metronic/theme/assets/pages/scripts/components-select2.min.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="/assets/metronic/theme_rtl/assets/layouts/layout4/scripts/layout.min.js"
        type="text/javascript"></script>
    <script src="/assets/metronic/theme_rtl/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
    <!-- <script src="assets/metronic/layouts/layout4/scripts/quick-sidebar.min.js" type="text/javascript"></script> -->
    <!-- <script type="text/javascript" src="assets/js/lib/fancybox/jquery.fancybox.pack.js"></script> -->
    <!-- END THEME LAYOUT SCRIPTS -->
    <script type="text/javascript"
        src="/assets/metronic/theme/assets/global/plugins/jquery.twbsPagination.min.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
</body>

</html>

{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
