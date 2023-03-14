<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\FrequentlyMsg;
use App\Repositories\UserRepository;

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
    public function __construct(Centrifugo $centrifugo,UserRepository $user_repository)
    {
        $this->centrifugo = $centrifugo;
        $this->user_repository         = $user_repository;

    }

    public function index(Request $request)
    {
        $rooms = 0;
        $limit = 2;
        $msg_params = [];

        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        if (isset($request->manager_question_type)){
            $msg_params['type'] = $request->manager_question_type;
        }
        if (isset($request->keyword)){
            $msg_params['keyword'] = $request->keyword;
        }

        $msg_sample = FrequentlyMsg::orderBy('id', 'desc')
        ->where('status','0')
        ->when(isset($msg_params['keyword']), function ($query) use ($msg_params) {
            $query->where('reply','LIKE', '%' .$msg_params['keyword']. '%');
            $query->orwhere('subject','LIKE', '%' .$msg_params['keyword']. '%');
        })
        ->when(isset($msg_params['type']), function ($query) use ($msg_params) {
            $query->where('type', $msg_params['type']);
        })
        ->paginate($limit);

        $auth_id    = Auth::user()->id;
        $params_auth = array(
            'user_id' => $auth_id
        );
        $auth = $this->user_repository->getUserServiceRole($params_auth);


        return view('msgsample.index', [
            'rooms' => $rooms,
            'msg_sample' => $msg_sample,
            'auth_service_role' => $auth
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

    public function getMsgSample(Request $request)
    {
        $limit =10;
        $msg_sample = [];
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        if (isset($request->manager_question_type)){
            $msg_params['type'] = $request->manager_question_type;
        }
        if (isset($request->keyword)){
            $msg_params['keyword'] = $request->keyword;
        }

        $msg_sample = FrequentlyMsg::orderBy('id', 'desc')
        ->where('status','0')
        ->when(isset($msg_params['keyword']), function ($query) use ($msg_params) {
            $query->where('reply','LIKE', '%' .$msg_params['keyword']. '%');
            $query->orwhere('subject','LIKE', '%' .$msg_params['keyword']. '%');
        })
        ->when(isset($msg_params['type']), function ($query) use ($msg_params) {
            $query->where('type', $msg_params['type']);
        })
        ->paginate($limit);

        return json_encode($msg_sample);

    }
}
