<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//S3用に追記//
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Weight;
use App\Models\Date;

class UsersController extends Controller
{

    //ユーザーの現在の状態を全て表示//
    public function show()
    {

        //トップページで見せるもの全てを格納する配列を定義＆初期化
        $data = [];

        //今日の日付
        $todaydate = date("Y-m-d");

        if (\Auth::check()){

            //ログインユーザー//
            $user = \Auth::user();


            //今日の体重//
            $weight = $user->weights()->whereDate('created_at', $todaydate)->first();


/*-----------------------------------------------------------------------------------------
    基礎代謝 / 適正体重 / 消費カロリー
-----------------------------------------------------------------------------------------*/

        $fitWeightFloor = 0;    // 適正体重 //
        $baseEnergy = 0;     // 基礎代謝 //
        $needEnergy = 0;        // 必要カロリー //

        if( isset($weight) ){

            // 適正体重 //
            $fitWeight = $user->height / 100 * $user->height / 100 * 22 ;
            $fitWeightFloor = floor( $fitWeight );

            if( $user->sex == '男性' ){

                // 基礎代謝(ハリスベネディクト式) //
                $baseEnergy = floor( 66.4730 + $user->height * 5.0033 + $weight->weight * 13.7516 - $user->age*6.7550 );

                // 男性の1日の消費カロリー (基礎代謝+身体活動指数) //
                if( $user->HardOrSoft == 'soft' ){ $needEnergy = $baseEnergy * 1.5; }
                if( $user->HardOrSoft == 'middle' ){ $needEnergy = $baseEnergy * 1.75; }
                if( $user->HardOrSoft == 'hard' ){ $needEnergy = $baseEnergy * 2; }

            }

            elseif( $user->sex == '女性' ){

                // 基礎代謝(ハリスベネディクト式) //
                $baseEnergy = floor( 655.0955 + $user->height * 1.8496 + $weight->weight * 9.5634 - $user->age*4.6756 );
                // 女性の1日の消費カロリー (基礎代謝+身体活動指数) //
                if( $user->HardOrSoft == 'soft' ){ $needEnergy = $baseEnergy * 1.5; }
                if( $user->HardOrSoft == 'middle' ){ $needEnergy = $baseEnergy * 1.75; }
                if( $user->HardOrSoft == 'hard' ){ $needEnergy = $baseEnergy * 2; }

            }


        }



/*-----------------------------------------------------------------------------------------
    目標摂取量 関連処理
-----------------------------------------------------------------------------------------*/

            //日あたりの目標タンパク質//
            $kcalParday = $user->kcalParday;
            $kcalPardayPar100 =  $kcalParday / 100;


            //
            $protainPardayCeil = 0;
            $fatPardayCeil = 0;
            $carboPardayCeil = 0;
            $parDay = [];



                if( $user->IncreaseOrDecrease === '増量期' ){
                //日あたりの目標タンパク質//
                    $protainParday = $kcalPardayPar100 * 30 / 4;
                    $protainPardayCeil = ceil($protainParday);

                    //日あたりの目標脂質//
                    $fatParday = $kcalPardayPar100 * 20 / 9;
                    $fatPardayCeil = ceil($fatParday);

                    //日あたりの目標炭水化物//
                    $carboParday = $kcalPardayPar100 * 50 / 4;
                    $carboPardayCeil = ceil($carboParday);
                    
                    $parDay = ['kcal' => $kcalParday,'protain' => $protainPardayCeil,'fat' => $fatPardayCeil,'carbo' => $carboPardayCeil,];
                }
                elseif( $user->IncreaseOrDecrease === '減量期' ){

                    $protainParday = $kcalPardayPar100 * 40 / 4;
                    $protainPardayCeil = ceil($protainParday);
    
                    //日あたりの目標脂質//
                    $fatParday = $kcalPardayPar100 * 20 / 9;
                    $fatPardayCeil = ceil($fatParday);
    
                    //日あたりの目標炭水化物//
                    $carboParday = $kcalPardayPar100 * 40 / 4;
                    $carboPardayCeil = ceil($carboParday);
                    
                    $parDay = ['kcal' => $kcalParday,'protain' => $protainPardayCeil,'fat' => $fatPardayCeil,'carbo' => $carboPardayCeil,];

                }

            

/*-----------------------------------------------------------------------------------------
    プロテインタスク 関連処理
-----------------------------------------------------------------------------------------*/
            
            //プロテインタスクがどのくらい達成されてるか、プロテインタスクテーブルのカラム内容で判定//
            $protainTaskFirstcup = $user->protaintasks()->whereDate('created_at', $todaydate)->where('cups','firstcup')->first();
            $protainTaskSecondcup = $user->protaintasks()->whereDate('created_at', $todaydate)->where('cups','secondcup')->first();
            $protainTaskThirdcup = $user->protaintasks()->whereDate('created_at', $todaydate)->where('cups','thirdcup')->first();

            //達成されたプロテインタスクの総栄養素を入れる配列の定義＆初期化//
            $protainAll =['kcal' => 0,'protain' => 0,'fat' =>0,'carbo' =>0,];
            
            //１杯目まで達成されていた時の、達成されたプロテインタスクの総栄養素を配列に格納//
            if( !is_null($protainTaskFirstcup) ){

                $cupKcal = $protainTaskFirstcup->kcal;
                $cupProtain = $protainTaskFirstcup->protain;
                $cupFat = $protainTaskFirstcup->fat;
                $cupCarbo = $protainTaskFirstcup->carbo;

                $protainAll = ['kcal' => $cupKcal,'protain' => $cupProtain,'fat' => $cupFat,'carbo' => $cupCarbo];
                
                
                //２杯目まで達成されていた時、達成されたプロテインタスクの総栄養素を配列に格納//
                if( !is_null($protainTaskSecondcup) ){

                    $cupKcal = $protainTaskFirstcup->kcal + $protainTaskSecondcup->kcal;
                    $cupProtain = $protainTaskFirstcup->protain + $protainTaskSecondcup->protain;
                    $cupFat = $protainTaskFirstcup->fat + $protainTaskSecondcup->fat;
                    $cupCarbo = $protainTaskFirstcup->carbo + $protainTaskSecondcup->carbo;

                    $protainAll = ['kcal' => $cupKcal,'protain' => $cupProtain,'fat' => $cupFat,'carbo' => $cupCarbo];

                    //３杯目まで達成されていた時、達成されたプロテインタスクの総栄養素を配列に格納//
                    if( !is_null($protainTaskThirdcup) ){

                        $cupKcal = $protainTaskFirstcup->kcal + $protainTaskSecondcup->kcal + $protainTaskThirdcup->kcal;
                        $cupProtain = $protainTaskFirstcup->protain + $protainTaskSecondcup->protain + $protainTaskThirdcup->protain;
                        $cupFat = $protainTaskFirstcup->fat + $protainTaskSecondcup->fat + $protainTaskThirdcup->fat;
                        $cupCarbo = $protainTaskFirstcup->carbo + $protainTaskSecondcup->carbo + $protainTaskThirdcup->carbo;
    
                        $protainAll = ['kcal' => $cupKcal,'protain' => $cupProtain,'fat' => $cupFat,'carbo' => $cupCarbo];

                    }
                }
            }
        
        }


/*-----------------------------------------------------------------------------------------
    目標値までの数値の表示
-----------------------------------------------------------------------------------------*/   
        
        $kcalPardayToGoal = $kcalParday - $protainAll['kcal'];
        $protainPardayToGoal = $protainPardayCeil - $protainAll['protain'];
        $fatPardayCeilToGoal = $fatPardayCeil - $protainAll['fat'];
        $carboPardayCeilToGoal = $carboPardayCeil - $protainAll['carbo'];

/*-----------------------------------------------------------------------------------------
    今日取得した栄養素の合計値
-----------------------------------------------------------------------------------------*/   
        
        $dayNuts = $user->protaintasks()->get();
        
        $daily = [];

        $sumKcal1 = 0;
        $sumKcal2 = 0;
        $sumKcal3 = 0;
        $sumKcal4 = 0;
        $sumKcal5 = 0;
        $sumKcal6 = 0;
        $sumKcal7 = 0;

        foreach ($dayNuts as $dayNut) {

            
            if(date('Y/m/d', strtotime($dayNut->created_at)) === date('Y/m/d', strtotime($todaydate))){
                $sumKcal1 += $dayNut->kcal;
            }

            elseif( date('Y/m/d', strtotime($dayNut->created_at)) === date('Y/m/d', strtotime('-1 day')) ) {
                $sumKcal2 += $dayNut->kcal;
            }
            elseif( date('Y/m/d', strtotime($dayNut->created_at)) === date('Y/m/d', strtotime('-2 day')) ) {
                $sumKcal3 += $dayNut->kcal;
            }
            elseif( date('Y/m/d', strtotime($dayNut->created_at)) === date('Y/m/d', strtotime('-3 day')) ) {
                $sumKcal4 += $dayNut->kcal;
            }
            elseif( date('Y/m/d', strtotime($dayNut->created_at)) === date('Y/m/d', strtotime('-4 day')) ) {
                $sumKcal5 += $dayNut->kcal;
            }
            elseif( date('Y/m/d', strtotime($dayNut->created_at)) === date('Y/m/d', strtotime('-5 day')) ) {
                $sumKcal6 += $dayNut->kcal;
            }
            elseif( date('Y/m/d', strtotime($dayNut->created_at)) === date('Y/m/d', strtotime('-6 day')) ) {
                $sumKcal7 += $dayNut->kcal;
            }
  
        }


        

       
/*-----------------------------------------------------------------------------------------
        ビューに渡す
-----------------------------------------------------------------------------------------*/

        

        $data = [

            //体重
            'weight' => $weight,

            //プロテインの摂取栄養素
            'protainAll' => $protainAll,


            //適正体重、基礎代謝、必要カロリー
            'fitWeightFloor' => $fitWeightFloor,
            'baseEnergy' => $baseEnergy,
            'needEnergy' => $needEnergy,

            //1日の目標までの残り摂取量
            'kcalPardayToGoal' => $kcalPardayToGoal,
            'protainPardayToGoal' => $protainPardayToGoal,
            'fatPardayCeilToGoal' => $fatPardayCeilToGoal,
            'carboPardayCeilToGoal' => $carboPardayCeilToGoal,

            //1日の目標摂取栄養素
            'parDay' => $parDay,
            'parprotain' => $protainPardayCeil,
            'parfat' => $fatPardayCeil,
            'parcarbo' => $carboPardayCeil,

            //１週間のカロリー
            'sumKcal1' => $sumKcal1,
            'sumKcal2' => $sumKcal2,
            'sumKcal3' => $sumKcal3,
            'sumKcal4' => $sumKcal4,
            'sumKcal5' => $sumKcal5,
            'sumKcal6' => $sumKcal6,
            'sumKcal7' => $sumKcal7,

        ];

        return view('welcome',compact('data'));

    }

/*-----------------------------------------------------------------------------------------
        個人設定
-----------------------------------------------------------------------------------------*/

    public function personalsettingspage()
    {
        return view('personalsettings');
    }

/*-----------------------------------------------------------------------------------------
        活動日誌ページ
-----------------------------------------------------------------------------------------*/

public function daily()
{
    return view('daily');
}

/*-----------------------------------------------------------------------------------------
        ユーザー設定
-----------------------------------------------------------------------------------------*/

    public function setting(Request $request)
    {

        //ログインユーザーのid取得
        $id = Auth::id();

        //ログインユーザーのidでユーザーを取得
        $user = User::find($id);

        $user->name = $request->name;
        $user->age = $request->age;
        $user->sex = $request->sex;
        $user->HardOrSoft = $request->HardOrSoft;
        $user->height = $request->height;
        $user->kcalParday = $request->kcalParday;
        $user->kcalParweek = $request->kcalParday * 7;
        $user->IncreaseOrDecrease = $request->IncreaseOrDecrease;
        
        $user->save();
        
        return redirect()->route('users.show');
    }












}
