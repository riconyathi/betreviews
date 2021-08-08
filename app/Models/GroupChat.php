<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','group_id','message','media'
    ];

    public function users()
    {
    return $this->belongsTo(User::class);

    }

    public function groups()
    {
    return $this->belongsTo(Group::class);

    }
}
