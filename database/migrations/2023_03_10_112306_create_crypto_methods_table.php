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
        Schema::create('crypto_methods', function (Blueprint $table) {
            $table->id();
            $table->string('cryptocurrency');
            $table->string('wallet_address');
            $table->text('qr_code')->nullable();
            $table->string('blockchain_network')->nullable();
            $table->string('image')->nullable();
            $table->string('short_name')->nullable();
            $table->enum('status', ['active','pending'])->default('active');
            $table->timestamps();
        });
        DB::table('crypto_methods')->insert([
            [
                'cryptocurrency' => 'Bitcoin',
                'wallet_address' => '1Pr1t97gb4aPqccC5GZHQaF3EU21cWfLuH',
                'blockchain_network' => 'Bitcoin',
                'short_name' => 'btc',
                'qr_code' => 'asset/theme2/images/gateways/63cfb1631c4ae1674555747.jpg',
                'image' => 'asset/theme2/images/gateways/BTC.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'cryptocurrency' => 'USDT Tether! Bep20',
                'wallet_address' => '0xb111da25fc5c5416a3bc24afc9c2bb3cf6a6e337',
                'blockchain_network' => 'Bep20',
                'short_name' => 'usdt',
                'qr_code' => 'asset/theme2/images/gateways/63cfb1631c4ae1674555747.jpg',
                'image' => 'asset/theme2/images/gateways/usdt_tether.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
              [
                'cryptocurrency' => 'Ethurem ',
                'wallet_address' => '0xb111da25fc5c5416a3bc24afc9c2bb3cf6a6e337',
                'blockchain_network' => 'ERC20',
                'short_name' => 'eth',
                'qr_code' => 'asset/theme2/images/gateways/63cfb1631c4ae1674555747.jpg',
                'image' => 'asset/theme2/images/gateways/ETH.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
              [
                'cryptocurrency' => 'BNB',
                'wallet_address' => '0xb111da25fc5c5416a3bc24afc9c2bb3cf6a6e337',
                'blockchain_network' => 'Bep20',
                'short_name' => 'BNB',
                'qr_code' => 'asset/theme2/images/gateways/63cfb1631c4ae1674555747.jpg',
                'image' => 'asset/theme2/images/gateways/BNB.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'cryptocurrency' => 'Solana',
                'wallet_address' => '767t7KbbhRWd5sXrgHmXsp89dAW1PprJUAiC6BUXEDmU',
                'blockchain_network' => 'Solana',
                'short_name' => 'sol',
                'qr_code' => 'asset/theme2/images/gateways/63cfb1631c4ae1674555747.jpg',
                'image' => 'asset/theme2/images/gateways/SOL.jpg',
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
        Schema::dropIfExists('crypto_methods');
    }
};
