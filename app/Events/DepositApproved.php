<?php

namespace App\Events;

use App\Models\MemberTransaction;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DepositApproved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public MemberTransaction $memberTransaction;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($memberTransaction)
    {
        $this->memberTransaction = $memberTransaction;
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
