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
        Schema::create('cc_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('credit_card_id');
            $table->dateTime('date_time')->nullable();
            $table->tinyInteger('transact_type_id');
            $table->string('description');
            $table->decimal('current_credit_limit', total: 19, places: 2)->default(0);
            $table->decimal('amount', total: 19, places: 2)->default(0);
            $table->decimal('post_credit_limit', total: 19, places: 2)->default(0);
            $table->string('remarks', 500);
            $table->string('ref_no', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cc_transactions');
    }
};
