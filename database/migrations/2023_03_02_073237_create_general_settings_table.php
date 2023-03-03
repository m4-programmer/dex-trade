<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// return new class
class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('sitename')->nullable();
            $table->string('site_currency',10)->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_phone')->nullable();
            $table->string('site_address')->nullable();
            $table->string('copyright')->nullable();

            $table->string('email_method')->default('php')->nullable();
            $table->text('email_config')->nullable();

            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('login_image')->nullable();
            
            $table->integer('is_email_verification_on')->default(0);
            $table->integer('is_sms_verification_on')->default(0);

            $table->string('preloader_image')->nullable();
            $table->boolean('preloader_status')->nullable();

            // not useful
            $table->boolean('analytics_status')->nullable();
            $table->string('analytics_key')->nullable();
            $table->tinyInteger('allow_modal')->nullable();
            $table->string('button_text')->nullable();
            $table->text('cookie_text')->nullable();
            // end of not useful

            $table->tinyInteger('allow_recaptcha')->nullable();
            $table->string('recaptcha_key')->nullable();
            $table->string('recaptcha_secret')->nullable();

            $table->tinyInteger('twak_allow')->default(0);
            // to paste in the code into the DB
            $table->text('twak_key')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();

        });
        // Add entries to general settings 
        DB::table('general_settings')->insert([
            [
                'sitename' => 'Dextrade',
                'site_currency' => 'USD',
                'site_email' => 'info@dex-trade.cc',
                'site_phone' => '+55 902839300',
                'site_address' => 'New London House Wtc 1 C. V. 6 London Street, Fenchurch Street Station, The City, London, United Kingdom, EC3R 7LP. ',
                'copyright' => '2015',
                'logo' => 'asset/theme2/images/logo/logo.jpg',
                'favicon' => 'asset/theme2/images/icon/icon.jpg',
                'login_image' => 'asset/theme2/images/login/login_image.jpg',
                'preloader_status' => 1,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
