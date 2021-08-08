<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','recipient_id','message','media'
    ];


    public function users()
    {
    return $this->belongsTo(User::class);

    }
}
