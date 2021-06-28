<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function show($id)
    {
        return new ReviewResource(Review::findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|size:36|unique:reviews',
            'content' => 'required|min:2',
            'rating' => 'required|in:1,2,3,4,5'
        ]);

        $booking = Booking::findByReviewKey($data['id']);

        if (null === $booking) {
            return abort(404);
        }

        $booking->review_key = '';
        $booking->save();

        $review = Review::make($data);
        $review->booking_id = $booking->id;
        $review->bookable_id = $booking->bookable_id;
        $review->save();

        return new ReviewResource($review);
    }

    public function getReviewSQL($id)
    {
        $review = DB::table('users')
        ->join('addresses', 'users.id', '=', 'addresses.user_id')
        ->join('bookings', 'bookings.address_id', '=', 'addresses.id')
        ->join('reviews', 'reviews.id', '=', 'bookings.reviews_key')
        ->select('reviews.id')
        ->where('users.id', '=', $id)
        ->get();

        return $review;
    }

 
  
}
