<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatMessageReceived implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    
    /**
    * Message from chat
    *
    * @var string
    */
    public $chatMessage;

    /**
    * User, which sending the message
    * 
    * @var User
    */
    public $user;
    
    /**
    * ID of room, where message was send
    * 
    * @var string
    */
    public $roomID;

    /**
     * Event for chat message
     *
     * @return void
     */
    public function __construct($chatMessage, $user, $roomID)
    {
        $this->chatMessage = $chatMessage;
        $this->user = $user;
        $this->roomID = $roomID;
    }


    /**
     * Channel for chat
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat-room.'.$this->roomID);
    }
}
