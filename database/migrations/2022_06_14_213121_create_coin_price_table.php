<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_price', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('coin_id');
            $table->foreign('coin_id')->references('id')->on('coin');

            $table->string('currency', 10);
            $table->decimal('price');
            $table->tinyInteger('last_price')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coin_price');
    }
};
