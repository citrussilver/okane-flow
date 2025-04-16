<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MayaAccount>
 */
class MayaAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mobile_number' => fake()->regexify('[0-9]{11}'),
            'account_nickname' => fake()->regexify("[A-Za-z]{5}'s Maya"),
            'last_4_digits' => fake()->regexify('[0-9]{4}'),
            'balance' => fake()->randomNumber(6, true)
        ];
    }
}
