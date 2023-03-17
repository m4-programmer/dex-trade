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
                'wallet_address' => '232nsbduiuwiagaisdbaisdhiabir',
                'blockchain_network' => 'Binance',
                'short_name' => 'btc',
                'qr_code' => 'asset/theme2/images/gateways/63cfb1631c4ae1674555747.jpg',
                'image' => 'asset/theme2/images/gateways/btc.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'cryptocurrency' => 'USDT Tether! Bep20',
                'wallet_address' => '232nsbduiuwiagaisdbaisdhiabir',
                'blockchain_network' => 'USDT',
                'short_name' => 'usdt',
                'qr_code' => 'asset/theme2/images/gateways/63cfb1631c4ae1674555747.jpg',
                'image' => 'asset/theme2/images/gateways/usdt_tether.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
              [
                'cryptocurrency' => 'Ethurem',
                'wallet_address' => '0xD678c1C47C53c6A5d79E827F54cb70b0CbFCec8f',
                'blockchain_network' => 'Binance',
                'short_name' => 'eth',
                'qr_code' => 'asset/theme2/images/gateways/63cfb1631c4ae1674555747.jpg',
                'image' => 'asset/theme2/images/gateways/Eth.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
              [
                'cryptocurrency' => 'Binance',
                'wallet_address' => '0xD678c1C47C53c6A5d79E827F54cb70b0CbFCec8f',
                'blockchain_network' => 'Binance',
                'short_name' => 'bnb',
                'qr_code' => 'asset/theme2/images/gateways/63cfb1631c4ae1674555747.jpg',
                'image' => 'asset/theme2/images/gateways/BNB.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'cryptocurrency' => 'Solana',
                'wallet_address' => '0xD678c1C47C53c6A5d79E827F54cb70b0CbFCec8f',
                'blockchain_network' => 'Binance',
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
