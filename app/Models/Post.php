<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
   

    protected $fillable = [
        'title',
        'content',
        'image',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }


    protected static function booted()
    {
        static::creating(function ($post) {

            if ($post->slug) return;

            $baseSlug = Str::slug($post->title);

            $count = self::where('slug', 'LIKE', "{$baseSlug}%")->count();

            $post->slug = $count ? "{$baseSlug}-{$count}" : $baseSlug;
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->translatedFormat('d F Y');
    }
    
}
