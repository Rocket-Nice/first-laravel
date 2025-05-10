<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        // 'email',
        // Add any other fields that should be mass assignable
    ];
}
