<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('favorite_trademarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('trademark_id');

            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('trademark_id')->references('id')->on('trademarks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorite_trademarks');
    }
};
