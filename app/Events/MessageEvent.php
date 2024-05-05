<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public string $message;
    public $sender_id, $receiver_id;
    public function __construct($content, $sender_id, $receiver_id)
    {

        $this->message = $content; // Initialize the $message property
        $this->receiver_id = $receiver_id;
        $this->sender_id = $sender_id;
    
        // Save the message to the database or perform any other necessary operations
        $message = new Message();
        $message->message = $content;
        $message->receiver_id = $receiver_id;
        $message->sender_id = $sender_id;
        $message->save();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PrivateChannel('livewire_chatapp');
    }
}
