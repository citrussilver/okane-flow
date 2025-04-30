<?php

namespace App\Http\Controllers;

use App\Http\Requests\MayaAccountRequest;
use App\Http\Resources\MayaAccountResource;
use App\Models\MayaAccount;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MayaAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('MayaAccount/Index', [
            'maya_accounts' => MayaAccountResource::collection(MayaAccount::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('MayaAccount/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MayaAccountRequest $request, MayaAccount $maya_accounts)
    {
        $maya_accounts->create($request->validated());
        // MayaAccount::create([
        //     'mobile_number' => $request->mobile_number,
        //     'account_nickname' => $request->account_nickname,
        //     'last_4_digits' => $request->last_4_digits,
        //     'balance' => $request->balance
        // ]);

        return redirect()->route('maya-accounts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(MayaAccount $maya_account)
    {
        return Inertia::render('MayaAccount/Show', [
            'maya_account' => MayaAccountResource::make($maya_account)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MayaAccount $maya_account)
    {
        return Inertia::render('MayaAccount/Edit', [
            'maya_account' => MayaAccountResource::make($maya_account)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MayaAccountRequest $request, MayaAccount $maya_account)
    {
        $maya_account->update($request->validated());

        return redirect()->route('maya-accounts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MayaAccount $maya_account)
    {
        $maya_account->delete();

        return back();
    }
}
