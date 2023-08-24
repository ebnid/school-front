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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->date('month_of_salary');
            $table->float('salary_amount')->nullable();
            $table->float('additional_bonous')->nullable();
            $table->float('overpaid_amount')->nullable();
            $table->string('message', 2048)->nullable();
            $table->datetime('paid_at')->nullable();
            $table->foreignId('employee_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
