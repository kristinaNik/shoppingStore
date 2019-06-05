<?php
/**
 * Created by PhpStorm.
 * User: kristina
 * Date: 6/1/19
 * Time: 12:53 PM
 */
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 20)->create();
    }
}
