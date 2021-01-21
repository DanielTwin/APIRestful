<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use App\Traits\AdminActions;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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

    public function addCategory(User $user, Product $product)
    {
        return $user->id === $product->seller->id;
    }

    public function deleteCategory(User $user, Product $product)
    {
        return $user->id === $product->seller->id;
    }
}
