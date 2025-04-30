<?php

namespace Database\Seeders;

use App\Models\MayaTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MayaTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MayaTransaction::factory(6)->create();
    }
}
