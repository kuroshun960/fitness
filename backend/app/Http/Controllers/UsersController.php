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

    //今日の体重表示を表示//
    public function show()
    {

        //トップページで見せるものを格納する配列を初期化
        $data = [];

        $todaydate = date("Y-m-d");

        if (\Auth::check()){

            //ログインユーザー//
            $user = \Auth::user();


            //今日の体重//
            $weight = $user->weights()->whereDate('created_at', $todaydate)->first();


            //プロテインタスク//
            $protainTaskFirstcup = $user->protaintasks()->orderBy('created_at', 'desc')->where('cups','firstcup')->first();
            $protainTaskSecondcup = $user->protaintasks()->orderBy('created_at', 'desc')->where('cups','secondcup')->first();
            $protainTaskThirdcup = $user->protaintasks()->orderBy('created_at', 'desc')->where('cups','thirdcup')->first();



            $protainAll =['kcal' => 0,'protain' => 0,'fat' =>0,'carbo' =>0,];

            
            
            if( !is_null($protainTaskFirstcup) ){

                $firstKcal = $protainTaskFirstcup->kcal;
                $firstProtain = $protainTaskFirstcup->protain;
                $firstFat = $protainTaskFirstcup->fat;
                $firstCarbo = $protainTaskFirstcup->carbo;

                $protainAll = ['kcal' => $firstKcal,'protain' => $firstProtain,'fat' => $firstFat,'carbo' => $firstCarbo];
                
                

                if( !is_null($protainTaskSecondcup) ){

                    $secondKcal = $protainTaskFirstcup->kcal + $protainTaskSecondcup->kcal;
                    $secondProtain = $protainTaskFirstcup->protain + $protainTaskSecondcup->protain;
                    $secondFat = $protainTaskFirstcup->fat + $protainTaskSecondcup->fat;
                    $secondCarbo = $protainTaskFirstcup->carbo + $protainTaskSecondcup->carbo;

                    $protainAll = ['kcal' => $secondKcal,'protain' => $secondProtain,'fat' => $secondFat,'carbo' => $secondCarbo];

                    if( !is_null($protainTaskThirdcup) ){

                        $thirdKcal = $protainTaskFirstcup->kcal + $protainTaskSecondcup->kcal + $protainTaskThirdcup->kcal;
                        $thirdProtain = $protainTaskFirstcup->protain + $protainTaskSecondcup->protain + $protainTaskThirdcup->protain;
                        $thirdFat = $protainTaskFirstcup->fat + $protainTaskSecondcup->fat + $protainTaskThirdcup->fat;
                        $thirdCarbo = $protainTaskFirstcup->carbo + $protainTaskSecondcup->carbo + $protainTaskThirdcup->carbo;
    
                        $protainAll = ['kcal' => $thirdKcal,'protain' => $thirdProtain,'fat' => $thirdFat,'carbo' => $thirdCarbo];

                    }
                }
            }
        
            
            
            


            /*
            //プロテインタスク//
            $protainTask = $user->protaintasks()->orderBy('created_at', 'desc')->select('kcal','carbo','protain','fat')->first();

            
            $Kcal = $protainTask;
            $Protain = $protainTask;
            $Carbo = $protainTask;
            $Fat = $protainTask;
            */
            
        }


        $data = [
            'weight' => $weight,
            'protainAll' => $protainAll,
            

            /*
            'Kcal' => $Kcal,
            'Protain' => $Protain,
            'Carbo' => $Carbo,
            'Fat' => $Fat,
            */
        ];

        


        return view('welcome',compact('data'));



        

        
        
    }












}
