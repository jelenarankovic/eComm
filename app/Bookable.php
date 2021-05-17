<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;


class Bookable extends Model
{
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function availableFor($from, $to): bool
    {
        return 0 === $this->bookings()->betweenDates($from, $to)->count();
    }

    public function pricefor($from, $to): array
    {
        $days = (new Carbon($from))->diffInDays(new Carbon($to)) + 1;
        $price = $days * $this->price;

        return [
            'total' => $price,
            'breakdown' => [
                $this->price => $days
            ]
        ];
    }

    protected $dataTableColumns = [
        'id' => [
            'search_term' => false,
        ],
        'title' => [
            'search_term' => true,
        ],
        'description' => [
            'search_term' => true,
        ],
        'price' => [
            'search_term' => true,
        ]
    ];
}
