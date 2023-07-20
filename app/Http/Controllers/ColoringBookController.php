<?php

namespace App\Http\Controllers;

use App\Models\ColoringBook;
use App\Http\Requests\StoreColoringBookRequest;
use App\Http\Requests\UpdateColoringBookRequest;

class ColoringBookController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ColoringBook::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = ColoringBook::paginate(20);

        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColoringBookRequest $request)
    {
        $book = ColoringBook::create($request->except('categories'));

        $book->attachTags(explode(',', $request->input('categories')));
        $book->addMediaFromRequest('image')->toMediaCollection();

        return response()->json($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(ColoringBook $coloringBook)
    {
        return response()->json($coloringBook);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColoringBookRequest $request, ColoringBook $coloringBook)
    {
        $coloringBook->update($request->except('categories'));

        if ($request->has('categories')) {
            $coloringBook->syncTags(explode(',', $request->input('categories')));
        }

        if($request->has('image')){
            $coloringBook->clearMediaCollection();
            $coloringBook->addMediaFromRequest('image')->toMediaCollection();
        }

        return response()->json($coloringBook);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ColoringBook $coloringBook)
    {
        $coloringBook->delete();

        return response()->json($coloringBook);
    }
}
