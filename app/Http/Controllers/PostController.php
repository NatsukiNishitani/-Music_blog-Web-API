<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Music;
use App\Models\Reply;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view('posts/show')->with(['posts' => $post->getPaginateByLimit()]);
    }
    
    public function review(Music $music)
    {
        return view('posts/review')->with(['music' => $music]);
    }
    
    
    public function store(Request $request, Music $music)
    {
        
        $post = new Post;
        $input = $request['post'];
        $input += ['music_id' => $music->id];
        $input += ['user_id' => $request->user()->id];
        $post->fill($input)->save();
        return redirect('/musics/'.$music->id);
    }
    
    public function edit()
    {
        
    }
    
   
    
    
    public function delete(Post $post, Music $music){
        $post->delete();
        return redirect('/musics/'.$music->id);
    }
}
