<?php

namespace App\Http\Controllers;

use App\Models\ColoringBook;
use App\Http\Requests\StoreColoringBookRequest;
use App\Http\Requests\UpdateColoringBookRequest;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class ColoringBookController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ColoringBook::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('c') && $request->c) {
            $books = ColoringBook::withAnyTagsOfAnyType([$request->c])->paginate(20)->withQueryString();
        } else {
            $books = ColoringBook::paginate(20)->withQueryString();
        }
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColoringBookRequest $request)
    {
        $book = ColoringBook::create($request->except('categories'));

        $trimmed = str_replace(' ', '', $request->categories);
        $tags = explode(',', $trimmed);
        $book->attachTags($tags, 'coloring-book');

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
            $trimmed = str_replace(' ', '', $request->categories);
            $tags = explode(',', $trimmed);
            $coloringBook->syncTagsWithType($tags, 'coloring-book');
        }

        if ($request->has('image')) {
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

    public function getCategories()
    {
        $categories = Tag::getWithType('coloring-book')->pluck('name');

        return response()->json($categories);
    }
}
