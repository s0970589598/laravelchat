@component('mail::message')
# 密碼重置要求

您收到這封電子郵件是因為我們收到了您的帳戶的密碼重置要求。

@component('mail::button', ['url' => $url])
重設密碼
@endcomponent

此重置連結將在 :count 分鐘後過期。

如果您沒有要求重設密碼，請忽略此郵件。

謝謝,<br>
{{ config('app.name') }}
@endcomponent
