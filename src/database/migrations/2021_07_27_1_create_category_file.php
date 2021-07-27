<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryFile extends Migration
{

    public function up()
    {
        Schema::create('category_file', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('file_id');            
            $table->timestamps();

            $table->primary(['file_id', 'category_id']);

            $table->foreign('file_id')->references('id')->on('files')->cascadeOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_file');
    }
}
