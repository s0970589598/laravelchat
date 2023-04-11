<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\Salutatory;
use App\Repositories\UserRepository;

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
    public function __construct(Centrifugo $centrifugo,UserRepository $user_repository)
    {
        $this->centrifugo = $centrifugo;
        $this->user_repository         = $user_repository;
    }

    public function index()
    {
        $rooms = 0;
        $limit = 10;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        $salutatory = Salutatory::orderBy('id', 'desc')
        ->where('status','0')
        ->paginate($limit);

        $auth_id    = Auth::user()->id;
        $params_auth = array(
            'user_id' => $auth_id
        );
        $auth = $this->user_repository->getUserServiceRole($params_auth);

        return view('salutatory.index', [
            'rooms' => $rooms,
            'salutatory' => $salutatory,
            'auth_service_role' => $auth
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
