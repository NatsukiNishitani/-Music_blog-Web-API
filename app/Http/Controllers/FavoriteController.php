<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;


class FavoriteController extends Controller
{
    //
    public function store($music, Post $post)
    {
        $post->users()->attach(Auth::id());
        
        return redirect('/musics/'. $music);
    
    }
    
    public function destroy($music, Post $post)
    {
        $post->users()->detach(Auth::id());
        
        return redirect('/musics/'. $music);
    }
}
