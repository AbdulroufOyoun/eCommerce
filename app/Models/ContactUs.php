<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ContactUs extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'message',
    ];
}
