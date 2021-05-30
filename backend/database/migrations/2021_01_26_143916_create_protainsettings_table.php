<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtainsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protainsettings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->string('name')->default('ビーレジェンド ナチュラル')->nullable();
            $table->float('kcal', 10, 1)->default(115)->nullable();
            $table->float('protain', 10, 1)->default(20)->nullable();
            $table->float('carbo', 10, 1)->default(4)->nullable();
            $table->float('fat', 10, 1)->default(1)->nullable();

            
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
        Schema::dropIfExists('protainsettings');
    }
}
