<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreditCardRequest;
use App\Http\Resources\CreditCardResource;
use App\Models\CreditCard;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CreditCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('CreditCard/Index', [
            'credit_cards' => CreditCardResource::collection(CreditCard::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CreditCard/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreditCardRequest $request, CreditCard $credit_cards)
    {
        // using Request to utilize validation rules
        $credit_cards->create($request->validated());

        return redirect()->route('credit-cards.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CreditCard $credit_card)
    {
        return Inertia::render('CreditCard/Show', [
            'credit_card' => CreditCardResource::make($credit_card)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CreditCard $credit_card)
    {
        return Inertia::render('CreditCard/Edit', [
            'credit_card' => CreditCardResource::make($credit_card)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreditCardRequest $request, CreditCard $credit_card)
    {
        $credit_card->update($request->validated());

        return redirect()->route('credit-cards.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CreditCard $credit_card)
    {
        $credit_card->delete();

        return back();
    }
}
