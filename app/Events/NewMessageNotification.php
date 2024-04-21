<?php
namespace App\Events;
use App\Models\Im;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewMessageNotification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $user1;
    public $user2;
    public $category;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($category,Im $message,$user1_id,$user2_id)
    {
        $this->category =$category;
        $this->message =$message->text;
        $this->user1 = User::where('id',$user1_id)->first();
        $this->user2 =$user2_id;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {

        return ['user.'.$this->user2];
    }
    public function broadcastAs()
    {
        return 'my-event';
    }
}
