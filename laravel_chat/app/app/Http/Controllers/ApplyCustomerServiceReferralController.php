<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use App\Models\ApplyCustomerServiceReferral;
use App\Models\CustomerServiceRelationRole;

use denis660\Centrifugo\Centrifugo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use Throwable;

class ApplyCustomerServiceReferralController extends Controller
{
    private Centrifugo $centrifugo;

    public function __construct(Centrifugo $centrifugo)
    {
        $this->centrifugo = $centrifugo;
    }

    public function index()
    {
        $rooms = Room::with(['users', 'messages' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->orderBy('created_at', 'desc')->get();

        return view('rooms.index', [
            'rooms' => $rooms,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:32', 'unique:rooms'],
        ]);

        DB::beginTransaction();
        try {
            $applyroom = ApplyCustomerServiceReferral::create([
                'updater',
                'assign_service' => '未分類',
                'assigned_service' => '未分類',
                'room_id' => '未分類',
                'assign_reason' => '未分類',
                'status' => '未分類',
                'assign_id' => '未分類',
            ]);
            $room->users()->attach(Auth::user()->id);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('rooms.show', $room->id);
    }


    public function updateApplyCustomerServiceReferralStatus(Request $request) {
        $status = Response::HTTP_OK;
        DB::beginTransaction();
        try {
            $params = $request->validate([
                'id'     => ['required'],
                'status' => ['required'],
            ]);

            $rooms = Room::find($params['id'])
                ->update([
                    'status'     => $params['status'],
            ]);

            $getrooms = Room::where('id',$params['id'])->get();

            DB::commit();
            $res = array(
                'msg'        => 'success',
                'data'       => $getrooms
            );
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $res = array(
             'msg'        => 'fail',
            );
        }
        return response(json_encode($res), $status);
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
