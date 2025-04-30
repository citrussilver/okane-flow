<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SavingsAccount>
 */
class SavingsAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bank_abbrev = pick_one(['BPI', 'SB', 'UB']);
        $bank_name = randomize_name($bank_abbrev, 8);

        return [
            'bank_name' => $bank_name,
            'bank_abbrev' => $bank_abbrev,
            'account_number' => fake()->regexify('[0-9]{15}'),
            'balance' => fake()->randomNumber(5, true)
        ];
    }
}
