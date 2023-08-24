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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->string('message')->nullable();
            $table->float('amount')->nullable();
            $table->datetime('paid_at')->nullable();
            $table->foreignId('employee_id')->constrained();
            $table->enum('status', ['pending', 'accepted', 'canceled'])->nullable()->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widthdraws');
    }
};
