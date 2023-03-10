<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use App\Models\SatisfactionSurvey;
use App\Models\CustomerServiceRelationRole;
use App\Repositories\MotcStationRepository;

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

    public function __construct(Centrifugo $centrifugo, MotcStationRepository $motc_station_repository)
    {
        $this->centrifugo = $centrifugo;
        $this->motc_station_repository = $motc_station_repository;
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
        $motc_station = $this->motc_station_repository->motcStationList();

        return view('satisfaction.index', [
            'rooms' => $rooms,
            'users' => $users,
            'motc_station' => $motc_station
        ]);
    }

    public function manage()
    {
        $rooms = 0;
        // $rooms = Room::with(['users', 'messages' => function ($query) {
        //     $query->orderBy('created_at', 'asc');
        // }])->orderBy('created_at', 'desc')->get();
        $rooms = 0;
        //$email_sample = EmailSample::get();
        $limit = 10;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        //$email_sample = DB::table('email_sample');
        $motc_station = $this->motc_station_repository->motcStationList();

        $users = User::orderBy('users.id', 'desc')
        ->where('status','0')
        ->leftJoin('customer_service_relation_role', 'users.id', '=', 'customer_service_relation_role.user_id')
        ->paginate($limit);


        return view('satisfaction.manage', [
            'rooms' => $rooms,
            'users' => $users,
            'motc_station' => $motc_station
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
