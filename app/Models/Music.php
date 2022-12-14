<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;
    
    protected $table = 'musics';
    
    protected $fillable = [
        'song_title',
        'singer',
    ];

    
    public function getByLimit(int $limit_count = 10){
        return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }
    
    
    
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    
    }
    
    
}
