<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'posts';
    protected $quarded = false;
    protected $fillable = [
        'title',
        'content',
        // 'email',
        'image',
        'likes',
        'is_published'
    ];
}
