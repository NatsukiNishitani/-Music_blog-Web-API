<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\FavoriteController;

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
Route::get('/musics/create', [MusicController::class, 'create']);   //新規曲登録入力画面
Route::post('/musics', [MusicController::class, 'store']);      //新規曲登録保存
Route::get('/musics/{music}/review', [PostController::class, 'review']);   //曲レビュー投稿ページ,いいね機能、五段階評価
Route::get('/musics/{music}/edit', [PostController::class, 'edit']);
Route::put('/musics/{post}', [PostController::class, 'update']);      //曲レビュー編集更新ページ
Route::get('/musics/{music}', [MusicController::class, 'show']);    //曲詳細・レビュー一覧,いいね機能、五段階評価記載されてる

Route::post('/musics/{music}', [PostController::class, 'store']);   //曲編集アップデート
Route::get('/musics/{music}/{post}', [ReplyController::class, 'reply']);  //show.bladeに対して返信機能
Route::get('/replies/{music}/{reply}', [ReplyController::class, 'show_reply']);
Route::post('/musics/{music}/{post}', [ReplyController::class, 'store']);
Route::delete('/musics/{post}/{music}', [PostController::class, 'delete']);
Route::post('/good/{music}/{post}', [FavoriteController::class, 'post_store']);
Route::post('/bad/{music}/{post}', [FavoriteController::class, 'post_destroy']);
Route::post('/like/{music}/{reply}/', [FavoriteController::class, 'reply_store']);
Route::post('/unlike/{music}/{reply}/', [FavoriteController::class, 'reply_destroy']);
Route::delete('/musics/{music}/{post}', [ReplyController::class, 'delete']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
