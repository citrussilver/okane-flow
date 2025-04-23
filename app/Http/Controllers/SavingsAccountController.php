<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavingsAccountRequest;
use App\Http\Resources\SavingsAccountResource;
use App\Models\SavingsAccount;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SavingsAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('SavingsAccount/Index', [
            'savings_accounts' => SavingsAccountResource::collection(SavingsAccount::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('SavingsAccount/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        SavingsAccount::create([
            'bank_name' => $request->bank_name,
            'bank_abbrev' => $request->bank_abbrev,
            'account_number' => $request->account_number,
            'balance' => $request->balance
        ]);

        return redirect()->route('savings-accounts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SavingsAccount $savings_account)
    {
        return Inertia::render('SavingsAccount/Show', [
            'savings_account' => SavingsAccountResource::make($savings_account)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SavingsAccount $savings_account)
    {
        return Inertia::render('SavingsAccount/Edit', [
            'savings_account' => SavingsAccountResource::make($savings_account)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SavingsAccountRequest $request, SavingsAccount $savings_account)
    {
        $savings_account->update($request->validated());

        return redirect()->route('savings-accounts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SavingsAccount $savings_account)
    {
        $savings_account->delete();

        return back();
    }
}
