<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Room;
use App\Repositories\FaqRepository;
use App\Repositories\MsgsampleRepository;
use App\Repositories\UserRepository;
use App\Repositories\RoomsRepository;
use App\Repositories\MotcStationRepository;

use denis660\Centrifugo\Centrifugo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class DashboardController extends Controller
{
    //private Centrifugo $centrifugo;
    protected $centrifugo;
    protected $user_repository;
    protected $msgsample_repository;
    protected $faq_repository;
    protected $rooms_repository;
    protected $motc_station_repository;

    public function __construct(User $user,
        Centrifugo $centrifugo,
        UserRepository $user_repository,
        MsgsampleRepository $msgsample_repository,
        FaqRepository $faq_repository,
        RoomsRepository $rooms_repository,
        MotcStationRepository $motc_station_repository
    )
    {
        //$this->user = $user;
        $this->user_repository = $user_repository;
        $this->msgsample_repository = $msgsample_repository;
        $this->faq_repository = $faq_repository;
        $this->rooms_repository = $rooms_repository;
        $this->motc_station_repository = $motc_station_repository;

        $this->centrifugo = $centrifugo;
    }

    public function index()
    {
        $rooms = 0;
        $limit = 10;
        $account_params = [];
        $rooms_wait_count = 0;
        $onlineCustomerCount = 0;
        $motc_params = [];

        // $user = Auth::user();
        // Log::info(json_encode($user));
        // Log::info(json_encode($user->isOnline()));
        $auth_id    = Auth::user()->id;
        $params_auth = array(
            'user_id' => $auth_id
        );

        $auth = $this->user_repository->getUserServiceRole($params_auth);
        $count_online_customer = $this->user_repository->getOnlineCustomer($auth['service'], $auth['role'], $limit , $account_params);

        if ($auth['role'] == 'admin99'){
            $err_url_count = $this->faq_repository->countUrlErr();
            $err_url_redirect = '/faq';
            $msg_date_count = DB::table('messages')
            ->leftJoin('rooms', 'messages.room_id', '=', 'rooms.id')
            ->leftJoin('motc_station', 'motc_station.sn', '=', 'rooms.service')
            ->select(DB::raw('COUNT(messages.id) AS NUM'), DB::raw("DATE_FORMAT(messages.created_at, '%Y-%m-%d') AS DAY"))
            // ->select('motc_station.sn', DB::raw('COUNT(messages.id) AS NUM'), DB::raw("DATE_FORMAT(messages.created_at, '%Y-%m-%d') AS DAY"))
            // ->groupBy('motc_station.sn', DB::raw("DATE_FORMAT(messages.created_at, '%Y-%m-%d')"))
            ->groupBy( DB::raw("DATE_FORMAT(messages.created_at, '%Y-%m-%d')"))
            //->orderBy('motc_station.sn')
            ->orderBy(DB::raw("DATE_FORMAT(messages.created_at, '%Y-%m-%d')"), 'desc')
            ->get();
        } else {
            $err_url_count = $this->msgsample_repository->countUrlErr();
            $err_url_redirect = '/msgsample';
            $motc_params = array(
                'station_name' => $auth['service']
            );

        }

        $motc_station = $this->motc_station_repository->motcStationList($motc_params);
        foreach ($motc_station as $motc) {
            $sn[] = $motc['sn'];
        }
        $room_params['status'] = [2,7];
        $rooms_wait_count = $this->rooms_repository->getAllMsgListByServiceRoleCount($sn,$auth['role'],$limit, $room_params);

        If ( $auth['role'] !='admin99') {
            $msg_date_count = DB::table('messages')
            ->leftJoin('rooms', 'messages.room_id', '=', 'rooms.id')
            ->leftJoin('motc_station', 'motc_station.sn', '=', 'rooms.service')
            // ->select('motc_station.sn', DB::raw('COUNT(messages.id) AS NUM'), DB::raw("DATE_FORMAT(messages.created_at, '%Y-%m-%d') AS DAY"))
            ->select( DB::raw('COUNT(messages.id) AS NUM'), DB::raw("DATE_FORMAT(messages.created_at, '%Y-%m-%d') AS DAY"))
            ->whereIn('motc_station.sn', $sn)
            // ->groupBy('motc_station.sn', DB::raw("DATE_FORMAT(messages.created_at, '%Y-%m-%d')"))
            ->groupBy(DB::raw("DATE_FORMAT(messages.created_at, '%Y-%m-%d')"))
            //->orderBy('motc_station.sn')
            ->orderBy(DB::raw("DATE_FORMAT(messages.created_at, '%Y-%m-%d')"), 'desc')
            ->get();
        }

        return view('dashboard.index', [
            'rooms' => $rooms,
            'errUrlCount' => $err_url_count,
            'errUrlRedirect' => $err_url_redirect,
            'onlineCustomerCount' => $count_online_customer,
            'waitCount' => $rooms_wait_count,
            'msgDayCount' => json_encode($msg_date_count)
        ]);
    }

}
