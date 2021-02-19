<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Buyer;
use App\Traits\AdminActions;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuyerPolicy
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


    public function view(User $user, Buyer $buyer)          //policy method (view) -> controller method (index)
    {
        return $user->id === $buyer->id;
    }

    public function purchase(User $user, Buyer $buyer)      //policy method (delete) -> controller method (destroy)
    {
        return $user->id === $buyer->id;
    }
}
