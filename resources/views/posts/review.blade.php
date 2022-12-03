<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1>Blog Name</h1>
        <form action="/musics/{{ $music->id }}" method="POST">
            @csrf
            <div class="review">
                <h2>感想 Review</h2>
                <textarea name="post[review]" placeholder="曲の感想・評価・詳細情報">{{ old('post.review') }}</textarea>
                <p class="review__error" style="color:red">{{ $errors->first('post.review') }}</p>
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="footer">
            <a href="/musics/{{ $music->id }}">戻る (back)</a>
        </div>
    </body>
</html>