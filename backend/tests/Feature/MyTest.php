<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use App\Models\User;

class MyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {

        $user = new User();
        $user->name = "山田";
        $user->email = "yamada@test.com";
        $user->password = \Hash::make('password');
        $user->save();
     
        $readUser = $user->where('name', '山田')->first();
        
        //テストを実行するメソッド
        $this->assertNotNull($readUser);            // データが取得できたかテスト
        $this->assertTrue(\Hash::check('password', $readUser->password)); // パスワードが一致しているかテスト
     
        $user->where('email', 'yamada@test.com')->delete(); // テストデータの削除

    }
}
