<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function create(Music $music)
    {
        return view('musics/create')->with(['musics' => $music->get()]);
    }
    
    public function store(Request $request, Music $music)
    {
        //dd(Music::find(1));
        
        //＄変数の格納
        $input_hashtag = $request['hashtag'];
        $input_music = $request['music'];
         //曲の保存
        $music->fill($input_music)->save();
        
        //ハッシュタグ複数登録
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $input_hashtag["name"], $match);
        foreach($match[1] as $input){
            //タグが被らないように保存
            $hashtag = Tag::firstOrCreate([
                'name' => $input
                ]);
                
            //中間テーブルの紐づけ
            $music->tags()->attach($hashtag->id);
        };
        

        return redirect('/musics/'.$music->id);
        
    }
    
    public function index(Music $music,Post $post){
        return view('musics/index')->with(['musics' => $music ->get(), 'posts' => $post->get()]);
        
    }
    
    public function show(Music $music, Post $post){
        return view('musics/show')->with(['music' => $music, 'posts' => $post->paginate(5)]);
        
    }
    
    public function search(Request $request){
        
        $search=$request->input("search");
        if($search){
            $results=Music::whereIn("tag_id", function($query) use($request){
            $query->from("tags")
            ->select("name")
            ->where("name", $request->input("search"));
        })->get();
        return view("musics/search")->with(["results"=>$results]);
    
        dd($results);
        }
        
        return view("musics/search");
        
        
    }
    
}
