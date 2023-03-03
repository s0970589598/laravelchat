<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    const AI_CUSTOMER_SERVICE    = 1;
    const WAIT_CUSTOMER_SERVICE  = 2;
    const IN_CUSTOMER_SERVICEING = 3;
    const OVERDUE_NO_REPLY       = 4;
    const REFERRALS              = 5;
    const COMPLETED              = 6;
    const WAIT_CONNACT           = 7;

    protected $fillable = [
        'name',
        'status',
        'service',
        'score',
        'code',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_rooms');
    }

    public function services()
    {
        return $this->belongsToMany(CustomerService::class, 'customer_service');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
