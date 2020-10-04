<?php

use Illuminate\Database\Seeder;
use App\Category;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(AdminsTableSeeder::class);
        // $this->call(SectionTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        // $this->call(UserSeeder::class);
    }
}
