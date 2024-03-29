<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\Media;
use App\Models\RoomUserRelation;
use App\Models\FrequentlyMsg;
use App\Models\User;

use App\Repositories\MotcStationRepository;
use App\Repositories\UserRepository;
use App\Repositories\RoomsRepository;

use denis660\Centrifugo\Centrifugo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

use App\Export\RoomExport;
use Maatwebsite\Excel\Facades\Excel;

use Throwable;

class DialogueController extends Controller
{
    //private Centrifugo $centrifugo;
    protected $centrifugo;
    protected $motc_station_repository;
    protected $user_repository;
    protected $rooms_repository;

    public function __construct(Centrifugo $centrifugo,
      MotcStationRepository $motc_station_repository,
      UserRepository $user_repository,
      RoomsRepository $rooms_repository
    )
    {
        $this->centrifugo = $centrifugo;
        $this->motc_station_repository = $motc_station_repository;
        $this->user_repository = $user_repository;
        $this->rooms_repository = $rooms_repository;
    }

    public function index()
    {
        $rooms = 0;
        $media = 0;
        $limit = 10;

        $media = Media::orderBy('id', 'desc')
        ->where('status','0')
        ->paginate($limit);
        $msg_sample = FrequentlyMsg::orderBy('id', 'desc')
        ->where('status','0')
        ->paginate($limit);


        return view('dialogue.index', [
            'rooms' => $rooms,

        ]);
    }

    public function manage()
    {
        $rooms = 0;
        $limit = 10;
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
        $rooms = $this->rooms_repository->getAllMsgListByServiceRole($sn,$auth['role']);

        $get_customer_params = array(
            'role' => 'customer'
        );
        $get_customer = $this->user_repository->getUserListByParams($get_customer_params);


        return view('dialogue.manage', [
            'rooms'        => $rooms,
            'motc_station' => $motc_station,
            'customer_list' => $get_customer,
            'auth_service_role' => $auth
        ]);
    }


    public function show(int $id)
    {
        $limit = 9;
        $rooms = Room::with('users')->orderBy('created_at', 'desc')->get();

        $room  = Room::with(['users', 'messages.user' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->find($id);

        $is_join = $room->users->contains('id', Auth::user()->id);

        if (empty($is_join)){
            $room->users()->attach(Auth::user()->id);
        }

        $media = Media::orderBy('id', 'desc')
        ->where('status','0')
        ->paginate($limit);

        $msg_sample = FrequentlyMsg::orderBy('id', 'desc')
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
        $motc_station_transfer = $this->motc_station_repository->motcStationList($motc_params=[]);

        return view('dialogue.index', [
            'rooms' => $rooms,
            'currRoom' => $room,
            'motc_station' => $motc_station,
            'motc_station_transfer' => $motc_station_transfer,
            'isJoin' => $room->users->contains('id', Auth::user()->id),
            'now' => Carbon::now('GMT+8')->toDateString(),
            'media' => $media,
            'msg_sample' => $msg_sample
        ]);
    }

    // 一般訊息  msg// 圖片/檔案 file
    // 貼圖     stickers// 訊息範本  msgtem// 媒體庫    media
    public function publish(int $id, Request $request)
    {
        $requestData = $request->json()->all();
        $check_api = 1;
        if(isset($requestData["type"])) {
            $msg_type = $requestData["type"];
        } else {
            if ( isset($request['type'])){
                $msg_type = $request['type'];
            } else {
                $msg_type = 'msg';
            }
        }

        // file tmp not
        if ($msg_type == 'msgtem'  || $msg_type == 'media' || $msg_type == 'stickers'){
            $requestData = $request->all();
            $check_api = 0;
        }

        $status      = Response::HTTP_OK;
        if (isset($requestData["sender_id"])){
            $sender_id = $requestData["sender_id"];
        } else {
            $sender_id = Auth::user()->id;
        }

        if (isset($requestData["sender_name"])){
            $sender_name = $requestData["sender_name"];
        } else {
            $sender_name = Auth::user()->name;
        }

        if ($msg_type == 'file'){
            $fileName = time() . '.'. $request->file->extension();
            $type = $request->file->getClientMimeType();
            $size = $request->file->getSize();
            $request->file->move(public_path('file'), $fileName);
            $msg = public_path('file') . '/' . $fileName;
        } else if ($msg_type == 'msgtem' || $msg_type == 'media') {
            foreach($requestData["items"] as $key =>$rd) {
                $arr[]=(int)$rd;
            }

            $msg = json_encode($arr);
        } else if ($msg_type == 'stickers') {
            foreach($requestData["items"] as $key =>$rd) {
                $arr[]=$rd;
            }
            $msg = json_encode($arr);

        } else {
            //  save 文件
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->store('uploads');
                $msg = $request->input('message');
                $msg_type = 'file';
                $fileName = time() . '.'. $file->extension();
                $type = $file->getClientMimeType();
                $size = $file->getSize();
                $file->move(public_path('file'), $fileName);
                $msg .= '[' . $type . ']' . public_path('file') . '/' . $fileName;
            } else {
                $msg = $requestData["message"];
            }
        }

        try {
            $message = Message::create([
                'sender_id' => $sender_id,
                'message'   => $msg,
                'room_id'   => $id,
                'type'      => $msg_type,
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
                "senderId"           => $sender_id,
                "senderName"         => $sender_name,
                "type"               => $msg_type,
            ]);

            $rs = array(
                'msg'=>'success',
                'data'=>$message
            );
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $rs = array(
                'msg'=>'fail'
            );
        }
        if ($check_api){
            return response($rs, $status);
        } else {
            return redirect()->route('dialogue.show',$id);
        }
    }

    // public function exportCsv()
    // {
    //     $rooms = 0;
    //     $limit = 10;
    //     $auth_id    = Auth::user()->id;
    //     $params_auth = array(
    //         'user_id' => $auth_id
    //     );
    //     $auth = $this->user_repository->getUserServiceRole($params_auth);

    //     if ($auth['role'] == 'admin99'){
    //         $motc_params = array();
    //     } else {
    //         $motc_params = array(
    //             'station_name' => $auth['service']
    //         );
    //     }
    //     $motc_station = $this->motc_station_repository->motcStationList($motc_params);

    //     foreach ($motc_station as $motc) {
    //         $sn[] = $motc['sn'];
    //     }
    //     $rooms = $this->rooms_repository->getAllMsgListByServiceRoleExport($sn,$auth['role']);

    //     $get_customer_params = array(
    //         'role' => 'customer'
    //     );
    //     $get_customer = $this->user_repository->getUserListByParams($get_customer_params);


    //     $fileName = 'daialogue.csv';
    //     // $faqData = FAQ::all(['question', 'answer'])->toArray();
    //     $data = $rooms->toArray();
    //     $headers = [
    //         "Content-type" => "text/csv",
    //         "Content-Disposition" => "attachment; filename=$fileName",
    //     ];
    //     $callback = function() use ($data) {
    //         $file = fopen('php://output', 'w');
    //         fputcsv($file, ['Question', 'Answer']);
    //         foreach ($data as $row) {
    //             fputcsv($file, $row);
    //         }
    //         fclose($file);
    //     };
    //     return response()->stream($callback, 200, $headers);
    // }

    public function exportCsv()
    {
        $limit = 10;
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
        // $rooms = $this->rooms_repository->getAllMsgListByServiceRoleExport($sn,$auth['role']);

        return Excel::download(new RoomExport($sn,$auth['role']), 'rooms.csv');
    }

}


