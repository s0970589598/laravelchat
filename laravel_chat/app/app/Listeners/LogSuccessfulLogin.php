<?php

namespace App\Listeners;

// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

use App\Events\UserLoggedIn;

use Illuminate\Support\Facades\Log;
use App\Models\UserLog;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        $user = $event->user;
        $ip = request()->ip();
        $device = request()->header('User-Agent');
        $loginTime = now();

        // Log::info('User logged in', [
        //     'user_id' => $user->id,
        //     'name' => $user->name,
        //     'ip' => $ip,
        //     'device' => $device,
        //     'login_time' => $loginTime,
        // ]);
        UserLog::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'ip' => $ip,
            'device' => $device,
            'action_time' => $loginTime,
            'action_type' => 'login',
        ]);

    }
}
