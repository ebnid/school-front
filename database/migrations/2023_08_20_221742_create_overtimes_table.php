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
        Schema::create('overtimes', function (Blueprint $table) {
            $table->id();
            $table->datetime('start_at')->nullable();
            $table->datetime('end_at')->nullable();
            $table->float('overtime')->nullable();
            $table->string('message')->nullable();
            $table->enum('status', ['pending', 'accepted', 'cancaled'])->default('pending')->nullable();
            $table->foreignId('attendance_id')->constrained();
            $table->foreignId('employee_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtimes');
    }
};
