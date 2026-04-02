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
        Schema::create('boarder_activity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boarder_id');
            $table->string('activity_name');
            $table->date('activity_date');
            $table->string('activity_reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boarder_activity');
    }
};
