<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, update existing records to the new DATE format
        // Parse formats like "January 2026", "March 2026" to "2026-01-01", "2026-03-01"
        $transactions = DB::table('transactions')->whereNotNull('billing_month')->get();
        
        foreach ($transactions as $transaction) {
            $oldValue = $transaction->billing_month;
            
            // Try to parse the old format (e.g., "January 2026", "March 2026")
            try {
                $date = \Carbon\Carbon::parse($oldValue)->startOfMonth()->format('Y-m-d');
                DB::table('transactions')
                    ->where('id', $transaction->id)
                    ->update(['billing_month' => $date]);
            } catch (\Exception $e) {
                // If parsing fails, set to null or keep as is
                DB::table('transactions')
                    ->where('id', $transaction->id)
                    ->update(['billing_month' => null]);
            }
        }

        // Now change the column to DATE type
        Schema::table('transactions', function (Blueprint $table) {
            $table->date('billing_month')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Convert dates back to VARCHAR format (e.g., "January 2026")
        $transactions = DB::table('transactions')->whereNotNull('billing_month')->get();
        
        foreach ($transactions as $transaction) {
            try {
                $date = \Carbon\Carbon::parse($transaction->billing_month)->format('F Y');
                DB::table('transactions')
                    ->where('id', $transaction->id)
                    ->update(['billing_month' => $date]);
            } catch (\Exception $e) {
                // Keep as is if parsing fails
            }
        }

        Schema::table('transactions', function (Blueprint $table) {
            $table->string('billing_month', 50)->nullable()->change();
        });
    }
};

