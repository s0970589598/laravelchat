<?php
namespace App\Events;

use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $status;
    public $timestamp;

    public function __construct(User $user, $status)
    {
        $this->user = $user;
        $this->status = $status;
        $this->timestamp = now();
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->user->id);
    }
}
