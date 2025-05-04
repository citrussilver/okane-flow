<?php

namespace Database\Seeders;

use App\Models\ShopeePay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopeePaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShopeePay::factory(2)->create();
    }
}
