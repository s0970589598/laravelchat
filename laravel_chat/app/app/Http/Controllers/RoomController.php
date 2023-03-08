<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use App\Models\CustomerServiceRelationRole;

use denis660\Centrifugo\Centrifugo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use Throwable;

class RoomController extends Controller
{
    private Centrifugo $centrifugo;

    public function __construct(Centrifugo $centrifugo)
    {
        $this->centrifugo = $centrifugo;
    }

    public function index()
    {
        $rooms = Room::with(['users', 'messages' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->orderBy('created_at', 'desc')->get();

        return view('rooms.index', [
            'rooms' => $rooms,
        ]);
    }

    public function show(int $id)
    {
        $rooms = Room::with('users')->orderBy('created_at', 'desc')->get();
        $room = Room::with(['users', 'messages.user' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->find($id);

        return view('rooms.index', [
            'rooms' => $rooms,
            'currRoom' => $room,
            'isJoin' => $room->users->contains('id', Auth::user()->id),
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
        $request->validate([
            'name' => ['required', 'string', 'max:32', 'unique:rooms'],
        ]);

        DB::beginTransaction();
        try {
            $room = Room::create([
                'name' => $request->get('name'),
                'status' => 0,
                'service' => '未分類',
                'code' => $this->generateRandomString(5),
            ]);
            $room->users()->attach(Auth::user()->id);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('rooms.show', $room->id);
    }

    public function publish(int $id, Request $request)
    {
        $requestData = $request->json()->all();
        $status = Response::HTTP_OK;

        try {
            $message = Message::create([
                'sender_id' => Auth::user()->id,
                'message' => $requestData["message"],
                'room_id' => $id,
            ]);

            $room = Room::with('users')->find($id);

            $channels = [];
            foreach ($room->users as $user) {
                $channels[] = "personal:#" . $user->id;
            }

            $this->centrifugo->broadcast($channels, [
                "text" => $message->message,
                "createdAt" => $message->created_at->toDateTimeString(),
                "createdAtFormatted" => $message->created_at->toFormattedDateString() . ", " . $message->created_at->toTimeString(),
                "roomId" => $id,
                "senderId" => Auth::user()->id,
                "senderName" => Auth::user()->name,
            ]);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response('', $status);
    }

    public function addRooms(Request $request){
        $status = Response::HTTP_OK;
        $res = 'success';

        $params = $request->validate([
            'session_id'   => ['required'],
            'service'      => ['required'],
        ]);

       DB::beginTransaction();
       try {

           $user = User::where('email',$params['session_id'] . '@motc.go')->get();
            if ( count($user) == 0 ) {
                $user = User::create([
                'name'     =>  $params['session_id'],
                'email'    =>  $params['session_id'] . '@motc.go',
                'password' =>  Hash::make('test123'),
                'authcode' =>  $params['session_id'],
                ]);
                $user_id  = $user->id;
                $authcode = $user->authcode;
                $user_name = $user->name;

                $service_relation_role = CustomerServiceRelationRole::create([
                    'user_id'  => $user_id ,
                    'service'  => $params['service'],
                    'role'     => 'user',
                ]);

            } else {
                $user_id = $user[0]->id;
                $authcode = $user[0]->authcode;
            }

           $room = Room::create([
            'name'    => $this->generateRandomString(5),
            'status'  => '1',
            'service' => $params['service'],
            'code'    => $this->generateRandomString(5),
           ]);

           $room->users()->attach($user_id);
           $res = array(
            'msg'              => 'success',
            'data' => array(
                'room_id'          => $room->id,
                'room_name'        => $room->name,
                'room_service'     => $room->service,
                'room_status'      => $room->status,
                'room_code'        => $room->code,
                'user_authcode'    => $authcode,
                'user_id'          => $user_id,
                'user_name'        => $user_name,
            ),
        );

           DB::commit();
       } catch (Throwable $e) {
           DB::rollBack();
           Log::error($e->getMessage());
           $status = Response::HTTP_INTERNAL_SERVER_ERROR;
           $res = array(
            'msg'        => 'fail',
           );
       }
       return response(json_encode($res), $status);
    }

    public function updateRoomsStatus(Request $request) {
        $status = Response::HTTP_OK;
        DB::beginTransaction();
        try {
            $params = $request->validate([
                'id'     => ['required'],
                'status' => ['required'],
            ]);

            $rooms = Room::find($params['id'])
                ->update([
                    'status'     => $params['status'],
            ]);

            $getrooms = Room::where('id',$params['id'])->get();

            DB::commit();
            $res = array(
                'msg'        => 'success',
                'data'       => $getrooms
            );
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $res = array(
             'msg'        => 'fail',
            );
        }
        return response(json_encode($res), $status);
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
