<?php

namespace App\Http\Middleware;

use App\Http\Resources\CreditCardResource;
use App\Http\Resources\GCashAccountResource;
use App\Http\Resources\MayaAccountResource;
use App\Http\Resources\SavingsAccountResource;
use App\Models\CreditCard;
use App\Models\GCashAccount;
use App\Models\MayaAccount;
use App\Models\SavingsAccount;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            // 'recaptcha_site_key' => config('services.google_recaptcha.site_key'),
            'global_shared_data' => [
                'gcash_accounts' => GCashAccountResource::collection(GCashAccount::all()),
                'savings_accounts' => SavingsAccountResource::collection(SavingsAccount::all()),
                'maya_accounts' => MayaAccountResource::collection(MayaAccount::all()),
                'cc_accounts' => CreditCardResource::collection(CreditCard::all()),
                'recaptcha_site_key' => config('services.recaptcha.site_key')
            ]
        ];
    }
}
