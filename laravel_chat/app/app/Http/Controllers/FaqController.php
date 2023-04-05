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
    public function index(Request $request)
    {
        $rooms = 0;
        $limit = 10;
        $faqparams = [];

        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }

        if (isset($request->user_name_keyword)){
            $faqparams['keyword'] = $request->user_name_keyword;
        }

        if (isset($request->manager_group_sn)){
            $faqparams['sn'] = $request->manager_group_sn;
        }


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

        foreach ($motc_station as $motc) {
            $sn[] = $motc['sn'];
        }

        $faq = FAQ::orderBy('id', 'desc')
        ->leftJoin('motc_station', 'motc_station.sn', '=', 'faq.service')
        ->where('faq.status','0')
        ->whereIn('sn', $sn)
        ->when(isset($faqparams['keyword']), function ($query) use ($faqparams) {
            $query->where('answer','LIKE', '%' .$faqparams['keyword']. '%');
        })
        ->paginate($limit);

        return view('faq.index', [
            'rooms' => $rooms,
            'faq'=> $faq,
            'motc_station' => $motc_station,
            'auth_service_role' => $auth
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
                'service'     => $request['service'],
                'answer'       => $request['answer'],
                //'url'          => $request['url'],
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
            'service'   => ['required'],
            'answer'   => ['required'],
            //'url'   => ['required'],
        ]);
        DB::beginTransaction();
        try {
            $faq = FAQ::create([
                'question'     => $params['question'],
                'answer'       => $params['answer'],
                //'url'          => $params['url'],
                'service'          => $params['service'],
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

    public function exportCsv()
{
    $fileName = 'faq.csv';
    $faqData = FAQ::all(['question', 'answer'])->toArray();
    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
    ];
    $callback = function() use ($faqData) {
        $file = fopen('php://output', 'w');
        fputcsv($file, ['Question', 'Answer']);
        foreach ($faqData as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
    };
    return response()->stream($callback, 200, $headers);
}
public function importCsv(Request $request)
{
    $status = Response::HTTP_OK;

    try {
        $file = $request->file('file');

        // validate the file
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        // read the file contents
        $csvData = array_map('str_getcsv', file($file->getPathname()));

        // process the data
        foreach ($csvData as $row) {
            $faq = new FAQ();
            $faq->question = isset($row[0]) ? $row[0]: '//';
            $faq->answer = isset($row[1]) ? $row[1]: '//';
            // $faq->status = $row[2];
            // $faq->url = $row[3];
            // $faq->is_err = $row[4];
            $faq->save();
        }
    } catch (Throwable $e) {
        Log::error($e->getMessage());
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $rs = array(
            'msg'=>'fail'
        );
    }
    if ($status === Response::HTTP_OK) {
        return response()->json(['success' => true, 'url' => '/faq']);
    } else {
        return response()->json(['success' => false]);
    }
}

}
