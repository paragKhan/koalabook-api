<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessCategories;
use App\Models\ListeningBook;
use App\Http\Requests\StoreListeningBookRequest;
use App\Http\Requests\UpdateListeningBookRequest;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        if ($request->has('c') && $request->c) {
            $books = ListeningBook::withAnyTagsOfAnyType([$request->c])->paginate(20)->withQueryString();
        } else {
            $books = ListeningBook::paginate(20)->withQueryString();
        }

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
        $book->attachTags($tags, ListeningBook::class);

        $book->addMediaFromRequest('cover_image')->toMediaCollection();

        return response()->json($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(ListeningBook $listeningBook)
    {
        return response()->json($listeningBook);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListeningBookRequest $request, ListeningBook $listeningBook)
    {
        $listeningBook->update($request->except('categories'));

        if($request->has('categories')){
            ProcessCategories::dispatch($listeningBook->categories, ListeningBook::class)->afterResponse();
            $trimmed = str_replace(' ', '', $request->categories);
            $tags = explode(',', $trimmed);
            $listeningBook->syncTagsWithType($tags, ListeningBook::class);
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
        ProcessCategories::dispatch($listeningBook->categories, ListeningBook::class)->afterResponse();

        $listeningBook->delete();
        return response()->json(['message' => 'Listening Book Deleted!']);
    }

    public function getCategories(){
        $categories = Tag::getWithType(ListeningBook::class)->pluck('name');

        return response()->json($categories);
    }
}
