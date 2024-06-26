<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessCategories;
use App\Models\StoryBook;
use App\Http\Requests\StoreStoryBookRequest;
use App\Http\Requests\UpdateStoryBookRequest;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class StoryBookController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(StoryBook::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('c') && $request->c) {
            $books = StoryBook::withAnyTagsOfAnyType([$request->c])->paginate(20)->withQueryString();
        } else {
            $books = StoryBook::paginate(20)->withQueryString();
        }

        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoryBookRequest $request)
    {
        $book = StoryBook::create($request->except('categories'));

        $trimmed = str_replace(' ', '', $request->categories);
        $tags = explode(',', $trimmed);
        $book->attachTags($tags, StoryBook::class);

        $book->addMediaFromRequest('cover_image')->toMediaCollection();

        return response()->json($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(StoryBook $storyBook)
    {
        return response()->json($storyBook);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoryBookRequest $request, StoryBook $storyBook)
    {
        $storyBook->update($request->except('categories'));

        if ($request->has('categories')) {
            ProcessCategories::dispatch($storyBook->categories, StoryBook::class)->afterResponse();
            $trimmed = str_replace(' ', '', $request->categories);
            $tags = explode(',', $trimmed);
            $storyBook->syncTagsWithType($tags, StoryBook::class);
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
        ProcessCategories::dispatch($storyBook->categories, StoryBook::class)->afterResponse();

        $storyBook->delete();

        return response()->json(['message' => 'Story Book Deleted!']);
    }

    public function getCategories()
    {
        $categories = Tag::getWithType(StoryBook::class)->pluck('name');

        return response()->json($categories);
    }
}
