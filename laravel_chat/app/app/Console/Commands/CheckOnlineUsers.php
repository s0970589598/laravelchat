<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\MotcOfflineHistory;


class CheckOnlineUsers extends Command
{
    // protected $name = 'command:checkonlineusers';

    protected $signature = 'check-online-users';

    protected $description = 'Check if there are online users during working hours and send email to the admin if no one is online';

    public function handle(UserRepository $user_repository)
    {
        $centers = [
            '基隆火車站旅遊服務中心' => [
                'sn'        => 1,
                'start_time' => '01:00:00',
                'end_time' => '17:00:00',
                'admin_email' => 'st92308@gmail.com',
                'role' => 'admin',
            ],
            '臺北火車站旅遊服務中心' => [
                'sn'        => 2,
                'start_time' => '01:30:00',
                'end_time' => '16:30:00',
                'admin_email' => 'st92308@gmail.com',
                'role' => 'admin',
            ],
            '桃園捷運A1台北車站旅遊服務中心' => [
                'sn'        => 3,
                'start_time' => '01:00:00',
                'end_time' => '18:00:00',
                'admin_email' => 'st92308@gmail.com',
                'role' => 'admin',
            ],
        ];

        foreach ($centers as $centerName => $center) {
            $startTime = date('Y-m-d') . ' ' . $center['start_time'];
            $endTime = date('Y-m-d') . ' ' . $center['end_time'];
            $adminEmail = $center['admin_email'];
            $role = $center['role'];
            $sn =  $center['sn'];

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
                MotcOfflineHistory::create(
                    array(
                        'service' => $sn
                    )
                );
                //Log::info($centerName . 'no customer' . $now);
                Mail::send('email.no_online_users', $data, function ($message) use ($adminEmail, $centerName) {
                    $message->to($adminEmail)
                            ->subject($centerName . '旅服中心目前沒有旅服人員上線，請立即確認')
                            ->setBody('您好，目前' . $centerName . '沒有客服人員在線上，請您確認該中心客服狀況。');
                });

            }
        }
    }
}
