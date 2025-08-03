<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function categories(): BelongsToMany{
        return $this->belongsToMany(Category::class,
            'category_movie',
            'movie_id',
            'category_id'
        );
    }

    protected function title(): Attribute{
        return Attribute::make(
            set: function ($value){
                if (is_numeric($value)){
                    throw new \Exception('Title cannot be numeric');
                }

                return $value;
            }
        );
    }
}
