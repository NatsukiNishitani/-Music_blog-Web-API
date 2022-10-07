<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Song Blog</h1>
        <div class='musics'>
            <div class='music'>
                <h2 class='music_title'>曲名 (songs)</h2>
                <p class='music_singer'>歌手 (singer)</p>
                <p class='hashtags'>ハッシュタグ</p>
                <div>
                    @foreach($musics as $music )
                        @foreach($music->tags as $music_tag)
                                
                            <span class="badge badge-pill badge-info">{{$music_tag->name}}</span>
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class='posts'>
                @foreach ($posts as $post)
                    <div class='post'>
                        <h2 class='review'>感想 (review)</h2>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>