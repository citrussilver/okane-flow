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
        return [
            'bank_name' => fake()->name(),
            'bank_abbrev' => fake()->regexify('[A-Z]{10}'),
            'account_number' => fake()->regexify('[0-9]{15}'),
            'balance' => fake()->randomNumber(6, true)
        ];
    }
}
