<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use denis660\Centrifugo\Centrifugo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class AccountController extends Controller
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
        // $rooms = Room::with(['users', 'messages' => function ($query) {
        //     $query->orderBy('created_at', 'asc');
        // }])->orderBy('created_at', 'desc')->get();
        $rooms = 0;
        //$email_sample = EmailSample::get();
        $limit = 2;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        //$email_sample = DB::table('email_sample');
        $users = User::orderBy('users.id', 'desc')
        //->where('status','1')
        ->rightJoin('customer_service_relation_role', 'users.id', '=', 'customer_service_relation_role.user_id')
        ->leftJoin('customer_service', 'customer_service.id', '=', 'customer_service_relation_role.service_id')
        ->paginate($limit);

        return view('account.index', [
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
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            //'password' => Hash::make($request->password),
        ]);

        $param = array(
            'email'   => $request->email,
            'service' => array(
                'service_id' => $request->email,
                'role'       => $request->role,

            ),
        );

        $this->sendUserConfirmMail($param);
        event(new Registered($user));

        return redirect()->route('rooms.show', $room->id);
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

}
