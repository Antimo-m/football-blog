<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $fillable = ['name', 'color'];
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
