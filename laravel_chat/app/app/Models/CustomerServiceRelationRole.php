<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CustomerServiceRelationRole extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'customer_service_relation_role';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'service',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
    ];

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'users');
    // }

    // public function services()
    // {
    //     return $this->belongsToMany(Customerservice::class, 'customer_service');
    // }

}
