<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use App\Models\SatisfactionSurvey;
use App\Models\CustomerServiceRelationRole;
use denis660\Centrifugo\Centrifugo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Throwable;

class SatisfactionController extends Controller
{
    //private Centrifugo $centrifugo;
    protected $centrifugo;
    public function __construct(Centrifugo $centrifugo)
    {
        $this->centrifugo = $centrifugo;
    }

    public function storeSatisfaction(Request $request)
    {
        $status = Response::HTTP_OK;
        $params = $request->validate([
             'room_id'  => ['required'],
             'service'  => ['required'],
             'point'    => ['required'],
             'memo'     => ['required'],
         ]);

        DB::beginTransaction();

        try {
            $satifaction = SatisfactionSurvey::create([
                'room_id'  =>  $params['email'],
                'service'  =>  $params['service'],
                'point'    =>  $params['point'],
                'memo'     =>  $params['memo'],
            ]);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        }
        // event(new Registered($user));

        return response(json_encode($satifaction), $status);
    }


    public function index()
    {
        $rooms = 0;
        $limit = 10;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        $users = User::orderBy('users.id', 'desc')
        //->where('status','0')
        ->leftJoin('customer_service_relation_role', 'users.id', '=', 'customer_service_relation_role.user_id')
        ->paginate($limit);

        return view('satisfaction.index', [
            'rooms' => $rooms,
            'users' => $users,
        ]);
    }

    public function manage()
    {
        $rooms = 0;
        // $rooms = Room::with(['users', 'messages' => function ($query) {
        //     $query->orderBy('created_at', 'asc');
        // }])->orderBy('created_at', 'desc')->get();
        $rooms = 0;
        //$email_sample = EmailSample::get();
        $limit = 10;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        //$email_sample = DB::table('email_sample');
        $users = User::orderBy('users.id', 'desc')
        //->where('status','0')
        ->leftJoin('customer_service_relation_role', 'users.id', '=', 'customer_service_relation_role.user_id')
        ->paginate($limit);

        return view('satisfaction.manage', [
            'rooms' => $rooms,
            'users' => $users,
        ]);
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
