<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('investment_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('minimum_amount');
            $table->string('maximum_amount');
            $table->string('roi');
            $table->string('duration');
            $table->enum('capital_back', ['yes', 'no'])->default('yes');
            $table->enum('status', ['active','pending'])->default('active');
            $table->timestamps();
        });

        DB::table('investment_plans')->insert([
            [
                'name' => 'Plan 1',
                'roi' => '15',
                'duration' => '24 hours',
                'minimum_amount' => '50',
                'maximum_amount' => '499',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Plan 2',
                'roi' => '35',
                'duration' => '48 hours',
                'minimum_amount' => '500',
                'maximum_amount' => '1999',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Plan 3',
                'roi' => '55',
                'duration' => '48 hours',
                'minimum_amount' => '2000',
                'maximum_amount' => '4999',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
            [
                'name' => 'Plan 4',
                'roi' => '90',
                'duration' => '72 hours',
                'minimum_amount' => '5000',
                'maximum_amount' => 'Unlimited',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
             [
                'name' => 'Plan 5',
                'roi' => '600',
                'duration' => '1 Year',
                'minimum_amount' => '300',
                'maximum_amount' => '4999',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Plan 6',
                'roi' => '700',
                'duration' => '1 Year',
                'minimum_amount' => '5000',
                'maximum_amount' => 'Unlimited',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_plans');
    }
};
