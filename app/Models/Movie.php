<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug'
    ];

    public function ratings(): HasMany{
        return $this->hasMany(Rating::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'category_movie', 'movie_id', 'category_id');
    }
}
