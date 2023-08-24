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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->datetime('in_at')->nullable();
            $table->datetime('out_at')->nullable();
            $table->float('late_time')->nullable();
            $table->float('early_out_time')->nullable();
            $table->float('overtime')->nullable();
            $table->float('extra_overtime')->nullable();
            $table->enum('type', ['replace', 'present', 'pay-leave', 'nopay-leave', 'absent', 'off-day'])->default('present');
            $table->enum('late_type', ['payable', 'non-payable'])->nullable();
            $table->enum('early_out_type', ['payable', 'non-payable'])->nullable();
            $table->string('early_out_reason')->nullable();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('replace_employee_id')->nullable()->constrained('employees');
            $table->foreignId('late_cover_id')->nullable()->constrained('employees');
            $table->foreignId('overtime_from_id')->nullable()->constrained('employees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
