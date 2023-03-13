<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Room;
use App\Models\User;

class RoomsRepository
{

    public function getAllMsgListByServiceRole($sn, $role, $limit = 10)
    {
        Log::info($sn);
        if ($role == 'admin99'){
            $rooms = Room::with(['users', 'messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])->orderBy('created_at', 'desc')
            ->paginate($limit);
        } else {
            $rooms = Room::with(['users', 'messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])->orderBy('created_at', 'desc')
            ->whereIn('service', $sn)
            ->paginate($limit);
        }
        return $rooms;
    }

    public function getAllMsgListByServiceRoleExport($sn, $role, $limit = 10)
    {
        if ($role == 'admin99'){
            $rooms = Room::with(['users', 'messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])->orderBy('created_at', 'desc');
        } else {
            $rooms = Room::with(['users', 'messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])->orderBy('created_at', 'desc')
            ->whereIn('service', $sn);
        }
        return $rooms;
    }



}
