<?php

namespace App\Http\Controllers;

use App\Models\StoryBook;
use App\Http\Requests\StoreStoryBookRequest;
use App\Http\Requests\UpdateStoryBookRequest;

class StoryBookController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(StoryBook::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = StoryBook::paginate(20);

        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoryBookRequest $request)
    {
        $book = StoryBook::create($request->except('categories'));

        $book->attachTags(explode(',', $request->input('categories')), "kids-book");

        $book->addMediaFromRequest('cover_image')->toMediaCollection();

        return response()->json($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(StoryBook $storyBook)
    {
        return response()->json($storyBook->load('pages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoryBookRequest $request, StoryBook $storyBook)
    {
        $storyBook->update($request->except('categories'));

        if ($request->has('categories')) {
            $storyBook->syncTagsWithType(explode(',', $request->input('categories')), 'kids-book');
        }

        if ($request->has('cover_image')) {
            $storyBook->clearMediaCollection();
            $storyBook->addMediaFromRequest('cover_image')->toMediaCollection();
        }

        return response()->json($storyBook);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoryBook $storyBook)
    {
        $storyBook->delete();

        return response()->json($storyBook);
    }
}
