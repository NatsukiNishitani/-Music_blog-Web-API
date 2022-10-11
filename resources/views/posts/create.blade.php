<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1>Blog Name</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="review">
                <h2>感想 Review</h2>
                <textarea name="post[review]" placeholder="曲の感想・評価・詳細情報"></textarea>
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="footer">
            <a href="/musics/{{ $music->id }}">戻る (back)</a>
        </div>
    </body>
</html>