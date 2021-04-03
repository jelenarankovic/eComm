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
       $this->call(BookablesTableSeeder::class);
       //ova BookablesTableSeeder kalasa je na istom nivou kao DBSeeder pa nmr da se importuje
    }
}
