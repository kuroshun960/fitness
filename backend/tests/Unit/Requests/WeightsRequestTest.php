<?php

namespace Tests\Unit\Requests; // ←Unit配下に移動

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Validator; // ←バリデーションファザード
use App\Http\Requests\WeightsRequest; // ←フォームリクエスト


class WeightsRequestTest extends TestCase
{



 /**
     * カスタムリクエストのバリデーションテスト
     *
     * @param string 項目名
     * @param string 値
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataproviderExample
     */
    public function testExample($item, $data, $expect)
    {
        //入力項目（$item）とその値($data)
        $dataList = [$item => $data];

        $request = new WeightsRequest();
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
            '正常' => ['weight', 65, true],
            '必須エラー' => ['weight', 0, false],
            //str_repeat('a', 256)で、256文字の文字列を作成(aが256個できる)
            '最大文字数エラー' => ['weight', str_repeat('a', 256), false],
            '最大数値' => ['weight', 500, false],
            'null' => ['weight', null, false],
        ];
    }





}
