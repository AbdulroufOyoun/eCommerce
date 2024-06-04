<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePromo extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'title',
        'video',
        'is_video'
    ];
}
