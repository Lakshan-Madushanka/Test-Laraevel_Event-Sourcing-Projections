<?php

namespace App\Services;

use App\Events\AccountCreated;
use App\Models\Account;
use Illuminate\Support\Str;

class AccountService
{
    public static function createWithAttributes(array $attributes): Account
    {
        /*
         * Let's generate a uuid.
         */
        $attributes['uuid'] = (string) Str::uuid();

        /*
         * The account will be created inside this event using the generated uuid.
         */
        event(new AccountCreated($attributes));

        /*
         * The uuid will be used the retrieve the created account.
         */
        return self::uuid($attributes['uuid']);
    }

    public static function uuid(string $uuid): ?Account
    {
        return Account::where('uuid', $uuid)->first();
    }

    public static function isBroken(Account $account)
    {
        return $account->balance < 0;
    }
}
