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
        Schema::create('allowed_devices', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip')->nullable();
            $table->string('unique_identifier', 5000)->nullable();
            $table->string('cookie')->nullable();
            $table->string('mac_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allowed_devices');
    }
};
