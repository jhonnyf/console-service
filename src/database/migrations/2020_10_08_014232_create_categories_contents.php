<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesContents extends Migration
{

    public function up()
    {
        Schema::create('category_content', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('language_id');
            $table->timestamps();

            $table->primary(['category_id', 'content_id', 'language_id']);
            // $table->primary(['category_id', 'content_id']);

            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('content_id')->references('id')->on('contents')->cascadeOnDelete();
            $table->foreign('language_id')->references('id')->on('languages')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_content');
    }
}
