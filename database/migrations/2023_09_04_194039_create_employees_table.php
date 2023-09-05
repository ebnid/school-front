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
            $table->string('name_bn')->nullable();
            $table->string('name_en')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->string('present_address', 2048)->nullable();
            $table->string('permanent_address', 2048)->nullable();
            $table->string('designation')->nullable();
            $table->string('nid_no')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('join_date')->nullable();
            $table->date('current_organization_join_date')->nullable();
            $table->string('subject')->nullable();
            $table->integer('subject_code')->nullable();
            $table->integer('examinner_code')->nullable();
            $table->string('training')->nullable();
            $table->string('term')->nullable();
            $table->text('bio')->nullable();
            $table->string('employee_type');
            $table->boolean('is_published')->nullable()->default(true);
            $table->string('cache_key')->nullable();
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
