<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareholdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareholders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organization_id')->nullable();
            $table->string('fio_ru')->nullable();
            $table->string('fio_tj')->nullable();
            $table->string('fio_en')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('country_id')->nullable();
            $table->boolean('type')->default(0);
            $table->string('stock')->nullable();
            $table->string('plz')->nullable();
            $table->string('birja_ru')->nullable();
            $table->string('birja_tj')->nullable();
            $table->string('birja_en')->nullable();
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
        Schema::dropIfExists('shareholders');
    }
}
