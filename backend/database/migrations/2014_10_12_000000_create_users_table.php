<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->rememberToken(); //
            // $table->foreignId('current_team_id')->nullable(); //
            $table->text('profile_photo_path')->nullable();
            $table->timestamps();

            // 目標カロリー/1日 //
            $table->integer('kcalParday')->nullable()->default(2000);
            // 目標カロリー/１週 //
            $table->integer('kcalParweek')->nullable();
            // 増量or減量 //
            $table->string('IncreaseOrDecrease')->nullable()->default('増量期');
            // 性別 //
            $table->string('sex')->nullable()->default('男性');
            // 運動量 //
            $table->string('HardOrSoft')->nullable()->default('middle');
            // 年齢 //
            $table->integer('age')->nullable();
            // 身長 //
            $table->integer('height')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
