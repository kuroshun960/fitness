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
    摂取栄養素 （プロテインタスク分追加処理）
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
        
            


/*-----------------------------------------------------------------------------------------
    今日取得した栄養素の合計値
-----------------------------------------------------------------------------------------*/   
        
        $dayProtainNuts = $user->protaintasks()->get();

        $dayMealNuts = $user->eats()->get();
        
        $daily = [];

        $sumKcal1 = ['kcal'=>0,'protain'=>0,'fat'=>0,'carbo'=>0,];

        $sumKcal2 = ['kcal'=>0,'protain'=>0,'fat'=>0,'carbo'=>0,];
        $sumKcal3 = ['kcal'=>0,'protain'=>0,'fat'=>0,'carbo'=>0,];
        $sumKcal4 = ['kcal'=>0,'protain'=>0,'fat'=>0,'carbo'=>0,];
        $sumKcal5 = ['kcal'=>0,'protain'=>0,'fat'=>0,'carbo'=>0,];
        $sumKcal6 = ['kcal'=>0,'protain'=>0,'fat'=>0,'carbo'=>0,];
        $sumKcal7 = ['kcal'=>0,'protain'=>0,'fat'=>0,'carbo'=>0,];
        

        $aaa = 1;

        foreach ($dayProtainNuts as $dayProtainNut) {

            
            if(date('Y/m/d', strtotime($dayProtainNut->created_at)) === date('Y/m/d', strtotime($todaydate))){
                $sumKcal1['kcal'] += $dayProtainNut->kcal;
                $sumKcal1['protain'] += $dayProtainNut->protain;
                $sumKcal1['fat'] += $dayProtainNut->fat;
                $sumKcal1['carbo'] += $dayProtainNut->carbo;
            }

            elseif( date('Y/m/d', strtotime($dayProtainNut->created_at)) === date('Y/m/d', strtotime('-'.$aaa.' day')) ) {
                $sumKcal2['kcal'] += $dayProtainNut->kcal;
                $sumKcal2['protain'] += $dayProtainNut->protain;
                $sumKcal2['fat'] += $dayProtainNut->fat;
                $sumKcal2['carbo'] += $dayProtainNut->carbo;
            }
            elseif( date('Y/m/d', strtotime($dayProtainNut->created_at)) === date('Y/m/d', strtotime('-2 day')) ) {
                $sumKcal3['kcal'] += $dayProtainNut->kcal;
                $sumKcal3['protain'] += $dayProtainNut->protain;
                $sumKcal3['fat'] += $dayProtainNut->fat;
                $sumKcal3['carbo'] += $dayProtainNut->carbo;
            }
            elseif( date('Y/m/d', strtotime($dayProtainNut->created_at)) === date('Y/m/d', strtotime('-3 day')) ) {
                $sumKcal4['kcal'] += $dayProtainNut->kcal;
                $sumKcal4['protain'] += $dayProtainNut->protain;
                $sumKcal4['fat'] += $dayProtainNut->fat;
                $sumKcal4['carbo'] += $dayProtainNut->carbo;
            }
            elseif( date('Y/m/d', strtotime($dayProtainNut->created_at)) === date('Y/m/d', strtotime('-4 day')) ) {
                $sumKcal5['kcal'] += $dayProtainNut->kcal;
                $sumKcal5['protain'] += $dayProtainNut->protain;
                $sumKcal5['fat'] += $dayProtainNut->fat;
                $sumKcal5['carbo'] += $dayProtainNut->carbo;
            }
            elseif( date('Y/m/d', strtotime($dayProtainNut->created_at)) === date('Y/m/d', strtotime('-5 day')) ) {
                $sumKcal6['kcal'] += $dayProtainNut->kcal;
                $sumKcal6['protain'] += $dayProtainNut->protain;
                $sumKcal6['fat'] += $dayProtainNut->fat;
                $sumKcal6['carbo'] += $dayProtainNut->carbo;
            }
            elseif( date('Y/m/d', strtotime($dayProtainNut->created_at)) === date('Y/m/d', strtotime('-6 day')) ) {
                $sumKcal7['kcal'] += $dayProtainNut->kcal;
                $sumKcal7['protain'] += $dayProtainNut->protain;
                $sumKcal7['fat'] += $dayProtainNut->fat;
                $sumKcal7['carbo'] += $dayProtainNut->carbo;
            }
  
        }

        foreach ($dayMealNuts as $dayMealNut) {
            
            if(date('Y/m/d', strtotime($dayMealNut->created_at)) === date('Y/m/d', strtotime($todaydate))){
                $sumKcal1['kcal'] += $dayMealNut->eatKcal;
                $sumKcal1['protain'] += $dayMealNut->eatProtain;
                $sumKcal1['fat'] += $dayMealNut->eatFat;
                $sumKcal1['carbo'] += $dayMealNut->eatCarbo;
            }
            elseif( date('Y/m/d', strtotime($dayMealNut->created_at)) === date('Y/m/d', strtotime('-1 day')) ) {
                $sumKcal2['kcal'] += $dayMealNut->eatKcal;
                $sumKcal2['protain'] += $dayMealNut->eatProtain;
                $sumKcal2['fat'] += $dayMealNut->eatFat;
                $sumKcal2['carbo'] += $dayMealNut->eatCarbo;
            }
            elseif( date('Y/m/d', strtotime($dayMealNut->created_at)) === date('Y/m/d', strtotime('-2 day')) ) {
                $sumKcal3['kcal'] += $dayMealNut->eatKcal;
                $sumKcal3['protain'] += $dayMealNut->eatProtain;
                $sumKcal3['fat'] += $dayMealNut->eatFat;
                $sumKcal3['carbo'] += $dayMealNut->eatCarbo;
            }
            elseif( date('Y/m/d', strtotime($dayMealNut->created_at)) === date('Y/m/d', strtotime('-3 day')) ) {
                $sumKcal4['kcal'] += $dayMealNut->eatKcal;
                $sumKcal4['protain'] += $dayMealNut->eatProtain;
                $sumKcal4['fat'] += $dayMealNut->eatFat;
                $sumKcal4['carbo'] += $dayMealNut->eatCarbo;
            }
            elseif( date('Y/m/d', strtotime($dayMealNut->created_at)) === date('Y/m/d', strtotime('-4 day')) ) {
                $sumKcal5['kcal'] += $dayMealNut->eatKcal;
                $sumKcal5['protain'] += $dayMealNut->eatProtain;
                $sumKcal5['fat'] += $dayMealNut->eatFat;
                $sumKcal5['carbo'] += $dayMealNut->eatCarbo;
            }
            elseif( date('Y/m/d', strtotime($dayMealNut->created_at)) === date('Y/m/d', strtotime('-5 day')) ) {
                $sumKcal6['kcal'] += $dayMealNut->eatKcal;
                $sumKcal6['protain'] += $dayMealNut->eatProtain;
                $sumKcal6['fat'] += $dayMealNut->eatFat;
                $sumKcal6['carbo'] += $dayMealNut->eatCarbo;
            }
            elseif( date('Y/m/d', strtotime($dayMealNut->created_at)) === date('Y/m/d', strtotime('-6 day')) ) {
                $sumKcal7['kcal'] += $dayMealNut->eatKcal;
                $sumKcal7['protain'] += $dayMealNut->eatProtain;
                $sumKcal7['fat'] += $dayMealNut->eatFat;
                $sumKcal7['carbo'] += $dayMealNut->eatCarbo;
            }

        }

