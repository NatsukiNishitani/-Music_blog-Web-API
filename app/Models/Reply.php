<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    
    protected $fillable = [
      'comment',
      'post_id',
      'user_id'
    ];
    
    public function users()
    {
      return $this->belogsToMany(User::class);
    }
}
