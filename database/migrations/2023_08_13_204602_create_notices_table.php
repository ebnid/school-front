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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('name', 2048);
            $table->string('slug', 2300);
            $table->text('content');
            $table->integer('order')->nullable();
            $table->enum('lang', ['bangla', 'english'])->default('bangla');
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
        Schema::dropIfExists('notices');
    }
};
