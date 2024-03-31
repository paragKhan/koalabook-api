<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Mail\SendPasswordResetOTP;
use App\Models\User;
use App\Rules\VerifyOTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function userRegister(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->assignRole('user');

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

    public function sendUserPasswordResetOTP(Request $request)
    {
        $request->validate([
            "email" => 'required|email|exists:users'
        ]);

        $email = $request->email;
        $otp = "";
        for($i = 0; $i < 6; $i++){
            $otp .= rand(1, 9);
        }

        DB::table('password_reset_tokens')->updateOrInsert(["email" => $email], [
            "token" => $otp,
            "created_at" => now()
        ]);

        Mail::to($email)->send(new SendPasswordResetOTP( $otp));

        return response()->json(["message" => "OTP sent at " . $email]);
    }

    public function verifyUserPasswordResetOTP(Request $request)
    {
        $request->validate([
           'email' => 'required|email|exists:users',
           'otp' => ['required', 'string', new VerifyOTP()]
        ]);

        return response()->json(['message' => "The OTP is valid."]);
    }

    public function resetUserPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'otp' => ['required', 'string', new VerifyOTP()],
            'password' => 'required|string|min:6|max:50'
        ]);

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->latest()->first();
        $user->update(['password' => Hash::make($password)]);

        DB::table('password_reset_tokens')->where('email', $email)->latest()->first()->delete();

        return response()->json(['message' => 'Password reset successful!']);
    }
}
