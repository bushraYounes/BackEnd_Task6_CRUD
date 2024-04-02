<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index()
    {
        try {
            $books = Book::all();
            return response()->json([
                'status' => 'success',
                'books' => $books
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => 'failed',
                'error' => $th
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {

        try {
            DB::beginTransaction();
            $book = Book::create([
                'title' => $request->title,
                'author' => $request->author,
                'volume' => $request->volume,
                'ISBN' => $request->ISBN,
                'edition' => $request->edition,
                'publication_year' => $request->publication_year,
                'publication_house' => $request->publication_house,
                'price' => $request->price
            ]);

            DB::commit();
            return response()->json([
                'statuse' => 'Store Success',
                'book' => $book
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return response()->json([
                'statuse' => 'Store Failed',
                'error' => $th
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json([
            'statuse' => 'Show success',
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        try {
            DB::beginTransaction();

            $newData = [];

        if ($request->filled('title')) {
            $newData['title'] = $request->title;
        }

        if ($request->filled('author')) {
            $newData['author'] = $request->author;
        }

        if ($request->filled('volume')) {
            $newData['volume'] = $request->volume;
        }

        if ($request->filled('edition')) {
            $newData['edition'] = $request->edition;
        }

        if ($request->filled('publication_year')) {
            $newData['publication_year'] = $request->publication_year;
        }

        if ($request->filled('publication_house')) {
            $newData['publication_house'] = $request->publication_house;
        }

        if ($request->filled('price')) {
            $newData['price'] = $request->price;
        }
        if ($request->filled('ISBN')) {
            $newData['ISBN'] = $request->price;
        }

        $book->update($newData);

        DB::commit();

        return response()->json([
            'status' => 'Update success',
            'book' => $book
        ]);
            
        } catch (\Throwable $th) {

            DB::rollBack();
            Log::error($th);
            return response()->json([
                'statuse' => 'Update Failed',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            $book->delete();
            return response()->json([
                'status' => 'Delete Success',
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => 'Delete Failed',
    
            ]);
        }
       
    }
}
