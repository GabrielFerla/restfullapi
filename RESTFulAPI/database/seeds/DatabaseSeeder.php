<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Category;
use App\Product;
use App\Transaction;
use App\Registro;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       DB::statement ('SET FOREIGN_KEY_CHECKS = 0'); 

     

       $userQuantity = 1000;
       $categoriesQuantity = 30;
       $productsQuantity = 1000;
       $transactionsQuantity = 1000;

       factory(User::class, $userQuantity)->create();
       factory(Product::class, $productsQuantity)->create();
       factory(Registro::class, $userQuantity)->create();

    }
}
