<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtaintasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protaintasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->string('cups');

            $table->integer('kcal')->nullable();
            $table->integer('protain')->nullable();
            $table->integer('carbo')->nullable();
            $table->integer('fat')->nullable();

            // 格納時の日あたりの目標カロリー
            $table->integer('KcalPardayAtThatTime')->nullable();

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
        Schema::dropIfExists('protaintasks');
    }
}
