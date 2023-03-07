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

    public function updateSatisfaction(Request $request)
    {
        Log::info($request);
        SatisfactionSurvey::where('room_id', $request['id'])
            ->update([
                'service'  => $request['service'],
                'role'     => $request['role'],
            ]);
        return redirect()->route('satisfaction.index');
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


    public function show(int $id)
    {
        $rooms = Room::with('users')->orderBy('created_at', 'desc')->get();
        $room  = Room::with(['users', 'messages.user' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->find($id);

        return view('rooms.index', [
            'rooms'    => $rooms,
            'currRoom' => $room,
            'isJoin'   => $room->users->contains('id', Auth::user()->id),
        ]);
    }

    public function join(int $id)
    {
        $room = Room::find($id);
        $room->users()->attach(Auth::user()->id);

        return redirect()->route('rooms.show', $id);
    }

    public function store(Request $request)
    {
        $params = $request->validate([
             'email' => ['required'],
             'service' => ['required'],
             'role' => ['required'],
         ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name'  =>  $params['email'],
                'email' =>  $params['email'],
                'password' => Hash::make('test123'),
                'authcode' => $this->generateRandomString(5),
            ]);
            $service_relation_role = CustomerServiceRelationRole::create([
                'user_id'  => $user->id,
                'service' => $params['service'],
                'role' => $params['role'],
            ]);

            $param = array(
                'email'   => $request->email,
                'service' => $request->service,
                'role' => $request->role,
            );

            //$this->sendUserConfirmMail($param);
            // $room->users()->attach(Auth::user()->id);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
        // event(new Registered($user));

        return redirect()->route('account.index');
    }

    public function update(Request $request)
    {
        Log::info($request);
        CustomerServiceRelationRole::where('user_id', $request['id'])
            ->update([
                'service'  => $request['service'],
                'role'     => $request['role'],
            ]);
        return redirect()->route('account.index');

    }


    public function publish(int $id, Request $request)
    {
        $requestData = $request->json()->all();
        $status      = Response::HTTP_OK;

        try {
            $message = Message::create([
                'sender_id' => Auth::user()->id,
                'message'   => $requestData["message"],
                'room_id'   => $id,
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
                "senderId"           => Auth::user()->id,
                "senderName"         => Auth::user()->name,
            ]);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response('', $status);
    }

    public function sendUserConfirmMail($param)
    {
        try {
            $user = new User([
                // 'order_number'        => Uuid::generate()->string,
                'email'                   => $request->get('customer_title'),
                'customer_name'           => $request->get('customer_name'),
                'customer_email'          => $request->get('customer_email'),
                'customer_phone'          => $request->get('customer_phone'),
                'customer_note'           => $request->get('customer_note'),
                'company_name'            => $request->get('company_name'),
                'company_address'         => $request->get('company_address'),
                'company_code'            => $request->get('company_code'),
                'company_city'            => $request->get('company_city'),
                'company_country'         => $request->get('company_country'),
                'customer_interest'       => $request->get('customer_interest'),
                'customer_interest_other' => $request->get('customer_interest_other'),
            ]);
            Log::info(json_encode($order));
            // $order->save();

            $to_list = collect([
                ['name' => 'GoodLinker', 'email' => env("MAIL_TO_ADDRESS", "allen.wu@goodlinker.io")],
            ]);

            Mail::to($to_list)->send(new OrderMail($order));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(new JsonResponse([], $exception->getMessage()), Response::HTTP_OK);
        }
        return response()->json(new JsonResponse(['msg' => '系統已經收到您的訂單，我們將會盡快處理！']), Response::HTTP_OK);

    }

    public function upstatus(request $request)
    {
        User::find($request['id'])
            ->update([
                'status'     => 1,
        ]);
        return redirect()->route('account.index');

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
