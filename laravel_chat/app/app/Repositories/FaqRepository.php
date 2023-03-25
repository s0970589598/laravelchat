<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Faq;

class FaqRepository
{
    public function countUrlErr()
    {
        return Faq::where('status','0')
        ->where('is_err','1')
        ->count();
    }

}
