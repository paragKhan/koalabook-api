<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionPlanRequest;
use App\Http\Requests\UpdateSubscriptionPlanRequest;
use App\Policies\SubscriptionPlanPolicy;

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
}
