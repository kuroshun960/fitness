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
            //ログインユーザーのid取得
            $id = Auth::id();
            //ログインユーザーのidでユーザーを取得
            $user = User::find($id);

                if ($request->firstcup == "飲んだ!"){

                    $firstcup = $user->protainsetting()->orderBy('created_at', 'desc')->select('kcal','carbo','protain','fat')->first();

                    //プロテインタスクに保存
                    $user->protaintasks()->create([
                        'cups' => "firstcup",
                        'kcal' => $firstcup->kcal,
                        'protain' => $firstcup->protain,
                        'carbo' => $firstcup->carbo,
                        'fat' => $firstcup->fat,
                    ]);
                }

                if ($request->secondcup == "飲んだ!"){

                    $secondcup = $user->protainsetting()->orderBy('created_at', 'desc')->select('kcal','carbo','protain','fat')->first();

                    //プロテインタスクに保存
                    $user->protaintasks()->create([
                        'cups' => "secondcup",
                        'kcal' => $secondcup->kcal,
                        'protain' => $secondcup->protain,
                        'carbo' => $secondcup->carbo,
                        'fat' => $secondcup->fat,
                    ]);
                }

                if ($request->thirdcup == "飲んだ!"){

                    $thirdcup = $user->protainsetting()->orderBy('created_at', 'desc')->select('kcal','carbo','protain','fat')->first();

                    //プロテインタスクに保存
                    $user->protaintasks()->create([
                        'cups' => "thirdcup",
                        'kcal' => $thirdcup->kcal,
                        'protain' => $thirdcup->protain,
                        'carbo' => $thirdcup->carbo,
                        'fat' => $thirdcup->fat,
                    ]);
                }

            return redirect()->route('users.show');
        }















}
