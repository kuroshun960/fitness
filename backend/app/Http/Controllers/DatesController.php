<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Weight;
use App\Models\Date;

use Illuminate\Support\Facades\Auth; 

class DatesController extends Controller
{

/*--------------------------------------------------------------------------
    日付を入力
--------------------------------------------------------------------------*/
        
    public function input(Request $request)
    {
        
        $id = Auth::id();

        $user = User::find($id);

        $userdate = $user->dates()->create([
            'date' => $request->number,
        ]);


        return redirect('/');
        

/*--------------------------------------------------------------------------

        //受け取ったid情報を変数に格納して、タグ生成ページへ又貸し。
        $artistId = Artist::findOrFail($id);
        
        
        $artistTags = Artist::findOrFail($id)->tags()->get();

        
        return view('welcome',compact('test_1'));

--------------------------------------------------------------------------*/
    

    }





}
