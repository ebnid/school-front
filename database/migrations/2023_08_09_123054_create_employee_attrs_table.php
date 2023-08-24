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
        Schema::create('employee_attrs', function (Blueprint $table) {
            $table->id();
            $table->string('attr_name');
            $table->string('used_attr');
            $table->string('str_value')->nullable();
            $table->integer('int_value')->nullable();
            $table->float('float_value')->nullable();
            $table->foreignId('employee_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_attrs');
    }
};
