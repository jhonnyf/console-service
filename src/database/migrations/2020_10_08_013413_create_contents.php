<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContents extends Migration
{

    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->integer('active')->default(1);            
            $table->string('slug');
            $table->date('date')->nullable();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('content')->nullable();
            $table->string('link')->nullable();
            $table->string('video')->nullable();
            $table->timestamps();    
        });
    }

    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
