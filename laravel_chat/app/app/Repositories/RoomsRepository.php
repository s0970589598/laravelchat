<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Room;
use App\Models\User;

class RoomsRepository
{

    public function getAllMsgListByServiceRole($sn, $role, $limit = 10, $room_params)
    {
        //Log::info($sn);

        if ($role == 'admin99'){
            // $rooms = Room::with(['users', 'messages' => function ($query) {
            //     $query->orderBy('created_at', 'asc');
            // }])->orderBy('created_at', 'desc')
            // ->paginate($limit);

            $rooms = Room::with(['users', 'messages' => function ($query) {
                $query->select('message')
                ->orderBy('created_at', 'asc');
            }])
            ->when(isset($room_params['start_time']), function ($query) use ($room_params) {
                $query->where('created_at', '>=',$room_params['start_time']);
            })
            ->when(isset($room_params['end_time']), function ($query) use ($room_params) {
                $query->where('created_at', '<=', $room_params['end_time']);
            })
            ->when(isset($room_params['sn']), function ($query) use ($room_params) {
                $query->where('service', $room_params['sn']);
            })
            ->when(isset($room_params['status']), function ($query) use ($room_params) {
                $query->where('status', $room_params['status']);
            })
            ->when(isset($room_params['search']), function ($query) use ($room_params) {
                $query->where(function ($q) use ($room_params) {
                    $q->where('name', 'LIKE', '%' . $room_params['search'] . '%')
                      ->orWhereHas('messages', function ($q) use ($room_params) {
                            $q->where('message', 'LIKE', '%' . $room_params['search'] . '%');
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit);

        } else {
            // $rooms = Room::with(['users', 'messages' => function ($query) {
            //     $query->orderBy('created_at', 'asc');
            // }])->orderBy('created_at', 'desc')
            // ->whereIn('service', $sn)
            // ->paginate($limit);

            $rooms = Room::with(['users', 'messages' => function ($query) {
                $query->select('message')
                ->orderBy('created_at', 'asc');
            }])
            ->when(isset($room_params['start_time']), function ($query) use ($room_params) {
                $query->where('created_at', '>=',$room_params['start_time']);
            })
            ->when(isset($room_params['end_time']), function ($query) use ($room_params) {
                $query->where('created_at', '<=', $room_params['end_time']);
            })
            ->when(isset($room_params['sn']), function ($query) use ($room_params) {
                $query->where('service', $room_params['sn']);
            })
            ->when(isset($room_params['status']), function ($query) use ($room_params) {
                $query->where('status', $room_params['status']);
            })
            ->when(isset($room_params['search']), function ($query) use ($room_params) {
                $query->where(function ($q) use ($room_params) {
                    $q->where('name', 'LIKE', '%' . $room_params['search'] . '%')
                      ->orWhereHas('messages', function ($q) use ($room_params) {
                            $q->where('message', 'LIKE', '%' . $room_params['search'] . '%');
                        });
                });
            })
            ->orderBy('created_at', 'desc')
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

        public function getAllMsgListByServiceRoleCount($sn, $role, $limit = 10, $room_params)
    {
        //Log::info($sn);

        if ($role == 'admin99'){
            // $rooms = Room::with(['users', 'messages' => function ($query) {
            //     $query->orderBy('created_at', 'asc');
            // }])->orderBy('created_at', 'desc')
            // ->paginate($limit);

            $rooms = Room::with(['users', 'messages' => function ($query) {
                $query->select('message')
                ->orderBy('created_at', 'asc');
            }])
            ->when(isset($room_params['start_time']), function ($query) use ($room_params) {
                $query->where('created_at', '>=',$room_params['start_time']);
            })
            ->when(isset($room_params['end_time']), function ($query) use ($room_params) {
                $query->where('created_at', '<=', $room_params['end_time']);
            })
            ->when(isset($room_params['sn']), function ($query) use ($room_params) {
                $query->where('service', $room_params['sn']);
            })
            ->when(isset($room_params['status']), function ($query) use ($room_params) {
                $query->where('status', $room_params['status']);
            })
            ->when(isset($room_params['search']), function ($query) use ($room_params) {
                $query->where(function ($q) use ($room_params) {
                    $q->where('name', 'LIKE', '%' . $room_params['search'] . '%')
                      ->orWhereHas('messages', function ($q) use ($room_params) {
                            $q->where('message', 'LIKE', '%' . $room_params['search'] . '%');
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->count();

        } else {
            // $rooms = Room::with(['users', 'messages' => function ($query) {
            //     $query->orderBy('created_at', 'asc');
            // }])->orderBy('created_at', 'desc')
            // ->whereIn('service', $sn)
            // ->paginate($limit);

            $rooms = Room::with(['users', 'messages' => function ($query) {
                $query->select('message')
                ->orderBy('created_at', 'asc');
            }])
            ->when(isset($room_params['start_time']), function ($query) use ($room_params) {
                $query->where('created_at', '>=',$room_params['start_time']);
            })
            ->when(isset($room_params['end_time']), function ($query) use ($room_params) {
                $query->where('created_at', '<=', $room_params['end_time']);
            })
            ->when(isset($room_params['sn']), function ($query) use ($room_params) {
                $query->where('service', $room_params['sn']);
            })
            ->when(isset($room_params['status']), function ($query) use ($room_params) {
                $query->where('status', $room_params['status']);
            })
            ->when(isset($room_params['search']), function ($query) use ($room_params) {
                $query->where(function ($q) use ($room_params) {
                    $q->where('name', 'LIKE', '%' . $room_params['search'] . '%')
                      ->orWhereHas('messages', function ($q) use ($room_params) {
                            $q->where('message', 'LIKE', '%' . $room_params['search'] . '%');
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->whereIn('service', $sn)
            ->count();
        }
        return $rooms;
    }




}
