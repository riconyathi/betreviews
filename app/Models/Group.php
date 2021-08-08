<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug','about'
    ];  

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function posts(){
        return $this->hasMany(post::class);
    }

    public function setSlugAttribute($value)
    {
        $slug = $value.'-'.auth()->user()->name.'-'.now();

        $this->attributes['slug'] = Str::slug($slug);
    }

    public function profile()
    {
        return $this->hasMany(GroupImage::class);
    }
}
