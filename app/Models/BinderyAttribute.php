<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BinderyAttribute extends Model
{
    use HasFactory,HasUuids,SoftDeletes;

    protected $fillable = [
        'admin_id',
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($model) {
            $model->setSuperAttribute();
        });

    }

    public function setSuperAttribute()
    {
        $this->attributes['admin_id'] = \auth('Admin')->user()->id;
    }

    public function Admin():BelongsTo{
        return $this->belongsTo(Admin::class,'admin_id');
    }
}
