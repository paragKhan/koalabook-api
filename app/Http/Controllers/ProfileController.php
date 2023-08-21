<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile(){
        return response()->json(auth()->user());
    }

    public function updateProfile(UpdateUserRequest $request){
        auth()->user()->update($request->validated());

        if ($request->has('image')) {
            auth()->user()->clearMediaCollection();
            auth()->user()->addMediaFromRequest('image')->toMediaCollection();
        }

        return response()->json(auth()->user());
    }
}
