<?php

namespace App\Http\Controllers;

use App\Http\Requests\CcTransactionRequest;
use App\Http\Requests\CreditCardRequest;
use App\Http\Resources\CcTransactionResource;
use App\Http\Resources\CreditCardResource;
use App\Models\CcTransaction;
use App\Models\CreditCard;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CcTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('CcTransaction/Index', [
            'cc_transactions' => CcTransactionResource::collection(CcTransaction::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CcTransaction/Create', [
            'credit_cards' => CreditCardResource::collection(CreditCard::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CcTransactionRequest $request, CcTransaction $cc_transactions)
    {
        // using Request to utilize validation rules
        $cc_transactions->create($request->validated());

        // update the balance in parent table -
        CreditCard::where('id', $request->credit_card_id)
            ->update(['avail_credit_limit' => $request->post_credit_limit]);

        return redirect()->route('cc-transactions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CcTransaction $cc_transaction)
    {
        return Inertia::render('CcTransaction/Show', [
            'cc_transaction' => CcTransactionResource::make($cc_transaction)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CcTransaction $cc_transaction)
    {
        return Inertia::render('CcTransaction/Edit', [
            'cc_transaction' => CcTransactionResource::make($cc_transaction),
            'credit_cards' => CreditCardResource::collection(CreditCard::all())
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CcTransactionRequest $request, CcTransaction $cc_transaction)
    {
        $cc_transaction->update($request->validated());

        // update the balance in parent table -
        CreditCard::where('id', $request->credit_card_id)
            ->update(['avail_credit_limit' => $request->post_credit_limit]);

        return redirect()->route('cc-transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CcTransaction $cc_transaction)
    {
        // return the amount to the parent table
        $amount = $cc_transaction->amount;
        $post_cl = $cc_transaction->post_credit_limit;
        $cc_id = $cc_transaction->credit_card_id;
        $cc = CreditCard::find($cc_id);
        $cc->avail_credit_limit = $post_cl + $amount;
        $cc->save();

        $cc_transaction->delete();

        return back();
    }
}
