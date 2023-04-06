<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\UserLog;
use App\Events\UserLoggedOut;
use Illuminate\Support\Facades\Log;

class LogSuccessfulLogout
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
    public function handle(UserLoggedOut $event)
    {
        $user = $event->user;
        $ip = request()->ip();
        $device = request()->header('User-Agent');
        $logoutTime = now();

        Log::info('User logged out', [
            'user_id' => $user->id,
            'name' => $user->name,
            'ip' => $ip,
            'device' => $device,
            'logout_time' => $logoutTime,
        ]);

            UserLog::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'ip' => $ip,
                'device' => $device,
                'action_time' => $logoutTime,
                'action_type' => 'logout',
            ]);

    }
}
