<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            
            $table->string('name')->nullable();;
            $table->integer('eatKcal')->nullable();
            $table->integer('eatProtain')->nullable();
            $table->integer('eatFat')->nullable();
            $table->integer('eatCarbo')->nullable();
            $table->integer('eatPrice')->nullable();

            $table->float('eatNet', 10, 1)->default(4)->nullable();

            $table->integer('KcalPardayAtThatTime')->nullable();
            $table->string('type')->default('食事');


            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eats');
    }
}