/*-----------------------------------------------------------------------------------------
    目標値までの数値の表示
-----------------------------------------------------------------------------------------*/   
                
        $kcalPardayToGoal = $kcalParday - $sumKcal1['kcal'];
        $protainPardayToGoal = $protainPardayCeil - $sumKcal1['protain'];
        $fatPardayCeilToGoal = $fatPardayCeil - $sumKcal1['fat'];
        $carboPardayCeilToGoal = $carboPardayCeil - $sumKcal1['carbo'];
                
/*-----------------------------------------------------------------------------------------
        継続日数
-----------------------------------------------------------------------------------------*/   

        $meals = $user->eats()->orderBy('created_at', 'desc')->get()
                    ->groupBy(function ($row) {
                    return $row->created_at->format('y-m-d');
                    });
        
        $i = -1;
        $continueDay = 0; 
        foreach ($meals as $meal => $value) {

            //昨日のデータがあれば、$iに数字を渡す。なければ渡さないので、一昨日以降の処理がされない
            if( $meal === date("y-m-d", strtotime($i.'day')) ){
                $i -= 1;
                $continueDay += 1;
                //dd($i);
            }
            //今日のデータが入力されたら、継続日数に1加算
            if( $meal === date("y-m-d", strtotime('today')) ){
                $continueDay += 1;
            }
        }
        


