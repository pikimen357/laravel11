<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    /** @use HasFactory<\Database\Factories\RatingFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_id',
        'rating',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function movie(): BelongsTo{
        return $this->belongsTo(Movie::class);
    }

    protected function casts(): array{
        return [
            'rating' => 'int',
        ];
    }

    public function rating(): Attribute{
        return Attribute::make(
          set: function ($value){
              if (! is_numeric($value) || $value < 1 || $value > 5){
                  throw new \Exception('Rating berupa angka antara 1 sampai 5');
              }
              return $value;
            }

        );
    }

}
