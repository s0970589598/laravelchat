<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserRepository
{
    public function motcStationList()
    {
        $motc_sation = MotcStation::get();
        return $motc_sation;
    }

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

        return $users->get();
    }


}
