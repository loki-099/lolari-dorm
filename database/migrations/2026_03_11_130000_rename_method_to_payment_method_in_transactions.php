<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Rename 'method' column to 'payment_method' to match the application code.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Rename 'method' to 'payment_method'
            $table->renameColumn('method', 'payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Rename back to 'method'
            $table->renameColumn('payment_method', 'method');
        });
    }
};

