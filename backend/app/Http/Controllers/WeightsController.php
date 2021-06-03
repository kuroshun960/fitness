<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//S3用に追記//
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Weight;
use App\Models\Date;

use App\Http\Requests\WeightsRequest;  // ←フォームリクエストを使ったバリデーション

class WeightsController extends Controller
{
/*--------------------------------------------------------------------------
    体重追加ページ
--------------------------------------------------------------------------*/
    

    //フォームリクエスト使用の場合は、メソッドの引数を Request から WeightsRequest（フォームリクエストクラス） に変更。

    public function input(WeightsRequest $request)
    {

        /*-------------------------
        フォームリクエストを使ったバリデーションなら、従来の記載はいらない！
        記述なしで自動で検証される。

        $request->validate([
            'weight' => 'numeric|max:300|min:1',
        ]);
        -------------------------*/

        //ログインユーザーのid取得
        $id = Auth::id();

        //ログインユーザーのidでユーザーを取得
        $user = User::find($id);

        //ログインユーザーの体重を作成
        $weight = $user->weights()->create([
            'weight' => $request->weight,
        ]);

        return redirect('/');






    }






}
