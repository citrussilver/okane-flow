<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopeePayTransactionRequest;
use App\Http\Resources\ShopeePayResource;
use App\Http\Resources\ShopeePayTransactionResource;
use App\Models\ShopeePay;
use App\Models\ShopeePayTransaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopeePayTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('ShopeePayTransaction/Index', [
            'shopee_pay_transactions' => ShopeePayTransactionResource::collection(ShopeePayTransaction::orderBy('date_time', 'desc')->get())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('ShopeePayTransaction/Create', [
            'shopee_pays' => ShopeePayResource::collection(ShopeePay::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShopeePayTransactionRequest $request, ShopeePayTransaction $shopee_pay_transactions)
    {
        $shopee_pay_transactions->create($request->validated());

        ShopeePay::where('id', $request->shopee_pay_id)
            ->update(['balance' => $request->post_balance]);

        return redirect()->route('shopee-pay-transactions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShopeePayTransaction $shopee_pay_transaction)
    {
        return Inertia::render('ShopeePayTransaction/Show', [
            'shopee_pay_transaction' => ShopeePayTransactionResource::make($shopee_pay_transaction)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShopeePayTransaction $shopee_pay_transaction)
    {
        return Inertia::render('ShopeePayTransaction/Edit', [
            'shopee_pay_transaction' => ShopeePayTransactionResource::make($shopee_pay_transaction),
            'shopee_pays' => ShopeePayResource::collection(ShopeePay::all())
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShopeePayTransactionRequest $request, ShopeePayTransaction $shopee_pay_transaction)
    {
        $shopee_pay_transaction->create($request->validated());

        ShopeePay::where('id', $request->shopee_pay_id)
            ->update(['balance' => $request->post_balance]);

        return redirect()->route('shopee-pay-transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShopeePayTransaction $shopee_pay_transaction)
    {
        // return the amount to the parent table
        $amount = $shopee_pay_transaction->amount;
        $post_bal = $shopee_pay_transaction->post_balance;
        $shopee_pay_id = $shopee_pay_transaction->maya_id;
        $shopee_pay_acct = ShopeePay::find($shopee_pay_id);
        $shopee_pay_acct->balance = $post_bal + $amount;
        $shopee_pay_acct->save();

        $shopee_pay_transaction->delete();

        return back();
    }
}
