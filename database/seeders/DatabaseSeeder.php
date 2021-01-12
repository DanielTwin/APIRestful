<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        User::flushEventListeners();
        Category::flushEventListeners();
        Product::flushEventListeners();
        Transaction::flushEventListeners();

        $quantityUsers = 1000;
        $quantityCategories = 30;
        $quantityProducts = 1000;
        $quantityTransactions = 1000;


        \App\Models\User::factory($quantityUsers)->create();
        \App\Models\Category::factory($quantityCategories)->create();

		\App\Models\Product::factory($quantityTransactions)->create()->each(
			function ($product) {
				$categories = Category::all()->random(mt_rand(1, 5))->pluck('id');

				$product->categories()->attach($categories);
			}
		);        

        \App\Models\Transaction::factory($quantityTransactions)->create();

    }
}
