<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//S3用に追記//
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Weight;
use App\Models\Protainsetting;
use App\Models\Protaintask;

class ProtaintasksController extends Controller
{

    //いっぱい目のプロテインタスク
    public function drank(Request $request)
        {

            $todaydate = date("Y-m-d");

            //ログインユーザーのid取得
            $id = Auth::id();
            //ログインユーザーのidでユーザーを取得
            $user = User::find($id);

            //ユーザーの最新のプロテイン設定の各数値を取得
            $cup = $user->protainsetting()->orderBy('created_at', 'desc')->select('kcal','carbo','protain','fat')->first();

                if ($request->firstcup == "飲んだ!"){

                    //プロテインタスクに保存
                    $user->protaintasks()->create([
                        'cups' => "firstcup",
                        'kcal' => $cup->kcal,
                        'protain' => $cup->protain,
                        'carbo' => $cup->carbo,
                        'fat' => $cup->fat,
                        'KcalPardayAtThatTime' => $user->kcalParday,
                    ]);
                }

                if ($request->secondcup == "飲んだ!"){

                    //プロテインタスクに保存
                    $user->protaintasks()->create([
                        'cups' => "secondcup",
                        'kcal' => $cup->kcal,
                        'protain' => $cup->protain,
                        'carbo' => $cup->carbo,
                        'fat' => $cup->fat,
                        'KcalPardayAtThatTime' => $user->kcalParday,
                    ]);
                }

                if ($request->thirdcup == "飲んだ!"){

                    //プロテインタスクに保存
                    $user->protaintasks()->create([
                        'cups' => "thirdcup",
                        'kcal' => $cup->kcal,
                        'protain' => $cup->protain,
                        'carbo' => $cup->carbo,
                        'fat' => $cup->fat,
                        'KcalPardayAtThatTime' => $user->kcalParday,
                    ]);
                }

            return redirect()->route('users.show');
        }















}
