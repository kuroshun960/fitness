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




    public function updatepage($id)
    {
        $user = \Auth::user();
        $meal = $user->meals()->find($id);
        
        $users_controller = app()->make('App\Http\Controllers\UsersController');
        $userAlldata = $users_controller->show();
        $data = $userAlldata['data'];

        return view('meal-update',compact('data','meal'));
    }

    public function update(Request $request ,$id)
    {
        
        //dd($request->file_name);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'kcal' => 'required|numeric',
            'protain' => 'required|numeric',
            'fat' => 'required|numeric',
            'carbo' => 'required|numeric',
            'gram' => 'numeric',
            'carbo' => 'required|numeric',

            'file_name' => ['file','mimes:jpeg,png,jpg,bmb','max:2048'],
 
        ]);

        $user = \Auth::user();

        $path = $user->meals()->find($id)->item_photo_path;

        if( isset($request->file_name) ){
        $upload_info = Storage::disk('s3')->putFile('/meals', $request->file('file_name'), 'public');

        $path = Storage::disk('s3')->url($upload_info);
        }
            
        

        $user->meals()->find($id)->update([

            'name' => $request->name,
            'price' => $request->price,
            'kcal' => $request->kcal,
            'protain' => $request->protain,
            'fat' => $request->fat,
            'carbo' => $request->carbo,
            'item_photo_path' => $path,
            'piece' => $request->piece,
            'gram' => $request->gram,
            'type' => $request->type,
            
        ]);

        return redirect()->route('users.show');
    }



    public function eats(Request $request)
        {

            $request->validate([
                'net' => 'required|numeric',
            ]);

            
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

            $request->validate([
                'name' => 'required|max:20',
                //'gram' => 'required|max:4',
                //'piece' => 'required|max:5',　
                'price' => 'required|numeric',
                'kcal' => 'required|numeric',
                'gram' => 'numeric',
                'protain' => 'required|numeric',
                'fat' => 'required|numeric',
                'carbo' => 'required|numeric',
                'file_name' => ['file','mimes:jpeg,png,jpg,bmb','max:2048'],
            ]);



            //ログインユーザーのid取得
            $id = Auth::id();
            //ログインユーザーのidでユーザーを取得
            $user = User::find($id);

            $path = null;

            if( isset($request->file_name) ){
                $upload_info = Storage::disk('s3')->putFile('/meals', $request->file('file_name'), 'public');
                $path = Storage::disk('s3')->url($upload_info);
                }
                

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
                'item_photo_path' => $path,
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



/*--------------------------------------------------------------------------
    アーティスト画像をS3にアップロードする処理
--------------------------------------------------------------------------*/

public function upload(Request $request)
    {        
        
        
        //名前と説明文のバリデーション
        
        $request->validate([
            'name' => 'required|max:20',
            'description' => 'required|max:255',
        ]);
        
        
        // 画像のアップ形式のバリデーション
        $this->validate($request, [
            'file' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ]
        ]);
        

        if ($request->file('file')->isValid([])) {
            
            //バリデーションを正常に通過した時の処理
            //S3へのファイルアップロード処理の時の情報を変数$upload_infoに格納する
            $upload_info = Storage::disk('s3')->putFile('/test', $request->file('file'), 'public');
            
            //S3へのファイルアップロード処理の時の情報が格納された変数を用いてアップロードされた画像へのリンクURLを変数に格納する
            $path = Storage::disk('s3')->url($upload_info);
            
            //現在ログイン中のユーザIDを変数$user_idに格納する
            $user_id = Auth::id();
            
            //モデルクラスのインスタンスを作成し、変数に格納
            $new_artist_data = new Artist();
            
            //このインスタンスを、”ログインユーザーが作成したインスタンス”として結びつける。
            $new_artist_data->user_id = $user_id;
            
            /*
            プロパティ(静的メソッド)に
            1.変数$pathに格納されている内容、
            2.$requestのnameの値
            3.$requestのdescriptionの値　を格納する
            */
            $new_artist_data->path = $path;
            $new_artist_data->name = $request->name;
            $new_artist_data->description = $request->description;
            $new_artist_data->style = $request->style;
            $new_artist_data->officialHp = $request->officialHp;
            $new_artist_data->twitter = $request->twitter;
            $new_artist_data->insta = $request->insta;
            
            //インスタンスの内容をDBのテーブルに保存する
            $new_artist_data->save();
            

            /* 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
            $request->user()->artist()->create([
            'name' => $request->name,
            'description' => $request->description,
            'path' => $path->path,
            ]);
            */

            return redirect('/');
            
        }else{
            //バリデーションではじかれた時の処理
            return redirect('/upload/image');
        }
        
        
    }
    




}
