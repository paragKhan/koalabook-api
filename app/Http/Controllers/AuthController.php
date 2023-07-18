<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function userRegister(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->assignRole('user');

        //todo: handle user image here

        //todo: send welcome email

        return response()->json(['message' => 'Registration successful.']);
    }


    public function userLogin(LoginRequest $request)
    {
        $credential = $request->only(['email', 'password']);

        if (auth()->attempt($credential) && auth()->user()->hasRole('user')) {
            $token = auth()->user()->createToken('api_token')->plainTextToken;
            $token = explode("|", $token)[1];
            return response()->json(['api_token' => $token, 'user' => auth()->user()]);
        }

        return response()->json(['message' => 'Invalid credentials.'], 401);
    }

    public function adminLogin(LoginRequest $request)
    {
        $credential = $request->only(['email', 'password']);

        if (auth()->attempt($credential) && auth()->user()->hasRole('admin')) {
            $token = auth()->user()->createToken('api_token')->plainTextToken;
            $token = explode("|", $token)[1];
            return response()->json(['api_token' => $token, 'user' => auth()->user()]);
        }

        return response()->json(['message' => 'Invalid credentials.'], 401);
    }
}
