<?php

namespace Tests\Unit\Requests; // ←Unit配下に移動

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Validator; // ←バリデーションファザード
use App\Http\Requests\PersonalRequest; // ←フォームリクエスト


class PersonalRequestTest extends TestCase
{



 /**
     * カスタムリクエストのバリデーションテスト
     *
     * @param array 項目名の配列
     * @param array 値の配列
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataproviderExample
     */
    public function testExample($keys, $values, $expect)
    {
        //入力項目の配列（$keys）と値の配列($values)から、連想配列を生成する
        $dataList = array_combine($keys, $values);

        $request = new PersonalRequest();
        //フォームリクエストで定義したルールを取得
        $rules = $request->rules();
        //Validatorファサードでバリデーターのインスタンスを取得、その際に入力情報とバリデーションルールを引数で渡す
        $validator = Validator::make($dataList, $rules);
        //入力情報がバリデーショルールを満たしている場合はtrue、満たしていな場合はfalseが返る
        $result = $validator->passes();
        //期待値($expect)と結果($result)を比較
        $this->assertEquals($expect, $result);
    }

    public function dataproviderExample()
    {
        return [
            
            '正常' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎', 100, 175.5, 100],
                true
            ],

            '名前 必須エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                [null, 100, 100, 100],
                false
            ],
            '名前 文字数エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎山田太郎山田太郎', 100, 100, 100],
                false
            ],


            '年齢 必須エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎', null, 100, 100],
                false
            ],
            '年齢 文字列エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎', '文字列', 100, 100],
                false
            ],
            '年齢 最大値エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎', 150, 100, 100],
                false
            ],
            '年齢 最小値エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎', -1, 100, 100],
                false
            ],
            '年齢 小数点エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎', 100.5, 100, 100],
                false
            ],


            '身長 必須エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎', 100, null, 100],
                false
            ],
            '身長 文字列エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎', 100, '文字列', 100],
                false
            ],
            '身長 最大値エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎', 100, 350, 100],
                false
            ],
            '身長 最小値エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎', 100, 0.5, 100],
                false
            ],



            '摂取カロリー日目標 必須エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎', 100, 100, null],
                false
            ],
            '摂取カロリー日目標 文字列エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎', 100, 100, '文字列'],
                false
            ],
            '摂取カロリー日目標 最大値エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎', 100, 100, 10000],
                false
            ],
            '摂取カロリー日目標 最小値エラー' => [
                ['name', 'age', 'height', 'kcalParday'],
                ['山田太郎', 100, 100, 0.5],
                false
            ],




   
  
        ];
    }





}
