<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentContent extends Migration
{

    public function up()
    {
        Schema::create('content_content', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('language_id');
            $table->timestamps();

            $table->primary(['id', 'content_id', 'language_id']);

            $table->foreign('id')->references('id')->on('contents')->cascadeOnDelete();
            $table->foreign('content_id')->references('id')->on('contents')->cascadeOnDelete();
            $table->foreign('language_id')->references('id')->on('languages')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('content_content');
    }
}
