<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Music　Search</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class='musics'>
            <form action="/musics" method="POST">
                @csrf
                <div class='music'>
                    <h1>曲投稿（music upload）</h1>
                        <h2 class='Song title'>曲名（song title）</h2>
                            <input type="text" name="music[song_title]" placeholder="songs" value="{{ old('music.song_title') }}"/>
                            <p class="song_title_error" style="color:red">{{ $errors->first('music.song_title') }}</p>
                        <h2 class='singer'>歌手(singer)</h2>
                            <input type="text" name="music[singer]" placeholder="singers" value="{{ old('music.singer') }}"/>
                            <p class="singer_error" style="color:red">{{ $errors->first('music.singer') }}</p>
                        <P class='hashtags'>#ハッシュタグ(tag)</p>  
                        <input type="text" name="hashtag[name]" placeholder="#〇〇〇" value="{{ old('hashtag.name') }}"/>
                        <p class="tag_error" style="color:red">{{ $errors->first('hashtag.name') }}</p>
                        <p>ハッシュタグ＃をつけて検索してください</p> 
                </div>
                <input type="submit" value="登録(store)"/>
            </form>
            <div class="back">[<a href="/">back</a>]</div>
            </div>
        </div>
    </body>
</html>