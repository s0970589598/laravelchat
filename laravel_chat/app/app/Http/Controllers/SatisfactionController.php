<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use App\Models\SatisfactionSurvey;
use App\Models\MotcOfflineHistory;
use App\Models\CustomerServiceRelationRole;
use App\Repositories\MotcStationRepository;
use App\Repositories\UserRepository;


use denis660\Centrifugo\Centrifugo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Throwable;

class SatisfactionController extends Controller
{
    //private Centrifugo $centrifugo;
    protected $centrifugo;
    protected $motc_station_repository;
    protected $user_repository;

    public function __construct(Centrifugo $centrifugo,
     MotcStationRepository $motc_station_repository,
     UserRepository $user_repository
     )
    {
        $this->centrifugo              = $centrifugo;
        $this->motc_station_repository = $motc_station_repository;
        $this->user_repository         = $user_repository;
    }

    public function storeSatisfaction(Request $request)
    {
        $status = Response::HTTP_OK;
        $satifaction = 0;
        $params = $request->validate([
             'room_id'  => ['required'],
             'service'  => ['required'],
             'point'    => ['required'],
             'memo'     => ['required'],
         ]);

        DB::beginTransaction();

        try {
            $satifaction = SatisfactionSurvey::create([
                'room_id'  =>  $params['room_id'],
                'service'  =>  $params['service'],
                'point'    =>  $params['point'],
                'memo'     =>  $params['memo'],
            ]);
            $rs = array(
                'msg'=>'success',
                'data'=> $satifaction,
            );
            DB::commit();
        } catch (Throwable $e) {
            $rs = array(
                'msg'=>'fail',
            );
            DB::rollBack();
            Log::error($e->getMessage());
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        }
        // event(new Registered($user));

        return response(json_encode($rs), $status);
    }


