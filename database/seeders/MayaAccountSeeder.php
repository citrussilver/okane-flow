<?php

namespace Database\Seeders;

use App\Models\MayaAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MayaAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MayaAccount::factory(2)->create();
    }
}