/*-----------------------------------------------------------------------------------------
        食品リスト
-----------------------------------------------------------------------------------------*/   
                
        $getMeals = $user->meals()->get();
                
        $mealslists = [];

        foreach ($getMeals as $getMeal) {

            array_push($mealslists,$getMeal);
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

            //登録した食品のリスト
            'mealslists' => $mealslists,

            //継続日数
            'continueDay' => $continueDay,

        ];

        return view('welcome',compact('data'));
    }

    }

/*-----------------------------------------------------------------------------------------
        個人設定
-----------------------------------------------------------------------------------------*/

    public function personalsettingspage()
    {
        $userAlldata = $this->show();
        $data = $userAlldata['data'];

        return view('personalsettings',compact('data'));
    }

/*-----------------------------------------------------------------------------------------
        プロテイン設定
-----------------------------------------------------------------------------------------*/


    public function protainsettingpage()
        {
            $userAlldata = $this->show();
            $data = $userAlldata['data'];

            return view('protainsettings',compact('data'));
        }



/*-----------------------------------------------------------------------------------------
        活動日誌 一覧ページ
-----------------------------------------------------------------------------------------*/

public function daily()
{
    $userAlldata = $this->show();
    $user = Auth::User();

        $days = $user->eats()->orderBy('created_at', 'desc')->get()
                ->groupBy(function ($row) {
                    return $row->created_at->format('y-m-d');
                });

        $protaintasks = $user->protaintasks()->orderBy('created_at', 'desc')->get()
                ->groupBy(function ($row) {
                    return $row->created_at->format('y-m-d');
                });
  
    $dayKcal = [];

    //日付のデータ取得
    foreach( $days as $day){

        
        $daydate = $day[0]->created_at->format('y-m-d');
            
        $allKcal = 0;
            //その日の食事を一個ずつ取得
            foreach( $day as $meal ){
                //その日の食事のkcalを一個ずつ加算
                $allKcal = $allKcal + $meal->eatKcal;
            }

            $i=0;
            //プロテインタスクデータを取得
            foreach( $protaintasks as $protaintask ){
                //プロテインタスクデータを日ごとに振り分け
                foreach($protaintask as $protain){
                    //日付データと、プロテインを飲んだ日が同じなら、$allkcalに加算
                    if($day[0]->created_at->format('Y/m/d') === $protaintask[0]->created_at->format('Y/m/d')){
                        $allKcal = $allKcal + $protaintask[0]->kcal;
                    }
                }
            }
            
        $dayKcal = array_merge($dayKcal,array($daydate=>$allKcal));

        if(isset($days[21-05-23])){
            $allKcal = 3000;
            array_push($dayKcal,$allKcal);
        }

    }

    //$dayKcalrev = array_reverse($dayKcal);

    $data = $userAlldata['data'];


    return view('daily',compact('data','days','dayKcal'));


}


/*-----------------------------------------------------------------------------------------
        活動日誌 日ページ
-----------------------------------------------------------------------------------------*/

public function daypage($id)
{
    $userAlldata = $this->show();
    $data = $userAlldata['data'];


    $day = $id;

    //dd($day);

    $user = Auth::User();

    //今日の日付
    //$todaydate = date("y-m-d");

    $eatmeals = $user->eats()->whereDate('created_at', $day)->get();
    $protaintasks = $user->protaintasks()->whereDate('created_at', $day)->get();

    

    $allKcal = 0;
    $allProtain = 0;
    $allFat = 0;
    $allCarbo = 0;
    $allPrice = 0;
    

    foreach($eatmeals as $eatmeal){
        
        $allKcal += $eatmeal->eatKcal;
        $allProtain += $eatmeal->eatProtain;
        $allFat += $eatmeal->eatFat;
        $allCarbo += $eatmeal->eatCarbo;
        $allPrice += $eatmeal->eatPrice;

    }

    

    foreach($protaintasks as $protaintask){

        $allKcal += $protaintask->kcal;
        $allProtain += $protaintask->Pprotain;
        $allFat += $protaintask->fat;
        $allCarbo += $protaintask->carbo;
        $allPrice += $protaintask->price;

    }

    

    $nutdata = [
        'allKcal' => $allKcal,
        'allProtain' => $allProtain,
        'allFat' => $allFat,
        'allCarbo' => $allCarbo,
        'allPrice' => $allPrice,
        ];

        

    //dd($eatmeals);

    return view('daypage',compact('eatmeals','day','protaintasks','nutdata','data'));
}

/*-----------------------------------------------------------------------------------------
        ユーザー設定
-----------------------------------------------------------------------------------------*/

    public function setting(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20',
            'age' => 'required|max:3',
            'height' => 'required|max:3',
            'kcalParday' => 'required',
            
        ]);

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
