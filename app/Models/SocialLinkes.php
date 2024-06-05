<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLinkes extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'link',
        'social_id',
    ];
}
