<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Cache;
use Illuminate\Support\Facades\Cookie;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'authcode',
        'phone',
        'line',
        'contact_email',
        'note',
        'point',
        'is_offline',
        'last_seen'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'users_rooms');
    }

    public function service_relation()
    {
        return $this->belongsToMany(CustomerServiceRelationRole::class, 'customer_service_relation_role');
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        Log::info('test');
        Log::info($token);
        $mail = Cookie::get('em');
        Log::info('1'. cookie::get('isAdd'));

        $data = Cache::get($mail);

        if($data) {
                $this->notify( new \App\Notifications\CustomNewUserResetPasswordNotification($token));
                Cache::forget($mail);
        } else {
                $this->notify( new \App\Notifications\CustomResetPasswordNotification($token));
                Cache::forget($mail);
        }
    }

}
