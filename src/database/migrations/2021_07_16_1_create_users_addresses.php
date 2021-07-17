<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersAddresses extends Migration
{

    public function up()
    {
        Schema::create('users_addresses', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->integer('active')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->string('zipcode', 256);
            $table->string('address', 256);
            $table->integer('number');
            $table->string('complement', 256);
            $table->string('district', 256);
            $table->string('city', 256);
            $table->string('state', 256);
            $table->string('country', 256);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users_addresses');
    }
}
