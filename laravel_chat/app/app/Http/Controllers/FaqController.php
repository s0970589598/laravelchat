<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Message;
use App\Models\Room;
use App\Repositories\MotcStationRepository;
use App\Repositories\UserRepository;

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
   protected $motc_station_repository;
   protected $user_repository;

   public function __construct(Centrifugo $centrifugo,
    MotcStationRepository $motc_station_repository,
    UserRepository $user_repository
    )
   {
       $this->centrifugo = $centrifugo;
       $this->motc_station_repository = $motc_station_repository;
       $this->user_repository         = $user_repository;
    }
    public function index()
    {
        $rooms = 0;
        $limit = 10;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }

        $faq = FAQ::orderBy('id', 'desc')
        ->where('status','0')
        ->paginate($limit);

        $auth_id    = Auth::user()->id;
        $params_auth = array(
            'user_id' => $auth_id
        );
        $auth = $this->user_repository->getUserServiceRole($params_auth);

        if ($auth['role'] == 'admin99'){
            $motc_params = array();
        } else {
            $motc_params = array(
                'station_name' => $auth['service']
            );
        }

        $motc_station = $this->motc_station_repository->motcStationList($motc_params);

        return view('faq.index', [
            'rooms' => $rooms,
            'faq'=> $faq,
            'motc_station' => $motc_station
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

    public function store(Request $request)
    {
        $params = $request->validate([
            'question'   => ['required'],
            'answer'   => ['required'],
            //'url'   => ['required'],
        ]);
        DB::beginTransaction();
        try {
            $faq = FAQ::create([
                'question'     => $params['question'],
                'answer'       => $params['answer'],
                //'url'          => $params['url'],
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

}
