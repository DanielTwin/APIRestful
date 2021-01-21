<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Transaction;
use App\Traits\AdminActions;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization, AdminActions;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Transaction $transaction)
    {
        return $user->id === $transaction->buyer->id || $user->id === $transaction->product->seller->id;
    }
}
