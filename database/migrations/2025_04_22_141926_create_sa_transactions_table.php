<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sa_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('sa_account_id');
            $table->dateTime('date_time')->nullable();
            $table->tinyInteger('transact_type_id');
            $table->decimal('current_balance', total: 19, places: 2)->default(0);
            $table->decimal('amount', total: 19, places: 2)->default(0);
            $table->decimal('post_balance', total: 19, places: 2)->default(0);
            $table->string('location', 200);
            $table->string('remarks', 500);
            $table->string('reference_number', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sa_transactions');
    }
};
