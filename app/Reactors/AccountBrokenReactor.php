<?php

namespace App\Reactors;

use App\Events\BrokenMailSent;
use App\Events\MoneySubtracted;
use App\Notifications\AccountBroken;
use App\Services\AccountService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Spatie\EventSourcing\EventHandlers\Reactors\Reactor;

class AccountBrokenReactor extends Reactor implements ShouldQueue
{
    public function onMoneySubtracted(MoneySubtracted $event)
    {
        $account = AccountService::uuid($event->uuid);

        if (AccountService::isBroken($account) && ! $account->broken_mail_sent) {
            Notification::route('mail', [Auth::user()->email => Auth::user()->name])
                ->notify(new AccountBroken());

            event(new BrokenMailSent($account->uuid));
        }
    }
}
