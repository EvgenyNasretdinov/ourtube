<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewVideoAdded implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * Event, when user adds the video
     *
     * @return void
     */

    /**
    * Video url
    * 
    * @var string
    */
    public $videoMessage;
    
    /**
    * Current room ID
    * 
    * @var string
    */
    public $roomID;

    public function __construct($videoMessage, $roomID)
    {
        $this->videoMessage = $videoMessage;
        $this->roomID = $roomID;
    }

    /**
     * Channel to send new video url 
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('script-room.'.$this->roomID);
    }
}
