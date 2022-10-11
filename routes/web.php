<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\PostController;

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

Route::post('/search', [MusicContoller::class, 'search']);   //今日検索画面
Route::get('/musics', [MusicController::class, 'index']);   //曲検索結果表示
Route::get('/musics/create', [MusicController::class, 'create']);   //新規曲登録入力画面
Route::post('/musics', [MusicController::class, 'store']);      //新規曲登録保存
Route::get('/musics/{music}/create', [PostController::class, 'create']);   //曲レビュー投稿ページ
//Route::get('/musics/{music}/')
Route::put('/musics/{music}', [PostController::class, 'update']);      //曲レビュー編集更新ページ
Route::get('/musics/{music}', [MusicController::class, 'show']);    //曲詳細・レビュー一覧ページ
Route::post('/musics/{music}', [PostController::class, 'store']);   //曲編集アップデート
Route::get('/posts');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
