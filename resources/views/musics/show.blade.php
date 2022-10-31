<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initisal-scale=1">
        <title>Music Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href={{asset("css/show.css") }}> 
    </head>
    <body>
        <x-app-layout>
        <h1 class="bg-red-200 text-green-700">曲レビュー (Music Review)</h1>
        <div class='music'>
            <div class='song'>
            <h2 class="song">曲名 (song) : {{ $music->song_title }}</h2>
            </div>
            <div class='singer'>
            <h3>歌手 (singer) : {{ $music->singer }} </h3>
            <p>{{ $music->created_at->diffForHumans() }}</p>
            </div>
            <div class='tags'>
                @foreach ($music->tags as $tag)
                <p>{{ $tag->name }}</p>
                @endforeach
                <form action="/musics/tag/{{ $music->id }}" method="POST">
                    <h3 class = "add hashtags">ハッシュタグの追加</h3>
                        @csrf
                        <input type="text" name="hashtag[name]" placeholder="#〇〇〇"/>
                        <p>＃をつけて検索してください</p>
                        <input type="submit" value="登録(store)"/>
                </form>
            </div>
        </div>
        <a href='/musics/{{ $music->id }}/review'>レビュー投稿 (Review)</a>
        <div class='posts'>
            <h2>投稿一覧 (Review)</h2>
            @foreach ($posts as $post)
            <p class='post_who'>{{ Auth::user()->name }}</p>
            <p class='post'>{{ $post->review }} <p>{{ $music->created_at->diffForHumans() }}</p></p>
                @if($post->users()->where('user_id', Auth::id())->exists())
                    <div class="col-md-3">
                        <form action="/bad/{{ $music->id }}/{{ $post->id }}" method="POST">
                             @csrf
                            <input type="submit" value="&#xf164;いいね取り消す" class="fas btn btn-danger">
                        </form>
                     </div>
                @else
                    <div class="col-md-3">
                        <form action="/good/{{ $music->id }}/{{ $post->id }}"  method="POST">
                        @csrf
                        <input type="submit" value="&#xf164;いいね" class="fas btn btn-success">
                      </form>
                     </div>
                @endif
                <div class="row justify-content-center">
                    <p>いいね数：{{ $post->users()->count() }}</p>
                </div>
                    <a href='/musics/{{ $music->id }}/{{ $post->id }}'><i class="fa-regular fa-comment"></i>返信 (Reply)</a>
                    @if(auth()->id() == $post->user_id)
                    <p class="edit">[<a href="/musics/{{ $post->id }}/edit">編集 (edit)</a>]</p>
                    <form action="/musics/{{ $post->id }}/{{ $music->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">削除 (delete)</button>
                    </form>
                    @endif
                </div>
            @endforeach
        </div>
        <div class='paginate'>{{ $posts->links() }}</div>
        <div class="footer">
            <a href="/search">検索画面へ (search)</a>
        </div>
        <script>
            function deletePost(id) {
                'use strict'
                
                if(confirm('削除すると復元できません。\n本当に削除しますか？')){
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        </x-app-layout>
    </body>
</html>