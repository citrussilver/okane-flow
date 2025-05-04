<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopeePayRequest;
use App\Http\Resources\ShopeePayResource;
use App\Models\ShopeePay;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopeePayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('ShopeePay/Index', [
            'shopee_pays' => ShopeePayResource::collection(ShopeePay::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('ShopeePay/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShopeePayRequest $request, ShopeePay $shopee_pays)
    {
        $shopee_pays->create($request->validated());

        return redirect()->route('shopee-pays.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShopeePay $shopee_pay)
    {
        return Inertia::render('ShopeePay/Show', [
            'shopee_pay' => ShopeePayResource::make($shopee_pay)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShopeePay $shopee_pay)
    {
        return Inertia::render('ShopeePay/Edit', [
            'shopee_pay' => ShopeePayResource::make($shopee_pay)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShopeePayRequest $request, ShopeePay $shopee_pay)
    {
        $shopee_pay->create($request->validated());

        return redirect()->route('shopee-pays.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShopeePay $shopee_pay)
    {
        $shopee_pay->delete();

        return back();
    }
}
