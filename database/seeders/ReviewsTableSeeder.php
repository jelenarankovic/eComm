<?php

namespace Database\Seeders;
use App\Models\Bookable;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create();
        // 'id' => Str::uuid(),
        // 'content' => $faker->sentences(5, true),
        // 'rating' => random_int(1, 5),
        Bookable::all()->each(function (Bookable $bookable) {  //za svaki od bookable zelimo da napisemo random rivju
            // $review = factory(Review::class, random_int(5, 30))->make();
            $reviews = Review::factory(random_int(5, 30))->make();
            // Review::factory(Review::class, random_int(5, 30))->make()->saveMany();
            $bookable->reviews()->saveMany($reviews); 
        });
    }
}