<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookable extends Model
{
    use HasFactory;

    public function bookings()
    {
        return $this->HasMany(Booking::class); //ovo nam isto govori da je one to many
    }

    public function reviews(){
        return $this->HasMany(Review::class);
    }

    public function availableFor($from, $to):bool{
        return 0 === $this->bookings()->betweenDates($from, $to)->count();  //ovaj count nam vraca 1 ako je objekat rezervisan za datume za koje pitamo iz forme
                                                                            //a funkcija nam vraca da li je jednako nuli, onda je slobodno, ako je false onda je zauzeto
    }
}
