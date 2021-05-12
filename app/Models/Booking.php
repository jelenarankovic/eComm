<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['from','to'];

    public function bookable()
    {
        return $this->belongsTo(Bookable::class); //ovo nam isto da ovaj booking pripada jednom bookablu
    }

    public function review(){
        return $this->HasOne(Review::class); //jedan booking moze da ima jedan rivju
    }
    
    public function address(){
        return $this->belongsTo(Address::class);
    }
    
    public function scopeBetweenDates(Builder $query, $from, $to){
        return $query->where('to', '>=', $from)
            ->where('from', '<=', $to);  //ovako smo sigurni da se reyervisanja ne preklapaju
    }

    protected static function boot(){
        parent::boot(); //moramo da pozovemo parent metodu iz modela
        static::creating(function($booking){
            $booking->review_key = Str::uuid();
        });
    }

    public static function findByReviewKey(string $reviewKey): ?Booking
    {
        return static::where('review_key', $reviewKey)->with('bookable')->get()->first();
        //ovo with jeeagerLoading, suprotno od lazy loadinga. Ovde se odmah fecuju relacije sa modelom
        //tako da umesto dva kverija imamo jedan. Znaci on ovde povuce i rivju i bookable za koji
        //je ostavljen taj rivju
    }
}
