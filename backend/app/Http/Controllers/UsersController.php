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

    public function show()
    {

        $date = [];


        if (\Auth::check()){

            //ログインユーザー//
            $user = \Auth::user();

            //ログインユーザーの今日の日付//
            $dates = $user->dates()->get();

            

       


            //今日の日付//
            $today = date("Y-m-d");
            

            $date = [
                'dates' => $dates,
                // 'todayweights' => $todayweights, //
            ];
        }

 

        return view('welcome', $date);

        

    }


}
