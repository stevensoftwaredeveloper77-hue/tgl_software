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
        Schema::create('agendly_appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_user_id');
            $table->unsignedBigInteger('business_user_id');
            $table->date('date');
            $table->time('hour');
            $table->unsignedBigInteger('state_id');
            $table->string('reason')->nullable();
            $table->foreign('customer_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('business_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('agendly_states')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendly_appointments');
    }
};
