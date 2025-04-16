<?php

namespace Database\Seeders;

use App\Models\SavingsAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SavingsAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SavingsAccount::factory(3)->create();
    }
}
