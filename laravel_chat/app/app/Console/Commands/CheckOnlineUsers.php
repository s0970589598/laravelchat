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
use Illuminate\Support\Facades\DB;

class CheckOnlineUsers extends Command
{
    // protected $name = 'command:checkonlineusers';

    protected $signature = 'check-online-users';

    protected $description = 'Check if there are online users during working hours and send email to the admin if no one is online';

// 2.請於登入紀錄資料表內(待Allen建立)，確認未上線中心的帳號是否皆為登出，判定登出條件如下：
// 2-1.帳號登入次數與登出次數相同，即為下線。
// 2-2.帳號登入次數大於登出次數，即為上線中。
// 每次登入、不同device登入都會有一筆資料，關閉網頁、登出、閒置機制時會寫入登出紀錄。

    public function handle(UserRepository $user_repository,MotcStationRepository $motc_station_repository)
    {
        $motc_list = $motc_station_repository->motcStationList([]);

        $current = Carbon::now('Asia/Taipei');
        $current3 = Carbon::now('Asia/Taipei');
        $right_now = $current->toDateTimeString();
        $right_now_date = $current3->toDateString();
        $w = $current->dayOfWeek;// $dt = 0 ~ 6 星期天是 0
        $user_logs = [];
        $l = [];

        $subone_one_hour = $current->subHours(1)->toDateTimeString();
        // Log::info($subone_one_hour);
        // Log::info($right_now);
        // Log::info($w);

        $user_logs = DB::table('user_logs')
        ->select('user_id', DB::raw('count(user_logs.id) as countlogs'), 'action_type', DB::raw("DATE_FORMAT(user_logs.created_at, '%Y-%m-%d') as data_date"))
        ->join('users', 'user_logs.user_id', '=', 'users.id')
        ->where(DB::raw("DATE_FORMAT(user_logs.created_at, '%Y-%m-%d')"), '=', $right_now_date)
        ->groupBy('user_id', 'action_type', DB::raw("DATE_FORMAT(user_logs.created_at, '%Y-%m-%d')"))
        ->orderBy('user_id', 'ASC')
        ->get();


        foreach($user_logs as $logs) {
            $l[$logs->user_id]['user_id'] = $logs->user_id;
            $l[$logs->user_id][$logs->action_type]['countlogs']  = $logs->countlogs;
        }

        foreach($motc_list as $motc) {
            $station_name = $motc->station_name;
            $sn            = $motc->sn;

            $contact = DB::table('customer_service_relation_role')
            ->select('users.email', 'users.name', 'customer_service_relation_role.role')
            ->leftJoin('users','users.id','=','customer_service_relation_role.user_id')
            ->where(function ($query) {
                $query->where('role', '=', 'admin99')
                      ->orWhere('role', '=', 'admin');
            })
            ->where('service', 'like',  '%' . $station_name . '%')
            ->orderByDesc('customer_service_relation_role.id')
            ->get();

            $motc_user = DB::table('customer_service_relation_role')
            ->select('users.email','customer_service_relation_role.user_id', 'users.name', 'customer_service_relation_role.role')
            ->leftJoin('users','users.id','=','customer_service_relation_role.user_id')
            ->where('service', 'like',  '%' . $station_name . '%')
            ->where(function ($query) {
                $query->where('role', '<>', 'user');
            })
            ->orderByDesc('customer_service_relation_role.id')
            ->get();

            $motc_all_users = count($motc_user);
            //$motc_users = $motc_all_users;
            // Log::info($sn . '/' .$motc_all_users );
            $check_users_log =[];
            // 2-1.帳號登入次數與登出次數相同，即為下線。
            // 2-2.帳號登入次數大於登出次數，即為上線中。
            foreach ($motc_user as $mu) {
                $login_count = isset($l[$mu->user_id]['login']['countlogs']) ?$l[$mu->user_id]['login']['countlogs'] : 0;
                $logout_count = isset($l[$mu->user_id]['logout']['countlogs']) ?$l[$mu->user_id]['logout']['countlogs'] : 0;

                if ($login_count <= $logout_count ){
                    $motc_all_users -= 1;
                }

                if ($motc_all_users == 0) {
                    // Log::info($sn . 'offline');
                    $check_users_log[$sn] = 'offline';
                } else {
                    $check_users_log[$sn] = 'on';
                }
            }

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
                if ($onlineUsers->isEmpty() || $check_users_log[$sn] == 'offline'){
                    MotcOfflineHistory::create(
                        array(
                            'service' => $sn
                        )
                    );
                    // Log::info($station_name . 'no customer' . $right_now);
                    // Log::info($station_name);

                    foreach($contact as $con){
                        // Log::info($con->name);
                        // Log::info($con->email);
                        // Log::info($con->role);
                        $data = [
                            'centerName' => $station_name,
                            'userName' => $con->name
                        ];
                        $contact_email = $con->email;

                        if ($contact_email =='mandy@faninsights.io'){
                            Mail::send('email.no_online_users', $data, function ($message) use ($contact_email, $station_name) {
                                $message->to($contact_email)
                                        ->subject($station_name . '旅服中心目前沒有旅服人員上線，請立即確認')
                                        ->setBody('您好，目前' . $station_name . '沒有客服人員在線上，請您確認該中心客服狀況。');
                            });
                        }


                    }
                    // Log::info('.....');

                }
            }
        }

    }

}
