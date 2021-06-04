<?php

namespace Tests\Unit\Requests; // ←Unit配下に移動

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Validator; // ←バリデーションファザード
use App\Http\Requests\ProtainRequest; // ←フォームリクエスト


class ProtainRequestTest extends TestCase
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

        $request = new ProtainRequest();
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
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 125, 125, 125, 125],
                true
            ],

        //------名前系---------

            '名前必須エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                [null, 125, 125, 125, 125],
                false
            ],
            '名前文字数エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                [str_repeat('a', 21), 125, 125, 125, 125],
                false
            ],

        //------カロリー系---------

            'カロリー値 必須エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', null, 125, 125, 125],
                false
            ],
            'カロリー値 文字列エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', '文字列', 125, 125, 125],
                false
            ],
            'カロリー値 最大値エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 1000, 125, 125, 125],
                false
            ],
            'カロリー値 最小値エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 0.5, 125, 125, 125],
                false
            ],

        //------プロテイン系---------

            'プロテイン値 必須エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 125, null, 125, 125],
                false
            ],
            'プロテイン値 文字列エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 125, '文字列', 125, 125],
                false
            ],
            'プロテイン値 最大値エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 125, 1000, 125, 125],
                false
            ],
            'プロテイン値 最小値エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 125, 0.5, 125, 125],
                false
            ],

        //------炭水化物系---------

            '炭水化物 必須エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 125, 125, null, 125],
                false
            ],
            '炭水化物 文字列エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 125, 125, '文字列', 125],
                false
            ],
            '炭水化物 最大値エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 125, 125, 1000, 125],
                false
            ],
            '炭水化物 最小値エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 125, 125, 0.5, 125],
                false
            ],

        //------脂質系---------

            '脂質 必須エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 125, 125, 125, null],
                false
            ],
            '脂質 文字列エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 125, 125, 125, '文字列'],
                false
            ],
            '脂質 最大値エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 125, 125, 125, 1000],
                false
            ],
            '脂質 最小値エラー' => [
                ['name', 'kcal', 'protain', 'carbo', 'fat'],
                ['プロテイン', 125, 125, 125, 0.5],
                false
            ],




  

  
        ];
    }





}
