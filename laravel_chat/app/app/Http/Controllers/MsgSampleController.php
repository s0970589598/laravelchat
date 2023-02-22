<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\FrequentlyMsg;
use denis660\Centrifugo\Centrifugo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class MsgSampleController extends Controller
{
    //private Centrifugo $centrifugo;
    protected $centrifugo;
    public function __construct(Centrifugo $centrifugo)
    {
        $this->centrifugo = $centrifugo;
    }

    public function index()
    {
        // $rooms = Room::with(['users', 'messages' => function ($query) {
        //     $query->orderBy('created_at', 'asc');
        // }])->orderBy('created_at', 'desc')->get();
        $rooms = 0;
        //$email_sample = EmailSample::get();
        $limit = 2;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        //$email_sample = DB::table('email_sample');
        $msg_sample = FrequentlyMsg::orderBy('id', 'desc')
        ->where('status','1')
        ->paginate($limit);
        return view('msgsample.index', [
            'rooms' => $rooms,
            'msg_sample' => $msg_sample
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
            'type'     => ['required'],
            'subject'  => ['required'],
            'reply'    => ['required'],
        ]);
        DB::beginTransaction();
        try {
            $frequently_msg = FrequentlyMsg::create([
                'type'        => $params['type'],
                'subject'     => $params['subject'],
                'reply'       => $params['reply'],
                'status'      => 1,
            ]);
            // $room->users()->attach(Auth::user()->id);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('msgsample.index', $frequently_msg->id);
    }

    public function update($params)
    {
        return Media::find($params['id'])
            ->update([
                'type'        => $params['type'],
                'title'       => $params['title'],
                'file'        => $params['file'],
                'status'      => $params['status'],
        ]);
    }

    public function publish(int $id, Request $request)
    {
        $requestData = $request->json()->all();
        $status      = Response::HTTP_OK;

        try {
            $message = Message::create([
                'sender_id' => Auth::user()->id,
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
                "senderId"           => Auth::user()->id,
                "senderName"         => Auth::user()->name,
            ]);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response('', $status);
    }
}
