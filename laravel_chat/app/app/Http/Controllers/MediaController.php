<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\Media;
use App\Repositories\UserRepository;
use App\Repositories\MotcStationRepository;

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
    protected $motc_station_repository;

    public function __construct(Centrifugo $centrifugo,UserRepository $user_repository ,MotcStationRepository $motc_station_repository   )
    {
        $this->centrifugo = $centrifugo;
        $this->user_repository         = $user_repository;
        $this->motc_station_repository = $motc_station_repository;

    }

    public function index(Request $request)
    {
        $rooms = 0;
        $limit = 10;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        $media = Media::where('media.status','0')
        ->leftJoin('motc_station', 'motc_station.sn', '=', 'media.service')
        ->orderBy('media.id', 'desc')
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

        return view('media.index', [
            'rooms' => $rooms,
            'media' => $media,
            'auth_service_role' => $auth,
            'motc_station' => $motc_station
        ]);
    }

    public function store(Request $request)
    {
        $params = $request->validate([
            'type'   => ['required'],
            'service'   => ['required'],
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
                'service'     => $params['service'],
                'status'      => 0,
            ]);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('media.index', $media->id);
    }

    public function update(Request $request)
    {
        $params = array(
            'type' =>$request['type'],
            'title' =>$request['title'],
            'service' =>$request['service'],
        );
        if ($request->file) {
            $fileName = time() . '.'. $request->file->extension();
            $type = $request->file->getClientMimeType();
            $size = $request->file->getSize();
            $request->file->move(public_path('file'), $fileName);
            $params['file'] = $fileName;
        }

        Media::find($request['id'])
            ->update($params);
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

    public function getMedia(Request $request){
        $limit =10;
        $media_params = [];
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        if (isset($request['keyword']) && $request['keyword']) {
            $media_params['keyword'] = $request['keyword'] ;
        }

        //Log::info($media_params);
        $media = Media::orderBy('id', 'desc')
        ->where('status','0')
        ->when(isset($media_params['keyword']), function ($query) use ($media_params) {
            $query->where('title','LIKE', '%' .$media_params['keyword']. '%');
        })
        ->paginate($limit);

        return json_encode($media);
    }
}
