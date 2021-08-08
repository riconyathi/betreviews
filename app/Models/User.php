<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use App\Models\Post;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'slug',
        'surname'
    ];

    protected $guard_name = 'api';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post()
    {
        return $this->hasMany(Post::class);
    }
    public function groupPost()
    {
        return $this->hasMany(GroupPost::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function chat()
    {
        return $this->hasMany(Chat::class);
    }

    public function groupChat()
    {
        return $this->hasMany(GroupChat::class);
    }

    public function followers()
    {
        return $this->hasMany(Following::class);
    }
    public function replies()
    {
        return $this->hasMany(Replies::class);
    }
    public function profile()
    {
        return $this->hasMany(ProfileImage::class);
    }


    public function setSlugAttribute($value)
    {
        $slug = $value.'-'.now();

        $this->attributes['slug'] = Str::slug($slug);
       
    }
}
