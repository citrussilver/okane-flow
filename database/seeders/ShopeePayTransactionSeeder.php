<?php

namespace Database\Seeders;

use App\Models\ShopeePayTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopeePayTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShopeePayTransaction::factory(5)->create();
    }
}
