<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'content', 'rating'];

    public function bookable(){
        return $this->belongsTo(Bookable::class); //:: omogucava staticki pristup, u ovom slucaju pristupamo klasi a ne objektu 
    }

    public function booking(){
        return $this->belongsTo(Bookable::class);
    }
    
    public function getIncrementing(){
        return false;
    }

    public function getKeyType(){
        return 'string';
    }
}
