<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = "posts";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
  
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}