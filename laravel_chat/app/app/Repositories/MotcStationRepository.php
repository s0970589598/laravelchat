<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\MotcStation;

class MotcStationRepository
{
    public function motcStationList($params)
    {
        $motc_sation = MotcStation::where('status','1')
        ->leftJoin('motc_open','motc_station.sn','=','motc_open.service')
        ->orderBy('sn', 'asc');

        if(isset($params['station_name'])) {
            $motc_sation->whereIn('station_name', $params['station_name']);
        }

        if(isset($params['station_name'])) {
            $motc_sation->whereIn('station_name', $params['station_name']);
        }

        if(isset($params['domain_alias'])) {
            $motc_sation->where('domain_alias', $params['domain_alias']);
        }

        if(isset($params['limit'])) {
            return $motc_sation->paginate($params['limit']);
        } else {
            return $motc_sation->get();

        }

    }



}
