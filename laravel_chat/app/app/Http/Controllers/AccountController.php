<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
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
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;


class AccountController extends Controller
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

    public function index(Request $request)
    {
        $rooms = 0;
        $limit = 10;
        $account_params = [];

        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }

        if (isset($request->user_name_keyword)){
            $account_params['name'] = $request->user_name_keyword;
        }

        if (isset($request->manager_group_sn)){
            $account_params['manager_group_sn'] = $request->manager_group_sn;
        }

        //Log::info($account_params);


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
        $users        = $this->user_repository->getAllUserListByServiceRole($auth['service'], $auth['role'], $limit , $account_params);

        return view('account.index', [
            'rooms'        => $rooms,
            'users'        => $users,
            'motc_station' => $motc_station,
            'auth_service_role' => $auth
        ]);
    }

    public function show(int $id)
    {
        $rooms = Room::with('users')->orderBy('created_at', 'desc')->get();
        $room  = Room::with(['users', 'messages.user' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->find($id);

        return view('rooms.index', [
            'rooms'    => $rooms,
            'currRoom' => $room,
            'isJoin'   => $room->users->contains('id', Auth::user()->id),
        ]);
    }

    public function join(int $id)
    {
        $room = Room::find($id);
        $room->users()->attach(Auth::user()->id);

        return redirect()->route('rooms.show', $id);
    }

    public function store(Request $request)
    {
        $params = $request->validate([
             'email' => ['required'],
             'service' => ['required'],
             'role' => ['required'],
         ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name'  =>  $params['email'],
                'email' =>  $params['email'],
                'password' => Hash::make('test123'),
                'authcode' => $this->generateRandomString(5),
            ]);

            $service_relation_role = CustomerServiceRelationRole::create([
                'user_id'  => $user->id,
                'service' =>json_encode($params['service'],JSON_UNESCAPED_UNICODE),
                'role' => $params['role'],
            ]);

            $param = array(
                'email'   => $request->email,
                'service' => $request->service,
                'role' => $request->role,
            );
            Cache::put($request->email, 'true');
            Cookie::queue('em',$request->email,36000);
            Log::info('2'. Cache::get($request->email));
            $status = Password::sendResetLink(
                $request->only('email')
            );
            Log::info('3'. Cache::get($request->email));


            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('account.index');
    }

    public function update(Request $request)
    {
        CustomerServiceRelationRole::where('user_id', $request['id'])
            ->update([
                'service'  => json_encode($request['service'], JSON_UNESCAPED_UNICODE),
                'role'     => $request['role'],
            ]);
        return redirect()->route('account.index');
    }

    public function updateUserContact(string $authcode, Request $request)
    {

        $status = Response::HTTP_OK;
        $params = $request->json()->all();

        DB::beginTransaction();
        $userupdate = array(
            'msg'=>'fail'
        );

        try {
            $user = User::where('authcode', $authcode)
            ->update($params);

            DB::commit();

            $userupdate = array(
                'msg' =>'success',
                'data' => $this->getUserByAuthcode($authcode)
            );
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response(json_encode($userupdate), $status);
    }

    public function getUserByAuthcode(string $authcode){
        return User::where('authcode', $authcode)->get();

    }

    public function upstatus(request $request)
    {
        $user = User::find($request['id'])
            ->update([
                'status'     => 1,
        ]);

        return redirect()->route('account.index');

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
