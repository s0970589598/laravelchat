<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Room;
use App\Repositories\FaqRepository;
use App\Repositories\MsgsampleRepository;
use App\Repositories\UserRepository;

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
    protected $user_repository;
    protected $msgsample_repository;
    protected $faq_repository;

    public function __construct(User $user,
        Centrifugo $centrifugo,
        UserRepository $user_repository,
        MsgsampleRepository $msgsample_repository,
        FaqRepository $faq_repository
    )
    {
        //$this->user = $user;
        $this->user_repository = $user_repository;
        $this->msgsample_repository = $msgsample_repository;
        $this->faq_repository = $faq_repository;
        $this->centrifugo = $centrifugo;
    }

    public function index()
    {
        $rooms = 0;
        // $user = Auth::user();
        // Log::info(json_encode($user));
        // Log::info(json_encode($user->isOnline()));
        $auth_id    = Auth::user()->id;
        $params_auth = array(
            'user_id' => $auth_id
        );

        $auth = $this->user_repository->getUserServiceRole($params_auth);

        if ($auth['role'] == 'admin99'){
            $err_url_count = $this->faq_repository->countUrlErr();
        } else {
            $err_url_count = $this->msg_repository->countUrlErr();
        }

        return view('dashboard.index', [
            'rooms' => $rooms,
            'errUrlCount' => $err_url_count,
        ]);
    }

}
