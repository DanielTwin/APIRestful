<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Seller;
use App\Traits\AdminActions;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellerPolicy
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

    public function view(User $user, Seller $seller)
    {
        return $user->id === $seller->id;
    }

    public function sale(User $user, User $seller)
    {
        return $user->id === $seller->id;
    }

    public function editProduct(User $user, Seller $seller)
    {
        return $user->id ===$seller->id;
    }
    
    public function deleteProduct(User $user, Seller $seller)
    {
        return $user->id === $seller->id;
    }
}
