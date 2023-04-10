<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
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
    <meta name="csrf_token" content="{{ csrf_token() }}" />
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
    <link href="/assets/metronic/theme_rtl/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/metronic/theme_rtl/assets/layouts/layout4/css/themes/light.min.css" rel="stylesheet"
        type="text/css" id="style_color" />
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
        /* *{
                outline: 1px solid #ccc;
            }  */
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

        .initImg{
            width: 80px;
            height: 80px;
        }
        .initStickersImg{
            width: 100px;
            height: 100px;
        }

        .initFileImg{
            width: 300px;
            height: 300px;
        }


        .containImg{
            object-fit: contain;
        }
    </style>
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9" style="padding: 0;">
                <div class="dialogue-section">
                    <div class="dialogue-head" id="chat-history">
                        <p class="real-time">{{$now}}</p>
                        @if (!empty($currRoom))
                            @foreach($currRoom->messages as $message)
                                <?php
                                    // $user_name     = $message->user->name;
                                    // $contact_email = $message->user->contact_email;
                                    // $line          = $message->user->line;
                                    // $phone         = $message->user->phone;
                                    // $user_authcode = $message->user->authcode;
                                    // $note          = $message->user->note;
                                ?>
                                @if ($message->sender_id === Auth::user()->id)
                                    @if ($message->type === 'msgtem')
                                        <?php
                                            $msg_sample_id = json_decode($message->message);
                                            $msg_sample = App\Models\FrequentlyMsg::whereIn('id', $msg_sample_id)->get();
                                        ?>
                                        <?php foreach($msg_sample as $msgtem){?>
                                            <!-- BEGIN RESPONCSE DIALOGUE -->
                                            <div class="response-dialogue">
                                                <div class="user">
                                                    <img class="user-avatar" src="/assets/images/customer-response.png" alt="images">
                                                    <div class="dialogue">
                                                        <span class="dialogue-time">{{ $message->created_at->toFormattedDateString() }}, {{ $message->created_at->toTimeString() }}</span>
                                                        <div class="dialogue-content">
                                                            <p><a href="{{$msgtem->url}}">{{$msgtem->url}}</a>
                                                            </p>
                                                            <div class="dialogue-info">
                                                                <div class="activity">
                                                                    <div class="title">{{$msgtem->suject}}</div>
                                                                    <div class="content">
                                                                        <p>{{$msgtem->reply}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="thumbnail" style="margin: 0;">
                                                                    <img src="/assets/images/thumbnail.png" alt="images">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END RESPONCSE DIALOGUE-->
                                        <?php }?>
                                    @elseif ($message->type === 'media')
                                        <?php
                                        $media_id = json_decode($message->message);
                                        $media_v = App\Models\Media::whereIn('id', $media_id)->get();
                                        ?>
                                        <?php foreach($media_v as $med){?>
                                            <!-- BEGIN RESPONCSE DIALOGUE -->
                                            <div class="response-dialogue">
                                                <div class="user">
                                                    <img class="user-avatar" src="/assets/images/customer-response.png" alt="images">
                                                    <div class="dialogue">
                                                        <span class="dialogue-time">{{ $message->created_at->toFormattedDateString() }}, {{ $message->created_at->toTimeString() }}</span>
                                                        <div class="dialogue-content">
                                                            <div class="dialogue-info">
                                                                <img src="/file/{{ $med->file}}" alt="" class="initStickersImg containImg">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END RESPONCSE DIALOGUE-->
                                        <?php }?>
                                    @elseif ($message->type === 'stickers')
                                        <?php
                                        $sticker_name = json_decode($message->message);
                                        ?>
                                        <?php foreach($sticker_name as $sticker){?>
                                            <!-- BEGIN RESPONCSE DIALOGUE -->
                                            <div class="response-dialogue">
                                                <div class="user">
                                                    <img class="user-avatar" src="/assets/images/customer-response.png" alt="images">
                                                    <div class="dialogue">
                                                        <span class="dialogue-time">{{ $message->created_at->toFormattedDateString() }}, {{ $message->created_at->toTimeString() }}</span>
                                                        <div class="dialogue-content">
                                                            <div class="dialogue-info">
                                                                <img src="/assets/images/sticker/{{ $sticker}}" alt="" class="initStickersImg containImg">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END RESPONCSE DIALOGUE-->
                                        <?php }?>

                                    @elseif($message->type === 'file')
                                        <!-- BEGIN RESPONCSE DIALOGUE -->
                                        <div class="response-dialogue">
                                            <div class="user">
                                                <img class="user-avatar" src="/assets/images/customer-response.png" alt="images">
                                                <div class="dialogue">
                                                    <?php
                                                    list($msg, $file) = explode("[file]", $message->message);
                                                    list($type, $filename) = explode("#", $file);
                                                    if (strpos($type, "image") !== false) {
                                                        // $fileType 中包含 "image" 字串
                                                        $filename = $filename;
                                                    } else {
                                                        // $fileType 中不包含 "image" 字串
                                                        $filename = 'assets/images/file.png';
                                                    }
                                                ?>
                                                    <span class="dialogue-time">{{ $message->created_at->toFormattedDateString() }}, {{ $message->created_at->toTimeString() }}</span>
                                                    <div class="dialogue-content">
                                                        <div class="dialogue-info">
                                                            <div class="activity">
                                                                <div class="content">
                                                                   <p>{{$msg}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="thumbnail" style="margin: 0;">
                                                                <img src="/{{ $filename}}" alt="" class="initFileImg containImg">
                                                            <a onclick="downloadFile(`/{{$filename}}`)">下載</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END RESPONCSE DIALOGUE-->
                                    @else
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

                                    @endif
                                @else
                                    @if ($message->type === 'msgtem')
                                        <?php
                                        $msg_sample_id = json_decode($message->message);
                                        $msg_sample = App\Models\FrequentlyMsg::whereIn('id', $msg_sample_id)->get();
                                        foreach($msg_sample as $msgtem){
                                        ?>
                                        <!-- BEGIN REQUEST DIALOGUE -->
                                        <div class="request-dialogue">
                                                <div class="user">
                                                    <img class="user-avatar" src="/assets/images/user-request.png" alt="images">
                                                    <div class="dialogue-content">
                                                    <p>
                                                        <a href="{{$msgtem->url}}">{{$msgtem->url}}</a>
                                                    </p>
                                                    <div class="dialogue-info">
                                                        <div class="activity">
                                                            <div class="title">{{$msgtem->suject}}</div>
                                                            <div class="content">
                                                                <p>{{$msgtem->reply}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="thumbnail" style="margin: 0;">
                                                            <img src="/assets/images/thumbnail.png" alt="images">
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <span class="dialogue-time">{{ $message->created_at->toFormattedDateString() }}, {{ $message->created_at->toTimeString() }}</span>
                                                </div>
                                            </div>
                                            <!-- END REQUEST DIALOGUE -->
                                        <?php }?>
                                    @elseif ($message->type === 'media')
                                        <?php
                                            $media_id = json_decode($message->message);
                                            $media_v = App\Models\Media::whereIn('id', $media_id)->get();
                                            foreach($media_v as $med){
                                        ?>
                                        <!-- BEGIN REQUEST DIALOGUE -->
                                        <div class="request-dialogue">
                                            <div class="user">
                                                <img class="user-avatar" src="/assets/images/user-request.png" alt="images">
                                                <div class="dialogue-content">
                                                <div class="dialogue-info">
                                                    <img src="/file/{{ $med->file}}" alt="" class="initStickersImg containImg">
                                                </div>
                                                </div>
                                                <span class="dialogue-time">{{ $message->created_at->toFormattedDateString() }}, {{ $message->created_at->toTimeString() }}</span>
                                            </div>
                                        </div>
                                        <!-- END REQUEST DIALOGUE-->
                                        <?php }?>
                                    @elseif ($message->type === 'stickers')
                                        <?php $sticker_name = json_decode($message->message);
                                            foreach($sticker_name as $sticker){
                                        ?>
                                        <!-- BEGIN REQUEST DIALOGUE -->
                                        <div class="request-dialogue">
                                            <div class="user">
                                                <img class="user-avatar" src="/assets/images/user-request.png" alt="images">
                                                <div class="dialogue-content">
                                                <img src="/assets/images/sticker/{{ $sticker}}" alt="" class="initStickersImg containImg">
                                                </div>
                                                <span class="dialogue-time">{{ $message->created_at->toFormattedDateString() }}, {{ $message->created_at->toTimeString() }}</span>
                                            </div>
                                        </div>
                                        <!-- END REQUEST DIALOGUE -->
                                        <?php }?>
                                    @elseif($message->type === 'file')
                                        <!-- BEGIN RESPONCSE DIALOGUE -->
                                        <div class="response-dialogue">
                                            <div class="user">
                                                <img class="user-avatar" src="/assets/images/customer-response.png" alt="images">
                                                <div class="dialogue">
                                                    <?php
                                                    list($msg, $file) = explode("[file]", $message->message);
                                                    list($type, $filename) = explode("#", $file);
                                                    if (strpos($type, "image") !== false) {
                                                        // $fileType 中包含 "image" 字串
                                                        $filename = $filename;
                                                    } else {
                                                        // $fileType 中不包含 "image" 字串
                                                        $filename = 'assets/images/file.png';
                                                    }
                                                ?>
                                                    <span class="dialogue-time">{{ $message->created_at->toFormattedDateString() }}, {{ $message->created_at->toTimeString() }}</span>
                                                    <div class="dialogue-content">
                                                        <div class="dialogue-info">
                                                            <div class="activity">
                                                                <div class="content">
                                                                   <p>{{$msg}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="thumbnail" style="margin: 0;">
                                                                <img src="/{{ $filename}}" alt="" class="initFileImg containImg">
                                                            <a onclick="downloadFile(`/{{$filename}}`)">下載</a>
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
                                                        {{ $message->message }}
                                                    </p>
                                                </div>
                                                <span class="dialogue-time">{{ $message->created_at->toFormattedDateString() }}, {{ $message->created_at->toTimeString() }}</span>
                                            </div>
                                        </div>
                                        <!-- END REQUEST DIALOGUE -->
                                    @endif
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
                                        <textarea id="chat-message-input" class="form-control" maxlength="300" rows="5"
                                        placeholder="請輸入訊息"></textarea>

                                    <div class="message-input-actions btn-group">
                                        {{-- <div id="preview"></div> --}}
                                        <div id="preview">
                                            <img src="/assets/images/file.png" id="showImg" width="80" height="80">
                                        </div>
                                        <label class="upload-btn">
                                            <input id="upload_img" style="display:none;" type="file" accept=".jpg,.jpeg,.gif,.png,.pdf,.mov,.mp4">
                                            <i class="icon-paper-clip" id="uploadfile"></i>
                                        </label>
                                        <label class="upload-btn">
                                            <i class=" icon-trash" id="clearfile" style="display:none;"></i>
                                        </label>
                                    </div>
                                </div>
                                <!-- BEGIN FOOTER -->
                                <div class="page-footer-inner">Copyright © 2023 FANINSIGHTS.IO ALL RIGHTS RESERVED.
                                </div>
                                <!-- END FOOTER -->
                            </div>
                            <div class="message-feature">
                                <div class="send">
                                    <button id="submit-msg" class="submit-btn" onclick="send()">發送</button>
                                </div>
                                <div class="customer-turn">
                                    <button class="refer-btn" data-target="#apply-return" data-toggle="modal">客服轉介</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding: 0;border: 1px solid #F5F5F5;">
                <?php
                    $user_name  = $rooms_users[0]->name;
                    $contact_email = $rooms_users[0]->contact_email;
                    $phone = $rooms_users[0]->phone;
                    $line = $rooms_users[0]->line;
                    $note = $rooms_users[0]->note;
                    $user_authcode = $rooms_users[0]->authcode;
                ?>
                <div class="feature-section">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">
                                <div class="media">
                                    <img class="media-object" src="/assets/images/user-default.png" alt="...">
                                    <div class="media-body">
                                        <h4 class="media-heading">{{isset($user_name) ? $user_name : ''}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <ul class="list-unstyled">
                                <li class="list-items">
                                    <span class="info"><i class="fa fa-envelope"></i>Email</span>
                                    {{-- <span class="num">{{isset($contact_email) ? $contact_email : ''}}</span> --}}
                                    <input class="form-control input"  type="text" name="email" id="email" value="{{isset($contact_email) ? $contact_email : ''}}">
                                </li>
                                <li class="list-items">
                                    <span class="info"><i class="fa fa-phone"></i>手機</span>
                                    {{-- <span class="num">{{isset($phone) ? $phone : ''}}</span> --}}
                                    <input class="form-control input"  type="text" name="phone" id="phone" value="{{isset($phone) ? $phone : ''}}">

                                </li>
                                <li class="list-items">
                                    <span class="info"><i class="fa fa-comment"></i>Line</span>
                                    {{-- <span class="num">{{isset($line) ? $line : ''}}</span> --}}
                                    <input class="form-control input"  type="text" name="line" id="line" value="{{isset($line) ? $line : ''}}">

                                </li>
                                <li class="list-items">
                                    <span class="info"><i class="fa fa-sticky-note-o"></i>回覆備註</span>
                                <textarea class="form-control" rows="5" placeholder="請輸入備註" id="note" name="note" >{{isset($note) ? $note :''}}</textarea>
                                </li>
                                {{-- <li class="list-items">
                                    <span class="info"><i class="fa fa-location-arrow"></i>定位點</span>
                                    <span class="num"></span>
                                </li> --}}
                            </ul>
                            <input type="hidden" name="authcode" id="authcode" value="{{isset($user_authcode) ? $user_authcode : ''}}">
                            <button  type="button" id="updateUserInfo" onclick="updateuserinfo()" class="search-btn" id="btn-search" style="margin-right: 5px;">更新聯絡資料</button>
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
                                    <a  data-target="#media" class="icon-btn" data-toggle="modal">
                                        <i class="fa fa-folder-o"></i>
                                        <div>媒體庫</div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a  data-target="#message" class="icon-btn" data-toggle="modal">
                                        <i class="fa fa-comment"></i>
                                        <div>訊息範本</div>
                                    </a>
                                </div>
                                <div class="col-md-4" style="padding: 0 20px 0 5px;">
                                    <a data-target="#sticker" class="icon-btn" data-toggle="modal">
                                        <i class="fa fa-image"></i>
                                        <div>貼圖</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject">回覆備註</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="form-group">
                                <textarea class="form-control" rows="5" placeholder="請輸入備註" id="note" name="note" >{{isset($note) ? $note :''}}</textarea>
                            </div>
                        </div>
                    </div> --}}
                    <div class="feature-btn">
                        <button class="return-btn" onClick="location.href='/dialoguelist'">返回</button>
                        <button class="submit-btn" type="submit" onclick="roomcomplete()">客服完成</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN MEDIA MODAL -->
    <div class="modal container fade in" id="media" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">媒體庫</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <form id="search-form">
                <div class="col-md-4">
                    <input name="keyword" class="form-control" placeholder="請輸入關鍵字" value=""
                        style="margin-right: 5px;">
                    <input name="page" type="hidden" value="1" />
                </div>
                <button type="submit" class="search-btn" id="btn-search" style="margin-right: 5px;">
                    <i class="fa fa-search"></i>
                    查詢
                </button>
                </form>
            </div>
            <form id="publish-msg-sample" action="/dialogue/{{$currRoom->id}}/publish" method="POST" enctype="application/json">
                @csrf
                <input type="hidden" id="msg-type" name="type" value="media">

                <div class="media-content">
                    <div class="row">
                        <?php foreach ($media as $m): ?>
                        <div class="col-md-4">
                            <div class="media">
                                <div class="media-info">
                                    <div class="media-title">
                                        <input type="checkbox" id="media-{{ $m->id }}" name="items[]" value="{{ $m->id }}">

                                        <label for="media-{{ $m->id }}">{{ $m->title}}</label>
                                    </div>
                                    {{-- <div class="thumbnail" style="margin: 0;"> --}}
                                    <div  style="margin: 0;">
                                        <?php
                                            list($fiel, $type)= explode(".", $m->file);
                                            echo $type;
                                            echo strpos($type, "jpg");
                                            if (strpos($type, "png") || strpos($type, "jpg") || strpos($type, "tiff")
                                                    || strpos($type, "gif") || strpos($type, "jpeg")  )
                                                {
                                         ?>
                                            <img src="/file/{{ $m->file}}" alt="" class="initImg containImg">
                                        <?php   } else { ?>
                                            <img src="/assets/images/file.png" alt="" class="initImg containImg">
                                        <?php   } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button class="close-btn" data-dismiss="modal">關閉</button>
            <button type="submit" class="submit-btn">確定</button>
        </div>
    </form>
    </div>
    <!-- END MEDIA MODAL -->
    <!-- BEGIN MESSAGE MODAL -->
    <div class="modal container fade in" id="message" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">訊息範本</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <input name="keyword" class="form-control" placeholder="請輸入關鍵字" value=""
                        style="margin-right: 5px;">
                    <input name="page" type="hidden" value="1" />
                </div>
                <button type="submit" class="search-btn" id="btn-search" style="margin-right: 5px;">
                    <i class="fa fa-search"></i>
                    查詢
                </button>
            </div>
            <form id="publish-msg-sample" action="/dialogue/{{$currRoom->id}}/publish" method="POST" enctype="application/json">
            {{-- <form id="publish-msg-sample" > --}}
                    @csrf
                <input type="hidden" id="msg-type" name="type" value="msgtem">
                <div class="dialogue-content">
                <div class="row">
                    <?php foreach ($msg_sample as $msg): ?>
                        <div class="col-md-4">
                            <div class="dialogue">
                                <div class="dialogue-info">
                                    <div class="dialogue-title">
                                        <div class="source">
                                            <input class="messageCheckbox" type="checkbox" id="msgsample"  name="items[]" value="{{ $msg->id }}">
                                            <p>
                                                <a
                                                    href="{{ $msg->url }}">{{ $msg->url }}</a>
                                            </p>
                                        </div>
                                        <div class="activity">
                                            <div class="activity-content">
                                                <div class="title">{{ $msg->subject }}</div>
                                                <div class="content">
                                                    <p>
                                                        {{ $msg->reply }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="thumbnail" style="margin: 0;">
                                                <img src="/assets/images/thumbnail.png" alt="images">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button class="close-btn" data-dismiss="modal">關閉</button>
            <button type="submit" class="submit-btn" id="msgtemsubmit">確定</button>
        </div>
    </form>

    </div>
    <!-- END MESSAGE MODAL -->
    <!-- BEGIN CUSTOMER RETURN MODAL -->
    <div id="apply-return" class="modal container fade" tabindex="-1" aria-hidden="true" style="display: none; margin-top: -397px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">申請客服轉介</h4>
        </div>
        <form action="/room/assign/apply" method="POST">
            @csrf
        <div class="modal-body" >
            <div class="row">
                <label class="control-label col-md-2" style="margin-bottom: 20px;">指派單位</label>
                <div class="col-md-10" style="margin-bottom: 20px;">
                    <input type="hidden" name="assign_service" value="{{ $currRoom->service }}">
                    <input type="hidden" name="room_id" value="{{ $currRoom->id }}">
                    <input type="hidden" name="assign_id" value="{{ Auth::user() -> id }}">
                    <select class="form-control select2-multiple select2-hidden-accessible" multiple="" tabindex="-1"
                    aria-hidden="true"  name="assigned_service" required>
                        <optgroup label="旅遊服務中心">
                            @foreach($motc_station_transfer as $motc)
                            <option value="{{$motc->sn}}">{{$motc->station_name}}</option>
                            @endforeach
                        </optgroup>
                        {{-- <optgroup label="基隆市">
                            <option value="1">基隆火車站旅遊服務中心</option>
                        </optgroup>
                        <optgroup label="台北市">
                            <option value="2">臺北火車站旅遊服務中心</option>
                            <option value="3">桃園捷運A1台北車站旅遊服務中心</option>
                            <option value="4">捷運西門站旅遊服務中心</option>
                            <option value="5">捷運臺北101/世貿站旅遊服務中心</option>
                        </optgroup> --}}
                    </select>
                </div>
                <label class="col-md-2 control-label" style="margin-bottom: 20px;">指派原因</label>
                <div class="col-md-10" style="margin-bottom: 20px;">
                    <textarea class="form-control" row="10" placeholder="請輸入指派原因" style="height: 400px;" name="assign_reason" required></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="close-btn" data-dismiss="modal">取消</button>
            <button type="submit" class="submit-btn">送出</button>
        </div>
    </form>
    </div>
    <!-- END CUSTOMER RETURN MODAL -->
    <!-- BEGIN STICKER MODAL -->
    <div class="modal container fade in" id="sticker" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <form id="publish-msg-sample" action="/dialogue/{{$currRoom->id}}/publish" method="POST" enctype="application/json">
            <input type="hidden" id="msg-type" name="type" value="stickers">
            @csrf
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">貼圖</h4>
        </div>
        <div class="modal-body">
            <div class="row gx-3">
                <div class="col-md-2">
                    <div class="sticker">
                        <div class="sticker-info">
                            <div class="sticker-title">
                                <input type="checkbox" id="checkbox-1" name="items[0]" value="ok.png">
                                <label for="checkbox-1">好</label>
                            </div>
                            <div class="img-wrap">
                                <img src="/assets/images/sticker/ok.png" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="sticker">
                        <div class="sticker-info">
                            <div class="sticker-title">
                                <input type="checkbox" id="checkbox-1" name="items[1]" value="i_got_it.png">
                                <label for="checkbox-1">我知道了</label>
                            </div>
                            <div class="img-wrap">
                                <img src="/assets/images/sticker/i_got_it.png" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="sticker">
                        <div class="sticker-info">
                            <div class="sticker-title">
                                <input type="checkbox" id="checkbox-1" name="items[2]" value="thank-you.png">
                                <label for="checkbox-1">謝謝</label>
                            </div>
                            <div class="img-wrap">
                                <img src="/assets/images/sticker/thank-you.png" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="sticker">
                        <div class="sticker-info">
                            <div class="sticker-title">
                                <input type="checkbox" id="checkbox-1" name="items[3]" value="welcome.png">
                                <label for="checkbox-1">不客氣</label>
                            </div>
                            <div class="img-wrap">
                                <img src="/assets/images/sticker/welcome.png" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="sticker">
                        <div class="sticker-info">
                            <div class="sticker-title">
                                <input type="checkbox" id="checkbox-1" name="items[4]" value="for_you.png">
                                <label for="checkbox-1">給你</label>
                            </div>
                            <div class="img-wrap">
                                <img src="/assets/images/sticker/for_you.png" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="sticker">
                        <div class="sticker-info">
                            <div class="sticker-title">
                                <input type="checkbox" id="checkbox-1" name="items[5]" value="got_it.png">
                                <label for="checkbox-1">收到</label>
                            </div>
                            <div class="img-wrap">
                                <img src="/assets/images/sticker/got_it.png" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="sticker">
                        <div class="sticker-info">
                            <div class="sticker-title">
                                <input type="checkbox" id="checkbox-1" name="items[6]" value="goodbye.png">
                                <label for="checkbox-1">再見</label>
                            </div>
                            <div class="img-wrap">
                                <img src="/assets/images/sticker/goodbye.png" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="sticker">
                        <div class="sticker-info">
                            <div class="sticker-title">
                                <input type="checkbox" id="checkbox-1" name="items[7]" value="doubt.png">
                                <label for="checkbox-1">疑惑</label>
                            </div>
                            <div class="img-wrap">
                                <img src="/assets/images/sticker/doubt.png" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="close-btn" data-dismiss="modal">關閉</button>
            <button type="submit" class="submit-btn">確定</button>
        </div>
        </form>
    </div>
    <!-- END STICKER MODAL -->
    <!--[if lt IE 9]>
        <script src="/assets/metronic/global/plugins/respond.min.js"></script>
        <script src="/assets/metronic/global/plugins/excanvas.min.js"></script>
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
    <!-- <script src="/assets/js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script> -->
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/assets/metronic/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js"
        type="text/javascript"></script>
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
    <script src="/assets/metronic/theme/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>
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
    <!-- <script src="/assets/metronic/layouts/layout4/scripts/quick-sidebar.min.js" type="text/javascript"></script> -->
    <!-- <script type="text/javascript" src="/assets/js/lib/fancybox/jquery.fancybox.pack.js"></script> -->
    <!-- END THEME LAYOUT SCRIPTS -->
    <script type="text/javascript"
        src="/assets/metronic/theme/assets/global/plugins/jquery.twbsPagination.min.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- websocket centrifuge -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"> --}}
    <script src="https://cdn.jsdelivr.net/gh/centrifugal/centrifuge-js@2.8.4/dist/centrifuge.min.js"></script>

    <script type="text/javascript">
    // const textarea = document.getElementById("chat-message-input");
    // const button = document.getElementById("submit-msg");

    // textarea.addEventListener("keydown", function(event) {
    // if (event.key === "Enter" && !event.shiftKey && event.target === textarea) {
    //     event.preventDefault();
    //     button.click();
    // }
    // });

        function downloadFile(url) {
            var newurl = location.protocol +'//' +location.hostname+url
            fetch(newurl, {
                headers: {
                'Content-Type': 'application/octet-stream'
                }
            })
                .then(response => response.blob())
                .then(blob => {
                 // 使用 split 函數拆分網址
                const parts = newurl.split('.');
                // 取得最後一個元素，也就是副檔名
                const extension = parts[parts.length - 1];
                const url = window.URL.createObjectURL(new Blob([blob]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'file.' + extension); // 檔案名稱可以自行指定
                document.body.appendChild(link);
                link.click();
                link.parentNode.removeChild(link);
                });
            }

        function updateuserinfo(){
            var authcode = document.getElementById("authcode").value;
            var email = document.getElementById("email").value;
            var phone = document.getElementById("phone").value;
            var line = document.getElementById("line").value;
            var currentRoomId = "{{ !empty($currRoom) ? $currRoom -> id : 0 }}";
            var note = document.getElementById("note").value;
            $.ajax({
                url: "/api/contact/" + authcode + "/update",
                data: JSON.stringify({
                    "contact_email":email,
                    "phone":phone,
                    "line":line,
                    "note":note
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
                    window.location.replace('/dialogue/'+ currentRoomId);
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

        function roomcomplete(){
            // var note = document.getElementById("note").value;
            var authcode = document.getElementById("authcode").value;
            var currentRoomId = "{{ !empty($currRoom) ? $currRoom -> id : 0 }}";
            const xhttp = new XMLHttpRequest();
            const csrfToken = "{{ csrf_token() }}";

            xhttp.open("POST", "/dialogue/" + currentRoomId + "/publish");
            xhttp.setRequestHeader("X-CSRF-TOKEN", csrfToken);
            xhttp.send(JSON.stringify({
                message: 'completed'
            }));

            // $.ajax({
            //     url: "/api/contact/" + authcode + "/update",
            //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            //     data: JSON.stringify({
            //         "note":note
            //     }),
            //     dataType: 'json',
            //     contentType: 'application/json;charset=UTF-8',
            //     method: 'POST',
            //     processData: false, // important
            //     contentType: false, // important
            //     cache: false,
            //     success: function(data)
            //     {
            //         // redirect
            //         //window.location.replace(data.redirect);
            //     },
            //     error: function(data)
            //     {
            //         // intergrate Swal to display error
            //         // Swal.close();
            //         // if (data.status == 419) {
            //         //     window.location.reload();
            //         // } else {
            //         //     Swal.fire({
            //         //         icon: 'info',
            //         //         title: 'Error',
            //         //         html: data.responseJSON.message,
            //         //     });
            //         // }
            //     }
            // });
            $.ajax({
                url: "/api/rooms/update/status",
                data: JSON.stringify({
                    "id":currentRoomId,
                    "status":6
                }),
                dataType: 'json',
                contentType: 'application/json;charset=UTF-8',
                method: 'POST',
                processData: false, // important
                contentType: false, // important
                cache: false,
                success: function(data)
                {
                    //console.log(data)
                    //alet(data)
                    // redirect
                    window.location.replace('/dialoguelist');
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



            // $.ajax({
            //     url: "https://qa.taiwan.net.tw/api/survey/send/" +currentRoomId,
            //     dataType: 'json',
            //     contentType: 'application/json;charset=UTF-8',
            //     method: 'GET',
            //     processData: false, // important
            //     contentType: false, // important
            //     cache: false,
            //     success: function(data)
            //     {
            //         // redirect
            //         //window.location.replace(data.redirect);
            //     },
            //     error: function(data)
            //     {
            //         // intergrate Swal to display error
            //         // Swal.close();
            //         // if (data.status == 419) {
            //         //     window.location.reload();
            //         // } else {
            //         //     Swal.fire({
            //         //         icon: 'info',
            //         //         title: 'Error',
            //         //         html: data.responseJSON.message,
            //         //     });
            //         // }
            //     }
            // });

        }

        var output = document.getElementById("output");
        const messageInput = document.querySelector('#chat-message-input');
        const imageInput = document.querySelector('#upload_img');
        const preview = document.querySelector('#preview');
        const showImg = document.querySelector('#showImg');
        const maxWidth = 1000;

        const clearBtn = document.getElementById('clearfile');
        const uploadBtn = document.getElementById('uploadfile');
        preview.style.display = 'none';

        preview.addEventListener('click', function() {
            imageInput.click();
        });

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            const reader = new FileReader();

            if(file.size > 2097152){
                alert("您上傳的檔案過大，僅可上傳2mb內的檔案。");
                return;
            };
            const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png', 'image/gif', 'image/tiff', 'video/quicktime', 'video/mp4'];

            if (!allowedTypes.includes(file.type)) {
                alert('此檔案類型不支援，僅可上傳2mb內的PDF、JPG、PNG、GIF、JPEG、TIF、MOV、MP4檔案');
                return;
            }

            reader.addEventListener('load', function() {
                const img = document.createElement('img');
                            // 調整圖片大小
                if (file.type.startsWith('image/')) {
                    img.src = reader.result;
                } else {
                    img.src = '/assets/images/file.png';
                }


                img.width = 80;
                img.height = 80;
                preview.innerHTML = '';

                preview.appendChild(img);
                preview.style.display = 'inline-block';
                clearBtn.style.display = 'inline-block';
                uploadBtn.style.display = 'none';
                // messageInput.value += `[file]${file.name}[file]` ;
                // messageInput.value = `[file]${file.name}[file]` ;
            });


            reader.readAsDataURL(file);
        });

        clearBtn.addEventListener('click', function() {
            imageInput.value = '';
            preview.innerHTML = '';
            clearBtn.style.display = 'none';
            uploadBtn.style.display = 'inline-block';

        });
        //preview.appendChild(clearBtn);

        function send(){
            //output.innerHTML = input.value;
            const currentUserId = "{{ Auth::user() -> id }}";
            const currentRoomId = "{{ !empty($currRoom) ? $currRoom -> id : 0 }}";

            const chatHistory = document.querySelector('#chat-history');
            const messageInput = document.querySelector('#chat-message-input');
            const uploadInput = document.querySelector('#upload_img');
            const csrfToken = "{{ csrf_token() }}";

            var message = messageInput.value;
            const preview = document.querySelector('#preview');
            var type = 'message';
            const formData = new FormData();

            // Add message to form data
            formData.append('message', message);

            // Add selected file to form data
            if (uploadInput.files.length > 0) {
                const file = uploadInput.files[0];
                formData.append('file', file);
                type = 'file';
                //messageInput.value += ' [附加圖片] ';
            }

            if (type == 'file') {
                 message = 'file';
            }

            //e.preventDefault();
            // const message = messageInput.value;
            if (!message) {
                return;
            }
            const xhttp = new XMLHttpRequest();
            if (type == 'file') {
                xhttp.onreadystatechange = function() {
                    if (this.readyState === 4) {
                        if (this.status === 200) {
                            const response = JSON.parse(this.responseText);
                            if (response.msg == 'success') {
                                window.location.href = "/dialogue/" + currentRoomId ;
                            } else {
                                console.error('Redirect failed');
                            }
                        } else {
                            console.error(`Server error: ${this.status}`);
                        }
                    }
                };
            }


            xhttp.open("POST", "/dialogue/" + currentRoomId + "/publish");
            xhttp.setRequestHeader("X-CSRF-TOKEN", csrfToken);

            if (uploadInput.files.length == 0) {
                xhttp.send(JSON.stringify({
                    message: message
                }));
            } else {
                xhttp.send(formData);
            }

            messageInput.value = '';
            preview.innerHTML = '';

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
            const uploadInput = document.querySelector('#upload_img');
            const formData = new FormData();

            var type = 'message';

            function scrollToLastMessage() {
                chatHistory.scrollTop = chatHistory.scrollHeight;
            }
            scrollToLastMessage();
            if (messageInput !== null) {
                messageInput.focus();

                const csrfToken = "{{ csrf_token() }}";
                messageInput.onkeypress = function(e) {
                    if (e.key === "Enter" && document.activeElement === messageInput) { // enter, return

                        // Add selected file to form data
                        if (uploadInput.files.length > 0) {
                            const file = uploadInput.files[0];
                            formData.append('file', file);
                            type = 'file';
                            //messageInput.value += ' [附加圖片] ';
                        }


                        if (window.getSelection().toString().length !== 0 && window.getSelection().anchorNode.parentElement !== messageInput) {
                            return;
                        }
                        e.preventDefault();
                        var message = messageInput.value;
                        // Add message to form data
                        formData.append('message', message);

                        if (type == 'file') {
                            message = 'file';
                        }
                        if (!message) {
                            return;
                        }
                        const xhttp = new XMLHttpRequest();
                        if (type == 'file') {
                            xhttp.onreadystatechange = function() {
                                if (this.readyState === 4) {
                                    if (this.status === 200) {
                                        const response = JSON.parse(this.responseText);
                                        if (response.msg == 'success') {
                                            window.location.href = "/dialogue/" + currentRoomId ;
                                        } else {
                                            console.error('Redirect failed');
                                        }
                                    } else {
                                        console.error(`Server error: ${this.status}`);
                                    }
                                }
                            };
                        }

                        xhttp.open("POST", "/dialogue/" + currentRoomId + "/publish");
                        xhttp.setRequestHeader("X-CSRF-TOKEN", csrfToken);
                        // xhttp.send(JSON.stringify({
                        //     message: message
                        // }));
                        if (uploadInput.files.length == 0) {
                            xhttp.send(JSON.stringify({
                                message: message
                            }));
                        } else {
                            xhttp.send(formData);
                        }
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
                                '<div class="dialogue-content" style="max-width: 100%;">'+
                                    '<div class="dialogue-info">'+
                                        '<div class="activity">'+
                                            '<div class="content" >'+
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
                                '<div class="dialogue-content" style="max-width: 100%;">'+
                                    '<div class="dialogue-info">'+
                                        '<div class="activity">'+
                                            '<div class="content" >'+
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

            const centrifuge = new Centrifuge("wss://" + window.location.host + "/connection/websocket");

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

        // 获取元素
const mediaContent = document.querySelector('.media-content');
const searchForm = document.querySelector('#search-form');

// 发送 AJAX 请求
function searchMedia(keyword, page) {
  const url = `/api/media?keyword=${keyword}&page=${page}`;
  fetch(url)
    .then(response => response.json())
    .then(data => {
      // 清空原来的媒体内容
      mediaContent.innerHTML = '';

      // 构建新的媒体内容
      for (const m of data.data) {  // 改為 data.data，因為返回的媒體在 data.data 裡面
        const div = document.createElement('div');
        div.classList.add('col-md-4');
        div.innerHTML = `
          <div class="media">
            <div class="media-info">
              <div class="media-title">
                <input type="checkbox" id="media-${m.id}" name="items[]" value="${m.id}">
                <label for="media-${m.id}">${m.file}</label>
              </div>
              <div style="margin: 0;">
                <img src="/file/${m.file}" alt="" class="initImg containImg">
              </div>
            </div>
          </div>
        `;
        mediaContent.appendChild(div);
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

// 监听表单提交事件
searchForm.addEventListener('submit', event => {
  event.preventDefault();
  const keyword = searchForm.querySelector('[name="keyword"]').value;
  const page = 1; // 重置为第一页
  searchMedia(keyword, page);
});
    </script>

</body>

</html>