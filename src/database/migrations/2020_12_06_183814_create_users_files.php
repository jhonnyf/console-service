<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersFiles extends Migration
{

    public function up()
    {
        Schema::create('user_file', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('file_id');            
            $table->timestamps();

            $table->primary(['file_id', 'user_id']);

            $table->foreign('file_id')->references('id')->on('files');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_file');
    }
}
