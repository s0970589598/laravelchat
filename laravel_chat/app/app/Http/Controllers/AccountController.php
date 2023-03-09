<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use App\Models\CustomerServiceRelationRole;
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


class AccountController extends Controller
{
    //private Centrifugo $centrifugo;
    protected $centrifugo;
    public function __construct(Centrifugo $centrifugo)
    {
        $this->centrifugo = $centrifugo;
    }

    public function index()
    {
        $rooms = 0;
        $limit = 10;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        $users = User::orderBy('users.id', 'desc')
        ->leftJoin('customer_service_relation_role', 'users.id', '=', 'customer_service_relation_role.user_id')
        ->where('status','0')
        ->paginate($limit);

        return view('account.index', [
            'rooms' => $rooms,
            'users' => $users,
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
            $status = Password::sendResetLink(
                $request->only('email')
            );
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
        Log::info($params);

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
