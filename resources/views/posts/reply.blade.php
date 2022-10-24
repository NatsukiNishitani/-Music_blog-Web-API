<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1>Blog Name</h1>
        <p class="post">{{ $post->review }}</p>
        <form action="/musics/{{ $music->id }}/{{ $post->id}}" method="POST">
            @csrf
            <div class="reply">
                <h2>コメント Reply</h2>
                <textarea name="reply[comment]" placeholder="コメント，返事"></textarea>
            </div>
            <input type="submit" value="store"/>
        </form>
            <div class='reply_index'>
                <p class='reply'>{{ $reply->comment }}</p>
                @if(auth()->id() == $reply->user_id)
                    <form action="/musics/{{ $post->id }}/{{ $music->id }}/{{ $reply->id }}" id="form_{{ $reply->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $reply->id }})">delete</button>
                    </form>
                @endif
            </div>
        <div class="footer">
            <a href="/musics/{{ $music->id }}">戻る (back)</a>
        </div>
    </body>
</html>