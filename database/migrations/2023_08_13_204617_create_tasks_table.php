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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->time('start_at')->nullable();
            $table->time('end_at')->nullable();
            $table->float('rating')->nullable();
            $table->enum('status', ['pending', 'processing', 'complate', 'uncomplate', 'finished', 'canceled'])->default('pending')->nullable();
            $table->foreignId('assign_to_id')->constrained('employees');
            $table->foreignId('assign_by_id')->constrained('employees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
