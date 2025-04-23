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
        Schema::table('maya_transactions', function (Blueprint $table) {
            $table->renameColumn('current_maya_balance', 'current_balance');
            $table->renameColumn('post_maya_balance', 'post_balance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maya_transactions', function (Blueprint $table) {
            $table->renameColumn('balance', 'current_maya_balance');
            $table->renameColumn('post_balance', 'post_maya_balance');
        });
    }
};
