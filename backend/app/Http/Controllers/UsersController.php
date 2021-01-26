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

        
        $date = [];

        $todaydate = date("Y-m-d");

        if (\Auth::check()){

            //ログインユーザー//
            $user = \Auth::user();


            //ログインユーザーの今日の体重をひとつだけ取得//
            $weight = $user->weights()->whereDate('created_at', $todaydate)->first();

        }

        //取得した体重をビューに渡す
        return view('welcome',compact('weight'));
        

        
    }


}
