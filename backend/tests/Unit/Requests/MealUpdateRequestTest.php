<?php

namespace Tests\Unit\Requests; // ←Unit配下に移動

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Validator; // ←バリデーションファザード
use App\Http\Requests\MealUpdateRequest; // ←フォームリクエスト


class MealUpdateRequestTest extends TestCase
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

        $request = new MealUpdateRequest();
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
                ['name', 'kcal', 'protain', 'fat', 'carbo', 'price'],
                ['鶏肉', 100, 175.5, 100, 100, 100],
                true
            ],


        //------名前系---------

            '食事名 文字数エラー' => [
                ['name', 'kcal', 'protain', 'fat', 'carbo', 'price'],
                [str_repeat('a', 21), 100, 100, 100, 100, 100],
                false
            ],
            '食事名 必須エラー' => [
                ['name', 'kcal', 'protain', 'fat', 'carbo', 'price'],
                [null, 100, 100, 100, 100, 100],
                false
            ],

        //------名前系---------

            'カロリー値 必須エラー' => [
                ['name', 'kcal', 'protain', 'fat', 'carbo', 'price'],
                ['鶏肉', null, 125, 125, 125, 100],
                false
            ],
            'カロリー値 文字列エラー' => [
                ['name', 'kcal', 'protain', 'fat', 'carbo', 'price'],
                ['鶏肉', '文字列', 125, 125, 125, 100],
                false
            ],
            'カロリー値 最大値エラー' => [
                ['name', 'kcal', 'protain', 'fat', 'carbo', 'price'],
                ['鶏肉', 10000, 125, 125, 125, 100],
                false
            ],
            'カロリー値 最小値エラー' => [
                ['name', 'kcal', 'protain', 'fat', 'carbo', 'price'],
                ['鶏肉', 0.5, 125, 125, 125, 100],
                false
            ],

        //------プロテイン系---------

        'プロテイン値 必須エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, null, 125, 125, 100],
            false
        ],
        'プロテイン値 文字列エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, '文字列', 125, 125, 100],
            false
        ],
        'プロテイン値 最大値エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, 1000, 125, 125, 100],
            false
        ],
        'プロテイン値 最小値エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, 0.5, 125, 125, 100],
            false
        ],

        //------炭水化物系---------

        '炭水化物 必須エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, 125, null, 125, 100],
            false
        ],
        '炭水化物 文字列エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, 125, '文字列', 125, 100],
            false
        ],
        '炭水化物 最大値エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, 125, 1000, 125, 100],
            false
        ],
        '炭水化物 最小値エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, 125, 0.5, 125, 100],
            false
        ],

        //------脂質系---------

        '脂質 必須エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, 125, 125, null, 100],
            false
        ],
        '脂質 文字列エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, 125, 125, '文字列', 100],
            false
        ],
        '脂質 最大値エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, 125, 125, 1000, 100],
            false
        ],
        '脂質 最小値エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, 125, 125, 0.5, 100],
            false
        ],

        //------費用系---------

        '費用 必須エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, 125, 125, 100, null],
            false
        ],
        '費用 文字列エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, 125, 125, 100, '文字列'],
            false
        ],
        '費用 最大値エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, 125, 125, 100, 1000000],
            false
        ],
        '費用 最小値エラー' => [
            ['name', 'kcal', 'protain', 'carbo', 'fat', 'price'],
            ['鶏肉', 125, 125, 125, 100, 0.5],
            false
        ],


  
        ];
    }





}
