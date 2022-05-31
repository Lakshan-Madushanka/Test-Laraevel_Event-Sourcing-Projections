@push('css')
<style>
    .history-wrapper {
        height: 100vh;
        overflow: auto;
    }

</style>
@endpush

<div class="container">
    <div class="row">
        <div class="col-md justify-content-center ps-5 my-2">
            @if(! $account)
                <form method="post" action="{{route('users.accounts.store')}}">
                    @csrf
                    <div class="form-group ">
                        <label for="name" class="mb-3">Account name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               aria-describedby="nameHelp" placeholder="Enter name" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Create Account</button>
                </form>
            @else
                <ul class="list-group  my-5">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Account Name
                        <span>{{$account->name}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Account Created At
                        <span>{{$account->created_at->toDayDateTimeString()}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Account Balance
                        <span>{{$account->balance}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        No of transactions
                        <span>{{$transactionCount}}</span>
                    </li>
                </ul>

                <form method="post" action="{{route('users.accounts.addMoney')}}">
                    @csrf
                    <div class="form-group ">
                        <label for="name" class="mb-1">Amount</label>
                        <input type="number" class="form-control" id="name" name="amount"
                               aria-describedby="nameHelp" placeholder="Enter amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Deposit Money</button>
                </form>


                <form method="post" action="{{route('users.accounts.subtractMoney')}}">
                    @csrf
                    <div class="form-group ">
                        <label for="name" class="mb-1">Amount</label>
                        <input type="number" class="form-control" id="name" name="amount"
                               aria-describedby="nameHelp" placeholder="Enter amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Withdraw Money</button>
                </form>
            @endif
        </div>
        <div class="col-md">
            <ul class="list-group my-5 history-wrapper">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>Event</div>
                    <div>Amount</div>
                </li>
                    @forelse($history as $h)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>{{$h->event_class}} <small>({{$h->created_at->toDayDateTimeString()}})</small></div>
                            <span>{{$h->event_properties['amount']}}</span>
                        </li>
                    @empty
                        <li class="list-group-item d-flex justify-content-center align-items-center text-center">
                            No transactions
                        </li>
                    @endforelse
            </ul>
        </div>
    </div>
</div>