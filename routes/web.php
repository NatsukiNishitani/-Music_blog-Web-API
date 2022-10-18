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

Route::get('/search', [MusicController::class, 'search']);   //曲検索画面、検索結果表示
//Route::get('/musics', [MusicController::class, 'index']);   //曲検索結果表示
Route::get('/musics/create', [MusicController::class, 'create']);   //新規曲登録入力画面
Route::post('/musics', [MusicController::class, 'store']);      //新規曲登録保存
Route::get('/musics/{music}/review', [PostController::class, 'review']);   //曲レビュー投稿ページ,いいね機能、五段階評価
Route::get('/musics/{music}/edit', [PostController::class, 'edit']);
Route::put('/musics/{music}', [PostController::class, 'update']);      //曲レビュー編集更新ページ
Route::get('/musics/{music}', [MusicController::class, 'show']);    //曲詳細・レビュー一覧,いいね機能、五段階評価記載されてる
Route::post('/musics/{music}', [PostController::class, 'store']);   //曲編集アップデート
Route::get('/musics/{music}/{post}', [PostController::class, 'reply']);  //show.bladeに対して返信機能
Route::delete('musics/{music}/{post}', [PostController::class. 'delete']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
