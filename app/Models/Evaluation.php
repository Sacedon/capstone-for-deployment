<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluator_id',
        'user_id',
        'rating_1a',
        'rating_2a',
        'rating_3a',
        'rating_4a',
        'rating_5a',
        'rating_6a',
        'rating_7a',
        'rating_8a',
        'rating_9a',
        'rating_10a',
        'rating_1b',
        'rating_2b',
        'rating_3b',
        'rating_4b',
        'rating_5b',
        'rating_6b',
        'rating_7b',
        'rating_8b',
        'rating_9b',
        'rating_10b',
        'rating_1c',
        'rating_2c',
        'rating_3c',
        'rating_4c',
        'rating_5c',
        'rating_6c',
        'rating_7c',
        'rating_8c',
        'rating_9c',
        'rating_10c',
        'rating_1d',
        'rating_2d',
        'rating_3d',
        'rating_4d',
        'rating_5d',
        'rating_6d',
        'rating_7d',
        'rating_8d',
        'rating_9d',
        'rating_10d',
        'comments_a',
        'comments_b',
        'comments_c',
        'comments_d',
        'overall_rating',
        'submitted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
