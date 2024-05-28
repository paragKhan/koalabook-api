<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vouchers = Voucher::where('country', $request->ipinfo->country)->paginate(20);

        return response()->json($vouchers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoucherRequest $request)
    {
        $voucher = Voucher::create($request->validated());

        $voucher->addMediaFromRequest('image')->toMediaCollection();

        return response()->json($voucher);
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        return response()->json($voucher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        $voucher->update($request->validated());

        if ($request->has('image')) {
            $voucher->clearMediaCollection();
            $voucher->addMediaFromRequest('image')->toMediaCollection();
        }

        return response()->json($voucher);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();

        return response()->json($voucher);
    }
}
