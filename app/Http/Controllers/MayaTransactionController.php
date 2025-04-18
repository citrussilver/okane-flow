<?php

namespace App\Http\Controllers;

use App\Http\Resources\MayaAccountResource;
use App\Http\Resources\MayaTransactionResource;
use App\Models\MayaAccount;
use App\Models\MayaTransaction;
use Illuminate\Http\Request;
use Inertia\Inertia;


class MayaTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('MayaTransaction/Index', [
            'maya_transactions' => MayaTransactionResource::collection(MayaTransaction::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('MayaTransaction/Create', [
            'maya_accounts' => MayaAccountResource::collection(MayaAccount::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        MayaTransaction::create([
            'maya_id' => $request->maya_id,
            'date_time' => $request->date_time,
            'transact_type_id' => $request->transact_type_id,
            'current_maya_balance' => $request->current_maya_balance,
            'amount' => $request->amount,
            'post_maya_balance' => $request->post_maya_balance,
            'remarks' => $request->remarks,
            'reference_id' => $request->reference_id,
        ]);

        return redirect()->route('maya-transactions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
