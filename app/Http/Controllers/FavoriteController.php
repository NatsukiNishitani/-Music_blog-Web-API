<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Reply;
use Auth;


class FavoriteController extends Controller
{
    //
    public function post_store($music, Post $post)
    {
        $post->users()->attach(Auth::id());
        
        return redirect('/musics/'. $music);
    
    }
    
    public function post_destroy($music, Post $post)
    {
        $post->users()->detach(Auth::id());
        
        return redirect('/musics/'. $music);
    }
    
    public function reply_store($music, Post $post, Reply $reply)
    {
        $reply->users()->attach(Auth::id());
        
        return redirect('/musics/'. $music. '/'.$reply->post_id);
    }
    
    public function reply_destroy($music,Post $post, Reply $reply)
    {
        $reply->users()->detach(Auth::id());
        
        return redirect('/musics/'. $music. '/'.$reply->post_id);
    }
}
