<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title_tj');
            $table->string('title_ru');
            $table->string('title_en');
            $table->string('section_id');
            $table->string('link_tj');
            $table->string('link_ru');
            $table->string('link_en');
            $table->string('sort')->default(1);
            $table->boolean('type_link')->default(0);
            $table->string('file_ru')->nullable();
            $table->string('file_tj')->nullable();
            $table->string('file_en')->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('documents');
    }
}
