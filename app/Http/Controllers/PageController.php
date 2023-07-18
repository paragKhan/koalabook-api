<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\ListeningBook;
use App\Models\Page;
use App\Models\StoryBook;
use App\Services\BeyondWords;

class PageController extends Controller
{
    public function __construct()
    {

    }

    private function getBook()
    {
        switch (request()->model_type) {
            case 'story-book':
                return StoryBook::findOrFail(request()->model_id);
            case 'listening-book':
                return ListeningBook::findOrFail(request()->model_id);
        }
    }

    public function store(StorePageRequest $request)
    {
        $page = $this->getBook()->pages()->create($request->validated());

        $page->addMediaFromRequest('image')->toMediaCollection();

        $page->retriveAudioUrl();

        return response()->json($page);
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return response()->json($page);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $page->update(array_merge($request->validated(), ['audio_url' => null]));

        if($request->has('image')){
            $page->clearMediaCollection();
            $page->addMediaFromRequest('image')->toMediaCollection();
        }

        $page->retriveAudioUrl();

        return response()->json($page);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return  response()->json($page);
    }
}
