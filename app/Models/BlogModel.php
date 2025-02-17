<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    protected $table = 'blog_user';
    use HasFactory;
    protected $guard = [];
}
