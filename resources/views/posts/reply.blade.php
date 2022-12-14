<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Music Blog</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" /><meta charset="utf-8">
    </head>
    <body>
        <h1>{{ Auth::user()->name }}さんコメント</h1>
        <p class="post">{{ $post->review }}</p>
        <p>いいね数：{{ $post->users()->count() }}</p>
        <form action="/musics/{{ $music->id }}/{{ $post->id}}" method="POST">
            @csrf
            <div class="reply">
                <h2>コメント Reply</h2>
                <textarea name="reply[comment]" placeholder="コメント，返事">{{ old('reply.comment') }}</textarea>
                <p class="comment__error" style="color:red">{{ $errors->first('reply.comment') }}</p>
            </div>
            <input type="hidden" name="reply[post_id]" value={{ $post->id }} readonly></input>
            <input type="hidden" name="reply[user_id]" value={{ Auth::user()->id }} readonly></input>
            <input type="submit" value="store"/>
        </form>
            <div class='reply_detail_index'>
                @foreach($replies as $reply)
                <p class="replies">{{ $reply->comment }}
                    <p>{{ $music->created_at->diffForHumans() }}</p>
                </p>
                    @if($reply->users()->where('user_id', Auth::id())->exists())
                        <div class="col-md-3">
                            <form action="/unlike/{{ $music->id }}/{{ $reply->id }}/" method="POST">
                                 @csrf
                                <input type="submit" value="&#xf164;いいね取り消す" class="fas btn btn-danger">
                            </form>
                         </div>
                    @else
                        <div class="col-md-3">
                            <form action="/like/{{ $music->id }}/{{ $reply->id }}/"  method="POST">
                            @csrf
                            <input type="submit" value="&#xf164;いいね" class="fas btn btn-success">
                          </form>
                         </div>
                    @endif
                    <div class="row justify-content-center">
                        <p>いいね数：{{ $reply->users()->count() }}</p>
                    </div>
                    @if(auth()->id() == $reply->user_id)
                        <form action="/reply/{{ $post->id }}/{{ $reply->id }}" id="form_{{ $reply->id }}" method="post">
                            <p class="edit">[<a href="/musics/{{ $post->id }}/edit">編集 (edit)</a>]</p>
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePost({{ $reply->id }})">削除 delete</button>
                        </form>
                    @endif
                    </p>
                @endforeach
            </div>
            <div class='paginate'>
                {{ $replies->links() }}
            </div>
            <script>
                function deletePost(id) {
                    'use strict'

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                    }
                 }
            </script>
        <div class="footer">
            <a href="/musics/{{ $music->id }}">戻る (back)</a>
        </div>
    </body>
</html>