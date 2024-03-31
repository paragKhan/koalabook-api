<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessCategories;
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
        $book->attachTags($tags, ColoringBook::class);

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
            ProcessCategories::dispatch($coloringBook->categories, ColoringBook::class)->afterResponse();
            $trimmed = str_replace(' ', '', $request->categories);
            $tags = explode(',', $trimmed);
            $coloringBook->syncTagsWithType($tags, ColoringBook::class);
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
        ProcessCategories::dispatch($coloringBook->categories, ColoringBook::class)->afterResponse();
        $coloringBook->delete();
        return response()->json(['message' => 'Coloring Book Deleted!']);
    }

    public function getCategories()
    {
        $categories = Tag::getWithType(ColoringBook::class)->pluck('name');

        return response()->json($categories);
    }
}
