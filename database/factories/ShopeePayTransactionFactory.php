<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShopeePayTransaction>
 */
class ShopeePayTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $transact_name = pick_one(SHOPEEPAY_TRANSACTS);

        return [
            'shopee_pay_id' => fake()->randomDigitNot(0),
            'date_time' => fake()->date('Y_m_d') . ' ' . fake()->time(),
            'transact_type_id' => fake()->randomDigitNot(0),
            'description' => fake()->sentence(),
            'current_balance' => fake()->randomNumber(5, true),
            'amount' => fake()->randomNumber(5, true),
            'post_balance' => fake()->randomNumber(5, true),
            'remarks' => '[' . $transact_name . '] ' . fake()->sentence(),
            'order_sn' => fake()->regexify('[A-Z]{5}[0-4]{8}'),
            'reference_id' => fake()->regexify('[A-Z]{5}[0-4]{8}')
        ];
    }
}
