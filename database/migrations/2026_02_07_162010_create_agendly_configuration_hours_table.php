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
        Schema::create('agendly_configuration_hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_user_id');
            $table->time('hour');
            $table->foreign('business_user_id')->references('id')->on('agendly_businesses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendly_configuration_hours');
    }
};
