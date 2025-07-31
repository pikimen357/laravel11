<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug'
    ];

    public function movies(){
        return $this->belongsToMany(Movie::class, 'category_movie', 'category_id', 'movie_id');
    }

}
