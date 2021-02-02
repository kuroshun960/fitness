<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//S3用に追記//
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Weight;
use App\Models\Date;
use App\Models\Meals;
use App\Models\Eats;

class MealsController extends Controller
{
    
    public function show()
        {

            //ログインユーザー//
            $user = \Auth::user();

            $getmeals = $user->meals()->get();

            $meals = [];

            $mealDate = [];

            foreach ($getmeals as $meal) {
                

                //食品の情報
                $mealId = $meal->id;
                $mealName = $meal->name;
                $mealKcal = $meal->kcal;
                $mealPrice = $meal->price;
                $mealType = $meal->type;

                //食品の内容量
                $mealGram = $meal->gram;
                $mealPiece = $meal->piece;

                //食品の栄養素
                $mealProtain = $meal->protain;
                $mealCarbo = $meal->carbo;
                $mealFat = $meal->fat;

                /*
                //食品の内容量/グラム の初期化
                $mealKcalParGram = 0;
                $mealPriceParGram = 0;
                $mealKcalParPrice = 0;
                $mealGramParPrice = 0;

                //食品の内容量/個数 の初期化
                $mealKcalParPiece = 0;
                $mealPriceParPiece = 0;
                $mealKcalParPrice = 0;
                $mealPieceParPrice = 0;
                */
                //dd($mealCarbo);

                if( isset($meal->gram) ){
                $mealKcalParGram = number_format($meal->kcal / $meal->gram,2) ;
                $mealPriceParGram = number_format($meal->price / $meal->gram,2);
                $mealKcalParPrice = number_format($meal->kcal / $meal->price,2);
                $mealGramParPrice = number_format($meal->gram / $meal->price,2);

                $mealProtainParPrice = number_format($meal->protain / $meal->price,2) ;
                $mealFatParPrice = number_format($meal->fat / $meal->price,2);
                $mealCarboParPrice = number_format($meal->carbo / $meal->price,2);

                $mealDate = [
                    'mealId' => $mealId,
                    'mealName' => $mealName,
                    'mealType' => $mealType,
                    'mealKcal' => $mealKcal,
                    'mealPrice' => $mealPrice,
                    'mealGram' => $mealGram,
                    'mealPiece' => $mealPiece,
                    'mealProtain' => $mealProtain,
                    'mealCarbo' => $mealCarbo,
                    'mealFat' => $mealFat,

                    'mealKcalParGram' => $mealKcalParGram,
                    'mealPriceParGram' => $mealPriceParGram,
                    'mealKcalParPrice' => $mealKcalParPrice,
                    'mealGramParPrice' => $mealGramParPrice,

                    'mealProtainParPrice' => $mealProtainParPrice, 
                    'mealFatParPrice' => $mealFatParPrice,
                    'mealCarboParPrice' => $mealCarboParPrice,

                ];

                }
                elseif( isset($meal->piece) ){
                $mealKcalParPiece = number_format($meal->kcal / $meal->piece,2) ;
                $mealPriceParPiece = number_format($meal->price / $meal->piece,2) ;
                $mealKcalParPrice = number_format($meal->kcal / $meal->price,2) ;
                $mealPieceParPrice = number_format($meal->piece / $meal->price,2) ;

                $mealProtainParPrice = number_format($meal->protain / $meal->price,2) ;
                $mealFatParPrice = number_format($meal->fat / $meal->price,2);
                $mealCarboParPrice = number_format($meal->carbo / $meal->price,2);

                $mealDate = [
                    
                    'mealId' => $mealId,
                    'mealName' => $mealName,
                    'mealType' => $mealType,
                    'mealKcal' => $mealKcal,
                    'mealPrice' => $mealPrice,
                    'mealGram' => $mealGram,
                    'mealPiece' => $mealPiece,
                    'mealProtain' => $mealProtain,
                    'mealCarbo' => $mealCarbo,
                    'mealFat' => $mealFat,

                    'mealKcalParPiece' => $mealKcalParPiece,
                    'mealPriceParPiece' => $mealPriceParPiece,
                    'mealKcalParPrice' => $mealKcalParPrice,
                    'mealPieceParPrice' => $mealPieceParPrice,

                    'mealProtainParPrice' => $mealProtainParPrice, 
                    'mealFatParPrice' => $mealFatParPrice,
                    'mealCarboParPrice' => $mealCarboParPrice,
                ];

                

                }

                array_push($meals ,$mealDate);


            }


            $users_controller = app()->make('App\Http\Controllers\UsersController');
            $userAlldata = $users_controller->show();

            $data = $userAlldata['data'];
            


            
            return view('mealssetting',compact('meals','data'));

        }



    public function snacks()
    {
        $users_controller = app()->make('App\Http\Controllers\UsersController');
        $userAlldata = $users_controller->show();
        $data = $userAlldata['data'];

        $snacksshow = $this->show();

        $meals = $snacksshow['meals'];

        return view('snackssetting',compact('meals','data'));
    }




