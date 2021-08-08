<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','group_id','body','image','slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function setSlugAttribute($value)
    {
        $slug = $value.'-'.auth()->user()->name.'-'.now();
        $this->attributes['slug'] = Str::slug($slug);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function images(){

        return $this->hasMany(Images::class);
    }

    
}
