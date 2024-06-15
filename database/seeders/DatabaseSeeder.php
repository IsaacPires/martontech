<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run()
        {
                (new UsersTableSeeder())->run();
                (new SuppliersTableSeeder())->run();
                (new ProductsTableSeeder())->run();
                (new EntryTableSeeder())->run();
                (new sale_products())->run();
        }
}
