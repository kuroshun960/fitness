<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personalsettings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->string('cups');

            $table->integer('kcal')->nullable();
            $table->integer('protain')->nullable();
            $table->integer('carbo')->nullable();
            $table->integer('fat')->nullable();

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
        Schema::dropIfExists('personalsettings');
    }
}
