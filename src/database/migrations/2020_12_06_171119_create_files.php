<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiles extends Migration
{

    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->integer('active')->default(1);
            $table->unsignedBigInteger('file_gallery_id');
            $table->string('file_path', 256);
            $table->string('original_name', 256);
            $table->string('extension', 100);
            $table->decimal('size', 10, 4);
            $table->string('mime_type', 100);
            $table->timestamps();

            $table->foreign('file_gallery_id')->references('id')->on('files_galleries')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
}
