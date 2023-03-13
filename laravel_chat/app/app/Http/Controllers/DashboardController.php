<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Room;
use denis660\Centrifugo\Centrifugo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class DashboardController extends Controller
{
    //private Centrifugo $centrifugo;
    protected $centrifugo;

    public function __construct(User $user,Centrifugo $centrifugo)
    {
        //$this->user = $user;

        $this->centrifugo = $centrifugo;
    }

    public function index()
    {
        $rooms = 0;
        // $user = Auth::user();
        // Log::info(json_encode($user));
        // Log::info(json_encode($user->isOnline()));

        return view('dashboard.index', [
            'rooms' => $rooms,
        ]);
    }

}
