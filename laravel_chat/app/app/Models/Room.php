<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'status',
        'service_id',
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
