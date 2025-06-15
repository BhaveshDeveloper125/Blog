<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogData extends Model
{
    use HasFactory;
    protected $table = 'blog_data';

    protected $fillable = [
        'image',
        'title',
        'author',
        'content'
    ];
}
