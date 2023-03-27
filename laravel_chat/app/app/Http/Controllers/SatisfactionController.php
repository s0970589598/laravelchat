<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use App\Models\SatisfactionSurvey;
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


    public function index()
    {
        $rooms = 0;
        $limit = 10;
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

        // foreach ($motc_station as $motc) {
        //     $sn[] = $motc['sn'];
        // }

        // if ($auth['role'] == 'admin99'){
        //     $survey = SatisfactionSurvey::select('satisfaction_survey.id', 'point', 'memo', 'motc_station.station_name', 'satisfaction_survey.created_at')
        //     ->leftJoin('motc_station', 'satisfaction_survey.service', '=', 'motc_station.sn')
        //     ->get();
        // } else {
        //     $survey = SatisfactionSurvey::select('satisfaction_survey.id', 'point', 'memo', 'motc_station.station_name', 'satisfaction_survey.created_at')
        //     ->leftJoin('motc_station', 'satisfaction_survey.service', '=', 'motc_station.sn')
        //     ->whereIn('motc_station.sn',$sn)
        //     ->get();
        // }



        return view('satisfaction.index', [
            'rooms' => $rooms,
            'users' => $users,
            'motc_station' => $motc_station,
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
