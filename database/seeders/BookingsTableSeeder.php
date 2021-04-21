<?php

namespace Database\Seeders;
use App\Models\Bookable;
use App\Models\Booking;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon; // date-time library
use Database\Factories\BookingFactory;
class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bookable::all()->each(function (Bookable $bookable){
            // $booking = factory(Booking::class)->make(); // ovo pravi booking model na osnovu onog iz faktorija
            // $booking = new BookingFactory(); // ovo pravi booking model na osnovu onog iz faktorija
            // $booking->definition();
            /* OK OVAKO CEMO
                ne treba facotry opet, vec napravimo faker u okviru ovog seeder-a
                i tu mu izgenerisemo vrednosti i te vrednosti dodelimo objektu booking
                onda odredimo neki random broj (20) za for petlju i za svaki buking 
                ponovo damo random vrednosti za from i to na osnovu onih iz faker-a? idk iskreno sto smo ovako odradili bas
                ubacimo booking u kolekciju bookings
                na kraju napravimo konekciju one to many izmedju bookable i booking
                i ubacimo sve sto smo izgenerisali
                */
            $faker = Faker::create();
            $from = Carbon::instance($faker->dateTimeBetween('-1 months', '+1 months')); //generise radnom datum od mesec pre i mesec posel
            $to = (clone $from)->addDays(random_int(0, 14)); // najkrace ostaje 1 dan a najduze 15 dana
            $booking = new Booking();
            $booking->from = $from;
            $booking->to = $to;
            $bookings = collect([$booking]); // kolekcija booking objekata
            for($i=0; $i<random_int(1,20); $i++){
                $from = (clone $booking->to)->addDays(random_int(1,14));// sledeci booking pocinje barem 1 dan nakon sto se prethodni zavrsio
                $to = (clone $from)->addDays(random_int(0,14));//1-14 dana traje booking
                $booking = Booking::make([
                    //ubacujemo vrednosti
                    'from'=>$from,
                    'to'=>$to
                ]);
                $bookings->push($booking);
            }
            $bookable->bookings()->saveMany($bookings);
            //php artisan migrate:refresh --seed
            //ili ovo php artisan db:seed --class=BookingsTableSeeder
        });
    }
}