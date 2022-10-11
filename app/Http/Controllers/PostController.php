<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view('posts/show')->with(['posts' => $post->getPaginateByLimit()]);
    }
    
    public function create()
    {
        return view('posts/create');
    }
    
    public function store()
    {
        
        dd($request);
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/'.$music->id);
    }
}
