<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileContent extends Migration
{

    public function up()
    {
        Schema::create('file_content', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('file_id');
            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('language_id');
            $table->timestamps();

            $table->primary(['file_id', 'content_id', 'language_id']);

            $table->foreign('file_id')->references('id')->on('files')->cascadeOnDelete();
            $table->foreign('content_id')->references('id')->on('contents')->cascadeOnDelete();
            $table->foreign('language_id')->references('id')->on('languages')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('file_content');
    }
}
