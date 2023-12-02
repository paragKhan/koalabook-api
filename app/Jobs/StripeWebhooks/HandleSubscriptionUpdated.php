<?php

namespace App\Jobs\StripeWebhooks;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\Models\WebhookCall;

class HandleSubscriptionUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        $payload = $this->webhookCall->payload['data']['object'];

        $customer = User::whereStripeId($payload['customer'])->first();

        $data = [
            'name' => 'default',
            'stripe_id' => $payload['id'],
            'stripe_status' => $payload['status'],
            'stripe_price' => $payload['plan']['id'],
            'quantity' => 1,
            'ends_at' => $payload['current_period_end'],
            'trial_ends_at' => $payload['trial_end']
        ];

        $subscription = $customer->subscriptions()->where('stripe_id', $data['stripe_id'])->first();

        if ($subscription) {
            $subscription->update($data);
        } else {
            $customer->subscriptions()->create($data);
        }

        return true;
    }
}
