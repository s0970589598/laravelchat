<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // 一般訊息  msg
    // 圖片/檔案 file
    // 貼圖     stickers
    // 訊息範本  msgtem
    // 媒體庫    media

    protected $fillable = [
        'message',
        'room_id',
        'sender_id',
        'type',
    ];

    public function room()
    {
        return $this->hasOne(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
