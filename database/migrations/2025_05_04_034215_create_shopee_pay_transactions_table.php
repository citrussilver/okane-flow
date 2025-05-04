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
        Schema::create('shopee_pay_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('shopee_pay_id');
            $table->dateTime('date_time')->nullable();
            $table->tinyInteger('transact_type_id');
            $table->string('description');
            $table->decimal('current_balance', total: 19, places: 2)->default(0);
            $table->decimal('amount', total: 19, places: 2)->default(0);
            $table->decimal('post_balance', total: 19, places: 2)->default(0);
            $table->string('remarks', 500);
            $table->string('order_sn', 100)->nullable();
            $table->string('reference_id', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopee_pay_transactions');
    }
};