    public function index(Request $request)
    {
        $rooms = 0;
        $limit = 10;
        $satisfaction_params = [];
        $replyrate = [];
        $waitedrate = [];
        $satisfaction_list = [];
        $wait_array = [];
        $waited_array = [];
        $ing_array = [];
        $complete_array = [];

        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        $users = User::orderBy('users.id', 'desc')
        ->where('status','0')
        ->leftJoin('customer_service_relation_role', 'users.id', '=', 'customer_service_relation_role.user_id')
        ->paginate($limit);

        $auth_id    = Auth::user()->id;
        $params_auth = array(
            'user_id' => $auth_id
        );
        $auth = $this->user_repository->getUserServiceRole($params_auth);

        if ($auth['role'] == 'admin99'){
            $motc_params = array();
        } else {
            $motc_params = array(
                'station_name' => $auth['service']
            );
        }
        $motc_station = $this->motc_station_repository->motcStationList($motc_params);

        foreach ($motc_station as $motc) {
            $sn[] = $motc['sn'];
        }

        // 平均回覆時間 以日為單位   回覆時間 = room狀態為進入待客服後，轉為客服中經過的時間平均回覆時間=回覆時間累計/room數量
        // 未成單率 (未處理客服/呼叫人工客服數) * 100

        // 以日為單位 tablelist 區域	呼叫人工客服人次	人工客服完成人次	未成單率	平均回覆時間	客服上線率(8/8)*100%)
        // 每個小時檢測各中心是否有人員在線上，若有中心一天被檢測到一次沒人在線，在線率=(7/8)*100%


        if (isset($request->start_time)){
            $satisfaction_params['start_time'] = $request->start_time;
        }
        if (isset($request->end_time)){
            $satisfaction_params['end_time'] = $request->end_time;
        }


        // 每日未成單率
        // 未處理
        $everyday_wait = Room::select(DB::raw("DATE_FORMAT(rooms.created_at, '%Y-%m-%d') as rooms_created_at"), DB::raw('count(id) as count_wait'))
        ->where('status', 2)
        ->whereIn('service', $sn)
        ->groupBy(DB::raw("DATE_FORMAT(rooms.created_at, '%Y-%m-%d')"))
        ->orderBy('rooms_created_at', 'asc')
        ->get();

        // 客服中
        $everyday_ing  = Room::select(DB::raw("DATE_FORMAT(rooms.created_at, '%Y-%m-%d') as rooms_created_at"), DB::raw('count(id) as count_wait'))
        ->where('status', 3)
        ->whereIn('service', $sn)
        ->groupBy(DB::raw("DATE_FORMAT(rooms.created_at, '%Y-%m-%d')"))
        ->orderBy('rooms_created_at', 'asc')
        ->get();

        // 已完成
        $everyday_complete = Room::select(DB::raw("DATE_FORMAT(rooms.created_at, '%Y-%m-%d') as rooms_created_at"), DB::raw('count(id) as count_complete'))
        ->where('status', 6)
        ->whereIn('service', $sn)
        ->groupBy(DB::raw("DATE_FORMAT(rooms.created_at, '%Y-%m-%d')"))
        ->orderBy('rooms_created_at', 'asc')
        ->get();
        // Log::info($sn);

         // 曾經待客服狀態，包含待客服的
         $everyday_waited  = Room::select(DB::raw("DATE_FORMAT(rooms.created_at, '%Y-%m-%d') as rooms_created_at"), DB::raw('count(id) as count_wait'))
         ->where('status', '<>', 1)
         ->whereIn('service', $sn)
         ->groupBy(DB::raw("DATE_FORMAT(rooms.created_at, '%Y-%m-%d')"))
         ->orderBy('rooms_created_at', 'asc')
         ->get();
        // Log::info($everyday_waited);

        foreach ($everyday_wait as $wait) {
            $wait_array[$wait['rooms_created_at']]['rooms_created_at'] = $wait['rooms_created_at'];
            $wait_array[$wait['rooms_created_at']]['count_wait'] = $wait['count_wait'];
        }
        foreach ($everyday_waited as $wait) {
            $waited_array[$wait['rooms_created_at']]['rooms_created_at'] = $wait['rooms_created_at'];
            $waited_array[$wait['rooms_created_at']]['count_wait'] = $wait['count_wait'];
        }

        foreach($everyday_ing as $ing){
            $ing_array[$ing['rooms_created_at']]['rooms_created_at'] = $ing['rooms_created_at'];
            $ing_array[$ing['rooms_created_at']]['count_wait'] = $ing['count_wait'];
        }
        foreach($everyday_complete as $complete){
            $complete_array[$complete['rooms_created_at']]['rooms_created_at'] = $complete['rooms_created_at'];
            $complete_array[$complete['rooms_created_at']]['count_complete'] = $complete['count_complete'];
        }
        $keys = 0;
        // foreach ($wait_array as $key => $wait) {

        //     if(isset($ing_array[$key]['count_wait'])) {
        //         $all = $wait_array[$key]['count_wait'] + $ing_array[$key]['count_wait'];
        //         $waitedrate[$keys]['DAY'] = $key;
        //         $waitedrate[$keys]['NUM'] = ($wait_array[$key]['count_wait'] / $all) * 100;
        //         $keys++;
        //    }
        // }
        foreach ($waited_array as $key => $waited) {
                $nocomplete = $waited['count_wait'] - $complete_array[$key]['count_complete'];
            // if(isset($ing_array[$key]['count_wait'])) {
                // $all = $waited['count_wait'] + $ing_array[$key]['count_wait'];
                $waitedrate[$keys]['DAY'] = $key;
                $waitedrate[$keys]['NUM'] = ($nocomplete/ $waited['count_wait']) * 100;
                $keys++;
           // }
        }

         // 回覆時間
         $avg_replytime = Room::selectRaw("DATE_FORMAT(rooms.created_at, '%Y-%m-%d') as rooms_created_at , (sum(wait_end) - sum(wait_start)) as diffsec")
         ->where('wait_start', '!=', '')
         ->where('wait_end', '!=', '')
         ->whereIn('service', $sn)
         // ->groupBy('service')
         ->groupBy(DB::raw("DATE_FORMAT(rooms.created_at, '%Y-%m-%d')"))
         ->havingRaw('sum(wait_end) - sum(wait_start) != ""')
         //->orderBy('service', 'asc')
         ->get();

         $keys = 0;
         foreach($avg_replytime as  $replytime) {
             if (isset($waited_array[$replytime['rooms_created_at']])){
                $replyrate[$keys]['DAY'] = $replytime['rooms_created_at'];
                $replyrate[$keys]['NUM'] = ($replytime['diffsec']/$waited_array[$replytime['rooms_created_at']]['count_wait']) *100;
                $keys ++;
            }
         }


        // talbe
        if (isset($request->sn)){
            $satisfaction_params['sn'] = $request->sn;
            unset($sn);
            $sn[] = $satisfaction_params['sn'];
        }
        // 待處理的客服
        // ->when(isset($account_params['name']), function ($query) use ($account_params) {
        //     $query->where('name','LIKE', '%' .$account_params['name']. '%');
        // })
        // ->when(isset($account_params['manager_group_sn']), function ($query) use ($account_params) {
        //   $query->where('service', 'LIKE', '%' . $account_params['manager_group_sn'] . '%');
        // })

        $wait = Room::select('service', DB::raw('count(id) as count_ing'))
        ->where('status', 2)
        ->whereIn('service', $sn)
        ->when(isset($satisfaction_params['start_time']), function ($query) use ($satisfaction_params) {
            $query->whereBetween('created_at', [$satisfaction_params['start_time'] . ' 00:00:00', $satisfaction_params['end_time'] . ' 23:59:59']);
        })
        ->groupBy('service')
        ->orderBy('service', 'asc')
        ->get();

        // 處理中的客服
        $ing = Room::select('service', DB::raw('count(id) as count_ing'))
        ->where('status', 3)
        ->whereIn('service', $sn)
        ->when(isset($satisfaction_params['start_time']), function ($query) use ($satisfaction_params) {
            $query->whereBetween('created_at', [$satisfaction_params['start_time'] . ' 00:00:00', $satisfaction_params['end_time'] . ' 23:59:59']);
        })
        ->groupBy('service')
        ->orderBy('service', 'asc')
        ->get();

        // 已完成的客服
        $complete = Room::select('service', DB::raw('count(id) as count_ing'))
        ->where('status', 6)
        ->whereIn('service', $sn)
        ->when(isset($satisfaction_params['start_time']), function ($query) use ($satisfaction_params) {
            $query->whereBetween('created_at', [$satisfaction_params['start_time'] . ' 00:00:00', $satisfaction_params['end_time'] . ' 23:59:59']);
        })
        ->groupBy('service')
        ->orderBy('service', 'asc')
        ->get();

        // 曾經客服
        $customered = Room::select('service','station_name', DB::raw('count(id) as count_ing'))
        ->leftJoin('motc_station', 'motc_station.sn', '=', 'rooms.service')
        ->where('rooms.status', '<>' , 1)
        ->whereIn('service', $sn)
        ->when(isset($satisfaction_params['start_time']), function ($query) use ($satisfaction_params) {
            $query->whereBetween('created_at', [$satisfaction_params['start_time'] . ' 00:00:00', $satisfaction_params['end_time'] . ' 23:59:59']);
        })
        ->groupBy('service','station_name')
        ->orderBy('service', 'asc')
        ->get();


         // 回覆時間
        $satisfaction_reply = Room::selectRaw('service, (sum(wait_end) - sum(wait_start)) as diffsec')
        ->where('wait_start', '!=', '')
        ->where('wait_end', '!=', '')
        ->whereIn('service', $sn)
        ->when(isset($satisfaction_params['start_time']), function ($query) use ($satisfaction_params) {
            $query->whereBetween('created_at', [$satisfaction_params['start_time'] . ' 00:00:00', $satisfaction_params['end_time'] . ' 23:59:59']);
        })
        ->groupBy('service')
        ->havingRaw('sum(wait_end) - sum(wait_start) != ""')
        ->orderBy('service', 'asc')
        ->get();

        $motc_offline_history = MotcOfflineHistory::select('service',DB::raw('count(id) as count_ing'))
        ->when(isset($satisfaction_params['start_time']), function ($query) use ($satisfaction_params) {
            $query->whereBetween('created_at', [$satisfaction_params['start_time'] . ' 00:00:00', $satisfaction_params['end_time'] . ' 23:59:59']);
        })
        ->whereIn('service', $sn)
        ->groupBy('service')
        ->get();

        $offlineHistoryDates = MotcOfflineHistory::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
        ->count();


         foreach($wait as $wa){
            $wait_arr[$wa['service']]['count_ing'] = $wa['count_ing'];
         }
         foreach($complete as $com){
            $com_arr[$com['service']]['count_ing'] = $com['count_ing'];
         }
         foreach($satisfaction_reply as $sat){
            $satisfaction_reply_arr[$sat['service']]['diffsec'] = $sat['diffsec'];
         }
         foreach($motc_offline_history as $motc_off) {
            $motc_off_arr[$motc_off['service']]['count_ing'] = $motc_off['count_ing'];
         }

         //Log::info($com_arr);
         foreach($customered as $cu) {
            $satisfaction_list[$cu['service']]['service'] = $cu['station_name'];
            $satisfaction_list[$cu['service']]['callcustomer'] = $cu['count_ing'];

            $satisfaction_list[$cu['service']]['complete'] = isset($com_arr[$cu['service']]) ? $com_arr[$cu['service']]['count_ing'] : 0;
            $satisfaction_list[$cu['service']]['nocomplete'] = $cu['count_ing'] - $satisfaction_list[$cu['service']]['complete'];
            // $satisfaction_list[$cu['service']]['waitedrate'] = (isset($wait_arr[$cu['service']]['count_ing'])) ? round(($wait_arr[$cu['service']]['count_ing']/$cu['count_ing'])*100 , 2) : 0 ;
            $satisfaction_list[$cu['service']]['waitedrate'] = round(($satisfaction_list[$cu['service']]['nocomplete']/$cu['count_ing'])*100 , 2);


            $satisfaction_list[$cu['service']]['replyrate'] = isset($satisfaction_reply_arr[$cu['service']]['diffsec']) ? round(($satisfaction_reply_arr[$cu['service']]['diffsec']/ $cu['count_ing'])*100,2) : 0 ;
            $satisfaction_list[$cu['service']]['onlinerate'] = isset($motc_off_arr[$cu['service']]['count_ing']) ? round((((8 * $offlineHistoryDates)-$motc_off_arr[$cu['service']]['count_ing'])/ (8 * $offlineHistoryDates) )*100,2) : 100 ;
         }


         return view('satisfaction.index', [
            'rooms' => $rooms,
            'users' => $users,
            'motc_station' => $motc_station,
            'waitedrate' => json_encode($waitedrate),
            'replyrate' => json_encode($replyrate),
            'satisfactionList' => $satisfaction_list,
        ]);
    }

