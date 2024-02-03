<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class VerifyOTP implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $email = request()->input('email');

        $token = DB::table('password_reset_tokens')->where('email', $email)->first();

        if($token){
            if($token->token != $value){
                $fail("Invalid OTP!");
            }else if(Carbon::parse($token->created_at)->addMinutes(30)->lt(Carbon::now())){
                $fail("OTP expired!");
            }
        }else{
            $fail("Please try again later!");
        }
    }
}
