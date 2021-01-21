<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Policies\UserPolicy;
use App\Policies\BuyerPolicy;
use App\Policies\SellerPolicy;
use Laravel\Passport\Passport;
use App\Policies\ProductPolicy;
use App\Policies\TransactionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Buyer::class => BuyerPolicy::class,
        Seller::class => SellerPolicy::class,
        User::class => UserPolicy::class,
        Transaction::class => TransactionPolicy::class,
        Product::class => ProductPolicy::class,
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-action', function ($user) {
            return $user->isAdministator();
        });

        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addMinutes(30));    //get the exact date with the Carbon library, and allow the tokens to be valid for the desired time by means of the addMinutes, Hours or Seconds methods
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        Passport::enableImplicitGrant();

        //
        Passport::tokensCan([
            'purchase-product' => 'Crear transacciones para comprar productos determinados',
            'manage-products' => 'Crear, ver, actualizar y eliminar productos',
            'manage-account' => 'Obtener la informacion de la cuenta, nombre, email, estado (sin contraseña), modificar datos como email, nombre y contraseña. No puede eliminar la cuenta',
            'read-general' => 'Obtener información general, categorías donde se compra y se vende, productos vendidos o comprados, transacciones, compras y ventas',
        ]);
    }
}
