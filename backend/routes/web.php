<?php

use Illuminate\Support\Facades\Route;

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
