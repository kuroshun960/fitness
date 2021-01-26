<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

//S3用に追記//
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Weight;
use App\Models\Date;

class WeightsController extends Controller
{
/*--------------------------------------------------------------------------
    アーティスト追加ページ
--------------------------------------------------------------------------*/
    

    public function input(Request $request)
    {

        //ログインユーザーのid取得
        $id = Auth::id();

        //ログインユーザーのidでユーザーを取得
        $user = User::find($id);

        //ログインユーザーの”その日付”に付随する”体重”を取得
        $weight = $user->dates()->first()->weights()->create([
            'weight' => $request->number,
        ]);


        return redirect('/');



    }






}
