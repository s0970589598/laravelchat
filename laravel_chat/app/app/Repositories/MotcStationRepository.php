<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\MotcStation;

class MotcStationRepository
{
    public function motcStationList($params)
    {
        $motc_sation = MotcStation::orderBy('sn', 'asc')
        ->where('status','1');

        if(isset($params['station_name'])) {
            $motc_sation->whereIn('station_name', $params['station_name']);
        }

        if(isset($params['sn'])) {
            $motc_sation->whereIn('sn', $params['sn']);
        }

        if(isset($params['limit'])) {
            return $motc_sation->paginate($params['limit']);
        } else {
            return $motc_sation->get();

        }

    }



}
