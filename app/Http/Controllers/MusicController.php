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
        //ハッシュタグ複数登録
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request["hashtag"]["name"], $match);
        $tag = Tag::where('name', $match[1][0])->first();
        dd($tag->musics);
        
        
        //＄変数の格納
        $input_hashtag = $request['hashtag'];
        $input_music = $request['music'];
        //タグが被らないように保存
        $hashtag = Tag::firstOrCreate([
            'name' => $input_hashtag['name']
                ]);
        //曲の保存
        $music->fill($input_music)->save();
        //中間テーブルの紐づけ
        $music->tags()->attach($hashtag->id);

        return redirect('/musics/'.$music->id);
        
    }
    
    public function index(Music $music,Post $post){
        return view('musics/index')->with(['musics' => $music ->get(), 'posts' => $post->get()]);
        
    }
    
    public function show(){
        return view('musics/show');
    }
    
    public function search(){
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->tag_name, $match);
        foreach($match[1] as $input)
        {
            //すでにデータがあれば取得し、なければデータを作成する
            $tag=Tag::firstOrCreate(['name'=>$input]);
            //tagを初期化（$tagに配列でデータが入ってしまうため）
            $tag=null;
            //入力されたタグのidを取得
            $tag_id=Tag::where('name', $input)->get(['id']);
            //タグとmusicの紐づけ
            $music=Music::find($music_id);
            $music->tags()->attach($tag_id);
            
        }
        
    }
    
}
