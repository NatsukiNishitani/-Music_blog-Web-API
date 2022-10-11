<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initisal-scale=1">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>曲レビュー (Music Review)</h1>
        <div class='song'>
        <h2 class="song">曲名 (song) : {{ $music->song_title }}</h2>
        </div>
        <div class='singer'>
        <h3>歌手 (singer) : {{ $music->singer}} </h3>
        </div>
        <a href='/posts/create'>レビュー投稿 (Review)</a>
        <div class='posts'>
            <h2>レビュー (Review)</h2>
            @foreach ($music->reviews as $post)
                <div class='post'>
                    <p class='review'>{{ $post->review }}</p>
                    <a href='/posts/create'>レビュー投稿 (Review)</a>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
        <div class="footer">
            <a href"/search">戻る (back)</a>
        </div>
    </body>
</html>