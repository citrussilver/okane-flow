<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            UserSeeder::class,
            RoleSeeder::class,
            GCashAccountSeeder::class,
            MayaAccountSeeder::class,
            MayaTransactionSeeder::class,
            SavingsAccountSeeder::class,
            SaTransactionSeeder::class,
            CreditCardSeeder::class

        ]);
    }
}
