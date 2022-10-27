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
            <div class="back">[<a href="/">back</a>]</div>
            </div>
        </div>
        
        <div class='result'>
            @if($results)
            @foreach($results as $result)
            <h2>曲：{{ $result->song_title }}</h2>
            <p>歌手：{{ $result->singer }}</p>
            @endforeach
            @else
            <p>曲が見つかりませんでした</p>
            <a href='/musics/create'>新規曲登録 (create)</a>
            @endif
        </div>
    </body>
</html>