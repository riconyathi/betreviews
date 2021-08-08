<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','comment_id','reply','image'
    ];

    public function comment()
    {
    return $this->belongsTo(Comment::class);

    }

    public function users()
    {
    return $this->belongsTo(User::class);

    }
}
