<?php

namespace Database\Seeders;

use App\Models\Bookable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class BookablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 50) as $value) {
            DB::table('bookables')->insert([
                'title' => $faker->city . ' ' . Arr::random([
                    'Villa',
                    'House',
                    'Cottage',
                    'Luxury Villas',
                    'Cheap House',
                    'Rooms',
                    'Cheap Rooms',
                    'Luxury Rooms',
                    'Fancy Rooms'
                ]),
                'description' => $faker->text(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        // Bookable::factory(Bookable::class, 100)->create();
    }
}
