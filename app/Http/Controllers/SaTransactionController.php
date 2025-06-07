<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaTransactionRequest;
use App\Http\Resources\SaTransactionResource;
use App\Http\Resources\SavingsAccountResource;
use App\Models\SaTransaction;
use App\Models\SavingsAccount;
use Illuminate\Container\Attributes\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SaTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('SaTransaction/Index', [
            'sa_transactions' => SaTransactionResource::collection(SaTransaction::orderBy('date_time', 'desc')->get())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('SaTransaction/Create', [
            'savings_accounts' => SavingsAccountResource::collection(SavingsAccount::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaTransactionRequest $request, SaTransaction $sa_transactions)
    {
        // using Request to utilize validation rules
        $sa_transactions->create($request->validated());

        $sa_transacts = constant('SA_TRANSACTS_AS_AR');

        if($request->transact_type_id == $sa_transacts['transfer_money']['id'])
        {
            // Transfer to the acct
            SavingsAccount::where('id', $request->transfer_to_sa_account_id)
                ->update(['balance' => $request->target_sa_acct_balance]);
        }

        // update the balance in parent table - SavingsAccount
        SavingsAccount::where('id', $request->sa_account_id)
            ->update(['balance' => $request->post_balance]);

        return redirect()->route('sa-transactions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SaTransaction $sa_transaction)
    {
        return Inertia::render('SaTransaction/Show', [
            'sa_transaction' => SaTransactionResource::make($sa_transaction)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaTransaction $sa_transaction)
    {
        return Inertia::render('SaTransaction/Edit', [
            'sa_transaction' => SaTransactionResource::make($sa_transaction),
            'savings_accounts' => SavingsAccountResource::collection(SavingsAccount::all())
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaTransactionRequest $request, SaTransaction $sa_transaction)
    {
        $sa_transaction->update($request->validated());

        // update the balance in parent table - SavingsAccount
        SavingsAccount::where('id', $request->sa_account_id)
            ->update(['balance' => $request->post_balance]);

        return redirect()->route('sa-transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaTransaction $sa_transaction)
    {
        // return the amount to the parent table
        $amount = $sa_transaction->amount;
        $post_bal = $sa_transaction->post_balance;
        $sa_id = $sa_transaction->sa_account_id;
        $sa_acct = SavingsAccount::find($sa_id);
        $sa_acct->balance = $post_bal + $amount;
        $sa_acct->save();

        $sa_transaction->delete();

        return back();

        // return redirect()->route('sa-transactions.index')->with('success', 'Transaction deleted successfully');
    }
}
