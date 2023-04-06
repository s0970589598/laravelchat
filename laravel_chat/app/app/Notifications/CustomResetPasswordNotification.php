<?php
namespace App\Notifications;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends ResetPassword
{
    protected $source;

    public function __construct($token, $source)
    {
        parent::__construct($token);
        $this->source = $source;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('重設密碼')
            ->view(
                'emails.reset-password',
                [
                    'url' => url(config('app.url').route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)),
                    'count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire'),
                    'source' => $this->source,
                ]
            );
    }
}