    public function drinks()
    {
        $users_controller = app()->make('App\Http\Controllers\UsersController');
        $userAlldata = $users_controller->show();
        $data = $userAlldata['data'];

        $snacksshow = $this->show();

        $meals = $snacksshow['meals'];

        return view('drinkssetting',compact('meals','data'));
    }




    public function updatepage()
    {
        $users_controller = app()->make('App\Http\Controllers\UsersController');
        $userAlldata = $users_controller->show();
        $data = $userAlldata['data'];

        return view('meal-update',compact('data'));
    }

    public function update(Request $request ,$id)
    {

        

        $user = \Auth::user();

        

        //プロテインタスクに保存
        $user->meals()->find($id)->update([

            'name' => $request->name,
            'price' => $request->price,
            'kcal' => $request->kcal,
            'protain' => $request->protain,
            'fat' => $request->fat,
            'carbo' => $request->carbo,

            'piece' => $request->piece,
            'gram' => $request->gram,
            'type' => $request->type,
            
        ]);

        return redirect()->route('users.show');
    }



    public function eats(Request $request)
        {

            $user = \Auth::user();

            

            $eatmeal = $user->meals()->find($request->eatmeal);

            

            if( isset($eatmeal->gram) ){

            //摂取した量に対しての炭水化物
            $name = $eatmeal->name;
            //摂取した量に対してのカロリー
            $eatKcal = ceil ($eatmeal->kcal / $eatmeal->gram * $request->net);
            //摂取した量に対してのタンパク質
            $eatProtain = ceil ($eatmeal->protain / $eatmeal->gram * $request->net);
            //摂取した量に対しての脂質
            $eatFat = ceil ($eatmeal->fat / $eatmeal->gram * $request->net);
            //摂取した量に対しての炭水化物
            $eatCarbo = ceil ($eatmeal->carbo / $eatmeal->gram * $request->net);
            //摂取した量に対してかかった金額
            $eatPrice = ceil ($eatmeal->price / $eatmeal->gram * $request->net);
            //摂取していた時にユーザーが設定していた目標摂取カロリー
            $KcalPardayAtThatTime = ceil ($user->kcalParday);
            //摂取したグラム
            $eatNet = $request->net;
            //摂取した食品タイプ
            $type = $eatmeal->type;

            }
            elseif( isset($eatmeal->piece) ){

            //摂取した量に対しての炭水化物
            $name = $eatmeal->name;
            //摂取した量に対してのカロリー
            $eatKcal = ceil ($eatmeal->kcal / $eatmeal->piece * $request->net);
            //摂取した量に対してのタンパク質
            $eatProtain = ceil ($eatmeal->protain / $eatmeal->piece * $request->net);
            //摂取した量に対しての脂質
            $eatFat = ceil ($eatmeal->fat / $eatmeal->piece * $request->net);
            //摂取した量に対しての炭水化物
            $eatCarbo = ceil ($eatmeal->carbo / $eatmeal->piece * $request->net);
            //摂取した量に対してかかった金額
            $eatPrice = ceil ($eatmeal->price / $eatmeal->piece * $request->net);
            //摂取していた時にユーザーが設定していた目標摂取カロリー
            $KcalPardayAtThatTime = ceil ($user->kcalParday);
            //摂取したグラム
            $eatNet = $request->net;
            //摂取した食品タイプ
            $type = $eatmeal->type;


            }
            

            //プロテインタスクに保存
            $user->eats()->create([

                'name' => $name,
                'eatKcal' => $eatKcal,
                'eatProtain' => $eatProtain,
                'eatCarbo' => $eatCarbo,
                'eatFat' => $eatFat,
                'eatNet' => $eatNet,
                'eatPrice' => $eatPrice,
                'KcalPardayAtThatTime' => $KcalPardayAtThatTime,
                'type' => $type,
                
            ]);

            return redirect()->route('users.show');



        }

    

    public function setting(Request $request)
        {

            //ログインユーザーのid取得
            $id = Auth::id();
            //ログインユーザーのidでユーザーを取得
            $user = User::find($id);

            //プロテインタスクに保存
            $user->meals()->create([

                'name' => $request->name,
                'price' => $request->price,
                'kcal' => $request->kcal,
                'protain' => $request->protain,
                'fat' => $request->fat,
                'carbo' => $request->carbo,

                'piece' => $request->piece,
                'gram' => $request->gram,
                'type' => $request->type,
                
            ]);

            return redirect()->route('users.show');



        }


        public function mealsdetroy(Request $request ,$id)
        {
            
            $user = \Auth::user();

            $deleteMeal = $user->meals()->find($id);

            $deleteMeal->delete();
    
            return redirect()->route('mealssetting.setting');
        }


        public function destroy(Request $request)
        {
            
            
            
            $meal = $request->input();

            

            $delete = array_keys($meal);
            $id = $delete[1];

            $user = \Auth::user();

            $deleteEats = $user->eats()->find($id);

            $deleteEats->delete();
    
            return back();
        }







}
