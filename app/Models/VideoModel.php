<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoModel extends Model
{
    protected $table = 'video_user';
    use HasFactory;
    protected $guard = [];
}
