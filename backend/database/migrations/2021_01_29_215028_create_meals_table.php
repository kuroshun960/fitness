<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            //商品名
            $table->string('name');
            //商品種別
            $table->string('type')->default('食事');
            // 商品写真
            $table->text('item_photo_path')->nullable();

            // 内容量
            $table->integer('gram')->nullable();
            $table->integer('piece')->nullable();
            // 価格
            $table->integer('price')->nullable();

            // 栄養素
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
        Schema::dropIfExists('meals');
    }
}
