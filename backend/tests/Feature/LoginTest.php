<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class LoginTest extends TestCase
{




    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        // actingAsメソッドで認証済みにする
        $response_top = $this->actingAs(User::first()); // 追加
    

        // トップページ
        $response_top->get('/')->assertStatus(200)
        ->assertViewIs('welcome')
        ->assertSee('摂取カロリー');

        // プロテイン設定ページ
        $response_top->get('/protainsettingpage')->assertStatus(200)
        ->assertViewIs('protainsettings')
        ->assertSee('プロテインの栄養価情報を登録します');

        // 日誌ページ
        $response_top->get('/daily')->assertStatus(200)
        ->assertViewIs('daily')
        ->assertSee('の日誌');

        // パーソナルページ
        $response_top->get('/personalsettings')->assertStatus(200)
        ->assertViewIs('personalsettings')
        ->assertSee('個人設定');

        // 食事リスト 食事
        $response_top->get('/mealssetting')->assertStatus(200)
        ->assertViewIs('mealssetting')
        ->assertSee('登録した食事');

        // 食事リスト おやつ
        $response_top->get('/mealssetting')->assertStatus(200)
        ->assertViewIs('mealssetting')
        ->assertSee('登録した食事');

        // 食事リスト 飲料
        $response_top->get('/drinkssetting')->assertStatus(200)
        ->assertViewIs('drinkssetting')
        ->assertSee('登録した食事');





        
    }







}
