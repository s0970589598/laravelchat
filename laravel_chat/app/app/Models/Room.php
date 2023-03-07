<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    const AI_CUSTOMER_SERVICE    = 1; // 智能客服
    const WAIT_CUSTOMER_SERVICE  = 2; // 待客服
    const IN_CUSTOMER_SERVICEING = 3; // 客服中
    const OVERDUE_NO_REPLY       = 4; // 逾期未回覆
    const REFERRALS              = 5; // 客服轉介
    const COMPLETED              = 6; // 已完成
    const WAIT_CONNACT           = 7; // 待聯絡

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
