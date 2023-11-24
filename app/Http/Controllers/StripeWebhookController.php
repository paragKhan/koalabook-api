<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request){
        \Log::info($request->all());
    }
}
