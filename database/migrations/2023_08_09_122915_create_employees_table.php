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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->float('basic_salary')->nullable();
            $table->enum('status', ['running', 'go-out'])->default('running');
            $table->foreignId('designation_id')->constrained();
            $table->foreignId('shift_id')->constrained();
            $table->foreignId('organization_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('prev_employee_id')->nullable()->constrained('employees');
            $table->foreignId('next_employee_id')->nullable()->constrained('employees');
            $table->string('break_name')->nullable();
            $table->time('break_start_at')->nullable();
            $table->enum('working_status', ['working', 'break'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
