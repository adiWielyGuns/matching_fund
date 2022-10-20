<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $id;
    public $order;

    public function __construct($id, $order)
    {
        $this->id = $id;
        $this->order = $order;
    }

    public function broadcastOn()
    {
        return new Channel('orders.' . $this->id);
    }

    public function broadcastWith()
    {
        return [
            'order' => $this->order,
            'id' => $this->id,
        ];
    }

    public function broadcastAs()
    {
        return 'order';
    }
}
