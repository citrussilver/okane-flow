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

        $transact_name = pick_one(MAYA_TRANSACTS);

        return [
            'maya_id' => fake()->randomDigitNot(0),
            'date_time' => fake()->date('Y_m_d') . ' ' . fake()->time(),
            'transact_type_id' => fake()->randomDigitNot(0),
            'current_maya_balance' => fake()->randomFloat(),
            'amount' => fake()->randomFloat(),
            'post_maya_balance' => fake()->randomFloat(),
            'remarks' => '[' . $transact_name . '] ' . fake()->sentence(),
            'reference_id' => fake()->regexify('[A-Z]{5}[0-4]{8}')
        ];
    }
}
