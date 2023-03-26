<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class MotcStation extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'motc_station';

    const ENABLE  = 1;
    const NONABLE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sn',
        'domain_alias',
        'station_name',
        'area',
        'city',
        'contact_name',
        'contact_email',
        'contact_phone',
        'contact_address',
        'latitude',
        'longitude',
        'status',
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

    protected $guarded = ['updated_at'];

    public function service_relation()
    {
        return $this->belongsToMany(ServiceRelationRole::class, 'customer_service_relation_role');
    }

    public function getUpdatedAtColumn() {
        return null;
    }

}
