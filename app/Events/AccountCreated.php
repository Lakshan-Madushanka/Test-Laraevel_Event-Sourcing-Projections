<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class AccountCreated extends ShouldBeStored
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public ?array $accountAttributes;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(?array $attributes)
    {
        $this->accountAttributes = $attributes;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
