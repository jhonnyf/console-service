<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentFile extends Migration
{

    public function up()
    {
        Schema::create('content_file', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('file_id');            
            $table->timestamps();

            $table->primary(['file_id', 'content_id']);

            $table->foreign('file_id')->references('id')->on('files')->cascadeOnDelete();
            $table->foreign('content_id')->references('id')->on('contents')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('content_file');
    }
}
