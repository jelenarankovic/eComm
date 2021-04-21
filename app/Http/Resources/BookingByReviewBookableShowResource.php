<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingByReviewBookableShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //ovu klasu koristimo za serijalizaciju bookable kada hocemo da je dobijemo u 
        //BookingByReviewShowResource
        return [
            'bookable_id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description
        ];
    }
}
