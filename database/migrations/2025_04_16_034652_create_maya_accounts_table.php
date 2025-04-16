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
        Schema::create('maya_accounts', function (Blueprint $table) {
            $table->id();
            $table->char('mobile_number', length: 11);
            $table->char('account_nickname', length: 20);
            $table->char('last_4_digits', length: 4);
            $table->decimal('balance', total: 19, places: 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maya_accounts');
    }
};
