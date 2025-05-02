<?php

namespace Database\Seeders;

use App\Models\CcTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CcTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CcTransaction::factory(5)->create();
    }
}
