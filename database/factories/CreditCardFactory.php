<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreditCard>
 */
class CreditCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $randomize = fake()->randomElement(['Blue Mastercard', 'Platinum', 'Gold']);
        // $cc_name = fake()->regexify("[A-Za-z]{4}'s " . $randomize);

        $cc_name = randomize_name(['Blue Mastercard', 'Platinum', 'Gold'], 5);

        return [
            'last_4_digits' => fake()->regexify('[0-9]{4}'),
            'cc_name' => $cc_name,
            'credit_limit' => fake()->randomNumber(6, true),
            'avail_credit_limit' => fake()->randomNumber(6, true)
        ];
    }
}
