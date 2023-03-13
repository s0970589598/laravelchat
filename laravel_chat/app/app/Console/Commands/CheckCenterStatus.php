<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\NotifyAdmin;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CheckCenterStatus extends Command
{
    protected $signature = 'check:center-status';
    protected $description = 'Check center status and send email to admin if no customer online';

    public function handle()
    {

        $centers = Center::with('users')->get();

        foreach ($centers as $center) {
            $start_time = Carbon::createFromTimeString($center->start_time);
            $end_time = Carbon::createFromTimeString($center->end_time);

            $now = Carbon::now();

            if ($now->between($start_time, $end_time)) {
                $online_users = User::where('center_id', $center->id)
                                     ->where('is_online', true)
                                     ->get();
            if ($online_users->isEmpty()) {
                    $admin_email = $center->admin->email;
                    $mail_data = [
                        'center_name' => $center->name,
                        'admin_name' => $center->admin->name
                    ];
                    Mail::to($admin_email)->send(new NotifyAdmin($mail_data));
                }
            }
        }
    }
}
