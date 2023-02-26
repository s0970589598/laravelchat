<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\Media;
use denis660\Centrifugo\Centrifugo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class MediaController extends Controller
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
        $rooms = 0;
        //$email_sample = EmailSample::get();
        $limit = 2;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        //$email_sample = DB::table('email_sample');
        $media = Media::orderBy('id', 'desc')
        ->where('status','0')
        ->paginate($limit);

        return view('media.index', [
            'rooms' => $rooms,
            'media' => $media,
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
            'type'   => ['required'],
            'title'  => ['required'],
            'file'   => ['required'],
        ]);

        $fileName = time() . '.'. $request->file->extension();

        $type = $request->file->getClientMimeType();
        $size = $request->file->getSize();

        $request->file->move(public_path('file'), $fileName);


        DB::beginTransaction();
        try {
            $media = Media::create([
                'type'        => $params['type'],
                'title'       => $params['title'],
                'file'        => $fileName,
                'status'      => 0,
            ]);
            // $room->users()->attach(Auth::user()->id);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('media.index', $media->id);
    }

    public function update(Request $request)
    {
        $fileName = time() . '.'. $request->file->extension();

        $type = $request->file->getClientMimeType();
        $size = $request->file->getSize();

        $request->file->move(public_path('file'), $fileName);

        Media::find($request['id'])
            ->update([
                'type'        => $request['type'],
                'title'       => $request['title'],
                'file'        =>  $fileName,
        ]);
        return redirect()->route('media.index');

    }
    public function upstatus(Request $request)
    {
        Media::find($request['id'])
            ->update([
                'status'        => 1,
        ]);
        return redirect()->route('media.index');

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