    public function manage(Request $request)
    {
        $rooms = 0;
        // $rooms = Room::with(['users', 'messages' => function ($query) {
        //     $query->orderBy('created_at', 'asc');
        // }])->orderBy('created_at', 'desc')->get();
        $rooms = 0;
        //$email_sample = EmailSample::get();
        $limit = 10;
        $satisfaction_params = [];

        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        if (isset($request->start_time)){
            $satisfaction_params['start_time'] = $request->start_time;
        }
        if (isset($request->end_time)){
            $satisfaction_params['end_time'] = $request->end_time;
        }
        if (isset($request->sn)){
            $satisfaction_params['sn'] = $request->sn;
        }
        if (isset($request->status)){
            $satisfaction_params['status'] = $request->status;
        }
        if (isset($request->point)){
            $satisfaction_params['point'] = $request->point;
        }

        Log::info($satisfaction_params);
        $auth_id    = Auth::user()->id;
        $params_auth = array(
            'user_id' => $auth_id
        );
        $auth = $this->user_repository->getUserServiceRole($params_auth);

        if ($auth['role'] == 'admin99'){
            $motc_params = array();
        } else {
            $motc_params = array(
                'station_name' => $auth['service']
            );
        }
        $motc_station = $this->motc_station_repository->motcStationList($motc_params);

        foreach ($motc_station as $motc) {
            $sn[] = $motc['sn'];
        }

        if ($auth['role'] == 'admin99'){
            $survey = SatisfactionSurvey::select('satisfaction_survey.id', 'point', 'memo', 'motc_station.station_name', 'satisfaction_survey.created_at')
            ->leftJoin('motc_station', 'satisfaction_survey.service', '=', 'motc_station.sn')
            ->when(isset($satisfaction_params['start_time']), function ($query) use ($satisfaction_params) {
                $query->where('created_at', '>=',$satisfaction_params['start_time'] . ' 00:00:00');
            })
            ->when(isset($satisfaction_params['end_time']), function ($query) use ($satisfaction_params) {
                $query->where('created_at', '<=', $satisfaction_params['end_time'] . ' 23:59:59');
            })
            ->when(isset($satisfaction_params['sn']), function ($query) use ($satisfaction_params) {
                $query->where('service', $satisfaction_params['sn']);
            })
            ->when(isset($satisfaction_params['status']), function ($query) use ($satisfaction_params) {
                $query->where('status', $satisfaction_params['status']);
            })
            ->when(isset($satisfaction_params['point']), function ($query) use ($satisfaction_params) {
                $query->where('point', $satisfaction_params['point']);
            })
            ->paginate($limit);

            $countsurvey = SatisfactionSurvey::select('satisfaction_survey.id', 'point', 'memo', 'motc_station.station_name', 'satisfaction_survey.created_at')
            ->leftJoin('motc_station', 'satisfaction_survey.service', '=', 'motc_station.sn')
            ->count();

            $avg_points = SatisfactionSurvey::selectRaw('ROUND(AVG(point), 2) AS avg_point')
            ->leftJoin('motc_station', 'satisfaction_survey.service', '=', 'motc_station.sn')
            ->groupBy('motc_station.sn')
            ->get();


        } else {
            $survey = SatisfactionSurvey::select('satisfaction_survey.id', 'point', 'memo', 'motc_station.station_name', 'satisfaction_survey.created_at')
            ->leftJoin('motc_station', 'satisfaction_survey.service', '=', 'motc_station.sn')
            ->whereIn('motc_station.sn',$sn)
            ->when(isset($satisfaction_params['start_time']), function ($query) use ($satisfaction_params) {
                $query->where('created_at', '>=',$satisfaction_params['start_time'] . ' 00:00:00');
            })
            ->when(isset($satisfaction_params['end_time']), function ($query) use ($satisfaction_params) {
                $query->where('created_at', '<=', $satisfaction_params['end_time'] . ' 23:59:59');
            })
            ->when(isset($satisfaction_params['sn']), function ($query) use ($satisfaction_params) {
                $query->where('service', $satisfaction_params['sn']);
            })
            ->when(isset($satisfaction_params['status']), function ($query) use ($satisfaction_params) {
                $query->where('status', $satisfaction_params['status']);
            })
            ->when(isset($satisfaction_params['point']), function ($query) use ($satisfaction_params) {
                $query->where('point', $satisfaction_params['point']);
            })
            ->paginate($limit);

            $countsurvey = SatisfactionSurvey::select('satisfaction_survey.id', 'point', 'memo', 'motc_station.station_name', 'satisfaction_survey.created_at')
            ->leftJoin('motc_station', 'satisfaction_survey.service', '=', 'motc_station.sn')
            ->whereIn('motc_station.sn',$sn)
            ->count();
            $avg_points = SatisfactionSurvey::selectRaw('ROUND(AVG(point), 2) AS avg_point')
            ->leftJoin('motc_station', 'satisfaction_survey.service', '=', 'motc_station.sn')
            ->whereIn('motc_station.sn',$sn)
            ->groupBy('motc_station.sn')
            ->get();

        }



        $users = User::orderBy('users.id', 'desc')
        ->where('status','0')
        ->leftJoin('customer_service_relation_role', 'users.id', '=', 'customer_service_relation_role.user_id')
        ->paginate($limit);


        return view('satisfaction.manage', [
            'rooms' => $rooms,
            'users' => $users,
            'motc_station' => $motc_station,
            'survey' => $survey,
            'countsurvey' => $countsurvey,
            'avgPoints' => $avg_points
        ]);
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
