<?php

namespace Tests\Unit\Requests; // ←Unit配下に移動

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Validator; // ←バリデーションファザード
use App\Http\Requests\EatRequest; // ←フォームリクエスト


class EatRequestTest extends TestCase
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

        $request = new EatRequest();
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
            '正常' => ['net', 65, true],
            '文字型' => ['net', 'a', false],
            'null' => ['net', null, false],
        ];
    }





}
