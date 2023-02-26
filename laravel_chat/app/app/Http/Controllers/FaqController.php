<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Message;
use App\Models\Room;
use denis660\Centrifugo\Centrifugo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class FaqController extends Controller
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
        // $rooms = Room::with(['users', 'messages' => function ($query) {
        //     $query->orderBy('created_at', 'asc');
        // }])->orderBy('created_at', 'desc')->get();
        $limit = 10;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        //$email_sample = DB::table('email_sample');
        $faq = FAQ::orderBy('id', 'desc')
        // ->where('status','0')
        ->paginate($limit);

        return view('faq.index', [
            'rooms' => $rooms,
            'faq'=> $faq,
        ]);
    }

    public function show(int $id)
    {
        $faq = FAQ::find($id);

        return view('faq.index', [
            'faqByid'    => $faq,
        ]);
    }

    public function update(request $request)
    {
        $faq = FAQ::find($request['id'])
            ->update([
                'question'     => $request['question'],
                'answer'       => $request['answer'],
                'url'          => $request['url'],
        ]);
        return redirect()->route('faq.index');

    }

    public function upstatus(request $request)
    {
        $faq = FAQ::find($request['id'])
            ->update([
                'status'     => 1,
        ]);
        return redirect()->route('faq.index');

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
            'question'   => ['required'],
            'answer'   => ['required'],
            'url'   => ['required'],
        ]);
        DB::beginTransaction();
        try {
            $faq = FAQ::create([
                'question'     => $params['question'],
                'answer'       => $params['answer'],
                'url'          => $params['url'],
                'status'       => 0,
            ]);
            // $room->users()->attach(Auth::user()->id);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('faq.index');
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
