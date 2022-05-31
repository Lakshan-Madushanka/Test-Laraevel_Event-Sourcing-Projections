<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class MoneyAdded extends ShouldBeStored
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public string $uuid;
    public float $amount;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $uuid, float $amount)
    {
        $this->amount = $amount;
        $this->uuid = $uuid;
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
