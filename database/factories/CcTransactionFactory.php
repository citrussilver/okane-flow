<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Support\Constants;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CcTransaction>
 */
class CcTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $transact_name = pick_one(CC_TRANSACTS);

        return [
            'credit_card_id' => fake()->randomDigitNot(0),
            'date_time' => fake()->date('Y_m_d') . ' ' . fake()->time(),
            'transact_type_id' => fake()->randomDigitNot(0),
            'description' => fake()->sentence(),
            'current_credit_limit' => fake()->randomNumber(5, true),
            'amount' => fake()->randomNumber(5, true),
            'post_credit_limit' => fake()->randomNumber(5, true),
            'remarks' => '[' . $transact_name . '] ' . fake()->sentence(),
            'ref_no' => fake()->regexify('[A-Z]{5}[0-4]{8}')
        ];
    }
}
