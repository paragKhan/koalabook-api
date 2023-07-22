<?php

namespace App\Http\Controllers;

use App\Models\ListeningBook;
use App\Http\Requests\StoreListeningBookRequest;
use App\Http\Requests\UpdateListeningBookRequest;
use Spatie\Tags\Tag;

class ListeningBookController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ListeningBook::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = ListeningBook::paginate(20);

        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListeningBookRequest $request)
    {
        $book = ListeningBook::create($request->except('categories'));

        $trimmed = str_replace(' ', '', $request->categories);
        $tags = explode(',', $trimmed);
        $book->attachTags($tags, 'listening-book');

        $book->addMediaFromRequest('cover_image')->toMediaCollection();

        return response()->json($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(ListeningBook $listeningBook)
    {
        return response()->json($listeningBook->load('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListeningBookRequest $request, ListeningBook $listeningBook)
    {
        $listeningBook->update($request->except('categories'));

        if($request->has('categories')){
            $trimmed = str_replace(' ', '', $request->categories);
            $tags = explode(',', $trimmed);
            $listeningBook->syncTagsWithType($tags, 'listening-book');
        }

        if($request->has('cover_image')){
            $listeningBook->clearMediaCollection();
            $listeningBook->addMediaFromRequest('cover_image')->toMediaCollection();
        }

        return response()->json($listeningBook);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListeningBook $listeningBook)
    {
        $listeningBook->delete();

        return response()->json($listeningBook);
    }

    public function getCategories(){
        $categories = Tag::getWithType('listening-book')->pluck('name');

        return response()->json($categories);
    }
}
