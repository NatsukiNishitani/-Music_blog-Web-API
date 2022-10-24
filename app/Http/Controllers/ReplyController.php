<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Reply;
use App\Models\Music;
use App\Models\Review;

class ReplyController extends Controller
{
    public function reply(Music $music, Post $post, Reply $reply){
        return view('posts/reply')->with(['music' => $music,'post' => $post, 'reply' => $reply]);
    }
    
    public function store(Request $request,Music $music,Post $post)
    {   
        
        $reply = new Reply;
        $input = $request['reply'];
        $input += ['user_id' => $request->user()->id];
        $input += ['post_id' => $post];
        $reply->fill($input)->save();
        return redirect('/musics/'.$music.'/'.$post);
    }
    
    
}
