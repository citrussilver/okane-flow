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
        $cc_name = randomize_name(['Blue Mastercard', 'JCB', 'Visa', 'AMEX', 'Citi'], 5);

        return [
            'last_4_digits' => fake()->regexify('[0-9]{4}'),
            'cc_name' => $cc_name,
            'credit_limit' => fake()->randomNumber(5, true),
            'avail_credit_limit' => fake()->randomNumber(5, true)
        ];
    }
}
