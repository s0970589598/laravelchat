<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\MotcOfflineHistory;
use App\Repositories\MotcStationRepository;

class CheckOnlineUsers extends Command
{
    // protected $name = 'command:checkonlineusers';

    protected $signature = 'check-online-users';

    protected $description = 'Check if there are online users during working hours and send email to the admin if no one is online';


    public function handle(UserRepository $user_repository,MotcStationRepository $motc_station_repository)
    {
        // $centers = [
        //     '基隆火車站旅遊服務中心' => [
        //         'sn'        => 1,
        //         'start_time' => '01:00:00',
        //         'end_time' => '17:00:00',
        //         'admin_email' => 'st92308@gmail.com',
        //         'role' => 'admin',
        //     ],
        //     '臺北火車站旅遊服務中心' => [
        //         'sn'        => 2,
        //         'start_time' => '01:30:00',
        //         'end_time' => '16:30:00',
        //         'admin_email' => 'st92308@gmail.com',
        //         'role' => 'admin',
        //     ],
        //     '桃園捷運A1台北車站旅遊服務中心' => [
        //         'sn'        => 3,
        //         'start_time' => '01:00:00',
        //         'end_time' => '18:00:00',
        //         'admin_email' => 'st92308@gmail.com',
        //         'role' => 'admin',
        //     ],
        // ];
        $motc_list = $motc_station_repository->motcStationList([]);

        $current = Carbon::now('Asia/Taipei');
        $right_now = $current->toDateTimeString();
        $w = $current->dayOfWeek;// $dt = 0 ~ 6 星期天是 0


        $subone_one_hour = $current->subHours(1)->toDateTimeString();
        // Log::info($subone_one_hour);
        // Log::info($right_now);
        // Log::info($w);

        foreach($motc_list as $motc) {
            $station_name = $motc->station_name;
            $contact_name = $motc->contact_name;
            // $contact_email = $motc->contact_email;
            $contact_email = 'alice.chiu@faninsights.io';
            $sn            = $motc->sn;
            switch ($w) {
                case 0:
                    $start_time = Carbon::parse($motc->sun_open_hour)->timestamp;
                    $end_time = Carbon::parse($motc->sun_close_hour)->timestamp;
                break;
                case 1:
                    $start_time = Carbon::parse($motc->mon_open_hour)->timestamp;
                    $end_time = Carbon::parse($motc->mon_close_hour)->timestamp;
                break;
                case 2:
                    $start_time = Carbon::parse($motc->tue_open_hour)->timestamp;
                    $end_time = Carbon::parse($motc->tue_close_hour)->timestamp;
                break;
                case 3:
                    $start_time = Carbon::parse($motc->wed_open_hour)->timestamp;
                    $end_time = Carbon::parse($motc->wed_close_hour)->timestamp;
                break;
                case 4:
                    $start_time = Carbon::parse($motc->thu_open_hour)->timestamp;
                    $end_time = Carbon::parse($motc->thu_close_hour)->timestamp;
                break;
                case 5:
                    $start_time = Carbon::parse($motc->fri_open_hour)->timestamp;
                    $end_time = Carbon::parse($motc->fri_close_hour)->timestamp;
                break;
                case 6:
                    $start_time = Carbon::parse($motc->sat_open_hour)->timestamp;
                    $end_time = Carbon::parse($motc->sat_close_hour)->timestamp;
                break;
            }
            // Log::info($station_name);
            // Log::info($current2->timestamp);
            // Log::info($start_time);
            // Log::info($end_time);
            // Log::info('//');

            $current2 = Carbon::now('Asia/Taipei');
            if (($current2->timestamp >= $start_time) && ($current2->timestamp <= $end_time)){
                // Log::info('on');
                // Log::info($station_name);
                // exit;
                $params = array(
                    // 'role'      => 'customer',
                    'start_time'=> $subone_one_hour,
                    'end_time'  => $right_now ,
                    'service'   => $station_name,
                );
                $onlineUsers = $user_repository->getUserListByParams($params);
                if ($onlineUsers->isEmpty() ){
                    MotcOfflineHistory::create(
                        array(
                            'service' => $sn
                        )
                    );
                    // Log::info($station_name . 'no customer' . $right_now);
                    $data = [
                        'centerName' => $station_name,
                    ];
                    Mail::send('email.no_online_users', $data, function ($message) use ($contact_email, $station_name) {
                        $message->to($contact_email)
                                ->subject($station_name . '旅服中心目前沒有旅服人員上線，請立即確認')
                                ->setBody('您好，目前' . $station_name . '沒有客服人員在線上，請您確認該中心客服狀況。');
                    });
                }
            }
        }

        // foreach ($centers as $centerName => $center) {
        //     $startTime = date('Y-m-d') . ' ' . $center['start_time'];
        //     $endTime = date('Y-m-d') . ' ' . $center['end_time'];
        //     $adminEmail = $center['admin_email'];
        //     $role = $center['role'];
        //     $sn =  $center['sn'];

        //     $params = array(
        //         'role' => 'customer',
        //         'start_time'=>$current,
        //         'end_time'=>$right_now ,
        //         'service'=>$centerName,
        //     );
        //     $onlineUsers = $user_repository->getUserListByParams($params);
        //     Log::info($onlineUsers);
        //     exit;
        //     // Log::info(Carbon::now('Asia/Taipei'));
        //     // Log::info('---');
        //     // Log::info($now >= $startTime);
        //     // Log::info($now <= $endTime);
        //     // Log::info($onlineUsers->isEmpty());
        //     // Log::info('---');


        //     if ($onlineUsers->isEmpty() && ($now >=$startTime) && ($now <=$endTime)) {
        //         $data = [
        //             'centerName' => $centerName,
        //         ];
        //         MotcOfflineHistory::create(
        //             array(
        //                 'service' => $sn
        //             )
        //         );
        //         //Log::info($centerName . 'no customer' . $now);
        //         Mail::send('email.no_online_users', $data, function ($message) use ($adminEmail, $centerName) {
        //             $message->to($adminEmail)
        //                     ->subject($centerName . '旅服中心目前沒有旅服人員上線，請立即確認')
        //                     ->setBody('您好，目前' . $centerName . '沒有客服人員在線上，請您確認該中心客服狀況。');
        //         });

        //     }
        // }
    }

}
