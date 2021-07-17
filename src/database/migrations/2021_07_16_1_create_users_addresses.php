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
            $table->string('zipcode', 10);
            $table->string('address', 256)->nullable();
            $table->integer('number');
            $table->string('complement', 256)->nullable();
            $table->string('district', 256)->nullable();
            $table->string('city', 256)->nullable();
            $table->string('state', 256)->nullable();
            $table->string('country', 256)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users_addresses');
    }
}
