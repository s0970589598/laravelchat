<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use denis660\Centrifugo\Centrifugo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

use Throwable;

class DialogueController extends Controller
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

        return view('dialogue.index', [
            'rooms' => $rooms,
        ]);
    }

    public function manage()
    {
        $rooms = 0;
        $limit = 10;
        $rooms = Room::with(['users', 'messages' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->orderBy('created_at', 'desc')
        ->paginate($limit);
        return view('dialogue.manage', [
            'rooms' => $rooms,
        ]);
    }


    public function show(int $id)
    {
        $rooms = Room::with('users')->orderBy('created_at', 'desc')->get();
        $room  = Room::with(['users', 'messages.user' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->find($id);

        return view('dialogue.index', [
            'rooms' => $rooms,
            'currRoom' => $room,
            'isJoin' => $room->users->contains('id', Auth::user()->id),
            'now' => Carbon::now('GMT+8')->toDateString()
        ]);
    }

    public function publish(int $id, Request $request)
    {
        $requestData = $request->json()->all();
        $status      = Response::HTTP_OK;
        if (isset($requestData["sender_id"])){
            $sender_id = $requestData["sender_id"];
        } else {
            $sender_id = Auth::user()->id;
        }

        if (isset($requestData["sender_name"])){
            $sender_name = $requestData["sender_name"];
        } else {
            $sender_name = Auth::user()->name;
        }

        try {
            $message = Message::create([
                'sender_id' => $sender_id,
                'message'   => $requestData["message"],
                'room_id'   => $id,
            ]);

            $room = Room::with('users')->find($id);

            $channels = [];
            foreach ($room->users as $user) {
                $channels[] = "personal:#" . $user->id;
            }

            $this->centrifugo->broadcast($channels, [
                "text"               => $message->message,
                "createdAt"          => $message->created_at->toDateTimeString(),
                "createdAtFormatted" => $message->created_at->toFormattedDateString() . ", " . $message->created_at->toTimeString(),
                "roomId"             => $id,
                "senderId"           => $sender_id,
                "senderName"         => $sender_name,
            ]);

            $rs = array(
                'msg'=>'success',
                'data'=>$message
            );
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $rs = array(
                'msg'=>'fail'
            );
        }

        return response($rs, $status);
    }
}
