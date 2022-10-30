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
        return view('posts/reply')->with(['music' => $music,'post' => $post, 'replies' => $reply->getPaginateByLimit()]);
    }
    
    public function show_reply(Music $music, Reply $reply){
        return view('posts/reply')->with(['music' => $music,'main' => $reply, 'replies' => $reply->get()]);
    }   
    
    public function store(Request $request,Music $music,Post $post)
    {   

        $reply = new Reply;
        $input = $request['reply'];
        $reply->fill($input)->save();
        return redirect('/musics/'.$music->id.'/'.$post->id);
    }
    
    public function delete(Music $music, Post $post)
    {
        $reply->delete();
        return redirect('/musics/'.$music->id.$post->id);
    }
    
    

}

