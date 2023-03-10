<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\MotcStation;

class MotcStationRepository
{
    public function motcStationList()
    {
        $motc_sation = MotcStation::get();
        return $motc_sation;
    }

}
