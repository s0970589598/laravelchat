<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SatisfactionSurvey extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'satisfaction_survey';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'service',
        'room_id',
        'point',
        'memo',
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

}
