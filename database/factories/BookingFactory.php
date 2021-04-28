<?php

namespace Database\Factories;

use App\Models\Booking;
use Carbon\Carbon; // date-time library
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();
        $from = Carbon::instance($faker->dateTimeBetween('-1 months', '+1 months')); //generise radnom datum od mesec pre i mesec posel
        $to = (clone $from)->addDays(random_int(0, 14)); // najkrace ostaje 1 dan a najduze 15 dana

        return [
            'from' => $from,
            'to' => $to
        ];
    }
}
