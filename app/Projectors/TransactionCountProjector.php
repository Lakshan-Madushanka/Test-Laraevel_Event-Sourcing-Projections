<?php

namespace App\Projectors;

use App\Events\MoneyAdded;
use App\Events\MoneySubtracted;
use App\Models\TransactionCount;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class TransactionCountProjector extends Projector
{
    public function onMoneyAdded(MoneyAdded $event)
    {
        $this->record($event->uuid);
    }

    public function onMoneySubtracted(MoneySubtracted $event)
    {
        $this->record($event->uuid);
    }

    public function record(string $accountId)
    {
        $transactionCounter = TransactionCount::firstOrCreate(['account_uuid' => $accountId]);

        $transactionCounter->count += 1;

        $transactionCounter->save();
    }
}
