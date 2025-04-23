<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaTransaction>
 */
class SaTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transact_name = pick_one([
            'Deposit',
            'Withdraw',
            'Bills Payment',
            'Pay Credit Card',
            'GCash Cash-in',
            'Maya Cash-in',
            'Reload Prepaid Card',
            'Transfer Money',
            'Store payment',
            'Adjustment',
            'Earn Interest',
            'Tax Witheld',
            'Salary / Income',
            'Shopee - Online Banking',
            'Bank Charge',
            'ShopeePay Cash-in',
        ]);

        return [
            'sa_account_id' => fake()->randomDigitNot(0),
            'date_time' => fake()->date('Y_m_d') . ' ' . fake()->time(),
            'transact_type_id' => fake()->randomDigitNot(0),
            'current_balance' => fake()->randomNumber(5, true),
            'amount' => fake()->randomNumber(5, true),
            'post_balance' => fake()->randomNumber(5, true),
            'location' => fake()->word(),
            'remarks' => '[' . $transact_name . '] ' . fake()->sentence(),
            'reference_number' => fake()->regexify('[A-Z]{5}[0-4]{8}')
        ];
    }
}
