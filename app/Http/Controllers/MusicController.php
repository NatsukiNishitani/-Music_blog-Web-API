<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Post;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function create(Music $music)
    {
        return view('musics/create')->with(['musics' => $music->get()]);
    }
    
    public function store(Request $request, Music $music)
    {
        $input = $request['music'];
        $music -> fill($input)->save();
        return redirect('/musics/'.$music->id);
    }
    
    public function index(Music $music){
        return view('musics/index')->with(['musics' => $music ->get()]);
    }
    
    public function show(){
        return view('musics/show');
    }
}
