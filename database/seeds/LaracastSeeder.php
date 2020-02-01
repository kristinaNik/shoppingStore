<?php

use Illuminate\Database\Seeder;

class LaracastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Role::class, 1)->create();

      //  factory(App\Permission::class, 1)->create();
    }
}
