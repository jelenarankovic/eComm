<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookableIndexResource;
use App\Http\Resources\BookableShowResource;
use App\Models\Bookable;
use Illuminate\Http\Request;
class BookableController extends Controller
{
    //php artisan make:controller Api/BookableController
    /* controller klasa se koristi da grupise sve api zahteve koji se odnose na jedan isti elem, 
        u ovom slucaju bookable */
    public function index() {
        // lista svih elem
        return BookableIndexResource::collection(
            Bookable::all()
        );
    }
    public function show($id) {
        // pokazi 1 elem
        return new BookableShowResource(Bookable::findOrFail($id));
    }
}
