<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\User;

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

        if(isset($params['role'])) {
            $users->where('role', $params['role']);
        }

        if(isset($params['service'])) {
            $users->where('service', 'like', '%' . $params['service'] . '%');
        }

        if(isset($params['user_id'])) {
            $users->where('users.id', $params['user_id']);
        }

        return $users->get();
    }

    public function getAllUserListByServiceRole($service, $role, $limit = 10) {
        if ($role == 'admin99'){
            $users = User::select('*')
            ->orderBy('users.id', 'desc')
            ->leftJoin('customer_service_relation_role', 'users.id', '=', 'customer_service_relation_role.user_id')
            ->where('status','0')
            ->paginate($limit);
        } else {
            $users = User::select('*')
            ->orderBy('users.id', 'desc')
            ->leftJoin('customer_service_relation_role', 'users.id', '=', 'customer_service_relation_role.user_id')
            ->where('status','0')
            ->where(function ($query) use ($service) {
                foreach ($service as $station_name) {
                    $query->orWhere('service', 'like', '%' . $station_name . '%');
                }
            })
            ->paginate($limit);
        }
        return $users;
    }

    public function getUserServiceRole($params_auth){
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


}
