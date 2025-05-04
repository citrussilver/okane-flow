<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShopeePay>
 */
class ShopeePayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shopee_username' => fake()->regexify("[A-Za-z]{5}'s ShopeePay"),
            'balance' => fake()->randomNumber(5, true)
        ];
    }
}
