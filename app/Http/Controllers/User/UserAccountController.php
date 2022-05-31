<?php

namespace App\Http\Controllers\User;

use App\Events\MoneyAdded;
use App\Events\MoneySubtracted;
use App\Http\Controllers\Controller;
use App\Models\StoredEvent;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class UserAccountController extends Controller
{
    public function index()
    {
        $account = Auth::user()->account;
        $transactionCount = 0;
        $history = collect([]);

        if ($account) {
            $transactionCount = $account->transactionCount()->value('count');

            $history = StoredEvent::query()
                ->history($account->uuid)
                ->get();
        }

        return view('dashboard', [
            'account' => $account,
            'transactionCount' => $transactionCount ?? 0,
            'history' => $history ?? null,
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->only('name');

        if (Auth::user()->account()->exists()) {
            session()->flash('status', ['type' => 'warning', 'message' => 'Account Exists']);

            return redirect()->back();
        }

        $account = AccountService::createWithAttributes($attributes);

        session()->flash('status', ['type' => 'success', 'message' => 'AccountService created']);

        return redirect()->route('dashboard');
    }

    public function addMoney(Request $request)
    {
        $account = Auth::user()->account;

        Event::dispatch(new MoneyAdded($account->uuid, abs($request->amount)));

        session()->flash('status', ['type' => 'success', 'message' => 'Money Deposited']);

        return redirect()->route('dashboard');
    }

    public function subtractMoney(Request $request)
    {
        $account = Auth::user()->account;

        Event::dispatch(new MoneySubtracted($account->uuid, abs($request->amount)));

        session()->flash('status', ['type' => 'success', 'message' => 'Money Withdrew']);

        return redirect()->route('dashboard');
    }
}
