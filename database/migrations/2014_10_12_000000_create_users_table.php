<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('referral_id')->nullable();

            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();

            $table->string('current_plan')->nullable();

            $table->enum('role_as',['admin','user'])->default('user');
            $table->string('balance')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

         /*Create Super Admin*/
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Super',
                // 'lastname' => "Admin",
                'email' => 'admin@admin.com',
                'username' => 'admin',
                'image' => 'asset/theme2/frontend/img/user.png',
                'password' => Hash::make('12345'),
                'role_as'=> 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
