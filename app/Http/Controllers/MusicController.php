<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Post;
use App\Models\Reply;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;




class MusicController extends Controller
{
    public function create(Music $music)
    {
        return view('musics/create')->with(['musics' => $music->get()]);
    }
    
    
    
    public function store(Request $request, Music $music)
    {
        //＄変数の格納
        $input_hashtag = $request['hashtag'];
        //曲の保存
        $input_music = $request['music'];
        $music->fill($input_music)->save();
        //ハッシュタグ複数登録
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $input_hashtag["name"], $match);
        foreach($match[1] as $input){
            //タグが被らないように保存
            $hashtag = Tag::firstOrCreate([
                'name' =>"#". $input
                ]);
                
            //中間テーブルの紐づけ
            $music->tags()->attach($hashtag->id);
        };
        

        return redirect('/musics/'.$music->id);
        
    }
    
    public function add_hashtag(Request $request, Music $music)
    {
        $hashtag = $request['hashtag'];
        //ハッシュタグ複数登録
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $hashtag["name"], $match);
        foreach($match[1] as $input){
            //タグが被らないように保存
            $hashtag = Tag::firstOrCreate([
                'name' =>"#". $input
                ]);
                
            //中間テーブルの紐づけ
            $music->tags()->attach($hashtag->id);
        };
        

        return redirect('/musics/'.$music->id);
    }
    
    
    public function show(Request $request, Music $music, Post $post, Reply $reply, Tag $tag){
        
        return view('musics/show')->with(['music' => $music, 'posts' => $post->paginate(5),'reply' => $reply, 'tags' => $tag]);
        
        
        

     
    }
    
    
    
    /*public function search(Request $request){
        $keyword = $request->input("search");
        $query = Music::query();
        $musics=Music::all();

        if (isset($keyword)) {
            $musics = Music::whereHas('tags', function ($query) use ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
            })->get();
            
        } else {
            $musics=Music::all();
        }
        
        if (count($musics)==0) {
            return redirect('/musics/create');
        }
        return view('musics/search')->with(['musics' => $musics]);
    }*/
    
    
    public function search(Request $request){
        $keyword = $request->input("search");
        $query = Music::query();

        if (isset($keyword)) {
            $musics = Music::whereHas('tags', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%");
            })->get();
        } else {
            $musics=Music::all();
        } 
        if ($musics->isEmpty()) {
            return redirect('/musics/create');
        }
        return view('musics/search')->with(['musics' => $musics]);
    }
}

