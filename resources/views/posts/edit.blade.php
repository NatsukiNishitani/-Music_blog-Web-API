<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>編集画面</title>
    </head>
    <body>
    <h1 class="title">編集画面</h1>
    <div class='review'>
       <form action="/musics/{{ $music->id }}" method="POST">
           @csrf
           @method('PUT')
           <div class='review_edit'>
               <h2>感想 Review</h2>
               <textarea name="post[review]" placeholder="曲の感想・評価・詳細情報"></textarea>
           </div>
           <input type="submit" value="保存 (store)"/>
       </form>
       <div class="footer">
           <a href="/musics/{{ $music->id }}">戻る (back)</a>
       </div>
    </div>
</body>
</html>