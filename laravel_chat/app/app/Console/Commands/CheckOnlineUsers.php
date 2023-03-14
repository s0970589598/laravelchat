<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CheckOnlineUsers extends Command
{
    // protected $name = 'command:checkonlineusers';

    protected $signature = 'check-online-users';

    protected $description = 'Check if there are online users during working hours and send email to the admin if no one is online';

    public function handle(UserRepository $user_repository)
    {
        $centers = [
            '基隆火車站旅遊服務中心' => [
                'start_time' => '01:00:00',
                'end_time' => '17:00:00',
                'admin_email' => 'st92308@gmail.com',
                'role' => 'admin',
            ],
            '臺北火車站旅遊服務中心' => [
                'start_time' => '01:30:00',
                'end_time' => '16:30:00',
                'admin_email' => 'st92308@yahoo.com',
                'role' => 'admin',
            ],
            '桃園捷運A1台北車站旅遊服務中心' => [
                'start_time' => '01:00:00',
                'end_time' => '18:00:00',
                'admin_email' => 'allen.wu@goodlinker.io',
                'role' => 'admin',
            ],
        ];

        foreach ($centers as $centerName => $center) {
            $startTime = date('Y-m-d') . ' ' . $center['start_time'];
            $endTime = date('Y-m-d') . ' ' . $center['end_time'];
            $adminEmail = $center['admin_email'];
            $role = $center['role'];

            $params = array(
                'role' => 'customer',
                'start_time'=>$startTime,
                'end_time'=>$endTime,
                'service'=>$centerName,
            );
            $onlineUsers = $user_repository->getUserListByParams($params);

            $now = Carbon::now('Asia/Taipei');
            // Log::info(Carbon::now('Asia/Taipei'));
            // Log::info('---');
            // Log::info($now >= $startTime);
            // Log::info($now <= $endTime);
            // Log::info($onlineUsers->isEmpty());
            // Log::info('---');


            if ($onlineUsers->isEmpty() && ($now >=$startTime) && ($now <=$endTime)) {
                $data = [
                    'centerName' => $centerName,
                ];
                //Log::info($centerName . 'no customer' . $now);
                Mail::send('email.no_online_users', $data, function ($message) use ($adminEmail) {
                    $message->to($adminEmail)
                            ->subject('No online users during working hours');
                });
            }
        }
    }
}
