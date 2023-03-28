<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class MotcOpen extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'motc_open';


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'service',
        'sun_open_hour',
        'sun_close_hour',
        'mon_open_hour',
        'mon_close_hour',
        'tue_open_hour',
        'tue_close_hour',
        'wed_open_hour',
        'wed_close_hour',
        'thu_open_hour',
        'thu_close_hour',
        'fri_open_hour',
        'fri_close_hour',
        'sat_open_hour',
        'sat_close_hour',
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
