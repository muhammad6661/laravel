<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('home_description_tj');
            $table->string('home_description_ru');
            $table->string('home_description_en');
            $table->string('title_tj');
            $table->string('title_ru');
            $table->string('title_en');
            $table->string('logo_tj');
            $table->string('logo_ru');
            $table->string('logo_en');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('address_tj');
            $table->string('address_ru');
            $table->string('address_en');
            $table->string('link_instagram');
            $table->string('link_facebook');
            $table->string('link_telegram');
            $table->string('link_youtube');
            $table->string('title_logo_tj')->nullable();
            $table->string('title_logo_ru')->nullable();
            $table->string('title_logo_en')->nullable();
            $table->string('videoimage')->nullable();
            $table->string('link_video_ru')->nullable();
            $table->string('link_video_tj')->nullable();
            $table->string('link_video_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
