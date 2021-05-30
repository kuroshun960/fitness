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
            $table->float('gram', 4, 1)->nullable();
            $table->float('piece', 4, 1)->nullable();
            // 価格
            $table->float('price', 4, 1)->nullable();
            // 栄養素
            $table->float('kcal', 4, 1)->nullable();
            $table->float('protain', 4, 1)->nullable();
            $table->float('carbo', 4, 1)->nullable();
            $table->float('fat', 4, 1)->nullable();
            // 格納時の日あたりの目標カロリー
            $table->float('KcalPardayAtThatTime', 4, 1)->nullable();

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
