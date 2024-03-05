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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competitor_id');
            $table->foreign('competitor_id')->references('id')->on('competitors')->onDelete('cascade');
            $table->date('subscription_date');
            $table->date('subscription_finish');
            $table->decimal('annual_fee', 8, 2);
            $table->boolean('paid')->default(false);
            $table->decimal('discount', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
