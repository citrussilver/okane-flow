<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MayaTransaction>
 */
class MayaTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $transact_name = pick_one([
            'Cash-In',
            'Online Payment',
            'QR Pay',
            'Self Buy Load',
            'Bills Payment',
            'Adjustment',
            'Refund'
        ]);

        return [
            'maya_id' => fake()->randomDigitNot(0),
            'date_time' => fake()->date('Y_m_d') . ' ' . fake()->time(),
            'transact_type_id' => fake()->randomDigitNot(0),
            'current_balance' => fake()->randomNumber(5, true),
            'amount' => fake()->randomNumber(5, true),
            'post_balance' => fake()->randomNumber(5, true),
            'remarks' => '[' . $transact_name . '] ' . fake()->sentence(),
            'reference_id' => fake()->regexify('[A-Z]{5}[0-4]{8}')
        ];
    }
}
