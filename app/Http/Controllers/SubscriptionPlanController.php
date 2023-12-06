<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Http\Requests\StoreSubscriptionPlanRequest;
use App\Http\Requests\UpdateSubscriptionPlanRequest;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\StripeClient;

class SubscriptionPlanController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(SubscriptionPlan::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptionPlans = SubscriptionPlan::all();
        return response()->json($subscriptionPlans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionPlanRequest $request)
    {
        $subscriptionPlan = SubscriptionPlan::create($request->validated());

        return response()->json($subscriptionPlan);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscriptionPlan $subscriptionPlan)
    {
        return response()->json($subscriptionPlan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionPlanRequest $request, SubscriptionPlan $subscriptionPlan)
    {
        $subscriptionPlan->update($request->validated());

        return response()->json($subscriptionPlan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscriptionPlan $subscriptionPlan)
    {
        $subscriptionPlan->delete();

        return response()->json($subscriptionPlan);
    }

    public function createCheckoutLink(SubscriptionPlan $subscriptionPlan){
        if(\Auth::user()->subscribed()){
             return \Auth::user()->billingPortalUrl("https://koalabooks.de");
        }

        $session = \Auth::user()->newSubscription('default', $subscriptionPlan->st_price)
            ->trialDays($subscriptionPlan->trial_days)
            ->checkout([
            'success_url' => 'https://koalabooks.de/dankeschoen-seite',
            'cancel_url' => 'https://koalabooks.de/zahlung-fehlgeschlagen',
        ])->asStripeCheckoutSession();

        /*
        todo if the user already subscribed before send him portal link instead of checkout link
        */

        return response()->json(['checkout_link' => $session->url]);
    }
}
