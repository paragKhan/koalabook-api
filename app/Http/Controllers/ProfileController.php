<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;

class ProfileController extends Controller
{
    public function getProfile()
    {
        return response()->json(auth()->user());
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        auth()->user()->update($request->validated());

        if ($request->has('image')) {
            auth()->user()->clearMediaCollection();
            auth()->user()->addMediaFromRequest('image')->toMediaCollection();
        }

        return response()->json(auth()->user());
    }

    public function deleteProfile()
    {
        auth()->user()->delete();

        return response()->json(['message' => 'User account deleted']);
    }

    public function hasSubscription()
    {
        return response()->json(['subscribed' => auth()->user()->subscribed()]);
    }
}
