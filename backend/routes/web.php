<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AUTH\RegisterController;
use App\Http\Controllers\AUTH\LoginController;
use App\Http\Controllers\AUTH\ResetPasswordController;
use App\Http\Controllers\AUTH\VerificationController;
use App\Http\Controllers\AUTH\ForgotPasswordController;
use App\Http\Controllers\AUTH\ConfirmPasswordController;

use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserFollowController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WorksController;
use App\Http\Controllers\WeightsController;
use App\Http\Controllers\ProtainsettingsController;
use App\Http\Controllers\ProtaintasksController;
use App\Http\Controllers\DatesController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\EatsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*--------------------------------------------------------------------------
    ユーザ登録
--------------------------------------------------------------------------*/
    
        // ユーザ登録ページ表示

        Route::get('signup', [RegisterController::class, 'showRegistrationForm'])->name('signup.get');

        // ユーザ登録ページから送られたリクエストの作成処理(create ≒ post ≒ store)
        Route::post('signup', [RegisterController::class, 'register'])->name('signup.post');

/*--------------------------------------------------------------------------
    認証
--------------------------------------------------------------------------*/

        // ログインページ表示
        Route::get('login', [App\Http\Controllers\AUTH\LoginController::class, 'showLoginForm'])->name('login');
        // ログイン処理
        Route::post('login', [LoginController::class, 'login'])->name('login.post');
        // ログアウトボタン
        Route::get('logout', [LoginController::class, 'logout'])->name('logout.get');


/*-----------------------------------------------------------------------------------------
    ログインユーザー情報 (認証付きルート)
-----------------------------------------------------------------------------------------*/

Route::group(['middleware' => ['auth']], function () {
  
    //ログインユーザーの今日の日付と体重を表示
    Route::get('/', [UsersController::class,'show'])->name('users.show');





/*-----------------------------------------------------------------------------------------
    体重測定 機能
-----------------------------------------------------------------------------------------*/

    //送られてきた体重データの処理
    Route::post('weight', [WeightsController::class, 'input'])->name('weight.input');


/*-----------------------------------------------------------------------------------------
    プロテイン設定 機能
-----------------------------------------------------------------------------------------*/

    Route::get('protainsettingpage', [UsersController::class,'protainsettingpage'])->name('protainsettingpage');

    Route::post('protainsettings', [ProtainsettingsController::class,'setting'])->name('protainsettings.setting');

/*-----------------------------------------------------------------------------------------
    ユーザー設定 機能
-----------------------------------------------------------------------------------------*/

    Route::get('personalsettings', [UsersController::class,'personalsettingspage'])->name('personalsettingspage.show');

    Route::post('personalsettings', [UsersController::class,'setting'])->name('personalsettings.setting');

/*-----------------------------------------------------------------------------------------
    食事登録
-----------------------------------------------------------------------------------------*/

    Route::post('mealssetting', [MealsController::class,'setting'])->name('mealssetting.setting');

    Route::get('mealssetting/{id}', [MealsController::class,'updatepage'])->name('mealssetting.updatepage');
    Route::post('mealsupdate/{id}', [MealsController::class,'update'])->name('mealssetting.update');
    Route::delete('mealsdetroy/{id}', [MealsController::class,'mealsdetroy'])->name('meals.detroy');

    Route::get('mealssetting', [MealsController::class,'show'])->name('mealssetting.show');

    Route::get('drinkssetting', [MealsController::class,'drinks'])->name('drinks.show');
    Route::get('snackssetting', [MealsController::class,'snacks'])->name('snacks.show');

    Route::post('eats', [MealsController::class,'eats'])->name('eats');

    Route::post('eatsdelete', [MealsController::class,'destroy'])->name('eats.destroy');

/*-----------------------------------------------------------------------------------------
    活動日誌
-----------------------------------------------------------------------------------------*/

    Route::get('daily', [UsersController::class,'daily'])->name('users.daily');

    Route::get('daily/{id}/', [UsersController::class,'daypage'])->name('users.day');


/*-----------------------------------------------------------------------------------------
    プロテインタスク 機能
-----------------------------------------------------------------------------------------*/

    Route::post('protaintasks', [ProtaintasksController::class,'drank'])->name('protaintasks.drank');







});




/*-----------------------------------------------------------------------------------------
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
-----------------------------------------------------------------------------------------*/

