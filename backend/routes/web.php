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
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        // ログイン処理
        Route::post('login', [LoginController::class, 'login'])->name('login.post');
        // ログアウトボタン
        Route::get('logout', [LoginController::class, 'logout'])->name('logout.get');
        

/*-----------------------------------------------------------------------------------------
    体重測定機能
-----------------------------------------------------------------------------------------*/


    //作品をアップロードする処理のルーティング
    Route::post('/weightpost', [WeightController::class, 'upload'])->name('weight.post');
    //作品の詳細ページを表示するページ
    Route::put('/artist/work/{id}', [WorksController::class, 'update'])->name('work.update');

 
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
