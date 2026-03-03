<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct() {}


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $books = Book::query();

        $this->authorize('viewAny', Book::class);


        $books = Book::when($request->has('title'), function ($query) {
            $query->where('title', 'like', '%' . request()->input('title') . '%');
        })->when($request->has('isbn'), function ($query) {
            $query->where('isbn', 'like', '%' . request()->input('isbn') . '%');
        })->when($request->has('is_available'), function ($query) {
            $query->where('is_available', request()->input('is_available'));
        });


        // if(request()->has('title')){
        //     $books->where('title', 'like', '%'.request()->input('title').'%');
        // }
    
        // if(request()->has('isbn')){
        //     $books->where('isbn', 'like', '%'.request()->input('isbn').'%');
        // }

        // if(request()->has('is_available')){
        //     $books->where('is_available', request()->input('is_available'));
        // }

        $books = $books->paginate(request()->input('per_page', 10));

        return response()->json(BookResource::collection($books));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
