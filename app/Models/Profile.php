<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
    ];

    protected function casts(): array{
        return [
            'phone' => 'string',
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
