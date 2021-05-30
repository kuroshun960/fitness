<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//S3用に追記//
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Weight;
use App\Models\Protainsetting;

class ProtainsettingsController extends Controller
{
/*--------------------------------------------------------------------------
    プロテイン設定ページ
--------------------------------------------------------------------------*/
    
    public function setting(Request $request)
        {

            $request->validate([
                'name' => 'required',
                'kcal' => 'required|numeric|max:999',
                'protain' => 'required|numeric|max:999',
                'carbo' => 'required|numeric|max:999',
                'fat' => 'required|numeric|max:999',
            ]);

            //ログインユーザーのid取得
            $id = Auth::id();

            //ログインユーザーのidでユーザーを取得
            $user = User::find($id);

            //ログインユーザーのプロテイン設定を作成
            $weight = $user->protainsetting()->create([
                'name' => $request->name,
                'kcal' => $request->kcal,
                'protain' => $request->protain,
                'carbo' => $request->carbo,
                'fat' => $request->fat,
            ]);
            

            return redirect()->route('users.show');
        }





}
