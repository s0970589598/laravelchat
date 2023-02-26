<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>旅客名稱</title>
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
        <link rel="/shortcut icon" href="/assets/images/fav-icon.png" />
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
            /* *{
                outline: 1px solid #ccc;
            }  */
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9" style="padding: 0;">
            <div class="dialogue-section" >
                <div class="dialogue-head" id="chat-history">
                    <p class="real-time">{{$now}}</p>
                    @if (!empty($currRoom))
                    @foreach($currRoom->messages as $message)
                    @if ($message->sender_id === Auth::user()->id)
                    <!-- BEGIN RESPONCSE DIALOGUE -->
                    <div class="response-dialogue">
                        <div class="user">
                            <img class="user-avatar" src="https://robohash.org/{{ $message->user->name }}" alt="images">
                            <div class="dialogue">
                                <span class="dialogue-time">{{ $message->created_at->toFormattedDateString() }}, {{ $message->created_at->toTimeString() }}</span>
                                <div class="dialogue-content">
                                    <div class="dialogue-info">
                                        <div class="activity">
                                            <div class="content">
                                                <p> {{ $message->message }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END RESPONCSE DIALOGUE-->
                    @else
                    <!-- BEGIN REQUEST DIALOGUE -->
                    <div class="request-dialogue">
                        <div class="user">
                            <img class="user-avatar" src="/assets/images/user-request.png" alt="images">
                            <div class="dialogue-content">
                                <p>
                                    <?php
                                        $user = $message->user->name;
                                        $email = $message->user->email;
                                    ?>
                                    {{ $message->message }}
                                </p>
                            </div>
                            <span class="dialogue-time">{{ $message->created_at->toFormattedDateString() }}, {{ $message->created_at->toTimeString() }}</span>
                        </div>
                    </div>
                    <!-- END REQUEST DIALOGUE -->
                    @endif
                    @endforeach
                    @else
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                        您好，歡迎使用客服系統，請問您有什麼問題
                    </div>
                    @endif

                </div>
                <div class="dialogue-body">
                    <div class="message-content">
                        <div class="message-send">
                            <div class="message-input">
                                <textarea id="chat-message-input" class="form-control" maxlength="300" rows="5" placeholder="請輸入訊息"></textarea>
                                <div class="message-input-actions btn-group">
                                    <label class="upload-btn">
                                        <input id="upload_img" style="display:none;" type="file">
                                        <i class="icon-paper-clip"></i>
                                    </label>
                                </div>
                            </div>
                            <!-- BEGIN FOOTER -->
                            <div class="page-footer-inner">Copyright © 2023 FANINSIGHTS.IO ALL RIGHTS RESERVED.</div>
                            <!-- END FOOTER -->
                        </div>
                        <div class="message-feature">
                            <div class="send">
                                    <button type="submit" class="submit-btn" onclick="send()">發送</button>
                            </div>
                            <div class="customer-turn">
                                <button class="refer-btn">客服轉介</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" style="padding: 0;border: 1px solid #F5F5F5;">
            <div class="feature-section">
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <div class="media">
                                <img class="media-object" src="/assets/images/user-default.png" alt="...">
                                <div class="media-body">
                                    <h4 class="media-heading">{{isset($user) ? $user : ''}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <ul class="list-unstyled">
                            <li class="list-items">
                                <span class="info"><i class="fa fa-envelope"></i>Email</span>
                                <span class="num"> {{isset($email) ? $email : ''}}</span>
                            </li>
                            <li class="list-items">
                                <span class="info"><i class="fa fa-phone"></i>手機</span>
                                <span class="num"></span>
                            </li>
                            <li class="list-items">
                                <span class="info"><i class="fa fa-comment"></i>Line</span>
                                <span class="num"></span>
                            </li>
                            <li class="list-items">
                                <span class="info"><i class="fa fa-location-arrow"></i>定位點</span>
                                <span class="num"></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject">功能</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-4" style="padding: 0 5px 0 20px;">
                                <a href="#media" class="icon-btn" data-toggle="modal">
                                    <i class="fa fa-folder-o"></i>
                                    <div>媒體庫</div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#message" class="icon-btn" data-toggle="modal">
                                    <i class="fa fa-comment"></i>
                                    <div>訊息範本</div>
                                </a>
                            </div>
                            <div class="col-md-4" style="padding: 0 20px 0 5px;">
                                <a href="javascript:;" class="icon-btn">
                                    <i class="fa fa-image"></i>
                                    <div>貼圖</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject">回覆備註</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="form-group">
                            <textarea class="form-control" rows="5" placeholder="請輸入備註"></textarea>
                        </div>
                    </div>
                </div>
                <div class="feature-btn">
                    <button class="return-btn" onclick="location.href='{{ route('dialogue.manage') }}'">返回</button>
                    <button class="submit-btn">客服完成</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTAINER -->
    <!-- BEGIN MEDIA MODAL -->
    <div class="modal container fade in" id="media" tabindex="-1" role="dialog" aria-hidden="true" style="display: none; padding-right: 15px;">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">媒體庫</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <input name="keyword" class="form-control" placeholder="請輸入關鍵字" value="" style="margin-right: 5px;">
                            <input name="page" type="hidden" value="1" />
                        </div>
                        <button type="submit" class="search-btn" id="btn-search" style="margin-right: 5px;">
                            <i class="fa fa-search"></i>
                            查詢
                        </button>
                    </div>
                    <div class="media-content">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="media-info">
                                        <div class="media-title">
                                            <input type="checkbox" id="checkbox-1">
                                            <label for="checkbox-1">檔案格式.jpg</label>
                                        </div>
                                        <div class="thumbnail" style="margin: 0;">
                                            <img src="/assets/images/thumbnail.png" alt="images">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="media-info">
                                        <div class="media-title">
                                            <input type="checkbox" id="checkbox-1">
                                            <label for="checkbox-1">檔案格式.jpg</label>
                                        </div>
                                        <div class="thumbnail" style="margin: 0;">
                                            <img src="/assets/images/thumbnail.png" alt="images">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="media-info">
                                        <div class="media-title">
                                            <input type="checkbox" id="checkbox-1">
                                            <label for="checkbox-1">檔案格式.jpg</label>
                                        </div>
                                        <div class="thumbnail" style="margin: 0;">
                                            <img src="/assets/images/thumbnail.png" alt="images">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="media-info">
                                        <div class="media-title">
                                            <input type="checkbox" id="checkbox-1">
                                            <label for="checkbox-1">檔案格式.jpg</label>
                                        </div>
                                        <div class="thumbnail" style="margin: 0;">
                                            <img src="/assets/images/thumbnail.png" alt="images">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="media-info">
                                        <div class="media-title">
                                            <input type="checkbox" id="checkbox-1">
                                            <label for="checkbox-1">檔案格式.jpg</label>
                                        </div>
                                        <div class="thumbnail" style="margin: 0;">
                                            <img src="/assets/images/thumbnail.png" alt="images">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="media-info">
                                        <div class="media-title">
                                            <input type="checkbox" id="checkbox-1">
                                            <label for="checkbox-1">檔案格式.jpg</label>
                                        </div>
                                        <div class="thumbnail" style="margin: 0;">
                                            <img src="/assets/images/thumbnail.png" alt="images">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="media-info">
                                        <div class="media-title">
                                            <input type="checkbox" id="checkbox-1">
                                            <label for="checkbox-1">檔案格式.jpg</label>
                                        </div>
                                        <div class="thumbnail" style="margin: 0;">
                                            <img src="/assets/images/thumbnail.png" alt="images">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="media-info">
                                        <div class="media-title">
                                            <input type="checkbox" id="checkbox-1">
                                            <label for="checkbox-1">檔案格式.jpg</label>
                                        </div>
                                        <div class="thumbnail" style="margin: 0;">
                                            <img src="/assets/images/thumbnail.png" alt="images">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="media">
                                    <div class="media-info">
                                        <div class="media-title">
                                            <input type="checkbox" id="checkbox-1">
                                            <label for="checkbox-1">檔案格式.jpg</label>
                                        </div>
                                        <div class="thumbnail" style="margin: 0;">
                                            <img src="/assets/images/thumbnail.png" alt="images">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="close-btn" data-dismiss="modal">關閉</button>
                    <button class="submit-btn">確定</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END MEDIA MODAL -->
    <!-- BEGIN MESSAGE MODAL -->
    <div class="modal container fade in" id="message" tabindex="-1" role="dialog" aria-hidden="true" style="display: none; padding-right: 15px;">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">訊息範本</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <input name="keyword" class="form-control" placeholder="請輸入關鍵字" value="" style="margin-right: 5px;">
                            <input name="page" type="hidden" value="1" />
                        </div>
                        <button type="submit" class="search-btn" id="btn-search" style="margin-right: 5px;">
                            <i class="fa fa-search"></i>
                            查詢
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="close-btn" data-dismiss="modal">關閉</button>
                    <button class="submit-btn">確定</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END MESSAGE MODAL -->
    <!--[if lt IE 9]>
        <script src="/assets/metronic/global/plugins/respond.min.js"></script>
        <script src="/assets/metronic/global/plugins/excanvas.min.js"></script>
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
    <!-- <script src="/assets/js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script> -->
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/assets/metronic/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
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
    <script src="/assets/metronic/theme/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="/assets/metronic/theme_rtl/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
    <script src="/assets/metronic/theme_rtl/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
    <!-- <script src="/assets/metronic/layouts/layout4/scripts/quick-sidebar.min.js" type="text/javascript"></script> -->
    <!-- <script type="text/javascript" src="/assets/js/lib/fancybox/jquery.fancybox.pack.js"></script> -->
    <!-- END THEME LAYOUT SCRIPTS -->
    <script type="text/javascript" src="/assets/metronic/theme/assets/global/plugins/jquery.twbsPagination.min.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/centrifugal/centrifuge-js@2.8.4/dist/centrifuge.min.js"></script>
    <script>
        var output = document.getElementById("output");
        function send(){
            //output.innerHTML = input.value;
            const currentUserId = "{{ Auth::user() -> id }}";
            const currentRoomId = "{{ !empty($currRoom) ? $currRoom -> id : 0 }}";

            const chatHistory = document.querySelector('#chat-history');
            const messageInput = document.querySelector('#chat-message-input');
            const csrfToken = "{{ csrf_token() }}";

                //e.preventDefault();
                const message = messageInput.value;
                if (!message) {
                    return;
                }
                const xhttp = new XMLHttpRequest();
                xhttp.open("POST", "/rooms/" + currentRoomId + "/publish");
                xhttp.setRequestHeader("X-CSRF-TOKEN", csrfToken);
                xhttp.send(JSON.stringify({
                    message: message
                }));
                messageInput.value = '';
        }
        // helper functions to work with escaping html.
        const tagsToReplace = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;'
        };

        function replaceTag(tag) {
            return tagsToReplace[tag] || tag;
        }

        function safeTagsReplace(str) {
            return str.replace(/[&<>]/g, replaceTag);
        }

        window.addEventListener('load', () => {
            initApp();
        })

        function initApp() {
            const currentUserId = "{{ Auth::user() -> id }}";
            const currentRoomId = "{{ !empty($currRoom) ? $currRoom -> id : 0 }}";

            const chatHistory = document.querySelector('#chat-history');
            const messageInput = document.querySelector('#chat-message-input');

            function scrollToLastMessage() {
                chatHistory.scrollTop = chatHistory.scrollHeight;
            }
            scrollToLastMessage();

            if (messageInput !== null) {
                messageInput.focus();

                const csrfToken = "{{ csrf_token() }}";
                messageInput.onkeyup = function(e) {
                    if (e.keyCode === 13) { // enter, return
                        e.preventDefault();
                        const message = messageInput.value;
                        if (!message) {
                            return;
                        }
                        const xhttp = new XMLHttpRequest();
                        xhttp.open("POST", "/rooms/" + currentRoomId + "/publish");
                        xhttp.setRequestHeader("X-CSRF-TOKEN", csrfToken);
                        xhttp.send(JSON.stringify({
                            message: message
                        }));
                        messageInput.value = '';
                    }
                };
            }

            function addMessage(data) {
                const chatThreads = document.querySelector('#chat-history');
                const senderName = safeTagsReplace(data.senderName);
                const text = safeTagsReplace(data.text);
                const date = data.createdAtFormatted;
                const isSelf = data.senderId.toString() === currentUserId;
                const chatNewThread = document.createElement('div');
                chatNewThread.className = "request-dialogue";

                let msg = '<div class="user">' +
                    '<img class="user-avatar" src="/assets/images/user-request.png" alt="images">'+
                            '<div class="dialogue">' +
                                '<span class="dialogue-time">' + date + '</span>' +
                                '<div class="dialogue-content">'+
                                    '<div class="dialogue-info">'+
                                        '<div class="activity">'+
                                            '<div class="content">'+
                                                '<p>' + text + '</p>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'

                if (isSelf) {
                    chatNewThread.className = "response-dialogue";

                    msg = '<div class="user">' +
                            '<img class="user-avatar" src="https://robohash.org/'+ senderName + '" alt="images">'+
                            '<div class="dialogue">' +
                                '<span class="dialogue-time">' + date + '</span>' +
                                '<div class="dialogue-content">'+
                                    '<div class="dialogue-info">'+
                                        '<div class="activity">'+
                                            '<div class="content">'+
                                                '<p>' + text + '</p>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                }

                chatNewThread.innerHTML = msg;
                chatThreads.appendChild(chatNewThread);
            }

            // function addRoomLastMessage(data) {
            //     const lastRoomMessageText = document.querySelector('#room-' + data.roomId + ' .status');
            //     const lastRoomMessageUserName = document.querySelector('#room-' + data.roomId + ' .user-name');
            //     let text = data.text.substr(0, 15);
            //     if (data.text.length > 15) {
            //         text += "..."
            //     }
            //     lastRoomMessageText.innerHTML = safeTagsReplace(text);
            //     lastRoomMessageUserName.innerHTML = safeTagsReplace(data.senderName);
            // }

            const centrifuge = new Centrifuge("ws://" + window.location.host + "/connection/websocket");

            centrifuge.on('connect', function(ctx) {
                console.log("connected", ctx);
            });

            centrifuge.on('disconnect', function(ctx) {
                console.log("disconnected", ctx);
            });

            centrifuge.on('publish', function(ctx) {
                if (ctx.data.roomId.toString() === currentRoomId) {
                    addMessage(ctx.data);
                    scrollToLastMessage();
                }
                //addRoomLastMessage(ctx.data);
            });

            centrifuge.connect();
        }
    </script>
    </body>
</html>