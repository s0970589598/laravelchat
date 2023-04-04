<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserRepository
{
    // public function motcStationList()
    // {
    //     $motc_sation = MotcStation::get();
    //     return $motc_sation;
    // }

    public function getUserListByParams($params)
    {
        $users = User::orderBy('users.id', 'desc')
        ->leftJoin('customer_service_relation_role', 'users.id', '=', 'customer_service_relation_role.user_id')
        ->where('status','0');


        if(isset($params['start_time']) && isset($params['end_time']))
        {
            $users->where('last_seen', '>', $params['start_time']);
            $users->where('last_seen', '<', $params['end_time']);
        }


        if(isset($params['service'])) {
            $users->where('service', 'like', '%' . $params['service'] . '%');
        }

        if(isset($params['role'])) {
            $users->where('role', $params['role']);
        }

        if(isset($params['user_id'])) {
            $users->where('users.id', $params['user_id']);
        }
        // Log::info(json_encode($users->get()));

        return $users->get();
    }

    public function getAllUserListByServiceRole($service, $role, $limit = 10, $account_params)
    {
        if ($role == 'admin99'){
            $users = User::select('*')
            ->orderBy('users.id', 'desc')
            ->leftJoin('customer_service_relation_role', 'users.id', '=', 'customer_service_relation_role.user_id')
            ->where('status','0')
            ->when(isset($account_params['name']), function ($query) use ($account_params) {
                $query->where('name','LIKE', '%' .$account_params['name']. '%');
            })
            ->when(isset($account_params['manager_group_sn']), function ($query) use ($account_params) {
              $query->where('service', 'LIKE', '%' . $account_params['manager_group_sn'] . '%');
            })
            ->where('customer_service_relation_role.role', '!=','user')
            ->paginate($limit);
        } else {
            $users = User::select('*')
            ->orderBy('users.id', 'desc')
            ->leftJoin('customer_service_relation_role', 'users.id', '=', 'customer_service_relation_role.user_id')
            ->where('status','0')
            ->where('customer_service_relation_role.role', '!=','user')
            ->where(function ($query) use ($service) {
                foreach ($service as $station_name) {
                    $query->orWhere('service', 'like', '%' . $station_name . '%');
                }
            })
            ->when(isset($account_params['name']), function ($query) use ($account_params) {
                $query->where('name','LIKE', '%' .$account_params['name']. '%');
            })
            ->when(isset($account_params['manager_group_sn']), function ($query) use ($account_params) {
              $query->where('service', 'LIKE', '%' . $account_params['manager_group_sn'] . '%');
            })
            ->paginate($limit);
        }
        return $users;
    }

    public function getUserServiceRole($params_auth)
    {
        $auth       = $this->getUserListByParams($params_auth);
        $service    = $auth[0]->service;
        $role       = $auth[0]->role;
        $de_service = json_decode($service);

        return array(
            'auth' => $auth,
            'service' => $de_service,
            'role'=> $role
        );

    }

    public function getOnlineCustomer($service, $role, $limit = 10, $account_params){
        $now = now(); // 取得當前時間
        $thirtyMinutesAgo = $now->subMinutes(30); // 取得 30 分鐘前的時間
        if ($role == 'admin99'){
            $users = User::select('*')
            ->orderBy('users.id', 'desc')
            ->leftJoin('customer_service_relation_role', 'users.id', '=', 'customer_service_relation_role.user_id')
            ->where('status','0')
            ->when(isset($account_params['name']), function ($query) use ($account_params) {
                $query->where('name','LIKE', '%' .$account_params['name']. '%');
            })
            ->when(isset($account_params['manager_group_sn']), function ($query) use ($account_params) {
              $query->where('service', 'LIKE', '%' . $account_params['manager_group_sn'] . '%');
            })
            ->where('customer_service_relation_role.role', '!=','user')
            ->where('users.last_seen', '>=',$thirtyMinutesAgo)
            ->count();
        } else {
            $users = User::select('*')
            ->orderBy('users.id', 'desc')
            ->leftJoin('customer_service_relation_role', 'users.id', '=', 'customer_service_relation_role.user_id')
            ->where('status','0')
            ->where('customer_service_relation_role.role', '!=','user')
            ->where(function ($query) use ($service) {
                foreach ($service as $station_name) {
                    $query->orWhere('service', 'like', '%' . $station_name . '%');
                }
            })
            ->when(isset($account_params['name']), function ($query) use ($account_params) {
                $query->where('name','LIKE', '%' .$account_params['name']. '%');
            })
            ->when(isset($account_params['manager_group_sn']), function ($query) use ($account_params) {
              $query->where('service', 'LIKE', '%' . $account_params['manager_group_sn'] . '%');
            })
            ->where('users.last_seen', '>=',$thirtyMinutesAgo)
            ->count();
        }
        return $users;

    }

    public function rooms_users($room_id){

        $results = DB::table('users_rooms')
        ->select('authcode', 'phone', 'line', 'contact_email', 'note')
        ->leftJoin('users', 'users_rooms.user_id', '=', 'users.id')
        ->leftJoin('customer_service_relation_role', 'customer_service_relation_role.user_id', '=', 'users.id')
        ->where('customer_service_relation_role.role', '=', 'user')
        ->where('users_rooms.room_id', '=', $room_id)
        ->orderByDesc('users_rooms.room_id')
        ->get();

        return $results;
    }


}
