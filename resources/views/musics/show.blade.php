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
        <h3>歌手 (singer) : {{ $music->singer }} </h3>
        </div>
        <a href='/musics/{{ $music->id }}/review'>レビュー投稿 (Review)</a>
        <div class='posts'>
            <h2>レビュー (Review)</h2>
            @foreach ($posts as $post)
                <div class='post'>
                    <p class='review'>{{ $post->review }}</p>
                    @if(auth()->id() == $post->user_id)
                    <form action="musics/{{ $music->id }}/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
                    </form>
                    @endif
                    <a href='/musics/{{ $music->id }}/{{ $post->id }}'>返信 (Reply)</a>
                </div>
            @endforeach
        </div>
        <div class='paginate'>{{ $posts->links() }}</div>
        <div class="footer">
            <a href="/search">戻る (back)</a>
        </div>
        <script>
            function deletePost(id) {
                'use strict'
                
                if(confirm('削除すると復元できません。\n本当に削除しますか？')){
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        
    </body>
</html>