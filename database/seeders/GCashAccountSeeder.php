<?php

namespace Database\Seeders;

use App\Models\GCashAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GCashAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GCashAccount::factory(2)->create();
    }
}
