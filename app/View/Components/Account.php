<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Account extends Component
{
    public $account;
    public int $transactionCount;
    public Collection $history;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?\App\Models\Account $account, int $transactionCount, Collection $history)
    {
        $this->account = $account;
        $this->transactionCount = $transactionCount;
        $this->history = $history;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.account');
    }
}
