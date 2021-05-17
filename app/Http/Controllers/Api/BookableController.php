<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bookable;
use App\Http\Resources\BookableIndexResource;
use App\Http\Resources\BookableShowResource;


class BookableController extends Controller
{
    public function index()
    {
        return BookableIndexResource::collection(
            Bookable::all()
        );
    }

    public function show($id)
    {
        return new BookableShowResource(Bookable::findOrFail($id));
    }

   // public function index1(Request $request)
    // {   
    //     $length = $request->input('length');
    //     $sortBy = $request->input('column');
    //     $orderBy = $request->input('dir');
    //     $searchValue = $request->input('search');
        
    //     $query = Bookable::eloquentQuery($sortBy, $orderBy, $searchValue);

    //     $data = $query->paginate($length);
        
    //     return new DataTableCollectionResource($data);
    // }
}
