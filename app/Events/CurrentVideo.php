<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CurrentVideo implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
    * Video web adress
    * 
    * @var string
    */
    public $url;
    
    /**
    * Seconds, when video was uploaded to room to current time
    * 
    * @var int
    */
    public $diff;
    
    /**
    * Room ID
    * 
    * @var string
    */
    public $roomID;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($url, $diff, $roomID)
    {
        $this->url = $url;
        $this->diff = $diff;
        $this->roomID = $roomID;
    }

    /**
     * Channel to define current video in room
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('currentVideo-room.'.$this->roomID);
    }
}
