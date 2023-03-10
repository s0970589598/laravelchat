<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Message;
use App\Models\Room;
use App\Repositories\MotcStationRepository;

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

   public function __construct(Centrifugo $centrifugo, MotcStationRepository $motc_station_repository)
   {
       $this->centrifugo = $centrifugo;
       $this->motc_station_repository = $motc_station_repository;
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
        $motc_station = $this->motc_station_repository->motcStationList();

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
