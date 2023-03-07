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
        $rooms = 0;
        $limit = 2;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        $msg_sample = FrequentlyMsg::orderBy('id', 'desc')
        ->where('status','0')
        ->paginate($limit);
        return view('msgsample.index', [
            'rooms' => $rooms,
            'msg_sample' => $msg_sample
        ]);
    }

    public function store(Request $request)
    {
        $params = $request->validate([
            'type'     => ['required'],
            'subject'  => ['required'],
            'reply'    => ['required'],
        ]);

        if (isset($request->url)){
            $params['url'] = $request->url;
        } else {
            $params['url'] = '';
        }

        DB::beginTransaction();
        try {
            $frequently_msg = FrequentlyMsg::create([
                'type'        => $params['type'],
                'subject'     => $params['subject'],
                'reply'       => $params['reply'],
                'url'         => $params['url'],
                'status'      => 0,
            ]);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('msgsample.index', $frequently_msg->id);
    }

    public function update(Request $request)
    {
        FrequentlyMsg::find($request['id'])
            ->update([
                'type'        => $request['type'],
                'subject'     => $request['subject'],
                'reply'       => $request['reply'],
                'url'         => $request['url'],
        ]);
        return redirect()->route('msgsample.index');

    }

    public function upstatus(Request $request)
    {
        FrequentlyMsg::find($request['id'])
            ->update([
                'status'        => 1,
        ]);
        return redirect()->route('msgsample.index');

    }

}
