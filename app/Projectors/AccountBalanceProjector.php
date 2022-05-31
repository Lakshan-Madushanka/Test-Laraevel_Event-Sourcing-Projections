<?php

namespace App\Projectors;

use App\Events\AccountCreated;
use App\Events\BrokenMailSent;
use App\Events\MoneyAdded;
use App\Events\MoneySubtracted;
use App\Models\Account;
use App\Services\AccountService;
use Illuminate\Support\Facades\Auth;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class AccountBalanceProjector extends Projector
{
    public function onAccountCreated(AccountCreated $event)
    {
        $account = Account::create($event->accountAttributes);

        Auth::user()->account()->associate($account)->save();
    }

    public function onMoneyAdded(MoneyAdded $event)
    {
        $account = AccountService::uuid($event->uuid);

        $account->balance += $event->amount;

        if (! AccountService::isBroken($account) && $account->broken_mail_sent) {
            $account->broken_mail_sent = false;
        }

        $account->save();
    }

    public function onMoneySubtracted(MoneySubtracted $event)
    {
        $account = AccountService::uuid($event->uuid);

        $account->balance -= $event->amount;

        $account->save();
    }

    public function onBrokenMailSent(BrokenMailSent $event)
    {
        $account = AccountService::uuid($event->uuid);
        $account->broken_mail_sent = true;
        $account->save();
    }
}
