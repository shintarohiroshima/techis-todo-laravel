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

// 「/tasks」というURLと、indexメソッドを結びつけるコード
// [App\Http\Controllers\TaskController::class, 'index' で１つ！
// →Appから１つずつ辿り、どこのindexなのか、場所を表している！
// Routeには、「get」「post」「any」など様々送信方法がある！
// name は名前をつけているレベル
Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');

Route::post('/task', [App\Http\Controllers\TaskController::class, 'store'])->name('task');

// 「/tasks」というURLで、deleteというhttpメソッドの時、タスクコントローラーのdestroyメソッドが呼ばれるようにする
// '/task/{task}'はどこ？？ → https://124997985/task/1 みたいなイメージ！
Route::delete('/task/{task}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('/task/{task}');

// 画面の切り替え GRT
// データを送るときはPOST
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
