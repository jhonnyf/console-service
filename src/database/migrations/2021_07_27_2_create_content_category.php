<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentCategory extends Migration
{

    public function up()
    {
        Schema::create('content_category', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->primary(['content_id', 'category_id']);

            $table->foreign('content_id')->references('id')->on('contents')->cascadeOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('content_category');
    }
}
