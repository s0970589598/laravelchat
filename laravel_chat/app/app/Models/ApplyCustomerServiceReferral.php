<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ApplyCustomerServiceReferral extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'apply_customer_service_referral';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'assign_service',//指派
        'assigned_service',//被指派
        'room_id',
        'assign_reason',
        'status',
        'assign_id',//指派人
        'assigned_id',//被指派人
        'updater', //更新人
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

    public function service_relation()
    {
        return $this->belongsToMany(ServiceRelationRole::class, 'customer_service_relation_role');
    }

}
