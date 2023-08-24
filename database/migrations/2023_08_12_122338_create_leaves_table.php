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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('reason', 2024)->nullable();
            $table->datetime('from_date')->nullable();
            $table->datetime('to_date')->nullable();
            $table->datetime('accept_at')->nullable();
            $table->string('management_response', 2048)->nullable();
            $table->enum('status', ['pending', 'canceled', 'accepted'])->default('pending')->nullable();
            $table->foreignId('employee_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
