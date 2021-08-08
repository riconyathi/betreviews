<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'path','group_id'
    ];

    public function group(){

        return $this->belongsTo(Group::class);
    }
}
