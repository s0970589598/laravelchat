<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\FrequentlyMsg;

class MsgsampleRepository
{
    public function countUrlErr()
    {
        return FrequentlyMsg::where('status','0')
        ->where('is_err','1')
        ->count();
    }

}
