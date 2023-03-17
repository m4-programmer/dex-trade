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
        Schema::create('myinvestments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('transaction_id')->unique();
            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('investment_plans');
            $table->string('plan_name');
            $table->string('roi');
            $table->string('amount');
            $table->string('duration');
            $table->string('gateway');
            $table->enum('status', ['active','pending', 'ended'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('myinvestments');
    }
};
