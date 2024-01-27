<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RCWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $event_type = $request['event']['type'];
        $rc_user_id = $request["event"]["app_user_id"];
        $expires_at = $request["event"]["expiration_at_ms"];
        $user_id = explode("revenucat_", $rc_user_id)[1];

        $user = User::find($user_id);
        $user?->update(['subscription_expires_at' => Carbon::createFromTimestampMs($expires_at)]);

        return response()->json(["message" => "OK"]);
    }
}
