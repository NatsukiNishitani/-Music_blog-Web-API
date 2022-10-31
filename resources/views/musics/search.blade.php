<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Music</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class='musics'>
            <form action="/search" method="GET">
                @csrf
                <input type="search" name="search">
                <input type="submit" value="検索(search)"/>
            </form>
            </div>
        </div>
        
        <div class='result'>
            @if(isset($musics))
            @foreach($musics as $music)
            <a href='/musics/{{ $music->id }}'><h2>曲：{{ $music->song_title }}</h2></a>
            <p>歌手：{{ $music->singer }}</p>
            <p>{{ $music->created_at->diffForHumans() }}</p>
            @endforeach
            @else
            <p>曲が見つかりませんでした</p>
            <a href='/musics/create'>新規曲登録 (create)</a>
            @endif
        </div>
    </body>
</html>