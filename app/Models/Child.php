<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'birthdate', 'user_id'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
