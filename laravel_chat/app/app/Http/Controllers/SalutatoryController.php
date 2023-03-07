<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\Salutatory;
use denis660\Centrifugo\Centrifugo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SalutatoryController extends Controller
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
        $salutatory = Salutatory::orderBy('id', 'desc')
        ->where('status','0')
        ->paginate($limit);
        return view('salutatory.index', [
            'rooms' => $rooms,
            'salutatory' => $salutatory
        ]);
    }
    public function store(Request $request)
    {
        $params = $request->validate([
            'subject'  => ['required'],
            'content'    => ['required'],
        ]);


        DB::beginTransaction();
        try {
            $frequently_msg = Salutatory::create([
                'subject'     => $params['subject'],
                'content'     => $params['content'],
                'status'      => 0,
            ]);
            // $room->users()->attach(Auth::user()->id);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('salutatory.index', $frequently_msg->id);
    }

    public function update(Request $request)
    {
        Salutatory::find($request['id'])
            ->update([
                'subject'     => $request['subject'],
                'content'     => $request['content'],
        ]);
        return redirect()->route('salutatory.index');

    }

    public function upstatus(Request $request)
    {
        Salutatory::find($request['id'])
            ->update([
                'status'        => 1,
        ]);
        return redirect()->route('salutatory.index');
    }

}
