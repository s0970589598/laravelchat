<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLoggedOut
{
    use SerializesModels;

    public $user;
    public $ip;
    public $device;
    public $logoutTime;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $ip, $device, $logoutTime)
    {
        $this->user = $user;
        $this->ip = $ip;
        $this->device = $device;
        $this->logoutTime = $logoutTime;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
