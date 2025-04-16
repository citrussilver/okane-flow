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
        // $randomize = fake()->randomElement(['Blue Mastercard', 'Platinum', 'Gold']);
        // $bank_name = fake()->regexify("[A-Za-z]{4}'s " . $randomize);

        $bank_abbrev = pick_abbrev(['BPI', 'SB', 'UB']);
        $bank_name = randomize_name($bank_abbrev, 8);

        return [
            'bank_name' => $bank_name,
            'bank_abbrev' => $bank_abbrev,
            'account_number' => fake()->regexify('[0-9]{15}'),
            'balance' => fake()->randomNumber(6, true)
        ];
    }
}
